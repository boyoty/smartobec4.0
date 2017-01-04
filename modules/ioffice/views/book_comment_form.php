<script type="text/javascript">
  $(document).ready(function(){
    $("#comment_personid").select2({ width: '100%' });
    //$('#username').focus();
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
      <form data-toggle="validator" role="form" enctype="multipart/form-data" class="form-horizontal" method="POST" action="<?php echo base_url().'index.php/ioffice/book_comment_save' ?>">
        <input type="hidden" id="bookid" name="bookid" value="<?php echo $book->bookid; ?>">
        <div class="form-group">
          <label for="booktypeid" class="col-sm-2 control-label">ชั้นความเร็ว</label>
          <?php
          if($book->booktypeid==1){ $check1='checked'; }else{ $check1=""; }
          if($book->booktypeid==2){ $check2='checked'; }else{ $check2=""; }
          if($book->booktypeid==3){ $check3='checked'; }else{ $check3=""; }
          if($book->booktypeid==4){ $check4='checked'; }else{ $check4=""; }
          ?>
           <div class="col-sm-6">
             <label class="radio-inline">
               <input type="radio" name="booktypeid" id="booktypeid1" value="1" <?php echo $check1; ?> disabled> ปกติ
             </label>
             <label class="radio-inline">
               <input type="radio" name="booktypeid" id="booktypeid2" value="2" <?php echo $check2; ?> disabled><i class="fa fa-star text-red"></i> ด่วน
             </label>
             <label class="radio-inline">
               <input type="radio" name="booktypeid" id="booktypeid2" value="3" <?php echo $check3; ?> disabled><i class="fa fa-star text-red"></i><i class="fa fa-star text-red"></i> ด่วนมาก
             </label>
             <label class="radio-inline">
               <input type="radio" name="booktypeid" id="booktypeid2" value="4" <?php echo $check4; ?> disabled><i class="fa fa-star text-red"></i><i class="fa fa-star text-red"></i><i class="fa fa-star text-red"></i> ด่วนที่สุด
             </label>
           </div>
        </div>
        <hr>
        <div class="form-group">
          <label for="bookheader" class="col-sm-2 control-label">เรื่อง</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="bookheader" id="bookheader" placeholder="ส่วนสำหรับพิมพ์ชื่อเรื่อง" value="<?php echo $book->bookheader; ?>" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="bookreceive" class="col-sm-2 control-label">เรียน</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="bookreceive" id="bookreceive" placeholder="ส่วนสำหรับพิมพ์เรียน" value="<?php echo $book->bookreceive; ?>" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="file" class="col-sm-2 control-label">สิ่งที่ส่งมาด้วย</label>
          <div class="col-sm-10">
            <?php
            if($bookfile!=false){
              $fnum = 0;
              foreach ($bookfile as $row) {
                echo "<p><a href='".base_url().$row->filename."' class='btn btn-default' target='_blank'><span class='badge badge-sm'>".++$fnum."</span>&nbsp;".$row->filedesc."</a></p>";
              }
            }
            ?>
          </div>
        </div>        
        <hr>
        <div class="form-group">
          <label for="post_personid" class="col-sm-2 control-label">ลงความเห็น/สั่งการ</label>
          <div class="col-sm-10">
            <textarea class="form-control" rows="4" name="commentdetail" id="commentdetail" placeholder="ส่วนสำหรับลงความเห็น"></textarea>
            <p>
            <p></p>
            <p>
            <label class="radio-inline">
              <input type="radio" name="bookstatusid" id="bookstatusid1" value="2" onclick="javascript:showDiv('myContent');"><span class='glyphicon glyphicon-share-alt' aria-hidden='true'></span> เสนอ
            </label>
            </p>
            </p>
            <div id='myContent' style="display:none">
              <select  name='comment_personid' id='comment_personid' class="form-control select2">
                <option  value = ''>เลือกบุคลากร</option>
                <?php
                foreach ($book_person as $row_person) {
                  if($book->comment_personid==$row_person->person_id){ $select='selected'; }else{ $select=''; }
                  echo  '<option  value ="'.$row_person->person_id.'" '.$select.'>'.$row_person->fullname_position_department.'</option>' ;
                }
                ?>
              </select>
            </div>
            <p>
            <label class="radio-inline">
              <input type="radio" name="bookstatusid" id="bookstatusid20" value="20" onclick="javascript:hideDiv('myContent');"><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> ทราบ/อนุมัติ
            </label>
            <?php //if(($user_positionid!=1) and ($receive_booklevelid!=$row["receive_booklevelid"])){ ?>
            <label class="radio-inline">
              <input type="radio" name="bookstatusid" id="bookstatusid21" value="21" onclick="javascript:hideDiv('myContent');"><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span> ทราบ/อนุมัติ(ปฏิบัติราชการแทน)
            </label>
            <?php 
            if(!isset($_SESSION["system_delegate"])){ $_SESSION["system_delegate"]=""; }
            if($_SESSION["system_delegate"]==1) {
            ?>
            <label class="radio-inline">
              <input type="radio" name="bookstatusid" id="bookstatusid22" value="22" onclick="javascript:hideDiv('myContent');"><span class='glyphicon glyphicon-check' aria-hidden='true'></span> ทราบ/อนุมัติ(รักษาราชการแทน)
            </label>
            <?php } ?>
            </p>
            <p>
            <label class="radio-inline">
              <input type="radio" name="bookstatusid" id="bookstatusid30" value="30" onclick="javascript:hideDiv('myContent');"><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> ยุติเรื่อง
            </label>
            <label class="radio-inline">
              <input type="radio" name="bookstatusid" id="bookstatusid40" value="40" onclick="javascript:hideDiv('myContent');"><span class='glyphicon glyphicon-remove' aria-hidden='true'></span> คืนเรื่อง/แก้ไข
            </label>
            </p>
            <input name="cntrow" type="hidden" id="cntrow" value="0">
            <table border="0" cellspacing="0" cellpadding="0" id="myTable">
              <tr>
                <td width="60%"><input class="form-control" name="UploadedFile[]" type="file" class="BrowsFile" id="UploadedFile" size="55"></td>
                <td width="40%">&nbsp;<a href="javascript:insRow();" class="btn btn-success"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>&nbsp;เพิ่มช่องรับเอกสาร</a></td>
              </tr>
            </table>
          </div>
        </div>
        <hr>
        <input type="hidden" id="commentid" name="commentid" value="<?php echo $this->uri->segment(4); ?>">
        <input type="hidden" class="form-control" name="post_personid" id="post_personid" value="<?php echo $this->session->person_id; ?>">
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">
            <i class="fa fa-floppy-o"></i>&nbsp;บันทึก</button>&nbsp;
            <button type="submit" class="btn btn-default" onClick="history.go(-1);return true;" ><i class="fa fa-remove"></i>&nbsp;ยกเลิก</button>
          </div>
        </div>
      </form>
  </div>
</div> 
    <!-- จบส่วนแสดงผล -->
  </div>
</div>