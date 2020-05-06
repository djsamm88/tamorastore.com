<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Aplikasi Penjualan</title>
    <link rel='shortcut icon' href='//humbanghasundutankab.go.id/old/wp-content/uploads/favicon.ico' />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url()?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url()?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="<?php echo base_url()?>dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>plugins/pace/pace.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/jqueryui.css">

  <link rel="stylesheet" href="<?php echo base_url()?>assets/datetimepicker/datetimepicker.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/toastr/toastr.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

<style type="text/css">
  @media (min-width: 768px) {
    .modal-lg {
      width: 90%;
     max-width:1200px;
    }
  }
</style>

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo base_url()?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Sim</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>POS</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <?php 
            if($this->session->userdata('level') ==1 || $this->session->userdata('level') ==3)
            {?>
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-danger t4_notif_chat" ></span>
            </a>

            
            <ul class="dropdown-menu">
              <li class="header">You have <span class="t4_notif_chat"></span> messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                    <div id="t4_data_count"></div>
              </li>              
            </ul>
          
          </li>
          <?php }?>


           <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-lock"></i>
              <!--<span class="label label-success">4</span>-->
            </a>
            <ul class="dropdown-menu">
              <li class="header">Welcome :<br>
                  <b>
                    [<?php echo level($session['level'])?> ] -  
                    <?php echo $session['nama_admin']?> -
                    <?php echo $session['email_admin']?>                
                  </b>
                  <br>
                  <br>
                  <?php 
                    if($this->session->userdata('level') !=5)
                      {?>
                  <a href='#' onclick="eksekusi_controller('<?php echo base_url()?>index.php/profil/data_session_user','Profil');return false;">
                    <span class="fa  fa-user"></span> Update Profil
                  </a>
                    <?php } ?>

              </li>              
              <li>
                <!-- inner menu: contains the actual data -->                
                

              </li>
              <li class="footer"><a href="<?php echo base_url()?>index.php/login/logout"><font color='red'>Keluar</font></a></li>
              </ul>
          </li>

          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
      
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url()?>/assets/img/avatar.png" class="img" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('nama_admin')?> </p>
          <!-- Status -->
          <a href="#"><?php echo $this->session->userdata('email_admin')?></a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <!--
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
    -->
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu</li>
       

        
        <?php include "menu_kiri.php"?>



      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="">
      
      <?php include "isi.php"?>
      <?php //var_dump($session['nama_admin'])?>
    
  </div>


  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Sistem Informasi POS
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020 - <?php echo date('Y')?> <a href="#">-</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
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

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="<?php echo base_url()?>assets/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url()?>assets/jqueryui.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->



<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url()?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="<?php echo base_url()?>bower_components/chart.js/Chart.js"></script>

<script src="<?php echo base_url()?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>


<!-- AdminLTE App -->
<script src="<?php echo base_url()?>dist/js/adminlte.min.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>bower_components/PACE/pace.min.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
<script type="text/javascript">
  var BASE_PATH = "<?php echo base_url()?>";
</script>
<script type="text/javascript" src="<?php echo base_url()?>js/notify.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/custom.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/dataTables.bootstrap.js"></script>


<script type="text/javascript" src="<?php echo base_url()?>assets/datetimepicker/datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/datetimepicker/datetimepicker.pt-BR.js"></script>


<script type="text/javascript" src="<?php echo base_url()?>assets/toastr/toastr.min.js"></script>

<script src="https://cdn.firebase.com/js/client/2.2.3/firebase.js"></script>
<script type="text/javascript">
  var dbRef = new Firebase("https://tamorastore-com.firebaseio.com/");
</script>

<script type="text/javascript">
  // To make Pace works on Ajax calls
  $(document).ajaxStart(function () {
    Pace.restart();

  })
  
/*** panggil chat member ****/
$(document).ready(function(){
  $.get("<?php echo base_url()?>index.php/chat/chat_member",function(e){
    $("#t4_chat_member").html(e);
  })
})
/*** panggil chat member ****/



/*** panggil chat kontak ****/
$(document).ready(function(){
  $.get("<?php echo base_url()?>index.php/chat/chat_kontak_all",function(e){
    $("#t4_chat_kontak_all").html(e);
  })
})
/*** panggil chat kontak ****/

  
  $(document).ready(function(){
    $("#tbl_datanya_barang").dataTable();


    <?php if($this->session->userdata('level') !=5) {?> 
    setTimeout(function() {
         notif();
    }, 3000);
  <?php } ?>

  <?php if($this->session->userdata('level') ==5) {?> 
    setTimeout(function() {
         notif_member();
    }, 3000);
  <?php } ?>    

    /******** toastr**********/
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-bottom-right",
      "preventDuplicates": false,      
      "showDuration": "300",
      "hideDuration": "300",
      "timeOut": "10000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    /******** toastr**********/
  })


