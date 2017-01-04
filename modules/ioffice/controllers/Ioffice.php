<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// เปลี่ยนชื่อคลาส (Name) ให้เป็นชื่อคอนโทรลเลอร์ อักษาตัวแรกให้เป็นตัวใหญ่
class Ioffice extends Smart_Controller 
{

    public function __construct()
    {
        //public $PAGE;
        parent::__construct();
        // ตรวจสอบการเข้าสู่ระบบ ถ้ายังไม่เข้าสู่ระบบให้กลับไปที่หน้า login
        if (!isset($_SESSION['username'])) {
            redirect(base_url());
        }
        // จบ ตรวจสอบการเข้าสู่ระบบ
        // ตรวจสอบสิทธิ์การใช้งานเมนู
        $res_permission = $this->systemmodel->get_menulink_permission($this->session->person_id);
        if (!in_array($this->uri->segment(1) . '/' . $this->uri->segment(2), $res_permission)) {
            redirect(base_url() . 'index.php/member/nopermission');
        }
        // จบ ตรวจสอบสิทธิ์การใช้งานเมนู
        $this->load->library('grocery_CRUD');
        $this->load->library('pagination');
    }

    public function index()
    {
        // หน้าแรกที่จะแสดงเมื่อเข้าสู่โมดูล
        $data = 'member/ready';
        // ส่งัวแปรหน้าแรกที่จะแสดงผลไปแสดงผลในไฟล์แทมเพลต
        $this->load->view('templates/index', $data);
    }

    public function _example_output($output = null)
    {
        // ส่วนแสดงผลใช้กับ grocery crud
        $data['content'] = 'system/grocery_crud';
        $data['output']  = $output;
        $this->load->view('templates/index', $data);
    }

    public function example_grocery_crud()
    {
        // ตัวอย่างการใช้งาน grocery crud
        $crud = new grocery_CRUD();
        $crud->set_table('tabelname')
            ->set_subject('ชื่อรายการ')
            ->columns('field1', 'field2')
            ->display_as('field1', 'ชื่1')
            ->display_as('field2', 'ชื่อ2');
        $crud->fields('field1', 'field2');
        $crud->required_fields('field1', 'field2');
        $output = $crud->render();
        $this->_example_output($output);
    }

    public function book()
    {
        $limit = $this->systemmodel->get_config('book_limit');
        $page = ($this->uri->segment(3) != '')?$this->uri->segment(3):1;
        $this->load->model('IofficeModel');
        $this->load->library('pagination'); // โหลด pagination library
        $config["base_url"] = base_url().'index.php/ioffice/book'; 
        $config['total_rows'] = $this->IofficeModel->getall_book($this->session->person_id); 
        $config["per_page"] = $this->systemmodel->get_config('book_limit');
        $config["uri_segment"] = 3; 
        $config['num_links'] = 9;
        // twitter bootstrap markup 
        /*
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>'; 
        $config['num_tag_close'] = '</li>'; 
        $config['cur_tag_open'] = '<li class="active"><span>'; 
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>'; 
        $config['prev_tag_open'] = '<li>'; 
        $config['prev_tag_close'] = '</li>'; 
        $config['next_tag_open'] = '<li>'; 
        $config['next_tag_close'] = '</li>'; 
        $config['first_link'] = '&laquo;'; 
        $config['prev_link'] = '&lsaquo;'; 
        $config['last_link'] = '&raquo;'; 
        $config['next_link'] = '&rsaquo;'; 
        $config['first_tag_open'] = '<li>'; 
        $config['first_tag_close'] = '</li>'; 
        $config['last_tag_open'] = '<li>'; 
        $config['last_tag_close'] = '</li>';
        */

        $config['use_page_numbers'] = TRUE; // เพื่อให้เลขหน้าในลิงค์ถูกต้อง ให้เซตค่าส่วนนี้เป็น TRUE
        
        $this->pagination->initialize($config);
        //$this->PAGE['member_list'] = $this->model_page->getPageData($page,$per_page); // รายชื่อสมาชิกที่จะนำไปแสดงในหน้านั้น
        //$this->PAGE['pagination'] = $this->pagination->create_links(); // เลขหน้า
        $data = array(
            'content' => 'ioffice/book_select',
            //'data' => $this->IofficeModel->get_book($this->session->person_id),
            'bookstat' => $this->IofficeModel->get_bookstat($this->session->person_id),
            'data' => $this->IofficeModel->getpage_book($this->session->person_id,$limit,$page),
            'pagination' => $this->pagination->create_links()
            );
        $this->load->view('templates/index', $data);
    }

    public function book_insert_form()
    {
        $data['content'] = 'ioffice/book_insert_form';
        $this->load->model('IofficeModel');
        $data['data'] = array(
            'receive_person' => $this->IofficeModel->get_receive_person(),
            'book_person' => $this->IofficeModel->get_book_person(),
            'comment_personid' => $this->IofficeModel->get_last_comment_personid()
            );
        $this->load->view('templates/index', $data);
    }

