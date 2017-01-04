<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// เปลี่ยนชื่อโมเดล (MemberModel) ให้เป็นชื่อโมเดล อักษาตัวแรกให้เป็นตัวใหญ่และตามด้วยคำว่า Model
class IofficeModel extends CI_Model
{

    var $table = 'view_node';
    var $column_order = array('nodename','department_typename'); //set column field database for datatable orderable
    var $column_search = array('nodename','department_typename'); //set column field database for datatable searchable 
    var $order = array('nodeid' => 'asc'); // default order 

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

    function get_book2($person_id) {  
        $this->db->select('ib.*,ibt.booktypename,ibs.bookstatusname,vpm.fullname,ibg.bookgroupname');
        $this->db->from('ioffice2_book ib');   
        $this->db->join('ioffice2_booktype ibt','ibt.booktypeid=ib.booktypeid');
        $this->db->join('ioffice2_bookstatus ibs','ibs.bookstatusid=ib.bookstatusid');
        $this->db->join('ioffice2_bookgroup ibg','ib.bookgroupid=ibg.bookgroupid');
        $this->db->join('view_person_main vpm','vpm.person_id=ib.post_personid');
        $this->db->where('post_personid', $person_id);
        $this->db->order_by('updatedate','desc');
        //$this->db->limit(20);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_book($person_id) {  
        $this->db->select('ib.*,ibt.booktypename,ibs.bookstatusname,vpm.fullname');
        $this->db->from('ioffice_book as ib');   
        $this->db->join('ioffice_booktype as ibt','ibt.booktypeid=ib.booktypeid');
        $this->db->join('ioffice_bookstatus as ibs','ibs.bookstatusid=ib.bookstatusid');
        $this->db->join('view_person_main vpm','vpm.person_id=ib.post_personid');
        $this->db->where('post_personid', $person_id);
        $this->db->order_by('updatedate','desc');
        //$this->db->limit(20);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getall_book($person_id) {  
        $this->db->select('ib.*,ibt.booktypename,ibs.bookstatusname,vpm.fullname');
        $this->db->from('ioffice_book as ib');   
        $this->db->join('ioffice_booktype as ibt','ibt.booktypeid=ib.booktypeid');
        $this->db->join('ioffice_bookstatus as ibs','ibs.bookstatusid=ib.bookstatusid');
        $this->db->join('view_person_main vpm','vpm.person_id=ib.post_personid');
        $this->db->where('post_personid', $person_id);
        $this->db->order_by('updatedate','desc');
        //$this->db->limit(20);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function getpage_book($person_id,$limit,$page) {  
        $this->db->select('ib.*,ibt.booktypename,ibs.bookstatusname,vpm.fullname');
        $this->db->from('ioffice_book as ib');   
        $this->db->join('ioffice_booktype as ibt','ibt.booktypeid=ib.booktypeid');
        $this->db->join('ioffice_bookstatus as ibs','ibs.bookstatusid=ib.bookstatusid');
        $this->db->join('view_person_main vpm','vpm.person_id=ib.post_personid');
        $this->db->where('post_personid', $person_id);
        $this->db->order_by('updatedate','desc');
        //$start = $limit*($page-1);
        //$this->db->limit($limit,$start);
        //$this->db->limit(5);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_book_comment($person_id) {  
        $this->db->select('ib.*,ibc.commentid,ibt.booktypename,ibs.bookstatusname,vpm.fullname');
        $this->db->from('ioffice_book as ib');   
        $this->db->join('ioffice_booktype as ibt','ibt.booktypeid=ib.booktypeid');
        $this->db->join('ioffice_bookstatus as ibs','ibs.bookstatusid=ib.bookstatusid');
        $this->db->join('ioffice_bookcomment ibc','ibc.bookid=ib.bookid');
        $this->db->join('view_person_main vpm','vpm.person_id=ib.post_personid');
        $this->db->where('ibc.comment_personid', $person_id);
        $this->db->where('ibc.bookstatusid',2);
        $this->db->order_by('updatedate','desc');
        //$this->db->limit(20);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_book_commented($person_id) {  
        $this->db->select('ib.*,ibt.booktypename,ibs.bookstatusname,vpm.fullname');
        $this->db->from('ioffice_book as ib');   
        $this->db->join('ioffice_booktype as ibt','ibt.booktypeid=ib.booktypeid');
        $this->db->join('ioffice_bookstatus as ibs','ibs.bookstatusid=ib.bookstatusid');
        $this->db->join('ioffice_bookcomment ibc','ibc.bookid=ib.bookid');
        $this->db->join('view_person_main vpm','vpm.person_id=ib.post_personid');
        $this->db->where('ibc.comment_personid', $person_id);
        $this->db->where('ibc.bookstatusid<>2');
        $this->db->order_by('updatedate','desc');
        //$this->db->limit(20);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_book_byid($bookid) {  
        $this->db->select('ib.*,ibt.booktypename,ibs.bookstatusname,vpm.fullname');
        $this->db->from('ioffice_book as ib');   
        $this->db->join('ioffice_booktype as ibt','ibt.booktypeid=ib.booktypeid');
        $this->db->join('ioffice_bookstatus as ibs','ibs.bookstatusid=ib.bookstatusid');
        $this->db->join('view_person_main vpm','vpm.person_id=ib.post_personid');
        $this->db->where('ib.bookid', $bookid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function get_receive_person()
    {
        $this->db->select('*');
        $this->db->from('view_receive_person');
        $query = $this->db->get();
        if($query->num_rows() >0 ) {
            return $query->result();
        }else{
            return false;
        }
    }

    function get_book_person()
    {
        $this->db->where('department_typeid',1);
        $this->db->or_where('department_typeid',2);
        $this->db->or_where('department_typeid',3);
        $this->db->order_by('department_id,position_code');
        $query = $this->db->get('view_person_main');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    function get_student_info($student_id){
        $this->db->where('student_id',$student_id);
        $query = $this->db->get('student_main');
        if($query->num_rows() > 0) {
            return $query->result();
        }else{
            return false;
        }
    }

    function get_department_group_used()
    {
        $query = $this->db->get('view_department_group_used');
        if($query->num_rows() > 0) {
            return $query->result();
        }else{
            return false;
        }
    }

    function get_node_group($department_groupid)
    {
        $this->db->where('department_groupid',$department_groupid);
        $this->db->where('notetype','department');
        $query = $this->db->get('view_node_group');
        if($query->num_rows() > 0) {
            return $query->result();
        }else{
            return false;
        }
    }

    function get_node_person($department_id)
    {
        $this->db->where('department_id',$department_id);
        $this->db->where('nodetype','person');
        $query = $this->db->get('view_node_group');
        if($query->num_rows() > 0) {
            return $query->result();
        }else{
            return false;
        }
    }

    function get_bookfile($bookid)
    {
        $this->db->where('bookid',$bookid);
        $query = $this->db->get('ioffice_bookfile');
        if($query->num_rows() > 0 ){
            return $query->result();
        }else{
            return false;
        }
    }

    function get_bookfile_count($bookid)
    {
        $this->db->where('bookid',$bookid);
        $query = $this->db->get('ioffice_bookfile');
        return $query->num_rows();
    }

    function get_book2file_count($bookid)
    {
        $this->db->where('bookid',$bookid);
        $query = $this->db->get('ioffice2_bookfile');
        return $query->num_rows();
    }

    function get_bookcomment($bookid)
    {
        $this->db->select('ibc.*,ibs.bookstatusname,pp.position_name,sd.department_precis,vpm.fullname');
        $this->db->from('ioffice_bookcomment ibc');   
        $this->db->join('ioffice_bookstatus ibs','ibs.bookstatusid=ibc.bookstatusid');
        $this->db->join('person_position pp','pp.position_code=ibc.comment_positionid');
        $this->db->join('system_department sd','sd.department_id=ibc.comment_departmentid');
        $this->db->join('view_person_main vpm','vpm.person_id=ibc.comment_personid');
        $this->db->where('bookid', $bookid);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    function book_insert($data){
        $this->db->insert('ioffice_book', $data);
        return $this->db->insert_id();
    }

    function book2_insert($data){
        $this->db->insert('ioffice2_book', $data);
        return $this->db->insert_id();
    }

    function book_update($bookid,$data)
    {
        $this->db->where('bookid',$bookid);
        $this->db->update('ioffice_book',$data);
    }

    function book2_update($bookid,$data)
    {
        $this->db->where('bookid',$bookid);
        $this->db->update('ioffice2_book',$data);
    }

    function book_comment_update($commentid,$data)
    {
        $this->db->where('commentid',$commentid);
        $this->db->update('ioffice_bookcomment',$data);
    }

    function book2_comment_update($commentid,$data)
    {
        $this->db->where('commentid',$commentid);
        $this->db->update('ioffice2_bookcomment',$data);
    }

    function book_comment_insert($data)
    {
        $this->db->insert('ioffice_bookcomment',$data);
    }

    function book2_comment_insert($data){
        $this->db->insert('ioffice2_bookcomment', $data);
    }

    function bookfile_insert($data){
        $this->db->insert('ioffice_bookfile', $data);
    }

    function book2file_insert($data){
        $this->db->insert('ioffice2_bookfile', $data);
    }

    function del_bookfile($fileid)
    {
        $this->db->where('fileid', $fileid);
        $this->db->delete('ioffice_bookfile');
    }

    function set_bookstatus($bookid,$data)
    {
        $this->db->where('bookid',$bookid);
        $this->db->update('ioffice_book',$data);
    }

    function set_book2status($bookid,$data)
    {
        $this->db->where('bookid',$bookid);
        $this->db->update('ioffice2_book',$data);
    }

    function get_department()
    {
        $query = $this->db->get('system_department');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    function get_last_bookreceive($personid)
    {
        $this->db->where('post_personid',$personid);
        $this->db->where("bookreceive<>'-'");
        $this->db->order_by('bookid','desc');
        $this->db->limit(1);
        $query = $this->db->get('ioffice_book');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }
    }

    function get_last_bookheader($personid)
    {
        $this->db->where('post_personid',$personid);
        $this->db->where("bookheader<>'-'");
        $this->db->order_by('bookid','desc');
        $this->db->limit(1);
        $query = $this->db->get('ioffice_book');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }
    }

    function get_last_comment_personid()
    {
        $this->db->where('post_personid',$this->session->person_id);
        $this->db->order_by('bookid','desc');
        $this->db->limit(1);
        $query = $this->db->get('ioffice_book');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }
    }

    function get_bookstat($personid)
    {
        $this->db->where('post_personid',$personid);
        $query = $this->db->get('view_bookstat');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }
    }

    // Start Book2

    function get_book2stat($personid)
    {
        $this->db->where('post_personid',$personid);
        $query = $this->db->get('view_book2stat');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }
    }

