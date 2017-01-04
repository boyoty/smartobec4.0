<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-datepicker-thai-thai/js/bootstrap-datepicker.js"></script>
<!-- thai extension -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-datepicker-thai-thai/js/bootstrap-datepicker-thai.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-datepicker-thai-thai/js/locales/bootstrap-datepicker.th.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap-datepicker-thai-thai/css/datepicker.css">
<script type="text/javascript">
  $(document).ready(function(){
    $('#department_bookid').focus();
    // get thai date
    var fullDate = new Date();
    var twoDigitMonth = fullDate.getMonth()+1;
    if(twoDigitMonth.length==1)  twoDigitMonth="0" +twoDigitMonth;
    var twoDigitDate = fullDate.getDate()+"";
    if(twoDigitDate.length==1) twoDigitDate="0" +twoDigitDate;
    var thaiyear = fullDate.getFullYear()+543;
    var currentDate = twoDigitDate + "/" + twoDigitMonth + "/" + thaiyear;
    $('#bookdate').val(currentDate);
    $('#bookdate').on('changeDate', function(ev){
      $(this).datepicker('hide');
    });
    $('#btn_get_book2_departmentid').click(function(){
      if($('#bookgroupid').val()==''){ 
        swal({
          title:'ความช่วยเหลือ',
          text:'กรุณาเลือกทะเบียนหนังสือที่ต้องการ',
          type:'info'
        });
        $('#bookgroupid').focus();
        return false; 
      }
      $.ajax({
        url:'<?php echo base_url(); ?>index.php/ioffice/get_book2_departmentid',
        data:'bookgroupid='+$('#bookgroupid').val()+'&booktypeid='+$('input[name = "booktypeid"]:checked').val(),
        dataType:'json',
        type:'POST',
        success:function(res){
          var text = res.department_bookid;
          var new_department_bookid;
          //alert(text);
          //alert($('#public_status').prop('checked'));
          if($('#public_status').prop('checked')){
            new_department_bookid = text.replace('/', '/ว');
          }else{
            new_department_bookid = text;
          }
          $('#department_bookid').val(new_department_bookid);
          $('#department_bookid').attr('readonly',true);
          $('#bookdate').val(currentDate);
          $('#bookid').val(res.bookid);
          $('#bookdate').attr('readonly',true);
          $('#btn_modalid').attr('disabled',true);
          $('#btn_get_book2_departmentid').attr('disabled',true);
          $("#bookgroupid").prop( "disabled", true ); 
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
    $.ajax({
      url:'<?php echo base_url(); ?>index.php/ioffice/get_last_book2header',
      data:'',
      type:'POST',
      success:function(res){
        $('#bookheader').val(res);
      },
      error:function(err){
        swal({
            title : 'เกิดข้อผิดพลาด',
            text : err,
            type : 'error'
        });
      }
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
    $.ajax({
      url:'<?php echo base_url(); ?>index.php/ioffice/get_last_book2from',
      data:'',
      type:'POST',
      success:function(res){
        $('#bookfrom').val(res);
      },
      error:function(err){
        swal({
            title : 'เกิดข้อผิดพลาด',
            text : err,
            type : 'error'
        });
      }
    });
    $('#btn_last_bookfrom').click(function(){
      $.ajax({
        url:'<?php echo base_url(); ?>index.php/ioffice/get_last_book2from',
        data:'',
        type:'POST',
        success:function(res){
          $('#bookfrom').val(res);
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
    $('#public_status').click(function(){
      var text = $('#department_bookid').val();
      var new_department_bookid;
      //alert($('#public_status').prop('checked'));
      if($('#public_status').prop('checked')){
        new_department_bookid = text.replace('/', '/ว');
      }else{
        new_department_bookid = text.replace('/ว', '/');
      }      
      $('#department_bookid').val(new_department_bookid);
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
      <form data-toggle="validator" role="form" enctype="multipart/form-data" class="form-horizontal" method="POST" action="<?php echo base_url(); ?>index.php/ioffice/book2_insert">
        <div class="form-group">
          <label for="booktypeid" class="col-sm-2 control-label">ชั้นความเร็ว</label>
           <div class="col-sm-6">
             <label class="radio-inline">
               <input type="radio" name="booktypeid" id="booktypeid1" value="1" checked> ปกติ
             </label>
             <label class="radio-inline">
               <input type="radio" name="booktypeid" id="booktypeid2" value="2"><i class="fa fa-star text-red"></i> ด่วน
             </label>
             <label class="radio-inline">
               <input type="radio" name="booktypeid" id="booktypeid2" value="3"><i class="fa fa-star text-red"></i><i class="fa fa-star text-red"></i> ด่วนมาก
             </label>
             <label class="radio-inline">
               <input type="radio" name="booktypeid" id="booktypeid2" value="4"><i class="fa fa-star text-red"></i><i class="fa fa-star text-red"></i><i class="fa fa-star text-red"></i> ด่วนที่สุด
             </label>
           </div>
        </div>
        <hr>
        <div class="form-group">
          <label for="bookgroupid" class="col-sm-2 control-label">ทะเบียนหนังสือ</label>
          <div class="col-sm-10">
            <select name='bookgroupid' id='bookgroupid' class="form-control select2" required>
              <option  value = ''>เลือกทะเบียนหนังสือ</option>"
              <?php
              foreach ($bookgroup as $row_bookgroup) {
                echo  '<option  value ="'.$row_bookgroup->bookgroupid.'">'.$row_bookgroup->bookgroupname.'</option>' ;
              }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="department_bookid" class="col-sm-2 control-label">เลขที่หนังสือ</label>
          <div class="col-sm-10">
            <div class="input-group">
              <input type="text" class="form-control" name="department_bookid" id="department_bookid" placeholder="ส่วนสำหรับเลขที่หนังสือ">
              <span class="input-group-addon"><input id="public_status" type="checkbox"> ว</span>
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right input-medium" placeholder="ลงวันที่" id="bookdate" name="bookdate" data-provide="datepicker" data-date-language="th-th" required>
              <div class="input-group-btn">
                <button type="button" id="btn_get_book2_departmentid" class="btn btn-primary">ออกเลขที่หนังสือ <i class="fa fa-registered"></i></button>
              </div>
              <!--
              <div class="input-group-btn">
                <button type="button" id="btn_modalid" class="btn btn-primary" data-toggle="modal" data-target="#modalid">ออกเลขที่หนังสือ <i class="fa fa-registered"></i></button>
              </div> -->
              <!-- Modal -->
              <!--
              <div class="modal fade" id="modalid" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">ออกเลขที่หนังสือ</h4>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-sm-12">
                          <select name='bookgroupid' id='bookgroupid' class="form-control select2" style="width:100%">
                            <option  value = ''>เลือกทะเบียนหนังสือ</option>"
                            <?php
                            //foreach ($bookgroup as $row_bookgroup) {
                            //  echo  '<option  value ="'.$row_bookgroup->bookgroupid.'">'.$row_bookgroup->bookgroupname.'</option>' ;
                            //}
                            ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                      <button id="btn_get_book2_departmentid" type="button" class="btn btn-primary" data-dismiss="modal">ลงทะเบียน</button>
                    </div>
                  </div>
                </div>
              </div>
              -->
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="bookheader" class="col-sm-2 control-label">เรื่อง</label>
          <div class="col-sm-10">
            <div class="input-group">
              <input type="text" class="form-control" name="bookheader" id="bookheader" placeholder="ส่วนสำหรับพิมพ์ชื่อเรื่อง" required>
              <div class="input-group-btn">
                <button type="button" id="btn_last_bookheader" class="btn btn-primary"><i class="fa fa-feed"></i></button>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="bookreceive" class="col-sm-2 control-label">เรียน</label>
          <div class="col-sm-10">
            <div class="input-group">
              <input type="text" class="form-control" name="bookreceive" id="bookreceive" placeholder="ส่วนสำหรับพิมพ์เรียน" required>
              <div class="input-group-btn">
                <button type="button" id="btn_last_bookreceive" class="btn btn-primary"><i class="fa fa-feed"></i></button>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="bookfrom" class="col-sm-2 control-label">จาก</label>
          <div class="col-sm-10">
            <div class="input-group">
              <input type="text" class="form-control" name="bookfrom" id="bookfrom" placeholder="ส่วนสำหรับพิมพ์จาก" required>
              <div class="input-group-btn">
                <button type="button" id="btn_last_bookfrom" class="btn btn-primary"><i class="fa fa-feed"></i></button>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="bookdetail" class="col-sm-2 control-label">รายละเอียด</label>
          <div class="col-sm-10">
            <textarea class="form-control" rows="5" name="bookdetail" id="bookdetail" placeholder="ส่วนสำหรับพิมพ์รายละเอียด"></textarea>
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
              <table border="0" cellspacing="0" cellpadding="0" id="myTable">
                <tr>
                  <td width="60%"><input class="form-control" name="UploadedFile[]" type="file" class="BrowsFile" id="UploadedFile" size="55"></td>
                  <td width="40%">&nbsp;<a href="javascript:insRow();" class="btn btn-success"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>&nbsp;เพิ่มช่องรับเอกสาร</a></td>
                </tr>
              </table>
            </div>
        </div>
        <div class="form-group">
          <label for="post_personid" class="col-sm-2 control-label">ลงชื่อ</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="post_personname" value="<?php echo $this->session->navname; ?>" disabled>
            <input type="hidden" class="form-control" name="post_personid" id="post_personid" value="<?php echo $this->session->person_id; ?>">
            <input type="hidden" name="bookid" id="bookid" value="">
            <input type="hidden" name="referer" value="<?php echo $_SERVER['HTTP_REFERER']; ?>">
            <input type="hidden" name="ref_bookid" value="<?php echo $this->uri->segment(3); ?>">
          </div>
        </div>
        <hr>
        <div class='form-group'>
          <label for="comment_personid" class="col-sm-2 control-label">ส่งถึง</label>
          <div class="col-sm-10">
          <?php $this->load->view('ioffice/node_select_modal'); ?>
          <?php //$this->load->view('ioffice/node_datatable'); ?>
          <?php //$this->load->view('ioffice/node_select'); ?>
          <!--
          <div class="btn-group" data-toggle="buttons">
              <button class="btn btn-default">หน่วยงาน</button>
              <button class="btn btn-default">บุคคล</button>
          </div> 
          <button class="btn btn-default" type="button">เลือกแล้ว <span class="badge">4</span></button>
          -->
          </div>
        </div>
        <hr>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="bookstatusid" value="2" class="btn btn-primary">
            <i class="fa fa-floppy-o"></i>&nbsp;บันทึก | ส่งหนังสือ</button>&nbsp;
            <button type="submit" name="bookstatusid" value="1" class="btn btn-primary">
            <i class="fa fa-edit"></i>&nbsp;บันทึก | ฉบับร่าง</button>&nbsp;
            <button type="submit"class="btn btn-default" onClick="history.go(-1);return true;" ><i class="fa fa-remove"></i>&nbsp;ยกเลิก</button>
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
