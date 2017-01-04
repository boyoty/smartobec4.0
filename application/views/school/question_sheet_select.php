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
    <h4>เลือกแบบสำรวจข้อมูล</h4>
    <!-- ตารางรายการข้อมูล -->
    <div class="table-responsive">
      <table class="table table-striped table-condensed table-hover">
        <!-- หัวตาราง -->
        <thead>
          <th>#</th>
          <th>รหัสชุดแบบสำรวจ</th>
          <th>ชุดแบบสำรวจข้อมูล</th>
          <th>จัดการ</th>
        </thead>
        <!-- รายการข้อมูล -->
        <tbody>
          <?php 
          if($data!=false)
          {
            $no=0;
            foreach ($data as $row) 
            { 
              ?>
              <tr>
                <td><?php echo ++$no; ?></td>
                <td><?php echo $row->question_sheetid; ?></td>
                <td><?php echo $row->question_sheetname; ?></td>
                <td>
                  <div class="btn-group btn-group-xs" role="group" aria-label="...">
                    <?php echo form_open('school/select_student'); ?>
                    <button type="submit" class="btn btn-primary btn-xs" name="question_sheetid" value="<?php echo $row->question_sheetid; ?>">เลือกรายการ</span></button>
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