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
    <?php if (isset($error)): ?>
      <div class="alert alert-error"><?php echo $error; ?></div>
      <?php endif; ?>
      <?php if ($this->session->flashdata('success') == TRUE): ?>
          <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
      <?php endif; ?>
      <h2>เลือกไฟล์ข้อมูลนักเรียน csv</h2>
          <form method="post" action="<?php echo base_url() ?>index.php/student/importcsv" enctype="multipart/form-data">
              <input type="file" name="userfile" ><br><br>
              <button type="submit" name="submit" value="UPLOAD" class="btn btn-primary"><span class="glyphicon glyphicon-upload"></span>&nbsp;UPLOAD</button>
          </form>
      <br><br>
      <table class="table table-striped table-hover table-bordered">
          <caption>Address Book List</caption>
          <thead>
              <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Phone</th>
                  <th>Email</th>
              </tr>
          </thead>
          <tbody>
              <?php if ($data == FALSE): ?>
                  <tr><td colspan="4">There are currently No Addresses</td></tr>
              <?php else: ?>
                  <?php foreach ($data as $row): ?>
                      <tr>
                          <td><?php echo $row['firstname']; ?></td>
                          <td><?php echo $row['lastname']; ?></td>
                          <td><?php echo $row['phone']; ?></td>
                          <td><?php echo $row['email']; ?></td>
                      </tr>
                  <?php endforeach; ?>
              <?php endif; ?>
          </tbody>
      </table>
    <!-- จบส่วนแสดงผล -->
  </div>
</div>