    public function book_update_form()
    {
        $data['content'] = 'ioffice/book_update_form';
        $this->load->model('IofficeModel');
        $data['data'] = array(
            'book' => $this->IofficeModel->get_book_byid($this->uri->segment(3)),
            'receive_person' => $this->IofficeModel->get_receive_person(),
            'book_person' => $this->IofficeModel->get_book_person(),
            'bookfile' => $this->IofficeModel->get_bookfile($this->uri->segment(3))
            );
        $this->load->view('templates/index', $data);
    }

    public function book_comment_form()
    {
        $data['content'] = 'ioffice/book_comment_form';
        $this->load->model('IofficeModel');
        $data['data'] = array(
            'book' => $this->IofficeModel->get_book_byid($this->uri->segment(3)),
            'receive_person' => $this->IofficeModel->get_receive_person(),
            'book_person' => $this->IofficeModel->get_book_person(),
            'bookfile' => $this->IofficeModel->get_bookfile($this->uri->segment(3)),
            );
        $this->load->view('templates/index', $data);
    }

    public function book2_comment_form()
    {
        $data['content'] = 'ioffice/book2_comment_form';
        $this->load->model('IofficeModel');
        $data['data'] = array(
            'book' => $this->IofficeModel->get_book2_byid($this->uri->segment(3)),
            'receive_person' => $this->IofficeModel->get_receive_person(),
            'book_person' => $this->IofficeModel->get_book_person(),
            'bookfile' => $this->IofficeModel->get_bookfile($this->uri->segment(3)),
            );
        $this->load->view('templates/index', $data);
    }

    public function book_insert()
    {
        $this->load->model('IofficeModel');
        $arr = array(
                    'booktypeid' => $this->input->post('booktypeid'),
                    'bookstatusid' => $this->input->post('bookstatusid'),
                    'bookheader' => $this->input->post('bookheader'),
                    'bookreceive' => $this->input->post('bookreceive'),
                    'bookdetail' => $this->input->post('bookdetail'),
                    'post_personid' => $this->input->post('post_personid'),
                    'comment_personid' => $this->input->post('comment_personid')
                    );
        $bookid = $this->IofficeModel->book_insert($arr);
        // กรณีกดปุ่มบันทึกพร้อมเสนอ ทำการสร้างรายการเสนอ
        if($this->input->post('bookstatusid')==2)
        {
           $arr = array(
                'bookid' => $bookid,
                'bookstatusid' => 2,
                'post_personid' => $this->input->post('post_personid'),
                'comment_personid' => $this->input->post('comment_personid')
            );
            $this->IofficeModel->book_comment_insert($arr);
        }
        // Upload File
        $target_dir = "./assets/uploads/ioffice/bookfile/";
        $file_no = 0;
        for($j=0;$j<count($_FILES['UploadedFile']['tmp_name']);$j++) {
            if(!empty($_FILES['UploadedFile']['tmp_name'][$j])) {
                ++$file_no;
                $target_file = $target_dir . basename($_FILES["UploadedFile"]["name"][$j]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                //$sql = "SELECT COUNT(fileid) AS countfile FROM ioffice_bookfile WHERE bookid=$bookid";
                //$result = mysqli_query($connect, $sql);
                //$row = mysqli_fetch_assoc($result);
                $fnum = $this->IofficeModel->get_bookfile_count($bookid);
                $fnum = $fnum + 1;
                $rename_file = $target_dir . $bookid . '-' . $fnum . '-' .round(microtime(true)) . '.' . strtolower($imageFileType);
                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["UploadedFile"]["tmp_name"][$j]);
                    if($check !== false) {
                        //echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        //echo "File is not an image.";
                        $uploadOk = 0;
                    }
                }
                // Check if file already exists
                if (file_exists($rename_file)) {
                    //echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }
                // Check file size
                if ($_FILES["UploadedFile"]["size"][$j] > 500000) {
                    //echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                $imageFileType = strtolower($imageFileType);
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" && $imageFileType != "pdf"  && $imageFileType != "doc"
                && $imageFileType != "docs" && $imageFileType != "xls" && $imageFileType != "xlsx"
                && $imageFileType != "ppt" && $imageFileType != "pptx" && $imageFileType != "zip"
                && $imageFileType != "rar" ) {
                    //echo "Sorry, files type are allowed.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    //echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["UploadedFile"]["tmp_name"][$j], $rename_file)) {
                        //echo "The file ". basename( $_FILES["UploadedFile"]["name"][$j]). " has been uploaded.";
                        //$sql = "INSERT INTO ioffice_bookfile(bookid,filename,filedesc,filetype) VALUE($bookid,'$rename_file','".$_FILES["UploadedFile"]["name"][$j]."','$imageFileType')";
                        //$result = mysqli_query($connect,$sql);
                        //$this->load->view('upload_success', $data);
                        $arr = array(
                                'bookid' => $bookid,
                                'filename' => $rename_file,
                                'filedesc' => $_FILES["UploadedFile"]["name"][$j],
                                'filetype' => $imageFileType
                                );
                        $this->IofficeModel->bookfile_insert($arr);
                    } else {
                        //echo "Sorry, there was an error uploading your file.";
                    }
                }
            }//if
        }//for
        // End Upload file

