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
  });
</script>
<!-- begin add require script -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/multiselect/css/common.css" type="text/css" />
<link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/themes/ui-lightness/jquery-ui.css" />
<link type="text/css" href="<?php echo base_url(); ?>assets/multiselect/css/ui.multiselect.css" rel="stylesheet" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/multiselect/js/plugins/localisation/jquery.localisation-min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/multiselect/js/plugins/scrollTo/jquery.scrollTo-min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/multiselect/js/ui.multiselect.js"></script>
<script type="text/javascript">
  $(function(){
    $.localise('ui-multiselect', {/*language: 'en',*/ path: 'js/locale/'});
    $(".multiselect").multiselect();
    $('#switcher').themeswitcher();
  });
</script>
<!-- end add require script -->

<!-- ส่วนแสดงผล -->
<?php
$this->load->model('IofficeModel');
$result = $this->IofficeModel->get_multiselect_node();
if($result!=false){
  echo '<select id="countries" class="multiselect" multiple="multiple" name="countries[]">';
  foreach ($result as $row_node) {
    echo '<option value="'.$row_node->nodeid.'">'.$row_node->nodename.'</option>';
  }
  echo '</select>';
}
?>
<!--
<script type="text/javascript"
  src="http://jqueryui.com/themeroller/themeswitchertool/">
</script> -->
<div id="switcher"></div>

<!-- จบส่วนแสดงผล -->