    function get_book2comment_income($person_nodeid) {  
        $this->db->select('ib.*,ibc.commentid,ibt.booktypename,ibs.bookstatusname,vpm.fullname,ibg.bookgroupname');
        $this->db->from('ioffice2_book ib');   
        $this->db->join('ioffice2_booktype ibt','ibt.booktypeid=ib.booktypeid');
        $this->db->join('ioffice2_bookstatus ibs','ibs.bookstatusid=ib.bookstatusid');
        $this->db->join('ioffice2_bookgroup ibg','ib.bookgroupid=ibg.bookgroupid');
        $this->db->join('view_person_main vpm','vpm.person_id=ib.post_personid');
        $this->db->join('ioffice2_bookcomment ibc','ib.bookid=ibc.bookid');
        $this->db->where('comment_nodeid', $person_nodeid);
        $this->db->where('ibc.bookstatusid', 2);
        //$this->db->where('bookstatusid', $person_nodeid);
        $this->db->order_by('updatedate','desc');
        //$this->db->limit(20);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_book2comment($bookid)
    {
        $this->db->select('ibc.*,ibs.bookstatusname,vng.nodename');
        $this->db->from('ioffice2_bookcomment ibc');   
        $this->db->join('ioffice2_bookstatus ibs','ibs.bookstatusid=ibc.bookstatusid','left');
        $this->db->join('view_node vng','vng.nodeid=ibc.comment_nodeid','left');
        $this->db->where('bookid', $bookid);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    function get_book2file($bookid)
    {
        $this->db->where('bookid',$bookid);
        $query = $this->db->get('ioffice2_bookfile');
        if($query->num_rows() > 0 ){
            return $query->result();
        }else{
            return false;
        }
    }

    function get_last_book2receive($personid)
    {
        $this->db->where('post_personid',$personid);
        $this->db->where("bookreceive<>'-'");
        $this->db->order_by('bookid','desc');
        $this->db->limit(1);
        $query = $this->db->get('ioffice2_book');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }
    }

    function get_last_book2header($personid)
    {
        $this->db->where('post_personid',$personid);
        $this->db->where("bookheader<>'-'");
        $this->db->order_by('bookid','desc');
        $this->db->limit(1);
        $query = $this->db->get('ioffice2_book');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }
    }

