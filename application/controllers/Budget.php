<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// เปลี่ยนชื่อคลาส (Name) ให้เป็นชื่อคอนโทรลเลอร์ อักษาตัวแรกให้เป็นตัวใหญ่
class Budget extends CI_Controller
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

    public function plan()
    {
        // ระบบความปลอดภัย
        if($this->uri->segment(3)=='read' || $this->uri->segment(3)=='delete' || $this->uri->segment(3)=='edit'){
            $this->load->model('BudgetModel');
            $department = $this->BudgetModel->get_department_by_plan($this->uri->segment(4));
            if($department!=$this->session->department_id){
                redirect(base_url().'index.php/member/nopermission');
            }
        }
        // ตัวอย่างการใช้งาน grocery crud
        $crud = new grocery_CRUD();
        $crud->set_table('plan')
            ->set_subject('แผนงาน/โครงการ')
            ->columns('plan_id', 'plan_groupid','plan_schoolname','plan_name','budget')
            ->display_as('plan_id', 'เลขที่คำขอ')
            ->display_as('plan_groupid', 'ประเด็น')
            ->display_as('plan_name', 'ชื่อแผนงาน/โครงการ')
            ->display_as('plan_schoolname', 'โรงเรียน')
            ->display_as('policy_id', 'สนองนโยบาย สพฐ.')
            ->display_as('objective', 'วัตถุประสงค์')
            ->display_as('activity', 'กิจกรรม')
            ->display_as('quantity', 'เป้าหมายเชิงปริมาณ')
            ->display_as('quanlity', 'เป้าหมายเชิงคุณภาพ')
            ->display_as('kpi', 'ตัวชี้วัด')
            ->display_as('result', 'ผลที่คาดว่าจะได้รับ')
            ->display_as('budget', 'งบประมาณ')
            ->display_as('department_id', 'เขตพื้นที่การศึกษา')
            ->display_as('person_id', 'ผู้บันทึกข้อมูล');
        $crud->fields('plan_groupid','policy_id','department_id','plan_schoolname','plan_name','objective','activity','quantity','quanlity','kpi','result','budget','person_id');
        $crud->required_fields('plan_groupid','policy_id','department_id','plan_schoolname','plan_name','objective','activity','quantity','quanlity','kpi','result','budget','person_id');
        $crud->where('department_id',$this->session->department_id);
        $crud->set_relation('plan_groupid', 'plan_group', 'plan_groupname');
        $crud->set_relation('policy_id', 'policy', 'policy_name');
        $crud->set_relation('person_id', 'person_main', 'name');

        $crud->callback_add_field('department_id', array($this, 'add_field_callback_department_id'));
        $crud->callback_edit_field('department_id', array($this, 'edit_field_callback_department_id'));
        $crud->callback_add_field('person_id', array($this, 'add_field_callback_person_id'));
        $crud->callback_edit_field('person_id', array($this, 'edit_field_callback_person_id'));
        //$crud->callback_column('plan_name', array($this, '_full_text'));

        $output = $crud->render();
        $this->_example_output($output);
    }

    public function add_field_callback_department_id()
    {
        return $this->session->department_name . '<input type="hidden" name="department_id" value="' . $this->session->department_id . '">';
    }
    public function edit_field_callback_department_id($value, $primary_key)
    {
        return $this->session->department_name . '<input type="hidden" name="department_id" value="' . $this->session->department_id . '">';
    }
    public function add_field_callback_person_id()
    {
        return $this->session->fullname . '<input type="hidden" name="person_id" value="' . $this->session->person_id . '">';
    }
    public function edit_field_callback_person_id($value, $primary_key)
    {
        return $this->session->fullname . '<input type="hidden" name="person_id" value="' . $this->session->person_id . '">';
    }

    public function person_khet($operation = null)
    {
        $crud = new grocery_CRUD();

        //$crud->set_theme('bootstrap');
        
        $crud->set_table('person_main')
            ->set_subject('บุคลากร')
            ->columns('prename', 'name', 'surname', 'position_code', 'department', 'status', 'officer')
            ->display_as('person_id', 'รหัสบุคลากร')
            ->display_as('prename', 'คำนำหน้า')
            ->display_as('name', 'ชื่อ')
            ->display_as('surname', 'สกุล')
            ->display_as('position_code', 'ตำแหน่ง')
            ->display_as('position_other_code', 'ตำแหน่งอื่นๆ')
            ->display_as('status', 'สถานะ')
            ->display_as('department', 'หน่วยงาน')
            ->display_as('email', 'อีเมล์')
            ->display_as('tel', 'โทรศัพท์')
            ->display_as('username', 'username')
            ->display_as('password', 'password')
            ->display_as('pic', 'รูป')
            ->display_as('personmember', 'เลือกสิทธิ์การใช้งาน')
            ->display_as('person_order', 'ลำดับบุคลากร')
            ->display_as('officer', 'ผู้ทำรายการ')
            ->display_as('rec_date', 'วันที่ทำรายการ');
        $crud->where('person_main.department',$this->session->department_id);
        //$crud->order_by('person_main.position_code','ASC');
        $crud->fields('prename', 'name', 'surname', 'position_code', 'department', 'pic', 'username', 'password', 'personmember', 'status', 'officer', 'rec_date');
        $crud->required_fields('prename', 'name', 'surname', 'position_code', 'username', 'status', 'officer', 'rec_date');

        $crud->set_field_upload('pic', 'assets/uploads/person/pic', 'jpeg|jpg|png');

        $crud->set_relation('position_code', 'person_position', 'position_name',array('position_code' => '2'));
        $crud->set_relation('department', 'system_department', 'department_name');
        $crud->set_relation('status', 'person_status', 'person_statusname');
        $crud->set_relation_n_n('personmember', 'person_groupmember', 'person_group', 'person_id', 'person_groupid', 'person_groupname', 'priority',array('person_groupid' => '3'));
        $crud->set_relation('officer', 'person_main', 'name');
        $crud->unique_fields('username');
        //$crud->callback_add_field('status',array($this,'add_field_callback_1'));
        //$crud->callback_edit_field('status',array($this,'edit_field_callback_1'));
        $crud->callback_add_field('username', array($this, 'add_field_username'));
        $crud->callback_edit_field('username', array($this, 'edit_field_username'));
        $crud->callback_add_field('password', array($this, 'add_field_callback_2'));
        $crud->callback_edit_field('password', array($this, 'edit_field_callback_2'));
        $crud->callback_add_field('officer', array($this, 'add_field_callback_officer1'));
        $crud->callback_edit_field('officer', array($this, 'edit_field_callback_officer1'));
        $crud->callback_add_field('rec_date', array($this, 'add_field_callback_rec_date1'));
        $crud->callback_edit_field('rec_date', array($this, 'edit_field_callback_rec_date1'));
        $crud->callback_add_field('department', array($this, 'add_field_callback_department2'));
        $crud->callback_edit_field('department', array($this, 'edit_field_callback_department2'));

        //$crud->change_field_type('password','password');
        $crud->callback_before_insert(array($this, 'person_khet_callback_insert'));
        $crud->callback_before_update(array($this, 'person_khet_callback_update'));

        date_default_timezone_set("Asia/Bangkok");
        $output = $crud->render();

        $this->_example_output($output);
    }

    public function add_field_callback_department2()
    {
        return $this->session->department_name . '<input type="hidden" name="department" value="' . $this->session->department_id . '">';
    }
    public function edit_field_callback_department2($value, $primary_key)
    {
        return $this->session->department_name . '<input type="hidden" name="department" value="' . $this->session->department_id . '">';
    }

    public function add_field_callback_officer1()
    {
        $this->load->model('HomeModel');
        $officer_name = $this->HomeModel->get_person_name($this->session->person_id);
        return $officer_name . '<input type="hidden" name="officer" value="' . $this->session->person_id . '">';
    }
    public function edit_field_callback_officer1($value, $primary_key)
    {
        $this->load->model('HomeModel');
        $officer_name = $this->HomeModel->get_person_name($value);
        return $officer_name . '<input type="hidden" name="officer" value="' . $this->session->person_id . '">';
    }

    public function add_field_callback_rec_date1()
    {
        return date('Y-m-d H:i:s') . '<input type="hidden" name="rec_date" value="' . date('Y-m-d H:i:s') . '">';
    }

    public function edit_field_callback_rec_date1($value, $primary_key)
    {
        return $value . '<input type="hidden" name="rec_date" value="' . date('Y-m-d H:i:s') . '">';
    }

    public function add_field_callback_1()
    {
        return '<input type="radio" name="status" value="1" checked>ปกติ &nbsp;<input type="radio" name="status" value="2">ยกเลิก';
    }

    public function edit_field_callback_1($value, $primary_key)
    {
        //return '<input type="text" maxlength="50" value="'.$value.'" name="status" style="width:462px">';
        if ($value == 1) {
            return '<input type="radio" name="status" value="1" checked>ปกติ &nbsp;<input type="radio" name="status" value="2">ยกเลิก';
        } else {
            return '<input type="radio" name="status" value="1">ปกติ &nbsp;<input type="radio" name="status" value="2" checked>ยกเลิก';
        }
    }

    public function add_field_callback_2()
    {
        return '<input type="password" name="password">';
    }

    public function edit_field_callback_2($value, $primary_key)
    {
        return '<input type="password" name="password">';
    }

    public function add_field_username()
    {
        return '<input type="text" name="username"><br/><div class="label label-warning">กรณี username ซ้ำกับผู้ใช้งานอื่นจะไม่สามารถบันทึกได้</div>';
    }

    public function edit_field_username($value, $primary_key)
    {
        return '<input type="text" name="username" value="'.$value.'"><br/><div class="label label-warning">กรณี username ซ้ำกับผู้ใช้งานอื่นจะไม่สามารถบันทึกได้</div>';
    }

    public function person_khet_callback_insert($post_array, $primary_key = null)
    {
        //$this->load->model('MemberModel');
        //$user_exist = $this->MemberModel->checkuser_exist($post_array['username']);
        //if($user_exist==true){
        //    return false;
        //}else{
        //echo '<script type="text/javascript">alert("ok");</script>'
           $post_array['password'] = md5($post_array['password']);
            return $post_array; 
        //}
    }

    public function person_khet_callback_update($post_array, $primary_key)
    {
        //$this->load->library('encrypt');
        //$key = 'super-secret-key';
        if ($post_array['password']) {
            $post_array['password'] = md5($post_array['password']);
        } else {
            $this->load->model('HomeModel');
            $post_array['password'] = $this->HomeModel->get_password($primary_key);
        }
        return $post_array;
    }

    public function system_loginlog()
    {
        $crud = new grocery_CRUD();
        $crud->set_table('system_loginlog')
            ->set_subject('ประวัติการใช้งาน')
            ->columns('personid', 'username', 'logintime', 'ipaddress', 'hostname', 'os', 'browser')
            ->display_as('personid', 'ชื่อ-สกุล')
            ->display_as('username', 'username')
            ->display_as('logintime', 'เข้าใช้งานเมื่อ')
            ->display_as('ipaddress', 'หมายเลขไอพี')
            ->display_as('hostname', 'ชื่อโฮส')
            ->display_as('os', 'ระบบปฏิบัติการ')
            ->display_as('browser', 'บราวเซอร์');
        $crud->where('personid',$this->session->person_id);
        $crud->order_by('loginid', 'desc');
        $crud->fields('personid', 'username', 'logintime', 'ipaddress', 'hostname', 'os', 'browser');
        $crud->required_fields('personid', 'username', 'logintime', 'ipaddress', 'hostname', 'os', 'browser');
        $crud->set_primary_key('person_id', 'view_person_main');
        $crud->set_relation('personid', 'view_person_main', 'fullname_department');
        $crud->unset_add();
        $crud->unset_edit();
        $crud->unset_delete();
        date_default_timezone_set("Asia/Bangkok");
        $output = $crud->render();
        $this->_example_output($output);
    }

    public function planexport()
    {
        // ระบบความปลอดภัย
        if($this->uri->segment(3)=='read' || $this->uri->segment(3)=='delete' || $this->uri->segment(3)=='edit'){
            $this->load->model('BudgetModel');
            $department = $this->BudgetModel->get_department_by_plan($this->uri->segment(4));
            if($department!=$this->session->department_id){
                redirect(base_url().'index.php/member/nopermission');
            }
        }
        // ตัวอย่างการใช้งาน grocery crud
        $crud = new grocery_CRUD();
        $crud->set_table('plan')
            ->set_subject('แผนงาน/โครงการ')
            ->columns('plan_id', 'plan_groupid','policy_id','plan_schoolname','plan_name','objective','activity','quantity','quanlity','kpi','result','budget','person_id')
            ->display_as('plan_id', 'เลขที่คำขอ')
            ->display_as('plan_groupid', 'ประเด็น')
            ->display_as('plan_name', 'ชื่อแผนงาน/โครงการ')
            ->display_as('plan_schoolname', 'โรงเรียน')
            ->display_as('policy_id', 'สนองนโยบาย สพฐ.')
            ->display_as('objective', 'วัตถุประสงค์')
            ->display_as('activity', 'กิจกรรม')
            ->display_as('quantity', 'เป้าหมายเชิงปริมาณ')
            ->display_as('quanlity', 'เป้าหมายเชิงคุณภาพ')
            ->display_as('kpi', 'ตัวชี้วัด')
            ->display_as('result', 'ผลที่คาดว่าจะได้รับ')
            ->display_as('budget', 'งบประมาณ')
            ->display_as('department_id', 'เขตพื้นที่การศึกษา')
            ->display_as('person_id', 'ผู้บันทึกข้อมูล');
        $crud->fields('plan_groupid','policy_id','department_id','plan_schoolname','plan_name','objective','activity','quantity','quanlity','kpi','result','budget','person_id');
        $crud->required_fields('plan_groupid','policy_id','department_id','plan_schoolname','plan_name','objective','activity','quantity','quanlity','kpi','result','budget','person_id');
        $crud->where('department_id',$this->session->department_id);
        $crud->set_relation('plan_groupid', 'plan_group', 'plan_groupname');
        $crud->set_relation('policy_id', 'policy', 'policy_name');
        $crud->set_relation('department_id', 'system_department', 'department_precis');
        $crud->set_relation('person_id', 'person_main', 'name');
        
        $crud->unset_add();
        $crud->unset_edit();
        $crud->unset_delete();

        date_default_timezone_set("Asia/Bangkok");
        $output = $crud->render();
        $this->_example_output($output);
    }

    public function plancheck()
    {
        // ระบบความปลอดภัย
        if($this->uri->segment(3)=='read' || $this->uri->segment(3)=='delete' || $this->uri->segment(3)=='edit'){
            $this->load->model('BudgetModel');
            $department = $this->BudgetModel->get_department_by_plan($this->uri->segment(4));
            if($department!=$this->session->department_id){
                redirect(base_url().'index.php/member/nopermission');
            }
        }
        // ตัวอย่างการใช้งาน grocery crud
        $crud = new grocery_CRUD();
        $crud->set_table('plan')
            ->set_subject('แผนงาน/โครงการ')
            ->columns('plan_id', 'plan_groupid','plan_schoolname','plan_name','budget','person_id')
            ->display_as('plan_id', 'เลขที่คำขอ')
            ->display_as('plan_groupid', 'ประเด็น')
            ->display_as('plan_name', 'ชื่อแผนงาน/โครงการ')
            ->display_as('plan_schoolname', 'โรงเรียน')
            ->display_as('policy_id', 'สนองนโยบาย สพฐ.')
            ->display_as('objective', 'วัตถุประสงค์')
            ->display_as('activity', 'กิจกรรม')
            ->display_as('quantity', 'เป้าหมายเชิงปริมาณ')
            ->display_as('quanlity', 'เป้าหมายเชิงคุณภาพ')
            ->display_as('kpi', 'ตัวชี้วัด')
            ->display_as('result', 'ผลที่คาดว่าจะได้รับ')
            ->display_as('budget', 'งบประมาณ')
            ->display_as('department_id', 'เขตพื้นที่การศึกษา')
            ->display_as('person_id', 'ผู้บันทึกข้อมูล');
        $crud->fields('plan_groupid','policy_id','department_id','plan_schoolname','plan_name','objective','activity','quantity','quanlity','kpi','result','budget','person_id');
        $crud->required_fields('plan_groupid','policy_id','department_id','plan_schoolname','plan_name','objective','activity','quantity','quanlity','kpi','result','budget','person_id');
        $crud->where('department_id',$this->session->department_id);
        $crud->set_relation('plan_groupid', 'plan_group', 'plan_groupname');
        $crud->set_relation('policy_id', 'policy', 'policy_name');
        $crud->set_relation('department_id', 'system_department', 'department_precis');
        $crud->set_relation('person_id', 'person_main', 'name');
        
        $crud->unset_add();
        $crud->unset_edit();
        $crud->unset_delete();

        date_default_timezone_set("Asia/Bangkok");
        $output = $crud->render();
        $this->_example_output($output);
    }

    public function plandelete()
    {
        // ระบบความปลอดภัย
        if($this->uri->segment(3)=='read' || $this->uri->segment(3)=='delete' || $this->uri->segment(3)=='edit'){
            $this->load->model('BudgetModel');
            $department = $this->BudgetModel->get_department_by_plan($this->uri->segment(4));
            if($department!=$this->session->department_id){
                redirect(base_url().'index.php/member/nopermission');
            }
        }
        // ตัวอย่างการใช้งาน grocery crud
        $crud = new grocery_CRUD();
        $crud->set_table('plan')
            ->set_subject('แผนงาน/โครงการ')
            ->columns('plan_id', 'plan_groupid','plan_schoolname','plan_name','budget','person_id')
            ->display_as('plan_id', 'เลขที่คำขอ')
            ->display_as('plan_groupid', 'ประเด็น')
            ->display_as('plan_name', 'ชื่อแผนงาน/โครงการ')
            ->display_as('plan_schoolname', 'โรงเรียน')
            ->display_as('policy_id', 'สนองนโยบาย สพฐ.')
            ->display_as('objective', 'วัตถุประสงค์')
            ->display_as('activity', 'กิจกรรม')
            ->display_as('quantity', 'เป้าหมายเชิงปริมาณ')
            ->display_as('quanlity', 'เป้าหมายเชิงคุณภาพ')
            ->display_as('kpi', 'ตัวชี้วัด')
            ->display_as('result', 'ผลที่คาดว่าจะได้รับ')
            ->display_as('budget', 'งบประมาณ')
            ->display_as('department_id', 'เขตพื้นที่การศึกษา')
            ->display_as('person_id', 'ผู้บันทึกข้อมูล');
        $crud->fields('plan_groupid','policy_id','department_id','plan_schoolname','plan_name','objective','activity','quantity','quanlity','kpi','result','budget','person_id');
        $crud->required_fields('plan_groupid','policy_id','department_id','plan_schoolname','plan_name','objective','activity','quantity','quanlity','kpi','result','budget','person_id');
        $crud->where('department_id',$this->session->department_id);
        $crud->set_relation('plan_groupid', 'plan_group', 'plan_groupname');
        $crud->set_relation('policy_id', 'policy', 'policy_name');
        $crud->set_relation('department_id', 'system_department', 'department_precis');
        $crud->set_relation('person_id', 'person_main', 'name');
        
        $crud->unset_add();
        $crud->unset_edit();
        //$crud->unset_delete();

        date_default_timezone_set("Asia/Bangkok");
        $output = $crud->render();
        $this->_example_output($output);
    }

}
