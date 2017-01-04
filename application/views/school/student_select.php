<script type="text/javascript">
  $(document).ready(function(){
    $('#username').focus();
    $('#btn_login').click(function(){
      $.ajax({
        url:'<?php echo base_url(); ?>index.php/home/login',
        data:'username='+$('#username').val()+'&password='+$('#password').val(),
        type:'POST',
        success:function(res){
          if(res=='true'){
            swal({
                  title : 'แสดงเมือทำงานสำเร็จ',
                  text : '',
                  type : 'success'
                  },
                  function(){
                    // เมื่อทำงานสำเร็จให้ไปที่หน้านี้
                    window.location.replace("<?php echo base_url() ?>index.php/member");
                  }
              );

          }else{
            swal({
                  title : 'แสดงเมื่อทำงานไม่สำเร็จ',
                  text : '',
                  type : 'error'
              });
          }
        },
        error:function(err){
          swal({
                  title : 'เกิดข้อผิดพลาด',
                  text : err,
                  type : 'error'
              });
        }
      });
    });
  });
</script>
<div class="box box-success">
  <div class="box-header">
        <i class="fa fa-sign-in"></i>
    <h3 class="box-title"><?php echo $this->systemmodel->get_menuname($this->uri->segment(1) . '/' . $this->uri->segment(2)); // แสดงชื่อเมนู  ?></h3>
  </div>
  <div class="box-body">
    <!-- ส่วนแสดงผล -->
    <h4><?php echo '<div class="label label-primary">'.$this->session->department_name.'</div>&nbsp; | &nbsp;'.$this->session->question_sheetname; ?></h4>
    <!-- progress bar -->
    <div class="progress">
      <div class="progress-bar progress-bar-danger progress-bar-striped active" style="width: 35%"></div>
      <div class="progress-bar progress-bar-warning progress-bar-striped active" style="width: 20%"></div>
      <div class="progress-bar progress-bar-success progress-bar-striped active" style="width: 10%"></div>
    </div>
    <!-- ตารางรายการข้อมูล -->
    <div class="table-responsive">
      <table class="table table-striped table-condensed table-hover">
        <!-- หัวตาราง -->
        <thead>
          <th>#</th>
          <th>เลขประจำตัวประชาชน</th>
          <th>เลขประจำนักเรียน</th>
          <th>ชื่อ</th>
          <th>เพศ</th>
          <th>ชั้น</th>
          <th>ห้อง</th>
          <th>จัดการ</th>
        </thead>
        <!-- รายการข้อมูล -->
        <tbody>
          <?php 
          if($data!=false)
          {
            $no=0;
            //$this->load->model('QuestionModel');
            foreach ($data as $row) 
            { 
              $answer_status = $this->QuestionModel->get_answered($this->session->question_sheetid,$row->student_id);
              if($answer_status==true){
                $class = 'success'; 
                $btn_name = 'เรียบร้อย';
              }else{
                $class = 'danger';
                $btn_name = 'บันทึกข้อมูล';
              }
              ?>
              <tr>
                <td><?php echo ++$no; ?></td>
                <td><?php echo $row->idcard; ?></td>
                <td><?php echo $row->studentcode; ?></td>
                <td><?php echo $row->name.'&nbsp;&nbsp;'.$row->surname; ?></td>
                <td><?php echo $row->gender; ?></td>
                <td><?php echo $row->level; ?></td>
                <td><?php echo $row->classno; ?></td>
                <td>
                  <div class="btn-group btn-group-xs" role="group" aria-label="...">
                    <?php echo form_open('school/answer_form'); ?>
                    <input type="hidden" name="student_name" value="<?php echo $row->name.'&nbsp;&nbsp;'.$row->surname; ?>">
                    <button type="button" class="btn btn-primary btn-xs" name="answer_view"><span class='glyphicon glyphicon-search'></span></button>
                    <button type="submit" class="btn btn-<?php echo $class;?> btn-xs" name="student_id" value="<?php echo $row->student_id; ?>"><?php echo $btn_name;?></button>
                    <?php echo form_close(); ?>
                  </div>
                </td>
              </tr>
              <?php
            }
          }
          ?>
        </tbody>
      </table>
    </div>
    <!-- จบส่วนแสดงผล -->
  </div>
</div>