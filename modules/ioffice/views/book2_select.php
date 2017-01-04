<script type="text/javascript">
  $(document).ready(function(){
    $('#searchtext').focus();
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
<!-- เริ่มโหลด -->
<?php
  $this->load->model('IofficeModel');
?>
<!-- จบโหลด -->
<div class="box box-success">
  <div class="box-header">
        <i class="fa fa-sign-in"></i>
    <h3 class="box-title"><?php echo $this->systemmodel->get_menuname($this->uri->segment(1) . '/' . $this->uri->segment(2)); // แสดงชื่อเมนู  ?></h3>
  </div>
  <div class="box-body">
    <!-- ส่วนแสดงผล -->
    <div class="row">
      <div class="col-sm-12">
        <div class="pull-left">
          <a href="<?php echo base_url().'index.php/ioffice/book2_insert_form'; ?>" class="btn btn-primary" title="ออกเลขหนังสือราชการ"><i class="fa fa-plus"></i> สร้างหนังสือราชการ</a>
        </div>
        <div class="pull-right">
          <form class="form-inline">
            <div class="form-group">
              <input type="email" class="form-control" name="searchtext" id="searchtext" placeholder="คำค้นหา">
              <select class="form-control select2" style="width:180px">
                <option value="">เลือกทะเบียนหนังสือ</option>
                <?php 
                if($bookgroup!=false){
                  foreach ($bookgroup as $row_bookgroup) {
                    echo '<option value="'.$row_bookgroup->bookgroupid.'">'.$row_bookgroup->bookgroupname.'</option>';
                  }
                }
                ?>
              </select>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
          </form>
        </div>
      </div>
    </div>
    <hr>
    <!-- ตารางรายการข้อมูล -->
    <div class="table-responsive">
      <table class="table table-hover table-striped table-condensed table-responsive">
        <!-- หัวตาราง -->
        <thead>
          <th>#</th>
          <th width="80">เลขอ้างอิง</th>
          <th width="150">เลขที่หนังสือ/วันที่</th>
          <th>เรื่อง</th>
          <th width="250">เรียน</th>
          <th width="150">สถานะ</th>
          <th width="100">ดำเนินการ</th>
        </thead>
        <!-- รายการข้อมูล -->
        <tbody>
          <?php 
          if($data!=false)
          {
            $no=0;
            $all_rec = count($data);
            foreach ($data as $row) 
            { 
              $row_no = $all_rec-$no;
              $no++;
              $icon='';
              if($row->booktypeid==2){ $icon='<i class="fa fa-star text-red"></i>'; }
              if($row->booktypeid==3){ $icon='<i class="fa fa-star text-red"></i><i class="fa fa-star text-red"></i>'; }
              if($row->booktypeid==4){ $icon='<i class="fa fa-star text-red"></i><i class="fa fa-star text-red"></i><i class="fa fa-star text-red"></i>'; }
              ?>
              <tr>
                <td><?php echo '#'.$row_no; ?></td>
                <td><?php echo $row->bookid; ?></td>
                <td><?php echo $row->bookgroupname.'<br>'.$icon.'&nbsp'.$row->booktypename.'<br>'.$row->department_bookid.'<br>'.ThaiTimeConvert(strtotime($row->bookdate),'',''); ?></td>
                <td><?php echo $row->bookheader; ?></td>
                <td><?php echo $row->bookreceive; ?></td>
                <td><?php echo $row->bookstatusname; ?></td>
                <td>
                  <div class="btn-group btn-group-xs" role="group" aria-label="...">
                    <?php echo form_open('school/answer_form'); ?>
                    <input type="hidden" name="bookid" value="<?php echo $row->bookid.'&nbsp;&nbsp;'.$row->bookid; ?>">
                    <a href="<?php echo base_url().'index.php/ioffice/book2_show_from/'.$row->bookid; ?>" class="btn btn-primary btn-xs"><i class="fa fa-folder-open"></i></a> 
                    <!-- ปุ่มแก้ไข -->
                    <?php if(($row->bookstatusid==1)||($row->bookstatusid==3)||($row->bookstatusid==40)){ ?>
                      <a href="<?php echo base_url().'index.php/ioffice/book2_update_form/'.$row->bookid; ?>" class="btn btn-warning btn-xs" title="แก้ไข"><i class="fa fa-pencil"></i></a>
                    <?php } ?>
                    <!-- / ปุ่มแก้ไข -->
                    <!-- ปุ่มดึงเรื่องกลับ -->
                    <?php if($row->bookstatusid==2){ ?>
                    <a href="<?php echo base_url().'index.php/ioffice/set_book2status/'.$row->bookid; ?>/3" class="btn btn-danger btn-xs confirmlink" title="ดึงเรื่องกลับ"><i class="fa fa-remove"></i></a>
                    <?php } ?>
                    <!-- / ปุ่มดึงเรื่องกลับ -->
                    <!-- ปุ่มส่งออก -->
                    <?php if(($row->bookstatusid==20)||($row->bookstatusid==21)||($row->bookstatusid==22)){ ?>
                    <button href="book" type="button" class="btn btn-success btn-xs confirmlink" name="student_id" title="ส่งหนังสือ" value="<?php echo $row->bookid; ?>"><i class="fa fa-send"></i></button>
                    <?php } ?>
                    <!-- ปุ่มส่งออก -->
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