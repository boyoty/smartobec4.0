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
<!-- begin add require script -->

<!-- end add require script -->

<!-- ส่วนแสดงผล -->
<!-- เริ่ม ส่วนเลือกส่งถึง -->
<!-- START ACCORDION & CAROUSEL-->
<div class="row">
  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-body">
        <div class="box-group" id="accordion">
          <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
          <?php
          $this->load->model('IofficeModel');
          $res = $this->IofficeModel->get_system_department_group();
          if($res!=false){
            foreach ($res as $rec) {
              ?>
              <div class="panel box box-primary">
                <div class="box-header with-border">
                  <h4 class="box-title">
                    <input type="checkbox" id="groupcheck<?php echo $rec->department_groupid; ?>">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $rec->department_groupid; ?>">
                      <?php echo $rec->department_groupname; ?>
                    </a>
                  </h4>
                </div>
                <div id="collapse<?php echo $rec->department_groupid; ?>" class="panel-collapse collapse">
                  <div class="box-body">
                    <?php
                    $res_node = $this->IofficeModel->get_node_group($rec->department_groupid);
                    if($res_node!=false){
                      $count = count($res_node);
                      $count2 = ceil($count/2);
                      //echo '<div class="row">';
                      $i=0;
                      foreach ($res_node as $rec_node) {
                        $i=$i+1;
                        if($i==1&&$count!=1){ echo '<div class="col-md-6">'; }
                        if($i==$count2&&$count!=1){ echo '</div><div class="col-md-6">'; }
                        echo '<input type="checkbox" class="group'.$rec->department_groupid.'" name="nodeid[]" id="nodeid'.$rec_node->nodeid.'" value="'.$rec_node->nodeid.'"> '.$rec_node->nodename.'</br>';
                        //if($i==1||$i==$count2){ echo '</div>'; }
                      } 
                      if($count!=1){echo '</div>';}
                    }
                    ?>
                  </div>
                </div>
              </div>
              <script type="text/javascript">
                $(document).ready(function(){                
                  $('#groupcheck<?php echo $rec->department_groupid; ?>').click(function(){
                    $('.group<?php echo $rec->department_groupid; ?>').attr('checked', true);
                    //alert('ok');
                  });
                });
              </script>
              <?php 
            }
          }
          ?>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
<!-- END ACCORDION & CAROUSEL-->
<!-- จบ ส่วนเลือกส่งถึง -->
<!-- จบส่วนแสดงผล -->