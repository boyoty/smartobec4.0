<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// เปลี่ยนชื่อคลาส (Name) ให้เป็นชื่อคอนโทรลเลอร์ อักษาตัวแรกให้เป็นตัวใหญ่
class School extends CI_Controller
{

    public function __construct()
    {
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
    }

    public function index()
    {
        // หน้าแรกที่จะแสดงเมื่อเข้าสู่โมดูล
        $data['content'] = 'member/ready';
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

    public function answer()
    {   
        $data['content'] = 'school/question_sheet_select';
        $this->load->model('QuestionModel');
        $data['data'] = $this->QuestionModel->get_question_sheet();
        $this->load->view('templates/index', $data);
    }

    public function select_student()
    {
        if($this->input->post('question_sheetid')){
            $_SESSION['question_sheetid']=$this->input->post('question_sheetid');
            $this->load->model('QuestionModel');
            $_SESSION['question_sheetname']=$this->QuestionModel->get_question_sheetname($this->input->post('question_sheetid'));
        }
        $data['content'] = 'school/student_select';
        $this->load->model('StudentModel');
        $data['data'] = $this->StudentModel->get_student($this->session->department_id);
        $this->load->view('templates/index', $data);
    }

    public function answer_form()
    {
        $_SESSION['student_id'] = $this->input->post('student_id');
        $data['content'] = 'school/answer';
        $this->load->model('QuestionModel');
        $data['data'] = $this->QuestionModel->get_question($this->session->question_sheetid);
        $this->load->view('templates/index', $data);
    }

    public function answer_save()
    {
        $this->load->model('QuestionModel');
        $question = $this->QuestionModel->get_question($this->session->question_sheetid);       
        $arr='';
        foreach ($question as $row) {
            if($this->input->post($row->question_id)){
                //$arr = $arr.'"'.$row->question_id.'"=>"'.$this->input->post($row->question_id).'"'; 
                // delete old answer by question_id
                $this->QuestionModel->answer_delete($row->question_id,$this->input->post('student_id'));
                $check_array = is_array($this->input->post($row->question_id));
                if($check_array){
                    $arr_value = $this->input->post($row->question_id);
                    foreach ($arr_value as $value) {
                        $arr = array(
                        'student_id' => $this->input->post('student_id'),
                        'question_sheetid' => $this->session->question_sheetid,
                        'question_id' => $row->question_id,
                        'answer_value' => $value
                        ); 
                        $this->QuestionModel->answer_save($arr);
                    }
                }else{
                    $arr = array(
                    'student_id' => $this->input->post('student_id'),
                    'question_sheetid' => $this->session->question_sheetid,
                    'question_id' => $row->question_id,
                    'answer_value' => $this->input->post($row->question_id)
                    ); 
                   $this->QuestionModel->answer_save($arr);
                }
                
            }            
        }
        //$data['content'] = 'system/console';
        //$data['data'] = $arr;
        //$this->load->view('templates/index',$data);
        redirect(base_url().'index.php/school/select_student');
    }

    public function population_main()
    {
        // ตัวอย่างการใช้งาน grocery crud
        $crud = new grocery_CRUD();
        $crud->set_table('population_main')
            ->set_subject('ประชากรวัยเรียน(ทร.14)')
            ->columns('idcard', 'prename','name','surname','birthdate','address_no','address_moo','address_tambon','address_amper','address_province','address_postcode')
            ->display_as('idcard', 'เลขประจำตัวประชาชน')
            ->display_as('prename', 'คำนำหน้าชื่อ')
            ->display_as('name', 'ชื่อ')
            ->display_as('surname', 'นามสกุล')
            ->display_as('birthdate', 'วันเกิด')
            ->display_as('address_no', 'บ้านเลขที่')
            ->display_as('address_moo', 'หมู่')
            ->display_as('address_tambon', 'ตำบล')
            ->display_as('address_amper', 'อำเภอ')
            ->display_as('address_province', 'จังหวัด')
            ->display_as('address_postcode', 'รหัสไปรษณีย์')
            ->display_as('fathername', 'ชื่อบิดา')
            ->display_as('mathername', 'ชื่อมารดา')
            ->display_as('level', 'เข้าเรียนชั้น')
            ->display_as('department_name', 'เข้าเรียนที่')
            ->display_as('department_type', 'เข้าเรียนสังกัด')
            ->display_as('person_id', 'ผู้ทำรายการ');
        $crud->where('population_main.person_id',$this->session->person_id);
        $crud->fields('idcard', 'prename','name','surname','birthdate','address_no','address_moo','address_tambon','address_amper','address_province','address_postcode','fathername','mathername','level','department_name','department_type','person_id');
        $crud->required_fields('idcard', 'prename','name','surname','birthdate','address_no','address_moo','address_tambon','address_amper','address_province','address_postcode','fathername','mathername','person_id');
        $crud->unique_fields('idcard');
        //$crud->set_reletion('level','level_main','lavel_name');
        $crud->set_relation('person_id','person_main','name');
        $crud->callback_add_field('person_id', array($this, 'add_field_callback_person_id'));
        $crud->callback_edit_field('person_id', array($this, 'edit_field_callback_person_id'));
        date_default_timezone_set("Asia/Bangkok");
        $output = $crud->render();
        $this->_example_output($output);
    }

    public function add_field_callback_person_id()
    {
        $this->load->model('HomeModel');
        $officer_name = $this->HomeModel->get_person_name($this->session->person_id);
        return $officer_name . '<input type="hidden" name="person_id" value="' . $this->session->person_id . '">';
    }
    public function edit_field_callback_person_id($value, $primary_key)
    {
        $this->load->model('HomeModel');
        $officer_name = $this->HomeModel->get_person_name($value);
        return $officer_name . '<input type="hidden" name="person_id" value="' . $this->session->person_id . '">';
    }

}
