<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-datepicker-thai-thai/js/bootstrap-datepicker.js"></script>
<!-- thai extension -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-datepicker-thai-thai/js/bootstrap-datepicker-thai.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-datepicker-thai-thai/js/locales/bootstrap-datepicker.th.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap-datepicker-thai-thai/css/datepicker.css">
<script type="text/javascript">
  $(document).ready(function(){
    $('#department_bookid').focus();
    $('#btn_get_book2_departmentid').click(function(){
      if($('#bookgroupid').val()==''){ 
        swal({
          title:'ความช่วยเหลือ',
          text:'กรุณาเลือกทะเบียนหนังสือที่ต้องการขอเลขที่หนังสือ',
          type:'info'
        });
        $('#bookgroupid').focus();
        return false; 
      }
      $.ajax({
        url:'<?php echo base_url(); ?>index.php/ioffice/get_book2_departmentid',
        data:'bookgroupid='+$('#bookgroupid').val(),
        type:'POST',
        success:function(res){
          $('#department_bookid').val(res);
          $('#department_bookid').attr('readonly',true);
          var fullDate = new Date();
          var twoDigitMonth = fullDate.getMonth()+1;
          if(twoDigitMonth.length==1)twoDigitMonth="0"+twoDigitMonth;
          var twoDigitDate = fullDate.getDate()+"";
          if(twoDigitDate.length==1)twoDigitDate="0"+twoDigitDate;
          var thaiyear = fullDate.getFullYear()+543;
          var currentDate = twoDigitDate + "/" + twoDigitMonth + "/" + thaiyear;
          $('#bookdate').val(currentDate);
          $('#bookdate').attr('readonly',true);
          $('#btn_get_book2_departmentid').attr('disabled',true);
        },
        error:function(err){
          swal({
            title: 'เกิดข้อผิดพลาด',
            text: err,
            type: 'error'
          });
        }
      });
    });
    $('#btn_last_bookheader').click(function(){
      $.ajax({
        url:'<?php echo base_url(); ?>index.php/ioffice/get_last_book2header',
        data:'',
        type:'POST',
        success:function(res){
          $('#bookheader').val(res);
        },
        error:function(err){
          swal({
            title: 'เกิดข้อผิดพลาด',
            text: err,
            type: 'error'
          });
        }
      });
    });
    $('#btn_last_bookreceive').click(function(){
      $.ajax({
        url:'<?php echo base_url(); ?>index.php/ioffice/get_last_book2receive',
        data:'',
        type:'POST',
        success:function(res){
          $('#bookreceive').val(res);
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
<!-- Show and Hide File Upload -->
<script type="text/javascript">
function insRow()
  { 
    var CntRow=document.getElementById('cntrow');
    var idTR=(parseInt(CntRow.value)+1);
      var x=document.getElementById('myTable').insertRow(idTR);
      var Col0=x.insertCell(0);
      var Col1=x.insertCell(1);
      var OldObj1=document.getElementById("UploadedFile").outerHTML;
      var NewObj1=OldObj1.replace("id=UploadedFile","id=UploadedFile"+idTR);      
      Col0.innerHTML=NewObj1;
      Col1.innerHTML='&nbsp;<a href="javascript:delRow('+idTR+');" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
 CntRow.value=idTR;//ค่าต่อไป
  }

function delRow(obj)
  {
      var CntRow=document.getElementById('cntrow');
    if(obj==CntRow.value){ // ลบด้านล่างก่อน
        CntRow.value=(parseInt(CntRow.value)-1);
        document.getElementById('myTable').deleteRow(obj);
    }else{
      swal({
              title : 'ความช่วยเหลือ',
              text : 'กรุณาลบเอกสารแนบจากด้านล่างสุดก่อน',
              type : 'info'
          });
    }
  }
</script>

<!-- begin add require script -->

<!-- end add require script -->

<div class="box box-success">
  <div class="box-header">
        <i class="fa fa-sign-in"></i>
    <h3 class="box-title"><?php echo $this->systemmodel->get_menuname($this->uri->segment(1) . '/' . $this->uri->segment(2)); // แสดงชื่อเมนู  ?></h3>
  </div>
  <div class="box-body">
    <!-- ส่วนแสดงผล -->
      <form data-toggle="validator" role="form" enctype="multipart/form-data" class="form-horizontal" method="POST" action="<?php echo base_url().'index.php/ioffice/book2_update' ?>">
        <input type="hidden" id="bookid" name="bookid" value="<?php echo $book->bookid; ?>">
        <div class="form-group">
          <label for="booktypeid" class="col-sm-2 control-label">ชั้นความเร็ว</label>
          <?php
          $check='';
          if($book->booktypeid==1){ $icon=''; }
          if($book->booktypeid==2){ $icon='<i class="fa fa-star text-red"></i>'; }
          if($book->booktypeid==3){ $icon='<i class="fa fa-star text-red"></i><i class="fa fa-star text-red"></i>'; }
          if($book->booktypeid==4){ $icon='<i class="fa fa-star text-red"></i><i class="fa fa-star text-red"></i><i class="fa fa-star text-red"></i>'; }
          ?>
           <div class="col-sm-6"><?php echo $icon.' '.$book->booktypename; ?></div>
        </div>
        <hr>
        <div class='form-group'>
          <label for="bookgroupid" class="col-sm-2 control-label">ทะเบียนหนังสือ</label>
          <div class="col-sm-10"><?php echo $book->bookgroupname; ?></div>
        </div>
        <div class="form-group">
          <label for="department_bookid" class="col-sm-2 control-label">เลขที่หนังสือ</label>
          <div class="row">
            <div class="col-sm-4">
              <?php echo $book->department_bookid; ?>
            </div>
            <div class="col-sm-4">
              <?php echo 'ลงวันที่ '.ThaiTimeConvert(strtotime($book->bookdate),'',''); ?>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="bookheader" class="col-sm-2 control-label">เรื่อง</label>
          <div class="col-sm-10">
            <?php echo $book->bookheader; ?>
          </div>
        </div>
        <div class="form-group">
          <label for="bookreceive" class="col-sm-2 control-label">เรียน</label>
          <div class="col-sm-10">
            <?php echo $book->bookreceive; ?>
          </div>
        </div>
        <div class="form-group">
          <label for="bookreceive" class="col-sm-2 control-label">จาก</label>
          <div class="col-sm-10">
            <?php echo $book->bookfrom; ?>
          </div>
        </div>
        <div class="form-group">
          <label for="bookdetail" class="col-sm-2 control-label">รายละเอียด</label>
          <div class="col-sm-10">
            <textarea class="form-control" rows="5" name="bookdetail" id="bookdetail" placeholder="" readonly><?php echo $book->bookdetail; ?></textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                //CKEDITOR.replace( 'bookdetail' );
            </script>
          </div>
        </div>
        <div class="form-group">
          <input name="cntrow" type="hidden" id="cntrow" value="0">
          <label for="file" class="col-sm-2 control-label">สิ่งที่ส่งมาด้วย</label>
          <div class="col-sm-10">
            <?php
            if($bookfile!=false){
              $fnum = 0;
              foreach ($bookfile as $row) {
                echo "<p><a href='".base_url().'index.php/ioffice/del_bookfile/'.$book->bookid.'/'.$row->fileid."' class='btn btn-danger confirmlink'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span>&nbsp;ลบ</a>&nbsp;<a href='".base_url().$row->filename."' class='btn btn-default' target='_blank'><span class='badge badge-sm'>".++$fnum."</span>&nbsp;".$row->filedesc."</a></p>";
              }
            }else{
              echo 'ไม่มีสิ่งที่ส่งมาด้วย';
            }
            ?>
          </div>
        </div>
        <div class="form-group">
          <label for="post_personid" class="col-sm-2 control-label">ผู้ส่ง</label>
          <div class="col-sm-10">
            <?php echo $book->fullname_position_department; ?>
            <input type="hidden" class="form-control" name="post_personid" id="post_personid" value="<?php echo $this->session->person_id; ?>">
          </div>
        </div>
        <hr>
        <div class='form-group'>
          <label for="comment_personid" class="col-sm-2 control-label">ส่งถึง</label>
          <div class="col-sm-10">
            <!-- แสดงรายการความเห็น -->
            <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-send"></i> รายการส่งถึง</button>
            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <!-- modal content -->
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">
                      <?php echo $book->department_bookid; ?></br>
                      <?php echo $book->bookheader; ?>    
                    </h4>
                  </div>
                  <div class="modal-body">
                    <table class="table table-hover table-striped table-condensed table-responsive">
                      <thead>                                  
                        <th>ลำดับที่</th>
                        <th>สถานะ</th>
                        <th>ส่งถึง</th>
                        <th>เมื่อ</th>
                        <th>ความเห็น</th>
                      </thead> 
                      <tbody>
                        <?php 
                          $res_bookcomment = $this->IofficeModel->get_book2comment($book->bookid);
                          if($res_bookcomment!=false){
                            $commentnum = 0;
                            foreach ($res_bookcomment as $rec_bookcomment) {
                              echo "<tr>";
                              echo "<td>".++$commentnum."</td>";
                              echo "<td>".$rec_bookcomment->bookstatusname."</td>";
                              echo "<td>".$rec_bookcomment->nodename."</td>";
                              if($rec_bookcomment->commentdate!=''){
                                echo "<td>".ThaiTimeConvert(strtotime($rec_bookcomment->commentdate),"","2")."</td>";
                              }else{
                                echo "<td>".ThaiTimeConvert(strtotime($rec_bookcomment->postdate),"","2")."</td>";
                              }
                              echo "<td>".$rec_bookcomment->commentdetail."</td>";
                              echo "</tr>";
                            }
                          }
                        ?>
                      </tbody>                                 
                    </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class='glyphicon glyphicon-remove' aria-hidden='true'></span>&nbsp;ปิด</button>
                  </div>
                  <!-- /modal content -->
                </div>
              </div>
            </div>
            <!-- /แสดงรายการความเห็น -->
          </div>
        </div>
        <hr>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="bookstatusid" value="2" class="btn btn-primary">
            <i class="fa fa-floppy-o"></i>&nbsp;ส่งหนังสือ</button>&nbsp;
            <button type="submit"class="btn btn-default" onClick="history.go(-1);return true;" ><span class="glyphicon glyphicon-remove"></span>&nbsp;ยกเลิก</button>
          </div>
        </div>
      </form>
  </div>
</div> 
    <!-- จบส่วนแสดงผล -->
  </div>
</div>
<script type="text/javascript">
  $('.datepicker').datepicker({language:'th-th',format:'dd/mm/yyyy'});
</script>