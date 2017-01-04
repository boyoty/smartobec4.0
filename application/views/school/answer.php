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
    <h4><?php echo '<div class="label label-primary">'.$this->session->department_name.'</div>&nbsp; | &nbsp;'.$this->session->question_sheetname.'&nbsp; | &nbsp;'.$this->input->post('student_name'); ?></h4>
    <!-- progress bar -->
    <div class="progress">
      <div class="progress-bar progress-bar-danger progress-bar-striped active" style="width: 35%"></div>
      <div class="progress-bar progress-bar-warning progress-bar-striped active" style="width: 20%"></div>
      <div class="progress-bar progress-bar-success progress-bar-striped active" style="width: 10%"></div>
    </div>
    <!-- ตารางรายการข้อมูล -->
    <div class="table-responsive">
    <?php echo form_open('school/answer_save'); ?>
      <input type="hidden" name="student_id" value="<?php echo $this->input->post('student_id'); ?>">
      <table class="table table-condensed table-hover table-striped">
        <!-- หัวตาราง -->
        <!--<thead>
          <th>รายการ</th>
          <th>ข้อมูล</th>
        </thead>
        -->
        <tfoot>
          <tr>
            <td colspan="2"><br>&nbsp;<button class="btn btn-primary" type="submit" name="submit" value="save"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;บันทึก</button>&nbsp;<a class="btn btn-default" href="<?php echo base_url().'index.php/school/select_student';?>">ยกเลิก</a></td>
          </tr>
        </tfoot>
        <!-- รายการข้อมูล -->
        <tbody>
          <?php 
          if($data!=false)
          {
            $no=0;
            foreach ($data as $row) 
            { 
              $class="";
              $question_name='&nbsp;&nbsp;&nbsp;&nbsp;'.$row->question_name;
              if($row->question_typeid==1){ 
                $class='class="info"'; 
                $question_name=''.$row->question_name.''; 
              }
              if($row->question_typeid==2){ 
                $class='class="success"'; 
                $question_name='&nbsp;&nbsp;'.$row->question_name.''; 
              }
              ?>
              <tr <?php echo $class; ?>>
                <td width="50%"><?php echo $question_name; ?></td>
                <td>
                  <?php
                  switch ($row->question_typeid) {
                    case 1:
                      # code...
                      break;
                    case 2:
                      # code...
                      break;
                    case 3:
                      echo '<input type="text" class="form-control" name="'.$row->question_id.'" placeholder="ตัวเลข" required>';
                      break;
                    case 4:
                      echo '<input type="text" class="form-control" name="'.$row->question_id.'" placeholder="ร้อยละ" required>';
                      break;
                    case 5:
                      echo '<input type="text" class="form-control" name="'.$row->question_id.'" placeholder="ข้อความสั้นๆ" required>';
                      break;
                    case 6:
                      ?>
                      <!-- radio -->
                      <div class="form-group">
                        <?php 
                        $answer_array = explode(',', $row->question_answer); 
                        foreach ($answer_array as $value) {
                          ?>
                          <div class="radio">
                            <label>
                              <input type="radio" name="<?php echo $row->question_id; ?>" value="<?php echo $value; ?>" required>
                              <?php echo $value; ?>
                            </label>
                          </div>
                          <?php
                        }
                        ?>
                      </div>
                      <?php
                      break;
                    case 7:
                      ?>
                      <!-- checkbox -->
                      <div class="form-group">
                        <?php 
                        $answer_array = explode(',', $row->question_answer); 
                        $check_no=0;
                        foreach ($answer_array as $value) {
                          ?>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="<?php echo $row->question_id; ?>[]" value="<?php echo $value; ?>">
                              <?php echo $value; ?>
                            </label>
                          </div>
                          <?php
                        }
                        ?>
                      </div>
                      <?php
                      break;
                    case 8:
                      echo '<textarea name="'.$row->question_id.'" class="form-control" rows="3" required></textarea>';
                      break;
                    
                    default:
                      echo '&nbsp;';
                      break;
                  }
                  ?>
                </td>
              </tr>
              <?php
            }
          }
          ?>
        </tbody>
      </table>
      <?php echo form_close(); ?>
    </div>
    <!-- จบส่วนแสดงผล -->
  </div>
</div>