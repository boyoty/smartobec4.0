<?php
// start execute time
$time_start = microtime(true);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php //$this->load->model("systemmodel");?>
  <title><?php echo $this->systemmodel->get_config("web_title"); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="<?php echo base_url();?>favicon.ico" rel="shortcut icon" type="image/x-icon" />
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte233/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte233/plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte233/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte233/dist/css/skins/_all-skins.min.css">
  <!-- jQuery 2.2.0 -->
  <script src="<?php echo base_url(); ?>assets/adminlte233/plugins/jQuery/jQuery-2.2.0.min.js"></script>

  <script src="//code.jquery.com/jquery-1.12.1.min.js" type="text/javascript"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
  <link href="<?php echo base_url(); ?>assets/fancytree/src/skin-win7/ui.fancytree.css" rel="stylesheet" type="text/css">
  <script src="<?php echo base_url(); ?>assets/fancytree/src/jquery.fancytree.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/fancytree/src/jquery.fancytree.filter.js" type="text/javascript"></script>

  <!-- sweet alert -->
  <script src="<?php echo base_url(); ?>assets/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/sweetalert/dist/sweetalert.css">
  <script src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
       //alert('ok');
    });
  </script>
  <script type="text/javascript">
    $(function () {
      //Initialize Select2 Elements
      $(".select2").select2();
    });
  </script>
  <script type="text/javascript">
    function toggleDiv(divId) 
    {
      $("#"+divId).toggle();
    }
    function showDiv(divId) 
    {
      $("#"+divId).show();
    }
    function hideDiv(divId) 
    {
      $("#"+divId).hide();
    }
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
      $(".confirmlink").click(function(e) {
        e.preventDefault();
        var targetUrl = $(this).attr("href");
        swal({
          title: "ยืนยันการทำรายการ",
          text: "กรุณายืนยันการทำรายการอีกครั้ง",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#428BCA",
          confirmButtonText: "ยืนยัน",
          cancelButtonText: "ยกเลิก",
          closeOnConfirm: false
        },
        function(){
          //swal("Deleted!", "Your imaginary file has been deleted.", "success");
          window.location.href = targetUrl;
        });
      });
    });
  </script>

</head>
<body class="hold-transition skin-green-light sidebar-mini fixed">
<div class="wrapper">
  <?php $this->load->view("templates/topbar");?>
  <?php $this->load->view("templates/sidebar");?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php //if(isset($this->session->member)){ ?>
    <section class="content-header">
      <h1>
        <?php
if ($this->uri->segment(1) == '') {
    echo '<i class="fa fa-lock"></i>';
} elseif ($this->uri->segment(1) == 'home') {
    echo '<i class="fa fa-lock"></i>';
} elseif ($this->uri->segment(1) == 'member') {
    echo '<i class="fa fa-home"></i>&nbsp;&nbsp;หน้าหลัก';
} elseif ($this->uri->segment(1) == 'modulegroup') {
    $icon = $this->systemmodel->get_modulegroupicon_by_id($this->uri->segment(3));
    if ($icon == false) {$icon = 'fa-desktop';}
    echo '<i class="fa ' . $icon . '"></i>&nbsp;&nbsp;' . $this->systemmodel->get_modulegroupname_by_id($this->uri->segment(3));
} else {
    $icon = $this->systemmodel->get_modulegroupicon_by_module($this->uri->segment(1));
    if ($icon == false) {$icon = 'fa-desktop';}
    echo '<i class="fa ' . $icon . '"></i>&nbsp;&nbsp;' . $this->systemmodel->get_modulegroupname_by_module($this->uri->segment(1));
}
?>
        <!--<small>Control panel</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-sitemap"></i>&nbsp;&nbsp;หน้าหลัก</li>
        <?php
if ($this->uri->segment(1) == '') {

} elseif ($this->uri->segment(1) == 'home') {

} elseif ($this->uri->segment(1) == 'member') {

} elseif ($this->uri->segment(1) == 'modulegroup') {
    echo '<li class="active">' . $this->systemmodel->get_modulegroupname_by_id($this->uri->segment(3)) . '</li>';
} else {
    //if($this->uri->segment(3)!=''){
    //  echo '<li class="active">'.$this->systemmodel->get_modulegroupname_by_module($this->uri->segment(1)).'</li>';
    //}else{
    echo '<li>' . $this->systemmodel->get_modulegroupname_by_module($this->uri->segment(1)) . '</li>';
    echo '<li>' . $this->systemmodel->get_modulename($this->uri->segment(1)) . '</li>';
    echo '<li class="active">' . $this->systemmodel->get_menuname($this->uri->segment(1) . '/' . $this->uri->segment(2)) . '</li>';
    //}

}