function notifyMe(notifnya) {
  // Let's check if the browser supports notifications
  if (!("Notification" in window)) {
    alert("This browser does not support desktop notification");
  }

  // Let's check whether notification permissions have already been granted
  else if (Notification.permission === "granted") {
    // If it's okay let's create a notification
    var notification = new Notification(notifnya);
  }

  // Otherwise, we need to ask the user for permission
  else if (Notification.permission !== "denied") {
    Notification.requestPermission().then(function (permission) {
      // If the user accepts, let's create a notification
      if (permission === "granted") {
        var notification = new Notification(notifnya);
      }
    });
  }

  // At last, if the user has denied notifications, and you 
  // want to be respectful there is no need to bother them any more.
}

<?php 
if($this->session->userdata('level')==1 || $this->session->userdata('level')==3){
?>
/******* chat *********/
var chatsRef = dbRef.child('chat');
var newItems = false;
chatsRef.on("child_added", function(snap){
  if(snap.val().kpd_id=='kasir' && snap.val().baca=="belum")
  {
    //*********************notification********************************************//
    new Audio("<?php echo base_url()?>assets_chat/notif.mp3").play();
    //doNotification (snap.val().dari_nama,snap.val().isi,snap.val().tgl);
    notifyMe(snap.val().dari_nama,snap.val().isi);
    document.title = snap.val().dari_nama,snap.val().isi;
    //*********************notification********************************************//      
    data_count_kasir()
  }
  if (!newItems) return;    
});
/******** chat **********/
<?php } ?>
function data_count_kasir()
{
  $.get("<?php echo base_url()?>index.php/chat/data_count_kasir",function(e){
    $("#t4_data_count").html(e);
    data_notif_kasir();
  })
}
data_count_kasir();
data_notif_kasir();
function data_notif_kasir()
{  
  $.get("<?php echo base_url()?>index.php/chat/data_count_kasir_notif",function(e){
    $(".t4_notif_chat").html(e);
  })
}

function notif_member()
{
  $.get("<?php echo base_url()?>index.php/barang/notif",function(e){
    

    $(".badge_pesanan_ku").html("");
    if(e.jum_pesanan_ku !=0)
    {
      $(".badge_pesanan_ku").html(e.jum_pesanan_ku);
    }


    
  })
}


  function notif()
  {
    $.get("<?php echo base_url()?>index.php/barang/notif",function(e){
      

      $(".badge_barang_baru").html("");
      if(e.barang_baru != "0" || e.barang_baru!="")
      {
        $(".badge_barang_baru").html(e.barang_baru);
        toastr["error"]("Ada barang baru dari gudang, atur harganya!!!", "Barang Baru",{
            onclick: function() {
                  eksekusi_controller('<?php echo base_url()?>index.php/barang/data_beli','Pembelian Barang');
              }});
      }


      var all_notif_barang = e.barang_baru;
      
      $(".badge_barang").html("");
      if(all_notif_barang!="0" || all_notif_barang!="")
      {
        $(".badge_barang").html(all_notif_barang);  
      }

      
      $(".badge_gudang").html("");
      if(e.semu_stok_gudang != "" || e.semu_stok_gudang!="")
      {
        $(".badge_gudang").html(e.semu_stok_gudang);
        //toastr.warning(e.semu_stok_gudang);
        toastr["warning"]("Periksa stok barang di gudang!!!", "Gudang",{
            onclick: function() {
                  eksekusi_controller('<?php echo base_url()?>index.php/barang/stok_gudang/1','Stok Gudang');
              }
            });
      }


      $(".badge_pending").html("");
      if(e.jum_pending !="0")
      {
        $(".badge_pending").html(e.jum_pending);
      }

      
      $(".badge_pesanan_member").html("");
      if(e.jum_pesanan_member !="0")
      {
        $(".badge_pesanan_member").html(e.jum_pesanan_member);
      }


      $(".badge_pesanan_ku").html("");
      if(e.jum_pesanan_ku !="0")
      {
        $(".badge_pesanan_ku").html(e.jum_pesanan_ku);
      }


      
    })
  }




  $(function () {    
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------
    <?php
    $tgl = ""; 
    $debet = "";
    $kredit = "";
    foreach ($m_chart as $key) {
      $tgl .= "'".$key->tanggal."',";
      $debet .= $key->debet.',';
      $kredit .= $key->kredit.',';
    }
    ?>
    


    var areaChartData = {
      
      labels  : [<?php echo $tgl?>],
      datasets: [
        {
          label               : 'Kredit',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo rtrim($kredit,',')?>]          
          //data                : [30, 38, 50, 19, 86, 27, 90]
          //data                : [269920010,1000000,22119990]

        },
        {
          label               : 'Debet',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          //data                : [28, 48, 40, 19, 86, 27, 90]
          data                : [<?php echo rtrim($debet,',')?>]
          //data                : [205479850,1500000,38299970]

        }
      ]
    }

     var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }

    //Create the line chart
    //areaChart.Line(areaChartData, areaChartOptions)
//-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
    var lineChart                = new Chart(lineChartCanvas)
    var lineChartOptions         = areaChartOptions
    lineChartOptions.datasetFill = false
    lineChart.Line(areaChartData, lineChartOptions)

})
</script>
</body>
</html>