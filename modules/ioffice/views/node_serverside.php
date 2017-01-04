<script type="text/javascript">
  $(document).ready(function(){
    $('.check_departmentgroup').click(function(){
      //alert($(this).val());
      //$(this).prop('disabled', true);
      $.ajax({
        url:'<?php echo base_url(); ?>index.php/ioffice/ajax_select_departmentgroup',
        data:'department_groupid='+$(this).val()+'&token=ioffice2&checked='+$('#check_departmentgroup').prop('checked'),
        //dataType:'json',
        type:'POST',
        success:function(res){
          swal({
            title: 'ดำเนินการแล้ว',
            text: res,
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
    });
    $('.check_node').click(function(){
      //alert($(this).val());
      //$(this).prop('disabled', true);
      $.ajax({
        url:'<?php echo base_url(); ?>index.php/ioffice/ajax_select_department',
        data:'nodeid='+$(this).val()+'&token=ioffice2',
        //dataType:'json',
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
    $('#table_departmentgroup').DataTable();
    $('#table_department').DataTable();
    $('#table_person').DataTable();
    //$('#table_person').DataTable( {
        //"processing": true,
        //"serverSide": true,
        //"ajax": "scripts/server_processing.php"
    //} );
    $('#node_select').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "scripts/server_processing.php"
    });
  });
</script>
<!-- begin add require script -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
<!--<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">-->
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>
<!-- end add require script -->

<!-- ส่วนแสดงผล -->
<table id="example" class="display" cellspacing="0" width="100%">
  <thead>
      <tr>
          <th>First name</th>
          <th>Last name</th>
          <th>Position</th>
          <th>Office</th>
          <th>Start date</th>
          <th>Salary</th>
      </tr>
  </thead>
  <tfoot>
      <tr>
          <th>First name</th>
          <th>Last name</th>
          <th>Position</th>
          <th>Office</th>
          <th>Start date</th>
          <th>Salary</th>
      </tr>
  </tfoot>
</table>
<!-- จบส่วนแสดงผล -->