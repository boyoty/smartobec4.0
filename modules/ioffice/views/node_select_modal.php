<script type="text/javascript">
  $(document).ready(function(){
    table_g = $('#table_g').DataTable({
      responsive: true,
      stateSave: true,
      select: {
        style: 'multi'
      },
      //dom: 'Bfrtip',
      //buttons: [
      //  'selectAll',
      //  'selectNone'
      //],
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
          },
        "buttons": {
            "selectAll": "เลือกทั้งหมด",
            "selectNone": "ไม่เลือกทั้งหมด"
        }
        }
    });
    $('#table_g tbody').on( 'click', 'tr', function () {
      var data = table_g.row( this ).data();
      //alert(data[0]);
      if ( $(this).hasClass('selected') ) {
        var checked='false';
      }else{
        var checked='true';
      } 
      $.ajax({
        url:'<?php echo base_url(); ?>index.php/ioffice/ajax_select_departmentgroup',
        data:'department_groupid='+data[0]+'&token=ioffice2&checked='+checked,
        type:'POST',
        success:function(res){
          swal({
            title: res,
            text: 'ดำเนินการเรียบร้อยแล้ว',
            type: 'success'
          });
        },
        error:function(err){
          swal({
            title: 'เกิดข้อผิดพลาด',
            text: err,
            type: 'error'
          });
        }
      });
    } );

    table_dep2 = $('#table_dep2').DataTable({
      responsive: true,
      stateSave: true,
      select: {
        style: 'multi'
      },
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
    $('#table_dep2 tbody').on( 'click', 'tr', function () {
      var data = table_dep2.row( this ).data();
      //alert(data[0]);
      if ( $(this).hasClass('selected') ) {
        var checked='false';
      }else{
        var checked='true';
      } 
      $.ajax({
        url:'<?php echo base_url(); ?>index.php/ioffice/ajax_select_node',
        data:'nodeid='+data[0]+'&token=ioffice2&checked='+checked,
        type:'POST',
        success:function(res){
          /*swal({
            title: res,
            text: 'ดำเนินการเรียบร้อยแล้ว',
            type: 'success'
          });*/
        },
        error:function(err){
          swal({
            title: 'เกิดข้อผิดพลาด',
            text: err,
            type: 'error'
          });
        }
      });
    } );

    table_dep3 = $('#table_dep3').DataTable({
      responsive: true,
      stateSave: true,
      select: {
        style: 'multi'
      },
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
    $('#table_dep3 tbody').on( 'click', 'tr', function () {
      var data = table_dep3.row( this ).data();
      //alert(data[0]);
      if ( $(this).hasClass('selected') ) {
        var checked='false';
      }else{
        var checked='true';
      } 
      $.ajax({
        url:'<?php echo base_url(); ?>index.php/ioffice/ajax_select_node',
        data:'nodeid='+data[0]+'&token=ioffice2&checked='+checked,
        type:'POST',
        success:function(res){
          /*swal({
            title: res,
            text: 'ดำเนินการเรียบร้อยแล้ว',
            type: 'success'
          });*/
        },
        error:function(err){
          swal({
            title: 'เกิดข้อผิดพลาด',
            text: err,
            type: 'error'
          });
        }
      });
    } );

    table_dep8 = $('#table_dep8').DataTable({
      responsive: true,
      stateSave: true,
      select: {
        style: 'multi'
      },
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
    $('#table_dep8 tbody').on( 'click', 'tr', function () {
      var data = table_dep8.row( this ).data();
      //alert(data[0]);
      if ( $(this).hasClass('selected') ) {
        var checked='false';
      }else{
        var checked='true';
      } 
      $.ajax({
        url:'<?php echo base_url(); ?>index.php/ioffice/ajax_select_node',
        data:'nodeid='+data[0]+'&token=ioffice2&checked='+checked,
        type:'POST',
        success:function(res){
          /*swal({
            title: res,
            text: 'ดำเนินการเรียบร้อยแล้ว',
            type: 'success'
          });*/
        },
        error:function(err){
          swal({
            title: 'เกิดข้อผิดพลาด',
            text: err,
            type: 'error'
          });
        }
      });
    } );

    table_dep9 = $('#table_dep9').DataTable({
      responsive: true,
      stateSave: true,
      select: {
        style: 'multi'
      },
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
    $('#table_dep9 tbody').on( 'click', 'tr', function () {
      var data = table_dep9.row( this ).data();
      //alert(data[0]);
      if ( $(this).hasClass('selected') ) {
        var checked='false';
      }else{
        var checked='true';
      } 
      $.ajax({
        url:'<?php echo base_url(); ?>index.php/ioffice/ajax_select_node',
        data:'nodeid='+data[0]+'&token=ioffice2&checked='+checked,
        type:'POST',
        success:function(res){
          /*swal({
            title: res,
            text: 'ดำเนินการเรียบร้อยแล้ว',
            type: 'success'
          });*/
        },
        error:function(err){
          swal({
            title: 'เกิดข้อผิดพลาด',
            text: err,
            type: 'error'
          });
        }
      });
    } );

    table_boss = $('#table_boss').DataTable({
      responsive: true,
      stateSave: true,
      select: {
        style: 'multi'
      },
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
    $('#table_boss tbody').on( 'click', 'tr', function () {
      var data = table_boss.row( this ).data();
      //alert(data[0]);
      if ( $(this).hasClass('selected') ) {
        var checked='false';
      }else{
        var checked='true';
      } 
      $.ajax({
        url:'<?php echo base_url(); ?>index.php/ioffice/ajax_select_node',
        data:'nodeid='+data[0]+'&token=ioffice2&checked='+checked,
        type:'POST',
        success:function(res){
          /*swal({
            title: res,
            text: 'ดำเนินการเรียบร้อยแล้ว',
            type: 'success'
          });*/
        },
        error:function(err){
          swal({
            title: 'เกิดข้อผิดพลาด',
            text: err,
            type: 'error'
          });
        }
      });
    } );

    table_person = $('#table_person').DataTable({
      responsive: true,
      stateSave: true,
      select: {
        style: 'multi'
      },
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
    $('#table_person tbody').on( 'click', 'tr', function () {
      var data = table_person.row( this ).data();
      //alert(data[0]);
      if ( $(this).hasClass('selected') ) {
        var checked='false';
      }else{
        var checked='true';
      } 
      $.ajax({
        url:'<?php echo base_url(); ?>index.php/ioffice/ajax_select_node',
        data:'nodeid='+data[0]+'&token=ioffice2&checked='+checked,
        type:'POST',
        success:function(res){
          /*swal({
            title: res,
            text: 'ดำเนินการเรียบร้อยแล้ว',
            type: 'success'
          });*/
        },
        error:function(err){
          swal({
            title: 'เกิดข้อผิดพลาด',
            text: err,
            type: 'error'
          });
        }
      });
    } );

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
<button type="button" class="btn btn-default" name="view" data-toggle="modal" data-target="#myModal_dep2">สำนัก</button>
<button type="button" class="btn btn-default" name="view" data-toggle="modal" data-target="#myModal_dep3">กลุ่ม</button>
<button type="button" class="btn btn-default" name="view" data-toggle="modal" data-target="#myModal_dep8">สพป.</button>
<button type="button" class="btn btn-default" name="view" data-toggle="modal" data-target="#myModal_dep9">สพม.</button>
<button type="button" class="btn btn-default" name="view" data-toggle="modal" data-target="#myModal_boss">ผู้บริหาร</button>
<button type="button" class="btn btn-default" name="view" data-toggle="modal" data-target="#myModal_person">บุคลากรในหน่วยงาน</button>

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
        <table id="table_g" class="table_g table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>#</th>
              <th>กลุ่มหน่วยงาน</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if($result!=false){ 
              foreach ($result as $row) {
                echo '<tr>';
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

<!-- เริ่ม ส่งสำนัก -->
<div class="modal fade bs-example-modal-lg" id="myModal_dep2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="box-title">สำนัก</h4>
      </div>
      <div class="modal-body">
        <?php
        $result = $this->IofficeModel->get_node_bygroup(2);
        ?>
        <table id="table_dep2" class="table_dep2 table-striped table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>สำนัก</th>
              <th>กลุ่มหน่วยงาน</th>             
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
<!-- จบ ส่งสำนัก -->

<!-- เริ่ม ส่งกลุ่ม -->
<div class="modal fade bs-example-modal-lg" id="myModal_dep3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="box-title">กลุ่ม</h4>
      </div>
      <div class="modal-body">
        <?php
        $result = $this->IofficeModel->get_node_bygroup(3);
        ?>
        <table id="table_dep3" class="table_dep3 table-striped table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>กลุ่ม</th>
              <th>กลุ่มหน่วยงาน</th>             
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
<!-- จบ ส่งกลุ่ม -->

<!-- เริ่ม ส่ง สพป. -->
<div class="modal fade bs-example-modal-lg" id="myModal_dep8" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="box-title">สพป.</h4>
      </div>
      <div class="modal-body">
        <?php
        $result = $this->IofficeModel->get_node_bygroup(8);
        ?>
        <table id="table_dep8" class="table_dep8 table-striped table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>สพป.</th>
              <th>กลุ่มหน่วยงาน</th>             
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
<!-- จบ ส่ง สพป. -->

<!-- เริ่ม ส่ง สพม. -->
<div class="modal fade bs-example-modal-lg" id="myModal_dep9" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="box-title">สพม.</h4>
      </div>
      <div class="modal-body">
        <?php
        $result = $this->IofficeModel->get_node_bygroup(9);
        ?>
        <table id="table_dep9" class="table_dep9 table-striped table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>สพม.</th>
              <th>กลุ่มหน่วยงาน</th>             
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
<!-- จบ ส่ง สพม. -->

<!-- เริ่ม ส่งผู้บริหาร -->
<div class="modal fade bs-example-modal-lg" id="myModal_boss" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="box-title">ผู้บริหาร</h4>
        <!--<input type="checkbox" id="checkall_person"> เลือกทั้งหมด-->
      </div>
      <div class="modal-body">
        <?php
        $result = $this->IofficeModel->getall_node_bydep('person',1);
        ?>
        <table id="table_boss" class="table_boss table-striped table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>ผู้บริหาร</th>
              <th>กลุ่มหน่วยงาน</th>
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
<!-- จบ ส่งผู้บริหาร -->

<!-- เริ่ม ส่งบุคคลทั้วไป -->
<div class="modal fade bs-example-modal-lg" id="myModal_person" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="box-title">บุคลากรในหน่วยงาน</h4>
        <!--<input type="checkbox" id="checkall_person"> เลือกทั้งหมด-->
      </div>
      <div class="modal-body">
        <?php
        $result = $this->IofficeModel->getall_node('person',$this->session->department_masterid);
        ?>
        <table id="table_person" class="table_person table-striped table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>บุคลากรในหน่วยงาน</th>
              <th>กลุ่มหน่วยงาน</th>
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
<!-- จบ ส่งบุคคลทั่วไป -->

<!-- จบส่วนแสดงผล -->