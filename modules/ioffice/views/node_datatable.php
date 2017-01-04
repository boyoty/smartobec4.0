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
    //$('#table_node').DataTable();
    //datatables
    // Setup - add a text input to each footer cell
    $('#table tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
    table = $('#table').DataTable({ 
        responsive: true,
        //stateSave: true,
        select: {
          style: 'multi'
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('ioffice/ajax_list')?>",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ]
    });
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
  });
</script>
<!-- begin add require script -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
<!--<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">-->
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>
<!-- end add require script -->

<!-- ส่วนแสดงผล -->
<table id="table" class="display table table-striped table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>หน่วยงาน/บุคลากร</th>
      <th>ประเภท</th>
      <th>กลุ่มหน่วยงาน</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>#</th>
      <th>หน่วยงาน/บุคลากร</th>
      <th>ประเภท</th>
      <th>กลุ่มหน่วยงาน</th>
    </tr>
  </tfoot>
</table>
<!-- จบส่วนแสดงผล -->