    function get_last_book2from($personid)
    {
        $this->db->where('post_personid',$personid);
        $this->db->where("bookfrom<>'-'");
        $this->db->order_by('bookid','desc');
        $this->db->limit(1);
        $query = $this->db->get('ioffice2_book');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }
    }

    function get_last_comment2_personid()
    {
        $this->db->where('post_personid',$this->session->person_id);
        $this->db->order_by('bookid','desc');
        $this->db->limit(1);
        $query = $this->db->get('ioffice2_book');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }
    }

    function get_bookgroup()
    {
        $query = $this->db->get('ioffice2_bookgroup');
        if($query->num_rows() > 0 ){
            return $query->result();
        }else{
            return false;
        }
    }

    function get_book2_byid($bookid) {  
        $this->db->select('ib.*,ibt.booktypename,ibs.bookstatusname,vpm.fullname,vpm.fullname_position_department,ibg.bookgroupname');
        $this->db->from('ioffice2_book ib');   
        $this->db->join('ioffice2_booktype ibt','ibt.booktypeid=ib.booktypeid');
        $this->db->join('ioffice2_bookstatus ibs','ibs.bookstatusid=ib.bookstatusid');
        $this->db->join('ioffice2_bookgroup ibg','ib.bookgroupid=ibg.bookgroupid');
        $this->db->join('view_person_main vpm','vpm.person_id=ib.post_personid');
        $this->db->where('ib.bookid', $bookid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function get_book2_departmentid($bookgroupid,$departmentid)
    {
        // ดึงคำนำหน้าเลขที่หนังสือ
        $this->db->where('department_id',$departmentid);
        $query = $this->db->get('system_department');
        if($query->num_rows()==1){
            foreach ($query->result() as $row) {
                if($row->bookregister_departmentid!=''){
                    $departmentid = $row->bookregister_departmentid; 
                }
                $department_refid = $row->department_refid;
            }
        }else{
            $department_refid='';
        }
        $this->db->where('bookgroupid',$bookgroupid);
        $this->db->where('departmentid',$departmentid);
        $this->db->where('periodid',date("Y")+543);
        $query = $this->db->get('ioffice2_bookid');
        if($query->num_rows()==1){
            foreach ($query->result() as $row) {
                $department_bookid = $row->department_bookid+1;
            }
            $data = array(
                    'department_bookid'=>$department_bookid
                );
            $this->db->where('bookgroupid',$bookgroupid);
            $this->db->where('departmentid',$departmentid);
            $this->db->where('periodid',date("Y")+543);
            $this->db->update('ioffice2_bookid',$data);
            return $department_refid.$department_bookid;
        }else{
            $periodid = date("Y")+543;
            $data = array(
                'departmentid'=>$departmentid,
                'bookgroupid'=>$bookgroupid,
                'periodid'=>$periodid,
                'department_bookid'=>1
                );
            $this->db->insert('ioffice2_bookid',$data);
            return $department_refid.'1';
        }
    }

    function get_system_department_group()
    {
        $query = $this->db->get('system_department_group');
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return false;
        }
    }

    function getall_departmentgroup()
    {
        $query = $this->db->get('system_department_group');
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return false;
        }
    }

    function getall_node($nodetype,$department_masterid)
    {
        $this->db->where('nodetype',$nodetype);
        if($department_masterid!=null){
            $this->db->where('((department_masterid='.$department_masterid.') || (department_id='.$department_masterid.'))');
        }
        $query = $this->db->get('view_node');
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return false;
        }
    }

    function getall_node_bydep($nodetype,$department_id)
    {
        $this->db->where('nodetype',$nodetype);
        $this->db->where('department_id',$department_id);
        $query = $this->db->get('view_node');
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return false;
        }
    }

    function get_multiselect_node()
    {
        $this->db->order_by('department_id');
        $query = $this->db->get('view_node');
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return false;
        }
    }

    function get_book2group()
    {
        $query = $this->db->get('ioffice2_bookgroup');
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return false;
        }
    }

    function getall_note(){
        $this->db->order_by('department_id');
        $query = $this->db->get('view_node');
        return $query->num_rows();
    }

    function getpage_note($page,$per_page){
        $this->db->limit($page,$per_page);
        $query = $this->db->get('view_node');
        if($query->num_rows()>0){
            return $query->result;
        }else{
            return false;
        }
    }

    function get_node_bygroup($department_groupid){
        $this->db->where('department_groupid',$department_groupid);
        $this->db->where('nodetype','department');
        $this->db->order_by('department_id');
        $query = $this->db->get('view_node');
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return false;
        }
    }

    function tmp_select_node_insert($data){
        $this->db->insert('ioffice2_tmp_select_node', $data);
    }

    function tmp_select_node_delete($person_id,$nodeid,$token)
    {
        $this->db->where('person_id', $person_id);
        $this->db->where('nodeid',$nodeid);
        $this->db->where('token',$token);
        $this->db->delete('ioffice2_tmp_select_node');
    }

    function tmp_select_node_clear($person_id,$token)
    {
        $this->db->where('person_id', $person_id);
        $this->db->where('token',$token);
        $this->db->delete('ioffice2_tmp_select_node');
    }

    function get_tmp_select_node($person_id,$token){
        $this->db->where('person_id',$person_id);
        $this->db->where('token',$token);
        $this->db->order_by('nodeid');
        $query = $this->db->get('ioffice2_tmp_select_node');
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return false;
        }
    }

    function get_book2id($bookid){
        $this->db->where('ref_bookid',$bookid);
        $query = $this->db->get('ioffice2_book');
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return false;
        }
    }

    // End Book2

    // datatable
    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

}