?>
      </ol>
    </section>
    <?php //} ?>
    <!-- Main content -->
    <section class="content">
      <?php

if (isset($output)) {
    //echo 'output';
    $this->load->view($content, $output);
} elseif (isset($data)) {
    //echo 'data';
    $this->load->view($content, $data);
} else {
    //echo 'no output';
    $this->load->view($content);
}
?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b>
      <?php
echo $this->systemmodel->get_config('footer_version');
// Anywhere else in the script
echo ' | แสดงผลใน ' . number_format((microtime(true) - $time_start), 2, '.', '') . ' วินาที'; ?>
    </div>
    <strong>
      <?php
echo $this->systemmodel->get_config('footer_title');
// debug bar
//$res = $this->systemmodel->get_menu_permission($this->session->person_id);
//echo implode(' ', $res);
 ?>
    </strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/adminlte233/bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/adminlte233/plugins/select2/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/adminlte233/dist/js/app.min.js"></script>

<?php 
//แปลงเวลาเป็นภาษาไทย
function ThaiTimeConvert($timestamp="",$full="",$showtime=""){
  global $SHORT_MONTH, $FULL_MONTH, $DAY_SHORT_TEXT, $DAY_FULL_TEXT;

  $DAY_FULL_TEXT = array(
  "Sunday" => "อาทิตย์",
  "Monday" => "จันทร์",
  "Tuesday" => "อังคาร",
  "Wednesday" => "พุธ",
  "Thursday" => "พฤหัสบดี",
  "Friday" => "ศุกร์",
  "Saturday" => "เสาร์"
  );

  $DAY_SHORT_TEXT = array(
  "Sunday" => "อา.",
  "Monday" => "จ.",
  "Tuesday" => "อ.",
  "Wednesday" => "พ.",
  "Thursday" => "พฤ.",
  "Friday" => "ศ.",
  "Saturday" => "ส."
  );

  $SHORT_MONTH = array(
  "1" => "ม.ค.",
  "2" => "ก.พ.",
  "3" => "มี.ค.",
  "4" => "เม.ย.",
  "5" => "พ.ค.",
  "6" => "มิ.ย.",
  "7" => "ก.ค.",
  "8" => "ส.ค.",
  "9" => "ก.ย.",
  "10" => "ต.ค.",
  "11" => "พ.ย.",
  "12" => "ธ.ค."
  );

  $FULL_MONTH = array(
  "1" => "มกราคม",
  "2" => "กุมภาพันธ์",
  "3" => "มีนาคม",
  "4" => "เมษายน",
  "5" => "พฤษภาคม",
  "6" => "มิถุนายน",
  "7" => "กรกฏาคม",
  "8" => "สิงหาคม",
  "9" => "กันยายน",
  "10" => "ตุลาคม",
  "11" => "พฤศจิกายน",
  "12" => "ธันวาคม"
  );

  $FULL_MONTH2 = array(
  "01" => "มกราคม",
  "02" => "กุมภาพันธ์",
  "03" => "มีนาคม",
  "04" => "เมษายน",
  "05" => "พฤษภาคม",
  "06" => "มิถุนายน",
  "07" => "กรกฏาคม",
  "08" => "สิงหาคม",
  "09" => "กันยายน",
  "10" => "ตุลาคม",
  "11" => "พฤศจิกายน",
  "12" => "ธันวาคม"
  );

  $day = date("l",$timestamp);
  $month = date("n",$timestamp);
  $year = date("Y",$timestamp);
  $time = date("H:i:s",$timestamp);
  $times = date("H:i",$timestamp);
  if($full){
    $ThaiText = $DAY_FULL_TEXT[$day]." ที่ ".date("j",$timestamp)." เดือน ".$FULL_MONTH[$month]." พ.ศ.".($year+543) ;
  }else{
    $ThaiText = date("j",$timestamp)."  ".$SHORT_MONTH[$month]."  ".($year+543);
  }

  if($showtime == "1"){
    return $ThaiText." เวลา ".$time;
  }else if($showtime == "2"){
    $ThaiText = date("j",$timestamp)." ".$SHORT_MONTH[$month]." ".($year+543);
    return $ThaiText." : ".$times;
  }else{
    return $ThaiText;
  }
}
?>
<!-- Bootstrap Confirmation -->
<script>
  $('[data-toggle="confirmation"]').confirmation({
    title: "<B>กรุณายืนยัน</B>",
    btnOkLabel: "<i class='icon-ok-sign icon-white'></i> ยืนยัน",
    btnCancelLabel: "<i class='icon-remove-sign'></i> ยกเลิก",   
    singleton: "true",
    popout: "true"
    })
</script> 

</body>
</html>