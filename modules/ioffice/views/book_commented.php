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
          <a href="<?php echo base_url().'index.php/ioffice/book_commented'; ?>" class="btn btn-primary" title="เรียกข้อมูลใหม่"><i class="fa fa-refresh"></i> เรียกข้อมูลใหม่</a>
        </div>
        <div class="pull-right">
          <form class="form-inline">
            <div class="form-group">
              <input type="text" class="form-control" name="searchtext" id="searchtext" placeholder="คำค้นหา">
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
          <th width="150">ชั้นความเร็ว</th>
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
                <td><?php echo $icon.'&nbsp'.$row->booktypename.'<br>'.$row->department_bookid.'<br>'.ThaiTimeConvert(strtotime($row->postdate),'','2'); ?></td>
                <td><?php echo $row->bookheader; ?></td>
                <td><?php echo $row->bookreceive; ?></td>
                <td><?php echo $row->bookstatusname; ?></td>
                <td>
                  <div class="btn-group btn-group-xs" role="group" aria-label="...">
                    <?php echo form_open('school/answer_form'); ?>
                    <input type="hidden" name="bookid" value="<?php echo $row->bookid.'&nbsp;&nbsp;'.$row->bookid; ?>">
                    <button type="button" class="btn btn-primary btn-xs" name="view" title="แสดงรายละเอียด" data-toggle="modal" data-target="#myModal<?php echo $row->bookid; ?>"><i class="fa fa-folder-open"></i></button>
                    <?php echo form_close(); ?>
                  </div>
                  <!-- เริ่ม ส่วนแสดงรายละเอียดของบันทึกข้อความ -->
                  <div class="modal fade bs-example-modal-lg" id="myModal<?php echo $row->bookid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <div class="row">
                            <div class="col-md-6 text-left">
                              <h4><?php echo "เลขที่ ".$row->bookid; ?></h4>
                              <h4><?php echo "เลขที่สำนัก ".$row->department_bookid; ?></h4>
                            </div>
                            <div class="col-md-6 text-right">
                              <a href="#" class="btn btn-default">ชั้นความเร็ว&nbsp;:&nbsp;<?php echo $row->booktypename; ?></a>
                              <a href="#" class="btn btn-default">สถานะ&nbsp;:&nbsp;<?php echo $row->bookstatusname; ?></a>
                            </div>
                          </div>
                        </div>
                        <div class="modal-body">
                          <div class="well">
                            <h4 class="modal-title" id="myModalLabel">เรื่อง <?php echo $row->bookheader; ?></h4>
                            <h4 class="modal-title" id="myModalLabel">เรียน <?php echo $row->bookreceive; ?></h4>
                          </div>
                          <?php echo $row->bookdetail; ?>
                          <hr>
                          <h4>เอกสารแนบ</h4>
                          <?php
                          $res_bookfile = $this->IofficeModel->get_bookfile($row->bookid);
                          if($res_bookfile!=false){
                            $fnum = 0;
                            foreach ($res_bookfile as $rec_bookfile) {
                              echo '<p><a href="'.base_url().$rec_bookfile->filename.'" class="btn btn-default" target="_blank"><span class="badge badge-sm">'.++$fnum.'</span>&nbsp;'.$rec_bookfile->filedesc.'</a></p>';
                            }
                          }
                          ?>
                          <hr>
                          <h5>โดย&nbsp;<?php echo $row->fullname; ?></h5>
                          <h5>เมื่อ&nbsp;<?php if($row->updatedate){echo ThaiTimeConvert(strtotime($row->updatedate),"","2");}else{echo ThaiTimeConvert(strtotime($row->postdate),"","2");} ?></h5>
                          <hr>
                          <h4>รายการความเห็น</h4>
                          <table class="table table-hover table-striped table-condensed table-responsive">
                            <thead>                                  
                              <th>ลำดับที่</th>
                              <th>สถานะ</th>
                              <th>ชื่อ-สกุล</th>
                              <th>ตำแหน่ง</th>
                              <th>สำนัก</th>
                              <th>เมื่อ</th>
                              <th>ความเห็น</th>
                            </thead> 
                            <tbody>
                              <?php
                                $res_bookcomment = $this->IofficeModel->get_bookcomment($row->bookid);
                                if($res_bookcomment!=false){
                                  $commentnum = 0;
                                  foreach ($res_bookcomment as $rec_bookcomment) {
                                    echo "<tr>";
                                    echo "<td>".++$commentnum."</td>";
                                    echo "<td>".$rec_bookcomment->bookstatusname."</td>";
                                    echo "<td>".$rec_bookcomment->fullname."</td>";
                                    echo "<td>".$rec_bookcomment->position_name."</td>";
                                    echo "<td>".$rec_bookcomment->department_precis."</td>";
                                    echo "<td>".ThaiTimeConvert(strtotime($rec_bookcomment->commentdate),"","2")."</td>";
                                    echo "<td>".$rec_bookcomment->commentdetail."</td>";
                                    echo "</tr>";
                                  }
                                }
                              ?>
                              <!-- ส่วนแสดงความเห็น -->

                              <!-- จบส่วนแสดงความเห็น -->
                            </tbody>                                 
                          </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal"><span class='glyphicon glyphicon-remove' aria-hidden='true'></span>&nbsp;ปิด</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- จบ ส่วนแสดงรายละเอียดของบันทึกข้อความ -->
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