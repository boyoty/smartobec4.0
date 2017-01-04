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
      <form data-toggle="validator" role="form" enctype="multipart/form-data" class="form-horizontal" method="POST" action="?option=ioffice&task=book_manage&action=insert">
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
          <label for="bookheader" class="col-sm-2 control-label">เรื่อง</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="bookheader" id="bookheader" placeholder="ส่วนสำหรับพิมพ์ชื่อเรื่อง" required>
          </div>
        </div>
        <div class="form-group">
          <label for="receive_personid" class="col-sm-2 control-label">เรียน</label>
          <div class="col-sm-10">
            <select  name='receive_personid' id='receive_personid' class='form-control select2'>
              <?php 
              foreach($receive_person as $row_person){
                echo '<option  value ="'.$row_person->person_id.'" $selected>'.$row_person->fullname_position_department.'</option>';
              } 
              ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="bookdetail" class="col-sm-2 control-label">บันทึกข้อความ</label>
          <div class="col-sm-10">
            <textarea class="form-control" rows="25" name="bookdetail" id="bookdetail" placeholder="ส่วนสำหรับพิมพ์เนื้อหา"></textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'bookdetail' );
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
          </div>
        </div>
        <hr>
        <div class="form-group">
          <label for="bookheader" class="col-sm-2 control-label">ลงนามถึง</label>
          <div class="col-sm-10">
            <p>
              <input name="search" placeholder="พิมพ์คำค้นหา" autocomplete="off">
              <button id="btnResetSearch"><i class="fa fa-remove"></i> ล้างตัวกรอง</button>
              <span id="matches"></span>
            </p>
            <!-- Start_Exclude: This block is not part of the sample code -->
            <fieldset>
              <label for="hideMode">
                <input type="checkbox" id="hideMode">
                แสดงเฉพาะรายการที่ค้นหา
              </label>
              <!--<label for="leavesOnly">
                <input type="checkbox" id="leavesOnly">
                Leaves only
              </label>-->
              <label for="autoExpand">
                <input type="checkbox" id="autoExpand">
                เปิดรายการที่ค้นหาอัตโนมัติ
              </label>
              <label for="counter">
                <input type="checkbox" id="counter">
                แสดงจำนวนที่ค้นหา
              </label>
              <!--<label for="hideExpandedCounter">
                <input type="checkbox" id="hideExpandedCounter">
                hideExpandedCounter
              </label>
              <label for="fuzzy">
                <input type="checkbox" id="fuzzy">
                Fuzzy
              </label>
              <label for="highlight">
                <input type="checkbox" id="highlight">
                Highlight
              </label>
              <label for="regex">
                <input type="checkbox" id="regex">
                Regular expression
              </label>-->
            </fieldset>         

            <p id="sampleButtons">
            </p>
            <!-- End_Exclude -->          

            <!-- Add a <table> element where the tree should appear: -->
            <div id="tree">
            </div>
          </div>
        </div>
        <hr>
        <div class='form-group'>
          <label for="bookheader" class="col-sm-2 control-label">เสนอ(ส่งแฟ้มที่โต๊ะ)</label>
          <div class="col-sm-10">
          <select  name='department' id='department' class="form-control select2">
                <option  value = ''>เลือกบุคลากร</option>"
                <?php
                foreach ($book_person as $row_person) {
                  echo  '<option  value ="'.$row_person->person_id.'">'.$row_person->fullname_position_department.'</option>' ;
                }
                ?>
              </select>
          </div>
        </div>
        <div class='form-group'>
          <label for="bookheader" class="col-sm-2 control-label"></label>
          <div class="col-sm-10">
            <div class="alert alert-warning alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>คำแนะนำ</h4>
              บุคลากรทั่วไป => ปกติเสนอเรื่องไปที่ => ผอ.กลุ่ม<br/>
              ผอ.กลุ่ม => ปกติเสนอเรื่องไปที่ => ผอ.สำนัก<br/>
              ผอ.สำนัก => ปกติเสนอเรื่องไปที่ => รองเลขาฯ/ผู้ช่วยเลขาฯ/ที่ปรึกษา<br/>
              รองเลขาฯ/ผู้ช่วยเลขาฯ/ที่ปรึกษา => ปกติเสนอเรื่องไปที่ => เลขาฯ<br/>
            </div>
          </div>
        </div>
        <hr>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <?php 
            if($this->session->position_code<=11){ //ตำแหน่งที่อนุมัติเองได้ 
              ?> 
              <button type="submit" name="bookstatusid" value="20" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span>&nbsp;บันทึก(อนุมัติ)</button>&nbsp;
            <?php } ?>
            <button type="submit" name="bookstatusid" value="2" class="btn btn-primary">
            <span class="glyphicon glyphicon-ok"></span>&nbsp;บันทึก(พร้อมเสนอ)</button>&nbsp;
            <button type="submit" name="bookstatusid" value="1" class="btn btn-primary">
            <span class="glyphicon glyphicon-pencil"></span>&nbsp;บันทึก(ฉบับร่าง)</button>&nbsp;
            <button type="submit"class="btn btn-default" onClick="history.go(-1);return true;" ><span class="glyphicon glyphicon-remove"></span>&nbsp;ยกเลิก</button>
          </div>
        </div>
      </form>
  </div>
</div> 
    <!-- จบส่วนแสดงผล -->
  </div>
</div>