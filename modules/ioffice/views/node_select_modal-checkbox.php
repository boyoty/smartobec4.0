<script type="text/javascript">
  $(document).ready(function(){
    table_g = $('#table_departmentgroup').DataTable({
      responsive: true,
      //stateSave: true,
      paging: false,
      //select: {
      //      style: 'multi'
      //  },
      "language": {
            "lengthMenu": "แสดง _MENU_ รายการต่อหน้า",
            "zeroRecords": "Nothing found - sorry",
            "info": "แสดงหน้าที่ _PAGE_ จากทั้งหมด _PAGES_ หน้า",
            "infoEmpty": "ไม่พบข้อมูล",
            "infoFiltered": "(ค้นหาจาก _MAX_ รายการ)",
            "search": "ค้นหา",
            "processing": "กำลังโหลดข้อมูล",
            "paginate": {
                "first": "หน้าแรก",
                "last": "หน้าสุดท้าย",
                "next": "ถัดไป",
                "previous": "ก่อนหน้า"
            }
        }
    });
    $('.check_departmentgroup').change(function(){
      $.ajax({
        url:'<?php echo base_url(); ?>index.php/ioffice/ajax_select_departmentgroup',
        data:'department_groupid='+$(this).val()+'&token=ioffice2&checked='+$(this).prop('checked'),
        type:'POST',
        success:function(res){
          //swal({
          //  title: 'ดำเนินการเรียบร้อยแล้ว',
          //  text: res,
          //  type: 'success'
          //});
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
    $('#checkall_departmentgroup').change(function(){
      if($(this).prop('checked')){
        $('.check_departmentgroup').prop('checked',true);
      }else{
        $('.check_departmentgroup').prop('checked',false);
      }
      $('.check_departmentgroup').change();
    });

    table_d = $('#table_department').DataTable({
      responsive: true,
      //stateSave: true,
      //scrollY: 300,
      paging: false,
      "language": {
            "lengthMenu": "แสดง _MENU_ รายการต่อหน้า",
            "zeroRecords": "Nothing found - sorry",
            "info": "แสดงหน้าที่ _PAGE_ จากทั้งหมด _PAGES_ หน้า",
            "infoEmpty": "ไม่พบข้อมูล",
            "infoFiltered": "(ค้นหาจาก _MAX_ รายการ)",
            "search": "ค้นหา",
            "processing": "กำลังโหลดข้อมูล",
            "paginate": {
                "first": "หน้าแรก",
                "last": "หน้าสุดท้าย",
                "next": "ถัดไป",
                "previous": "ก่อนหน้า"
            }
        }
    });
    table_p = $('#table_person').DataTable({
      responsive: true,
      //stateSave: true,
      paging: false,
      "language": {
            "lengthMenu": "แสดง _MENU_ รายการต่อหน้า",
            "zeroRecords": "Nothing found - sorry",
            "info": "แสดงหน้าที่ _PAGE_ จากทั้งหมด _PAGES_ หน้า",
            "infoEmpty": "ไม่พบข้อมูล",
            "infoFiltered": "(ค้นหาจาก _MAX_ รายการ)",
            "search": "ค้นหา",
            "processing": "กำลังโหลดข้อมูล",
            "paginate": {
                "first": "หน้าแรก",
                "last": "หน้าสุดท้าย",
                "next": "ถัดไป",
                "previous": "ก่อนหน้า"
            }
        }
    });

    $('.check_department').change(function(){
      $.ajax({
        url:'<?php echo base_url(); ?>index.php/ioffice/ajax_select_node',
        data:'nodeid='+$(this).val()+'&token=ioffice2&checked='+$(this).prop('checked'),
        type:'POST',
        success:function(res){
          //swal({
          //  title: 'เลือกเรียบร้อยแล้ว',
          //  text: res,
          //  type: 'success'
          //});
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

    $('#checkall_department').change(function(){
      if($(this).prop('checked')){
        $('.check_department').prop('checked',true);
      }else{
        $('.check_department').prop('checked',false);
      }
      $('.check_department').change();
    });
    $('#checkall_person').change(function(){
      if($(this).prop('checked')){
        $('.check_person').prop('checked',true);
      }else{
        $('.check_person').prop('checked',false);
      }
      $('.check_person').change();
    });

  });
</script>
<!-- begin add require script -->
<!-- datatables simple -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>
<!-- datatables select -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/select/1.2.1/css/select.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/select/1.2.1/js/dataTables.select.min.js"></script>
<!-- datables button -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<!-- end add require script -->

<!-- ส่วนแสดงผล -->
<button type="button" class="btn btn-default" name="view" data-toggle="modal" data-target="#myModal_group">กลุ่มหน่วยงาน</button>
<button type="button" class="btn btn-default" name="view" data-toggle="modal" data-target="#myModal_department">หน่วยงาน</button>
<button type="button" class="btn btn-default" name="view" data-toggle="modal" data-target="#myModal_person">บุคคล</button>

<!-- เริ่ม ส่งกลุ่มหน่วยงาน -->
<div class="modal fade bs-example-modal-lg" id="myModal_group" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="box-title">กลุ่มหน่วยงาน</h4>
      </div>
      <div class="modal-body">
        <?php
        $this->load->model('IofficeModel');
        $result = $this->IofficeModel->getall_departmentgroup();
        ?>
        <input type="checkbox" id="checkall_departmentgroup"> เลือกทั้งหมด
        <table id="table_departmentgroup" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>เลือก</th>
              <th>รหัสกลุ่มหน่วยงาน</th>
              <th>กลุ่มหน่วยงาน</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if($result!=false){ 
              foreach ($result as $row) {
                echo '<tr>';
                echo '<td><input type="checkbox" id="check_departmentgroup" class="check_node" value="'.$row->department_groupid.'"></td>';
                echo '<td>'.$row->department_groupid.'</td>';
                echo '<td>'.$row->department_groupname.'</td>';
                echo '</tr>';
              }
            }
            ?>
          </tbody>
        </table>
      </div>
      <!--
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class='glyphicon glyphicon-remove' aria-hidden='true'></span>&nbsp;ปิด</button>
      </div>
      -->
    </div>
  </div>
</div>
<!-- จบ ส่งกลุ่มหน่วยงาน -->

<!-- เริ่ม ส่งหน่วยงาน -->
<div class="modal fade bs-example-modal-lg" id="myModal_department" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="box-title">หน่วยงาน</h4>
      </div>
      <div class="modal-body">
        <?php
        $result = $this->IofficeModel->getall_node('department',null);
        ?>
        <input type="checkbox" id="checkall_department"> เลือกทั้งหมด
        <table id="table_department" class="table_d table-striped table-bordered">
          <thead>
            <tr>
              <th>เลือก</th>
              <th>รหัสหน่วยงาน</th>
              <th>หน่วยงาน</th>
              <th>กลุ่มหน่วยงาน</th>             
            </tr>
          </thead>
          <tbody>
            <?php 
            if($result!=false){ 
              foreach ($result as $row) {
                echo '<tr>';
                echo '<td><input type="checkbox" id="check_department" class="check_department" value="'.$row->nodeid.'"></td>';
                echo '<td>'.$row->nodeid.'</td>';
                echo '<td>'.$row->nodename.'</td>';
                echo '<td>'.$row->department_typename.'</td>';                
                echo '</tr>';
              }
            }
            ?>
          </tbody>
        </table>
      </div>
      <!--
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class='glyphicon glyphicon-remove' aria-hidden='true'></span>&nbsp;ปิด</button>
      </div>
      -->
    </div>
  </div>
</div>
<!-- จบ ส่งหน่วยงาน -->

<!-- เริ่ม ส่งบุคคล -->
<div class="modal fade bs-example-modal-lg" id="myModal_person" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="box-title">บุคคล</h4>
        <!--<input type="checkbox" id="checkall_person"> เลือกทั้งหมด-->
      </div>
      <div class="modal-body">
        <?php
        $result = $this->IofficeModel->getall_node('person',$this->session->department_masterid);
        ?>
        <table id="table_person" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>บุคลากร</th>
              <th>กลุ่มหน่วยงาน</th>
              <!--<th>เลือก</th>-->
            </tr>
          </thead>
          <tbody>
            <?php 
            if($result!=false){ 
              foreach ($result as $row) {
                echo '<tr>';
                echo '<td>'.$row->nodeid.'</td>';
                echo '<td>'.$row->nodename.'</td>';
                echo '<td>'.$row->department_typename.'</td>';
                //echo '<td><input type="checkbox" id="check_person" class="check_person" value="'.$row->nodeid.'"></td>';
                echo '</tr>';
              }
            }
            ?>
          </tbody>
        </table>
      </div>
      <!--
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class='glyphicon glyphicon-remove' aria-hidden='true'></span>&nbsp;ปิด</button>
      </div>
      -->
    </div>
  </div>
</div>
<!-- จบ ส่งบุคคล -->

<!-- จบส่วนแสดงผล -->