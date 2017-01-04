<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// เปลี่ยนชื่อโมเดล (MemberModel) ให้เป็นชื่อโมเดล อักษาตัวแรกให้เป็นตัวใหญ่และตามด้วยคำว่า Model
class QuestionModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function example_model($username, $password)
    {
        // ตัวอย่างการใช้งานโมเดล
        $query = $this->db
            ->where('status', 1)
            ->where('username', $username)
            ->where('password', md5($password))
            ->get('person_main');
        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
                return $row->person_id;
            }
        } else {
            return false;
        }
    }

    function get_addressbook() {     
        $query = $this->db->get('addressbook');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
 
    function insert_csv($data) {
        $this->db->insert('addressbook', $data);
    }

    function get_question($question_sheetid) {     
        $this->db->where('question_sheetid', $question_sheetid);
        $this->db->order_by('question_order');
        $query = $this->db->get('question');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_question_sheet() {     
        $this->db->where('question_sheetstatusid', 1);
        $this->db->order_by('question_sheetorder');
        $query = $this->db->get('question_sheet');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_question_sheetname($question_sheetid) {     
        $this->db->where('question_sheetid', $question_sheetid);
        $query = $this->db->get('question_sheet');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                return $row->question_sheetname;
            }
        } else {
            return false;
        }
    }

    function get_answered($question_sheetid,$student_id){
        $this->db->where('question_sheetid',$question_sheetid);
        $this->db->where('student_id',$student_id);
        $query = $this->db->get('view_answered');
        if($query->num_rows()>0){
            return true;
        }else{
            return false;
        }
    }

    function answer_save($data){
        $this->db->insert('answer', $data);
    }

    function answer_delete($question_id,$student_id){
        $this->db->where('question_id', $question_id);
        $this->db->where('student_id', $student_id);
        $this->db->delete('answer');
    }

}
