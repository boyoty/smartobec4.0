<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // check login
        if (!isset($_SESSION['username'])) {
            redirect(base_url());
        }
        // end check login
        // check permission
        $res_permission = $this->systemmodel->get_menulink_permission($this->session->person_id);
        if (!in_array($this->uri->segment(1) . '/' . $this->uri->segment(2), $res_permission)) {
            redirect(base_url() . 'index.php/member/nopermission');
        }
        // end check permission

        $this->load->library('grocery_CRUD');
    }

    public function index()
    {
        $data = 'member/ready';
        $this->load->view('templates/index', $data);
    }

    public function _example_output($output = null)
    {
        $data['content'] = 'system/grocery_crud';
        $data['output']  = $output;
        $this->load->view('templates/index', $data);
        //$this->load->view('system/menuView',$output);
    }

    public function person_position()
    {
        $crud = new grocery_CRUD();

        //$crud->set_theme('bootstrap');
        $crud->set_table('person_position')
            ->set_subject('ตำแหน่งบุคลากร')
            ->columns('position_code', 'position_name')
            ->display_as('position_code', 'รหัสตำแหน่ง')
            ->display_as('position_name', 'ชื่อตำแหน่ง')
            ->display_as('position_type', 'ประเภทตำแหน่ง');

        $crud->fields('position_name');
        $crud->required_fields('position_name');

        $output = $crud->render();

        $this->_example_output($output);
    }

    public function person_main()
    {
        $crud = new grocery_CRUD();

        //$crud->set_theme('bootstrap');

        $crud->set_table('person_main')
            ->set_subject('บุคลากร')
            ->columns('person_id','prename', 'name', 'surname', 'position_code', 'department_id', 'status')
            ->display_as('person_id', 'รหัสบุคลากร')
            ->display_as('prename', 'คำนำหน้า')
            ->display_as('name', 'ชื่อ')
            ->display_as('surname', 'สกุล')
            ->display_as('idcard', 'เลขประจำตัวประชาชน')
            ->display_as('position_code', 'ตำแหน่ง')
            ->display_as('status', 'สถานะ')
            ->display_as('department_id', 'หน่วยงาน')
            ->display_as('email', 'อีเมล์')
            ->display_as('tel', 'โทรศัพท์')
            ->display_as('username', 'username')
            ->display_as('password', 'password')
            ->display_as('pic', 'รูป')
            ->display_as('personmember', 'สิทธิ์การใช้งาน')
            ->display_as('person_order', 'ลำดับที่บุคลากร')
            ->display_as('officer', 'ผู้ทำรายการ')
            ->display_as('rec_date', 'วันที่ทำรายการ');
        //$crud->where('person_main.department_id','14');
        //$crud->order_by('person_main.position_code','ASC');
        $crud->fields('prename', 'name', 'surname', 'idcard', 'position_code', 'department_id','email','tel', 'pic', 'username', 'password', 'personmember', 'status', 'officer', 'rec_date');
        $crud->required_fields('name', 'idcard', 'position_code', 'status', 'officer', 'rec_date');

        $crud->set_field_upload('pic', 'assets/uploads/person/pic', 'jpeg|jpg|png');

        $crud->set_relation('position_code', 'person_position', 'position_name');
        $crud->set_primary_key('department_id','view_system_department');
        $crud->set_relation('department_id', 'view_system_department', 'department_fullname');
        $crud->set_relation('status', 'person_status', 'person_statusname');
        $crud->set_relation_n_n('personmember', 'person_groupmember', 'person_group', 'person_id', 'person_groupid', 'person_groupname', 'priority');
        $crud->set_relation('officer', 'person_main', 'name');
        $crud->unique_fields('username','idcard');
        //$crud->unique_fields('idcard');
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

        //$crud->change_field_type('password','password');
        $crud->callback_before_insert(array($this, 'encrypt_password_callback_insert'));
        $crud->callback_before_update(array($this, 'encrypt_password_callback_update'));
        date_default_timezone_set("Asia/Bangkok");
        $output = $crud->render();

        $this->_example_output($output);
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

    public function add_field_username()
    {
        return '<input type="text" name="username"><br/><div class="label label-warning">กรณี username ซ้ำกับผู้ใช้งานอื่นจะไม่สามารถบันทึกได้</div>';
    }

    public function edit_field_username($value, $primary_key)
    {
        return '<input type="text" name="username" value="'.$value.'"><br/><div class="label label-warning">กรณี username ซ้ำกับผู้ใช้งานอื่นจะไม่สามารถบันทึกได้</div>';
    }

    public function add_field_callback_2()
    {
        return '<input type="password" name="password">';
    }

    public function edit_field_callback_2($value, $primary_key)
    {
        return '<input type="password" name="password"><br/><div class="label label-warning">กรอก password กรณีต้องการเปลี่ยนใหม่</div>';
    }

    public function encrypt_password_callback_insert($post_array, $primary_key = null)
    {
        $post_array['password'] = md5($post_array['password']);
        return $post_array;
    }

    public function encrypt_password_callback_update($post_array, $primary_key)
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

    public function system_department()
    {
        $crud = new grocery_CRUD();

        //$crud->set_theme('bootstrap');

        $crud->set_table('system_department')
            ->set_subject('หน่วยงาน')
            ->columns('department_id','department_name', 'department_precis', 'department_masterid', 'department_typeid', 'department_refid', 'department_statusid')
            ->display_as('department_id', 'รหัสหน่วยงาน')
            ->display_as('department_name', 'ชื่อหน่วยงาน')
            ->display_as('department_precis', 'ชื่อย่อ')
            ->display_as('department_masterid', 'ต้นสังกัด')
            ->display_as('department_typeid', 'ประเภท')
            ->display_as('department_refid', 'เลขที่หนังสือ')
            ->display_as('department_statusid', 'สถานะ')
            ->display_as('department_order', 'ลำดับที่')
            ->display_as('groupmember', 'กลุ่มหน่วยงาน');
        $crud->fields('department_name', 'department_precis', 'department_typeid', 'department_masterid', 'department_refid', 'department_order', 'groupmember', 'department_statusid');
        $crud->required_fields('department_name', 'department_precis', 'department_typeid', 'department_statusid');

        $crud->set_relation('department_typeid', 'system_department_type', 'department_typename');
        $crud->set_relation('department_statusid', 'system_department_status', 'department_statusname');
        $crud->set_relation('department_masterid', 'system_department', 'department_precis');
        $crud->set_relation_n_n('groupmember', 'system_department_groupmember', 'system_department_group', 'department_id', 'department_groupid', 'department_groupname', 'priority');

        $output = $crud->render();

        $this->_example_output($output);
    }

    public function system_department_type()
    {
        $crud = new grocery_CRUD();

        //$crud->set_theme('bootstrap');
        $crud->set_table('system_department_type')
            ->set_subject('ประเภทหน่วยงาน')
            ->columns('department_typeid', 'department_typename')
            ->display_as('department_typeid', 'รหัสประเภทหน่วยงาน')
            ->display_as('department_typename', 'ชื่อประเภทหน่วยงาน');

        $crud->fields('department_typename');
        $crud->required_fields('department_typename');

        $output = $crud->render();

        $this->_example_output($output);
    }

    public function system_user()
    {
        $crud = new grocery_CRUD();

        //$crud->set_theme('bootstrap');
        $crud->set_table('system_user')
            ->set_subject('ผู้ใช้งาน')
            ->columns('person_id', 'username', 'userpass')
            ->display_as('person_id', 'บุคลากร')
            ->display_as('username', 'username')
            ->display_as('userpass', 'password');
        $crud->fields('person_id', 'username', 'userpass');
        $crud->required_fields('person_id', 'username', 'userpass');

        $crud->set_primary_key('person_id', 'view_person_main');
        $crud->set_relation('person_id', 'view_person_main', 'fullname');

        $output = $crud->render();

        $this->_example_output($output);
    }

    public function system_department_group()
    {
        $crud = new grocery_CRUD();

        //$crud->set_theme('bootstrap');
        $crud->set_table('system_department_group')
            ->set_subject('กลุ่มหน่วยงาน')
            ->columns('department_groupid', 'department_groupname', 'department_grouporder')
            ->display_as('department_groupid', 'รหัสกลุ่มหน่วยงาน')
            ->display_as('department_groupname', 'กลุ่มหน่วยงาน')
            ->display_as('department_grouporder', 'ลำดับที่');
        $crud->fields('department_groupname', 'department_grouporder');
        $crud->required_fields('department_groupname');

        $output = $crud->render();

        $this->_example_output($output);
    }

    public function system_config()
    {
        $crud = new grocery_CRUD();
        $crud->set_table('system_config')
            ->set_subject('ตั้งค่าระบบ')
            ->columns('configkey', 'configdesc', 'configvalue')
            ->display_as('configkey', 'รายการ')
            ->display_as('configdesc', 'คำอธิบาย')
            ->display_as('configvalue', 'กำหนดค่า');
        $crud->fields('configkey', 'configdesc', 'configvalue');
        $crud->required_fields('configkey', 'configvalue');
        $output = $crud->render();
        $this->_example_output($output);
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

    public function person_profile()
    {
        //if($this->session->person_id!=$this->grocery_crud->getStateInfo()->primary_key){
        //redirect(base_url().'index.php/member/nopermission');
        //}
        // ระบบความปลอดภัย
        if($this->uri->segment(3)=='read' || $this->uri->segment(3)=='delete' || $this->uri->segment(3)=='edit'){
            //$this->load->model('BudgetModel');
            //$department = $this->BudgetModel->get_department_by_plan($this->uri->segment(4));
            if($this->uri->segment(4)!=$this->session->person_id){
                redirect(base_url().'index.php/member/nopermission');
            }
        }
        $crud = new grocery_CRUD();
        $crud->set_table('person_main')
            ->set_subject('บุคลากร')
            ->columns('prename', 'name', 'surname', 'position_code', 'department_id', 'status', 'officer')
            ->display_as('person_id', 'รหัสบุคลากร')
            ->display_as('prename', 'คำนำหน้า')
            ->display_as('name', 'ชื่อ')
            ->display_as('surname', 'สกุล')
            ->display_as('position_code', 'ตำแหน่ง')
            ->display_as('position_other_code', 'ตำแหน่งอื่นๆ')
            ->display_as('status', 'สถานะ')
            ->display_as('department_id', 'หน่วยงาน')
            ->display_as('email', 'อีเมล์')
            ->display_as('tel', 'โทรศัพท์')
            ->display_as('username', 'username')
            ->display_as('password', 'password')
            ->display_as('pic', 'รูป')
            ->display_as('personmember', 'สิทธิ์')
            ->display_as('person_order', 'ลำดับบุคลากร')
            ->display_as('officer', 'ผู้ทำรายการ')
            ->display_as('rec_date', 'วันที่ทำรายการ');
        $crud->where('person_main.person_id', $this->session->person_id);
        //$crud->order_by('person_main.position_code','ASC');
        $crud->fields('prename', 'name', 'surname','email','tel', 'pic', 'username', 'password', 'officer', 'rec_date');
        $crud->required_fields('prename', 'name', 'surname','email','tel', 'pic', 'username', 'officer', 'rec_date');

        $crud->set_field_upload('pic', 'assets/uploads/person/pic', 'jpeg|jpg|png');
        $crud->set_relation('position_code', 'person_position', 'position_name');
        $crud->set_relation('department_id', 'system_department', 'department_name');
        $crud->set_relation('status', 'person_status', 'person_statusname');
        $crud->set_relation('officer', 'person_main', 'name');
        //$crud->set_relation_n_n('personmember', 'person_groupmember', 'person_group', 'person_id', 'person_groupid', 'person_groupname','priority');
        //$crud->callback_add_field('password',array($this,'add_field_callback_2'));
        $crud->callback_edit_field('password', array($this, 'edit_field_callback_2'));
        $crud->callback_edit_field('officer', array($this, 'edit_field_callback_officer'));
        $crud->callback_edit_field('rec_date', array($this, 'edit_field_callback_rec_date'));
        //$crud->change_field_type('password','password');
        $crud->callback_before_insert(array($this, 'encrypt_password_callback_insert'));
        $crud->callback_before_update(array($this, 'encrypt_password_callback_update'));
        $crud->unset_add();
        $crud->unset_delete();
        $crud->unique_fields('username');
        date_default_timezone_set("Asia/Bangkok");
        $output = $crud->render();

        $this->_example_output($output);
    }

    public function edit_field_callback_officer($value, $primary_key)
    {
        $this->load->model('HomeModel');
        $officer_name = $this->HomeModel->get_person_name($value);
        return $officer_name . '<input type="hidden" name="officer" value="' . $this->session->person_id . '">';
    }

    public function edit_field_callback_rec_date($value, $primary_key)
    {
        return $value . '<input type="hidden" name="rec_date" value="' . date('Y-m-d H:i:s') . '">';
    }

    public function person_profile1()
    {
        $data['content'] = 'member/profile_edit';
        $this->load->model('HomeModel');
        $data['data'] = $this->HomeModel->get_person_data($this->session->person_id);
        $this->load->view('templates/index', $data);
    }

    public function person_profile_edit()
    {
        $this->load->model('HomeModel');
        $data['data'] = $this->HomeModel->get_person_data($this->session->person_id);
        $this->load->view('templates/index', $data);
    }

    public function test()
    {
        $crud = new grocery_CRUD();
        $crud->set_table('test')
            ->set_subject('ตารางทดสอบ')
            ->columns('test_id', 'test_name')
            ->display_as('test_id', 'รหัส')
            ->display_as('test_name', 'ชื่อ');
        $crud->fields('test_id', 'test_name');
        $crud->required_fields('test_id', 'test_name');
        $crud->unset_edit();
        $output = $crud->render();
        $this->_example_output($output);
    }

    public function planadmin()
    {
        // ตัวอย่างการใช้งาน grocery crud
        $crud = new grocery_CRUD();
        $crud->set_table('plan')
            ->set_subject('แผนงาน/โครงการ')
            ->columns('plan_id', 'plan_groupid','department_id','plan_schoolname','plan_name','budget')
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
        //$crud->where('department_id',$this->session->department_id);
        $crud->set_relation('plan_groupid', 'plan_group', 'plan_groupname');
        $crud->set_relation('policy_id', 'policy', 'policy_name');
        $crud->set_relation('department_id', 'system_department', 'department_precis');
        $crud->set_relation('person_id', 'person_main', 'name');
        
        //$crud->callback_column('plan_name', array($this, '_full_text'));
        
        //$crud->callback_add_field('department_id', array($this, 'add_field_callback_department_id'));
        //$crud->callback_edit_field('department_id', array($this, 'edit_field_callback_department_id'));
        $crud->callback_add_field('person_id', array($this, 'add_field_callback_person_id'));
        $crud->callback_edit_field('person_id', array($this, 'edit_field_callback_person_id'));
        date_default_timezone_set("Asia/Bangkok");
        $output = $crud->render();
        $this->_example_output($output);
    }

    //function _full_text($value, $row)
    //{
    //    return $value = mb_substr($value,0,30,'UTF-8').'...';
    //}

    public function add_field_callback_person_id()
    {
        return $this->session->fullname . '<input type="hidden" name="person_id" value="' . $this->session->person_id . '">';
    }
    public function edit_field_callback_person_id($value, $primary_key)
    {
        return $this->session->fullname . '<input type="hidden" name="person_id" value="' . $this->session->person_id . '">';
    }

    public function planexport()
    {
        // ตัวอย่างการใช้งาน grocery crud
        $crud = new grocery_CRUD();
        $crud->set_table('plan')
            ->set_subject('แผนงาน/โครงการ')
            ->columns('plan_id', 'plan_groupid','policy_id','department_id','plan_schoolname','plan_name','objective','activity','quantity','quanlity','kpi','result','budget','person_id')
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
        //$crud->where('department_id',$this->session->department_id);
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

    public function bookgroup()
    {
        $crud = new grocery_CRUD();

        //$crud->set_theme('bootstrap');
        $crud->set_table('ioffice2_bookgroup')
            ->set_subject('ทะเบียนหนังสือราชการ')
            ->columns('bookgroupid', 'bookgroupname','bookgroupstatusid')
            ->display_as('bookgroupid', 'รหัสทะเบียนหนังสือ')
            ->display_as('bookgroupname', 'ชื่อทะเบียนหนังสือ')
            ->display_as('bookgroupstatusid', 'สถานะ');

        $crud->fields('bookgroupname','bookgroupstatusid');
        $crud->required_fields('bookgroupname','bookgroupstatusid');
        $crud->set_relation('bookgroupstatusid','ioffice2_bookgroupstatus','bookgroupstatusname');

        $output = $crud->render();

        $this->_example_output($output);
    }

}