        redirect(base_url().'index.php/ioffice/book');

    }

    public function book_update()
    {
        $this->load->model('IofficeModel');
        $arr = array(
                    'booktypeid' => $this->input->post('booktypeid'),
                    'bookstatusid' => $this->input->post('bookstatusid'),
                    'bookheader' => $this->input->post('bookheader'),
                    'bookreceive' => $this->input->post('bookreceive'),
                    'bookdetail' => $this->input->post('bookdetail'),
                    'post_personid' => $this->input->post('post_personid'),
                    'comment_personid' => $this->input->post('comment_personid')
                    );
        $bookid = $this->input->post('bookid');
        $this->IofficeModel->book_update($bookid,$arr);
        // กรณีกดปุ่มบันทึกพร้อมเสนอ ทำการสร้างรายการเสนอ
        if($this->input->post('bookstatusid')==2)
        {
            $arr = array(
                    'bookid' => $bookid,
                    'bookstatusid' => 2,
                    'post_personid' => $this->input->post('post_personid'),
                    'comment_personid' => $this->input->post('comment_personid')
                );
            $this->IofficeModel->book_comment_insert($arr);
        }
        // Upload File
        $target_dir = "./assets/uploads/ioffice/bookfile/";
        $file_no = 0;
        //echo '<script type="text/javascript">swal("'.count($_FILES['UploadedFile']['tmp_name']).'");</script>';
        for($j=0;$j<count($_FILES['UploadedFile']['tmp_name']);$j++) {
            if(!empty($_FILES['UploadedFile']['tmp_name'][$j])) {
                ++$file_no;
                $target_file = $target_dir . basename($_FILES["UploadedFile"]["name"][$j]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                //$sql = "SELECT COUNT(fileid) AS countfile FROM ioffice_bookfile WHERE bookid=$bookid";
                //$result = mysqli_query($connect, $sql);
                //$row = mysqli_fetch_assoc($result);
                $fnum = $this->IofficeModel->get_bookfile_count($bookid);
                $fnum = $fnum + 1;
                $rename_file = $target_dir . $bookid . '-' . $fnum . '-' .round(microtime(true)) . '.' . strtolower($imageFileType);
                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["UploadedFile"]["tmp_name"][$j]);
                    if($check !== false) {
                        //echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        //echo "File is not an image.";
                        $uploadOk = 0;
                    }
                }
                // Check if file already exists
                if (file_exists($rename_file)) {
                    //echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }
                // Check file size
                if ($_FILES["UploadedFile"]["size"][$j] > 500000) {
                    //echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                $imageFileType = strtolower($imageFileType);
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" && $imageFileType != "pdf"  && $imageFileType != "doc"
                && $imageFileType != "docs" && $imageFileType != "xls" && $imageFileType != "xlsx"
                && $imageFileType != "ppt" && $imageFileType != "pptx" && $imageFileType != "zip"
                && $imageFileType != "rar" ) {
                    //echo "Sorry, files type are allowed.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    //echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["UploadedFile"]["tmp_name"][$j], $rename_file)) {
                        //echo "The file ". basename( $_FILES["UploadedFile"]["name"][$j]). " has been uploaded.";
                        //$sql = "INSERT INTO ioffice_bookfile(bookid,filename,filedesc,filetype) VALUE($bookid,'$rename_file','".$_FILES["UploadedFile"]["name"][$j]."','$imageFileType')";
                        //$result = mysqli_query($connect,$sql);
                        //$this->load->view('upload_success', $data);
                        $arr = array(
                                'bookid' => $bookid,
                                'filename' => $rename_file,
                                'filedesc' => $_FILES["UploadedFile"]["name"][$j],
                                'filetype' => $imageFileType
                                );
                        $this->IofficeModel->bookfile_insert($arr);
                    } else {
                        //echo "Sorry, there was an error uploading your file.";
                    }
                }
            }//if
        }//for
        // End Upload file

        redirect(base_url().'index.php/ioffice/book');

    }

    public function del_bookfile($fileid)
    {
        $this->load->model('IofficeModel');
        $this->IofficeModel->del_bookfile($this->uri->segment(4));
        redirect(base_url().'index.php/ioffice/book_update_form/'.$this->uri->segment(3));
    }

    public function set_bookstatus($bookid,$bookstatusid)
    {
        $this->load->model('IofficeModel');
        $arr = array('bookstatusid' => $this->uri->segment(4));
        $this->IofficeModel->set_bookstatus($this->uri->segment(3),$arr);
        redirect(base_url().'index.php/ioffice/book');
    }

    public function book_comment()
    {
        $this->load->model('IofficeModel');
        $data = array(
            'content' => 'ioffice/book_comment',
            'data' => $this->IofficeModel->get_book_comment($this->session->person_id),
            'bookstat' => $this->IofficeModel->get_bookstat($this->session->person_id)
            );
        $this->load->view('templates/index', $data);
    }

    public function book_comment_save()
    {
        $bookstatusid = $this->input->post('bookstatusid');
        $bookid = $this->input->post('bookid');
        //echo '<script type="text/javascript">alert("'.$bookid.'")</script>';
        if($bookstatusid==2){ $bookstatusid=4; }
        $arr = array(
                'bookstatusid' => $bookstatusid,
                'commentdetail' => $this->input->post('commentdetail')
                );
        $commentid = $this->input->post('commentid');
        $this->load->model('IofficeModel');
        $this->IofficeModel->book_comment_update($commentid,$arr);

        // Upload File
        $target_dir = "./assets/uploads/ioffice/bookfile/";
        $file_no = 0;
        //echo count($_FILES['UploadedFile']['tmp_name']);
        //echo '<script type="text/javascript">swal("'.count($_FILES['UploadedFile']['tmp_name']).'");</script>';
        for($j=0;$j<count($_FILES['UploadedFile']['tmp_name']);$j++) {
            if(!empty($_FILES['UploadedFile']['tmp_name'][$j])) {
                ++$file_no;
                $target_file = $target_dir . basename($_FILES["UploadedFile"]["name"][$j]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                //$sql = "SELECT COUNT(fileid) AS countfile FROM ioffice_bookfile WHERE bookid=$bookid";
                //$result = mysqli_query($connect, $sql);
                //$row = mysqli_fetch_assoc($result);
                $fnum = $this->IofficeModel->get_bookfile_count($bookid);
                $fnum = $fnum + 1;
                $rename_file = $target_dir . $bookid . '-' . $fnum . '-' .round(microtime(true)) . '.' . strtolower($imageFileType);
                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["UploadedFile"]["tmp_name"][$j]);
                    if($check !== false) {
                        //echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        //echo "File is not an image.";
                        $uploadOk = 0;
                    }
                }
                // Check if file already exists
                if (file_exists($rename_file)) {
                    //echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }
                // Check file size
                if ($_FILES["UploadedFile"]["size"][$j] > 500000) {
                    //echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                $imageFileType = strtolower($imageFileType);
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" && $imageFileType != "pdf"  && $imageFileType != "doc"
                && $imageFileType != "docs" && $imageFileType != "xls" && $imageFileType != "xlsx"
                && $imageFileType != "ppt" && $imageFileType != "pptx" && $imageFileType != "zip"
                && $imageFileType != "rar" ) {
                    //echo "Sorry, files type are allowed.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    //echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["UploadedFile"]["tmp_name"][$j], $rename_file)) {
                        //echo "The file ". basename( $_FILES["UploadedFile"]["name"][$j]). " has been uploaded.";
                        //$sql = "INSERT INTO ioffice_bookfile(bookid,filename,filedesc,filetype) VALUE($bookid,'$rename_file','".$_FILES["UploadedFile"]["name"][$j]."','$imageFileType')";
                        //$result = mysqli_query($connect,$sql);
                        //$this->load->view('upload_success', $data);
                        $arr = array(
                                'bookid' => $bookid,
                                'filename' => $rename_file,
                                'filedesc' => $_FILES["UploadedFile"]["name"][$j],
                                'filetype' => $imageFileType
                                );
                        $this->IofficeModel->bookfile_insert($arr);
                    } else {
                        //echo "Sorry, there was an error uploading your file.";
                    }
                }
            }//if
        }//for
        // End Upload file

        // เพิ่มรายการเสนอ
        if($this->input->post('bookstatusid')==2)
        {
            $arr = array(
                    'bookid' => $this->input->post('bookid'),
                    'bookstatusid' => $this->input->post('bookstatusid'),
                    'post_personid' => $this->input->post('post_personid'),
                    'comment_personid' => $this->input->post('comment_personid')
                );
            $this->IofficeModel->book_comment_insert($arr);
        }

        redirect(base_url().'index.php/ioffice/book_comment');
    }

    public function book2_comment_save()
    {
        $bookstatusid = $this->input->post('bookstatusid');
        $bookid = $this->input->post('bookid');
        //echo '<script type="text/javascript">alert("'.$bookid.'")</script>';
        if($bookstatusid==2){ $bookstatusid=4; }
        $arr = array(
                'bookstatusid' => $bookstatusid,
                'commentdetail' => $this->input->post('commentdetail')
                );
        $commentid = $this->input->post('commentid');
        $this->load->model('IofficeModel');
        $this->IofficeModel->book2_comment_update($commentid,$arr);

        // Upload File
        $target_dir = "./assets/uploads/ioffice/book2file/";
        $file_no = 0;
        //echo count($_FILES['UploadedFile']['tmp_name']);
        //echo '<script type="text/javascript">swal("'.count($_FILES['UploadedFile']['tmp_name']).'");</script>';
        for($j=0;$j<count($_FILES['UploadedFile']['tmp_name']);$j++) {
            if(!empty($_FILES['UploadedFile']['tmp_name'][$j])) {
                ++$file_no;
                $target_file = $target_dir . basename($_FILES["UploadedFile"]["name"][$j]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                //$sql = "SELECT COUNT(fileid) AS countfile FROM ioffice_bookfile WHERE bookid=$bookid";
                //$result = mysqli_query($connect, $sql);
                //$row = mysqli_fetch_assoc($result);
                $fnum = $this->IofficeModel->get_bookfile_count($bookid);
                $fnum = $fnum + 1;
                $rename_file = $target_dir . $bookid . '-' . $fnum . '-' .round(microtime(true)) . '.' . strtolower($imageFileType);
                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["UploadedFile"]["tmp_name"][$j]);
                    if($check !== false) {
                        //echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        //echo "File is not an image.";
                        $uploadOk = 0;
                    }
                }
                // Check if file already exists
                if (file_exists($rename_file)) {
                    //echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }
                // Check file size
                if ($_FILES["UploadedFile"]["size"][$j] > 500000) {
                    //echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                $imageFileType = strtolower($imageFileType);
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" && $imageFileType != "pdf"  && $imageFileType != "doc"
                && $imageFileType != "docs" && $imageFileType != "xls" && $imageFileType != "xlsx"
                && $imageFileType != "ppt" && $imageFileType != "pptx" && $imageFileType != "zip"
                && $imageFileType != "rar" ) {
                    //echo "Sorry, files type are allowed.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    //echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["UploadedFile"]["tmp_name"][$j], $rename_file)) {
                        //echo "The file ". basename( $_FILES["UploadedFile"]["name"][$j]). " has been uploaded.";
                        //$sql = "INSERT INTO ioffice_bookfile(bookid,filename,filedesc,filetype) VALUE($bookid,'$rename_file','".$_FILES["UploadedFile"]["name"][$j]."','$imageFileType')";
                        //$result = mysqli_query($connect,$sql);
                        //$this->load->view('upload_success', $data);
                        $arr = array(
                                'bookid' => $bookid,
                                'filename' => $rename_file,
                                'filedesc' => $_FILES["UploadedFile"]["name"][$j],
                                'filetype' => $imageFileType
                                );
                        $this->IofficeModel->bookfile_insert($arr);
                    } else {
                        //echo "Sorry, there was an error uploading your file.";
                    }
                }
            }//if
        }//for
        // End Upload file

        // เพิ่มรายการเสนอ
        if($this->input->post('bookstatusid')==2)
        {
            $arr = array(
                    'bookid' => $this->input->post('bookid'),
                    'bookstatusid' => $this->input->post('bookstatusid'),
                    'post_personid' => $this->input->post('post_personid'),
                    'comment_personid' => $this->input->post('comment_personid')
                );
            $this->IofficeModel->book_comment_insert($arr);
        }

        redirect(base_url().'index.php/ioffice/book2_comment');
    }

    public function book_commented()
    {
        $this->load->model('IofficeModel');
        $data = array(
            'content' => 'ioffice/book_commented',
            'data' => $this->IofficeModel->get_book_commented($this->session->person_id),
            'bookstat' => $this->IofficeModel->get_bookstat($this->session->person_id)
            );
        $this->load->view('templates/index', $data);
    }

    public function get_last_bookreceive()
    {
        $this->load->model('IofficeModel');
        $last_bookreceive = $this->IofficeModel->get_last_bookreceive($this->session->person_id);
        if($last_bookreceive!=false){
            echo $last_bookreceive->bookreceive;
        }else{
            echo '';
        }
    }

    public function get_last_bookheader()
    {
        $this->load->model('IofficeModel');
        $last_bookheader = $this->IofficeModel->get_last_bookheader($this->session->person_id);
        if($last_bookheader!=false){
            echo $last_bookheader->bookheader;
        }else{
            echo '';
        }
    }

    // Start Book2

    public function book2()
    {
        $this->load->model('IofficeModel');
        $data = array(
            'content' => 'ioffice/book2_select',
            'data' => $this->IofficeModel->get_book2($this->session->person_id),
            );
        $this->load->view('templates/index', $data);
    }

    public function book2_comment()
    {
        $this->load->model('IofficeModel');
        $data = array(
            'content' => 'ioffice/book2_comment',
            'data' => $this->IofficeModel->get_book2comment_income($this->session->person_nodeid),
            );
        $this->load->view('templates/index', $data);
    }

    public function book2_insert_form()
    {
        $data['content'] = 'ioffice/book2_insert_form';
        $this->load->model('IofficeModel');
        $this->IofficeModel->tmp_select_node_clear($this->session->person_id,'ioffice2');
        $data['data'] = array(
            'receive_person' => $this->IofficeModel->get_receive_person(),
            'book_person' => $this->IofficeModel->get_book_person(),
            'comment_personid' => $this->IofficeModel->get_last_comment2_personid(),
            'bookgroup' => $this->IofficeModel->get_bookgroup()
            );
        $this->load->view('templates/index', $data);
    }

    public function book2_update_form()
    {
        $data['content'] = 'ioffice/book2_update_form';
        $this->load->model('IofficeModel');
        $this->IofficeModel->tmp_select_node_clear($this->session->person_id,'ioffice2');
        $data['data'] = array(
            'book' => $this->IofficeModel->get_book2_byid($this->uri->segment(3)),
            'receive_person' => $this->IofficeModel->get_receive_person(),
            'book_person' => $this->IofficeModel->get_book_person(),
            'bookfile' => $this->IofficeModel->get_book2file($this->uri->segment(3)),
            'bookgroup' => $this->IofficeModel->get_bookgroup()
            );
        $this->load->view('templates/index', $data);
    }

    public function get_last_book2receive()
    {
        $this->load->model('IofficeModel');
        $last_bookreceive = $this->IofficeModel->get_last_book2receive($this->session->person_id);
        if($last_bookreceive!=false){
            echo $last_bookreceive->bookreceive;
        }else{
            echo '';
        }
    }

    public function get_last_book2header()
    {
        $this->load->model('IofficeModel');
        $last_bookheader = $this->IofficeModel->get_last_book2header($this->session->person_id);
        if($last_bookheader!=false){
            echo $last_bookheader->bookheader;
        }else{
            echo '';
        }
    }

    public function get_last_book2from()
    {
        $this->load->model('IofficeModel');
        $last_bookfrom = $this->IofficeModel->get_last_book2from($this->session->person_id);
        if($last_bookfrom!=false){
            echo $last_bookfrom->bookfrom;
        }else{
            echo '';
        }
    }

    public function get_book2_departmentid()
    {
        $this->load->model('IofficeModel');
        $book2_departmentid = $this->IofficeModel->get_book2_departmentid($this->input->post('bookgroupid'),$this->session->department_id);
        //if($book2_departmentid!=false){
        $arr = array(
                    'department_bookid' => $book2_departmentid,
                    'bookgroupid' => $this->input->post('bookgroupid'),
                    'bookdate' => date('Y-m-d'),
                    'booktypeid' => $this->input->post('booktypeid'),
                    'bookstatusid' => 1,
                    'bookregisterstatusid' => 1,
                    'bookheader' => '-',
                    'bookreceive' => '-',
                    'bookfrom' => '-',
                    'bookdetail' => '',
                    'post_personid' => $this->session->person_id //,
                    //'comment_personid' => $this->input->post('comment_personid')
                    );
        $bookid = $this->IofficeModel->book2_insert($arr);
        $arr = array('bookid'=>$bookid,'department_bookid'=>$book2_departmentid);
        echo json_encode($arr);
        //}else{
        //    echo '';
        //}
        //echo date("Y")+543;
    }

    public function book2_insert()
    {
        $this->load->model('IofficeModel');
        $date2db = explode('/',$this->input->post('bookdate'));
        $year = $date2db[2]-543;
        $date2db = $year.'-'.$date2db[1].'-'.$date2db[0];

        if($this->input->post('bookid')){
            $arr = array(
                'department_bookid' => $this->input->post('department_bookid'),
                //'bookgroupid' => $this->input->post('bookgroupid'),
                //'bookdate' => date('Y-m-d'),
                'booktypeid' => $this->input->post('booktypeid'),
                'bookstatusid' => $this->input->post('bookstatusid'),
                'bookheader' => $this->input->post('bookheader'),
                'bookreceive' => $this->input->post('bookreceive'),
                'bookfrom' => $this->input->post('bookfrom'),
                'bookdetail' => $this->input->post('bookdetail'),
                'post_personid' => $this->input->post('post_personid'),
                'comment_personid' => $this->input->post('comment_personid'),
                'ref_bookid' => $this->input->post('ref_bookid')
                //'bookregisterstatusid' => 1
                );
            $bookid = $this->input->post('bookid');
            $this->IofficeModel->book2_update($bookid,$arr);
        }else{
            $arr = array(
                'department_bookid' => $this->input->post('department_bookid'),
                'bookgroupid' => $this->input->post('bookgroupid'),
                'bookdate' => $date2db,
                'booktypeid' => $this->input->post('booktypeid'),
                'bookstatusid' => $this->input->post('bookstatusid'),
                'bookheader' => $this->input->post('bookheader'),
                'bookreceive' => $this->input->post('bookreceive'),
                'bookfrom' => $this->input->post('bookfrom'),
                'bookdetail' => $this->input->post('bookdetail'),
                'post_personid' => $this->input->post('post_personid'),
                'comment_personid' => $this->input->post('comment_personid'),
                'ref_bookid' => $this->input->post('ref_bookid')
                );
            $bookid = $this->IofficeModel->book2_insert($arr);
        }
               
        // กรณีกดปุ่มบันทึกพร้อมเสนอ ทำการสร้างรายการเสนอ
        if($this->input->post('bookstatusid')==2)
        {
            $result = $this->IofficeModel->get_tmp_select_node($this->session->person_id,'ioffice2');
            //if($result!=false){
                foreach ($result as $row) {
                    $arr = array(
                        'bookid' => $bookid,
                        'bookstatusid' => 2,
                        'post_personid' => $this->input->post('post_personid'),
                        'comment_nodeid' => $row->nodeid
                    );
                    $this->IofficeModel->book2_comment_insert($arr);
                } 
            //}    
        }
        // Upload File
        $target_dir = "./assets/uploads/ioffice/book2file/";
        $file_no = 0;
        for($j=0;$j<count($_FILES['UploadedFile']['tmp_name']);$j++) {
            if(!empty($_FILES['UploadedFile']['tmp_name'][$j])) {
                ++$file_no;
                $target_file = $target_dir . basename($_FILES["UploadedFile"]["name"][$j]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                //$sql = "SELECT COUNT(fileid) AS countfile FROM ioffice_bookfile WHERE bookid=$bookid";
                //$result = mysqli_query($connect, $sql);
                //$row = mysqli_fetch_assoc($result);
                $fnum = $this->IofficeModel->get_book2file_count($bookid);
                $fnum = $fnum + 1;
                $rename_file = $target_dir . $bookid . '-' . $fnum . '-' .round(microtime(true)) . '.' . strtolower($imageFileType);
                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["UploadedFile"]["tmp_name"][$j]);
                    if($check !== false) {
                        //echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        //echo "File is not an image.";
                        $uploadOk = 0;
                    }
                }
                // Check if file already exists
                if (file_exists($rename_file)) {
                    //echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }
                // Check file size
                if ($_FILES["UploadedFile"]["size"][$j] > 500000) {
                    //echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                $imageFileType = strtolower($imageFileType);
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" && $imageFileType != "pdf"  && $imageFileType != "doc"
                && $imageFileType != "docs" && $imageFileType != "xls" && $imageFileType != "xlsx"
                && $imageFileType != "ppt" && $imageFileType != "pptx" && $imageFileType != "zip"
                && $imageFileType != "rar" ) {
                    //echo "Sorry, files type are allowed.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    //echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["UploadedFile"]["tmp_name"][$j], $rename_file)) {
                        //echo "The file ". basename( $_FILES["UploadedFile"]["name"][$j]). " has been uploaded.";
                        //$sql = "INSERT INTO ioffice_bookfile(bookid,filename,filedesc,filetype) VALUE($bookid,'$rename_file','".$_FILES["UploadedFile"]["name"][$j]."','$imageFileType')";
                        //$result = mysqli_query($connect,$sql);
                        //$this->load->view('upload_success', $data);
                        $arr = array(
                                'bookid' => $bookid,
                                'filename' => $rename_file,
                                'filedesc' => $_FILES["UploadedFile"]["name"][$j],
                                'filetype' => $imageFileType
                                );
                        $this->IofficeModel->book2file_insert($arr);
                    } else {
                        //echo "Sorry, there was an error uploading your file.";
                    }
                }
            }//if
        }//for
        // End Upload file

        //redirect(base_url().'index.php/ioffice/book2');
        redirect($this->input->post('referer'));

    }

    public function book2_update()
    {
        $this->load->model('IofficeModel');
        $date2db = explode('/',$this->input->post('bookdate'));
        $year = $date2db[2]-543;
        $date2db = $year.'-'.$date2db[1].'-'.$date2db[0];
        $arr = array(
                    'department_bookid' => $this->input->post('department_bookid'),
                    'bookgroupid' => $this->input->post('bookgroupid'),
                    'bookdate' => $date2db,
                    'bookgroupid' => $this->input->post('bookgroupid'),
                    'booktypeid' => $this->input->post('booktypeid'),
                    'bookstatusid' => $this->input->post('bookstatusid'),
                    'bookheader' => $this->input->post('bookheader'),
                    'bookreceive' => $this->input->post('bookreceive'),
                    'bookfrom' => $this->input->post('bookfrom'),
                    'bookdetail' => $this->input->post('bookdetail'),
                    'post_personid' => $this->input->post('post_personid'),
                    'comment_personid' => $this->input->post('comment_personid')
                    );
        $bookid = $this->input->post('bookid');
        $this->IofficeModel->book2_update($bookid,$arr);
        // กรณีกดปุ่มบันทึกพร้อมเสนอ ทำการสร้างรายการเสนอ
        if($this->input->post('bookstatusid')==2)
        {
            $arr = array(
                    'bookid' => $bookid,
                    'bookstatusid' => 2,
                    'post_personid' => $this->input->post('post_personid'),
                    'comment_personid' => $this->input->post('comment_personid')
                );
            $this->IofficeModel->book2_comment_insert($arr);
        }
        // Upload File
        $target_dir = "./assets/uploads/ioffice/book2file/";
        $file_no = 0;
        //echo '<script type="text/javascript">swal("'.count($_FILES['UploadedFile']['tmp_name']).'");</script>';
        for($j=0;$j<count($_FILES['UploadedFile']['tmp_name']);$j++) {
            if(!empty($_FILES['UploadedFile']['tmp_name'][$j])) {
                ++$file_no;
                $target_file = $target_dir . basename($_FILES["UploadedFile"]["name"][$j]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                //$sql = "SELECT COUNT(fileid) AS countfile FROM ioffice_bookfile WHERE bookid=$bookid";
                //$result = mysqli_query($connect, $sql);
                //$row = mysqli_fetch_assoc($result);
                $fnum = $this->IofficeModel->get_book2file_count($bookid);
                $fnum = $fnum + 1;
                $rename_file = $target_dir . $bookid . '-' . $fnum . '-' .round(microtime(true)) . '.' . strtolower($imageFileType);
                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["UploadedFile"]["tmp_name"][$j]);
                    if($check !== false) {
                        //echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        //echo "File is not an image.";
                        $uploadOk = 0;
                    }
                }
                // Check if file already exists
                if (file_exists($rename_file)) {
                    //echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }
                // Check file size
                if ($_FILES["UploadedFile"]["size"][$j] > 500000) {
                    //echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                $imageFileType = strtolower($imageFileType);
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" && $imageFileType != "pdf"  && $imageFileType != "doc"
                && $imageFileType != "docs" && $imageFileType != "xls" && $imageFileType != "xlsx"
                && $imageFileType != "ppt" && $imageFileType != "pptx" && $imageFileType != "zip"
                && $imageFileType != "rar" ) {
                    //echo "Sorry, files type are allowed.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    //echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["UploadedFile"]["tmp_name"][$j], $rename_file)) {
                        //echo "The file ". basename( $_FILES["UploadedFile"]["name"][$j]). " has been uploaded.";
                        //$sql = "INSERT INTO ioffice_bookfile(bookid,filename,filedesc,filetype) VALUE($bookid,'$rename_file','".$_FILES["UploadedFile"]["name"][$j]."','$imageFileType')";
                        //$result = mysqli_query($connect,$sql);
                        //$this->load->view('upload_success', $data);
                        $arr = array(
                                'bookid' => $bookid,
                                'filename' => $rename_file,
                                'filedesc' => $_FILES["UploadedFile"]["name"][$j],
                                'filetype' => $imageFileType
                                );
                        $this->IofficeModel->book2file_insert($arr);
                    } else {
                        //echo "Sorry, there was an error uploading your file.";
                    }
                }
            }//if
        }//for
        // End Upload file

        //redirect(base_url().'index.php/ioffice/book2');
        redirect($this->input->post('referer'));

    }

    public function set_book2status($bookid,$bookstatusid)
    {
        $this->load->model('IofficeModel');
        $arr = array('bookstatusid' => $this->uri->segment(4));
        $this->IofficeModel->set_book2status($this->uri->segment(3),$arr);
        redirect(base_url().'index.php/ioffice/book2');
    }

    public function book2_show_from()
    {
        $data['content'] = 'ioffice/book2_show_from';
        $this->load->model('IofficeModel');
        $data['data'] = array(
            'book' => $this->IofficeModel->get_book2_byid($this->uri->segment(3)),
            'receive_person' => $this->IofficeModel->get_receive_person(),
            'book_person' => $this->IofficeModel->get_book_person(),
            'bookfile' => $this->IofficeModel->get_book2file($this->uri->segment(3)),
            'bookgroup' => $this->IofficeModel->get_bookgroup()
            );
        $this->load->view('templates/index', $data);
    }

    public function ajax_select_departmentgroup(){
        $this->load->model('IofficeModel');
        $result = $this->IofficeModel->get_node_bygroup($this->input->post('department_groupid'));
        $count=0;
        if($result!=false){
            if($this->input->post('checked')=='true'){
                foreach ($result as $row) {
                    if(($row->nodeid!=$this->session->department_nodeid)&&($row->nodeid!=$this->session->department_masternodeid)) {
                        $arr = array(
                            'person_id' => $this->session->person_id,
                            'nodeid' => $row->nodeid,
                            'token' => $this->input->post('token')
                        );
                        $this->IofficeModel->tmp_select_node_insert($arr);
                        $count=$count+1;  
                    }    
                }
                $msg = 'เลือกแล้ว'; 
            }else{
                foreach ($result as $row) {
                    if(($row->nodeid!=$this->session->department_nodeid)&&($row->nodeid!=$this->session->department_masternodeid)) {
                        $person_id = $this->session->person_id;
                        $nodeid = $row->nodeid;
                        $token = $this->input->post('token');
                        $this->IofficeModel->tmp_select_node_delete($person_id,$nodeid,$token);
                        $count=$count+1;
                    }
                }
                $msg = 'ยกเลิกการเลือก';
            }
            
        }         
        echo $msg.' '.$count.' หน่วยงาน';    
    }

    public function ajax_select_node(){
        $this->load->model('IofficeModel');
        if($this->input->post('checked')=='true'){
            $arr = array(
                'person_id' => $this->session->person_id,
                'nodeid' => $this->input->post('nodeid'),
                'token' => $this->input->post('token')
            );
            $this->IofficeModel->tmp_select_node_insert($arr);    
        }else{
            $person_id = $this->session->person_id;
            $nodeid = $this->input->post('nodeid');
            $token = $this->input->post('token');
            $this->IofficeModel->tmp_select_node_delete($person_id,$nodeid,$token); 
        }      
        echo 'เลือกเรียบร้อยแล้ว';    
    }

    public function server_processing(){
        $this->load->view('ioffice/server_processing');
    }

    public function ajax_list()
    {
        $this->load->model('IofficeModel');
        $list = $this->IofficeModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $node) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $node->nodename;
            $row[] = $node->nodetypename;
            $row[] = $node->department_typename;
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->IofficeModel->count_all(),
                        "recordsFiltered" => $this->IofficeModel->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    // End Book2

}
