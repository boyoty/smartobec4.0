<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// เปลี่ยนชื่อคลาส (Name) ให้เป็นชื่อคอนโทรลเลอร์ อักษาตัวแรกให้เป็นตัวใหญ่
class Account extends CI_Controller
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

    public function po()
    {
        // ตัวอย่างการใช้งาน grocery crud
        $crud = new grocery_CRUD();
        $crud->set_table('budget_po')
            ->set_subject('ทะเบียนคุมใบงวด')
            ->columns('poid', 'potitle','pototal','poused','pobalance')
            ->display_as('poid', 'เลขที่ใบงวด')
            ->display_as('potitle', 'รายละเอียดใบงวด')
            ->display_as('pototal', 'งบประมาณทั้งหมด')
            ->display_as('poused', 'งบประมาณใช้ไป')
            ->display_as('pobalance', 'งบประมาณคงเหลือ');
        $crud->fields('potitle','pototal');
        $crud->required_fields('potitle','pototal');
        $output = $crud->render();
        $this->_example_output($output);
    }

    public function po_report()
    {
        $data['content'] = 'budget/po';
        $this->load->model('AccountModel');
        $data['data'] = $this->AccountModel->get_po();
        $this->load->view('templates/index', $data);
    }

    public function used()
    {
        // ตัวอย่างการใช้งาน grocery crud
        $crud = new grocery_CRUD();
        $crud->set_table('budget_used')
            ->set_subject('ทะเบียนคุมใบเบิก')
            ->columns('usedid','usedtitle','poid','poused')
            ->display_as('usedid', 'เลขที่ใบเบิก')
            ->display_as('poid', 'เลขที่ใบงวด')
            ->display_as('usedtitle', 'รายละเอียดใบเบิก')
            ->display_as('poused', 'งบประมาณใช้ไป');
        $crud->fields('usedtitle','poid','poused');
        $crud->required_fields('usedtitle','poid','poused');
        $crud->set_relation('poid','budget_po','potitle');
        $output = $crud->render();
        $this->_example_output($output);
    }

}
