<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Pratt - Free Bootstrap 3 Theme">
  <meta name="author" content="Alvarez.is - BlackTie.co">
  <link rel="shortcut icon" href="assets/ico/favicon.png">

  <title>Pratt - Free Bootstrap 3 Theme</title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url()?>assets/css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  <!-- Custom styles for this template -->
  <link href="<?php echo base_url()?>assets/css/main.css" rel="stylesheet">

  <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

  <style type="text/css">
  .navbar-default .dropdown-menu.notify-drop {
    min-width: 330px;
    background-color: #fff;
    min-height: 360px;
    max-height: 360px;
  }
  .navbar-default .dropdown-menu.notify-drop .notify-drop-title {
    border-bottom: 1px solid #e2e2e2;
    padding: 5px 15px 10px 15px;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content {
    min-height: 280px;
    max-height: 280px;
    overflow-y: scroll;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content::-webkit-scrollbar-track
  {
    background-color: #F5F5F5;
  }

  .navbar-default .dropdown-menu.notify-drop .drop-content::-webkit-scrollbar
  {
    width: 8px;
    background-color: #F5F5F5;
  }

  .navbar-default .dropdown-menu.notify-drop .drop-content::-webkit-scrollbar-thumb
  {
    background-color: #ccc;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content > li {
    border-bottom: 1px solid #e2e2e2;
    padding: 10px 0px 5px 0px;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content > li:nth-child(2n+0) {
    background-color: #fafafa;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content > li:after {
    content: "";
    clear: both;
    display: block;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content > li:hover {
    background-color: #fcfcfc;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content > li:last-child {
    border-bottom: none;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content > li .notify-img {
    float: left;
    display: inline-block;
    width: 45px;
    height: 45px;
    margin: 0px 0px 8px 0px;
  }
  .navbar-default .dropdown-menu.notify-drop .allRead {
    margin-right: 7px;
  }
  .navbar-default .dropdown-menu.notify-drop .rIcon {
    float: right;
    color: #999;
  }
  .navbar-default .dropdown-menu.notify-drop .rIcon:hover {
    color: #333;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content > li a {
    font-size: 12px;
    font-weight: normal;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content > li {
    font-weight: bold;
    font-size: 11px;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content > li hr {
    margin: 5px 0;
    width: 70%;
    border-color: #e2e2e2;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content .pd-l0 {
    padding-left: 0;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content > li p {
    font-size: 11px;
    color: #666;
    font-weight: normal;
    margin: 3px 0;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content > li p.time {
    font-size: 10px;
    font-weight: 600;
    top: -6px;
    margin: 8px 0px 0px 0px;
    padding: 0px 3px;
    border: 1px solid #e2e2e2;
    position: relative;
    background-image: linear-gradient(#fff,#f2f2f2);
    display: inline-block;
    border-radius: 2px;
    color: #B97745;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content > li p.time:hover {
    background-image: linear-gradient(#fff,#fff);
  }
  .navbar-default .dropdown-menu.notify-drop .notify-drop-footer {
    border-top: 1px solid #e2e2e2;
    bottom: 0;
    position: relative;
    padding: 8px 15px;
  }
  .navbar-default .dropdown-menu.notify-drop .notify-drop-footer a {
    color: #777;
    text-decoration: none;
  }
  .navbar-default .dropdown-menu.notify-drop .notify-drop-footer a:hover {
    color: #333;
  }
  </style>

  <script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
  <script src="<?php echo base_url()?>assets/js/smoothscroll.js"></script>
  <script src="<?php echo base_url()?>assets/js/bootstrap.js"></script>
  <script src="<?php echo base_url()?>assets/js/jquery-2.1.1.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js"></script>


</head>

<body data-spy="scroll" data-offset="0" data-target="#navigation">

  <!-- Fixed navbar -->
  <div id="navigation" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="row">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <!--	<div class="navbar-header"> -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Birthday App</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="#">Home</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" onclick=" " id="birthday">
                Notifications <span class="badge pull-right" id="badge_birthday"></span>
              </a>
              <ul class="dropdown-menu notify-drop">
                <div class="notify-drop-title">
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">Notifications
                      <div class="col-md-6 col-sm-6 col-xs-6 text-right"><a href="" class="rIcon allRead" data-tooltip="tooltip" data-placement="bottom" title="tümü okundu."></a></div>
                    </div>
                  </div>
                  <!-- end notify title -->
                  <!-- notify content -->
                  <div class="drop-content">
                    <li>
                      <div class="col-md-3 col-sm-3 col-xs-3"><div class="notify-img"><img src="http://placehold.it/45x45" alt=""></div></div>
                      <div class="col-md-9 col-sm-9 col-xs-9 pd-l0"><a href="">Ahmet</a> yorumladı. <a href="">Çicek bahçeleri...</a> <a href="" class="rIcon"><i class="fa fa-dot-circle-o"></i></a>

                        <hr>
                        <p class="time">Şimdi</p>
                      </div>
                    </li>
                    <li>
                      <div class="col-md-3 col-sm-3 col-xs-3"><div class="notify-img"><img src="http://placehold.it/45x45" alt=""></div></div>
                      <div class="col-md-9 col-sm-9 col-xs-9 pd-l0"><a href="">Ahmet</a> yorumladı. <a href="">Çicek bahçeleri...</a> <a href="" class="rIcon"><i class="fa fa-dot-circle-o"></i></a>
                        <p>Lorem ipsum sit dolor amet consilium.</p>
                        <p class="time">1 Saat önce</p>
                      </div>
                    </li>
                    <li>
                      <div class="col-md-3 col-sm-3 col-xs-3"><div class="notify-img"><img src="http://placehold.it/45x45" alt=""></div></div>
                      <div class="col-md-9 col-sm-9 col-xs-9 pd-l0"><a href="">Ahmet</a> yorumladı. <a href="">Çicek bahçeleri...</a> <a href="" class="rIcon"><i class="fa fa-dot-circle-o"></i></a>
                        <p>Lorem ipsum sit dolor amet consilium.</p>
                        <p class="time">2 Hafta önce</p>
                      </div>
                    </li>
                  </div>
                  <div class="notify-drop-footer text-center">
                    <a href=""><i class="fa fa-eye"></i> Tümünü Göster</a>
                  </div>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i>&nbspUser<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Edit Profile</a></li>
                  <li><a href="#">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </div>
  </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript">
$('.carousel').carousel({
  interval: 3500
});
</script>
<script type="text/javascript">
$(function () {
  $('[data-tooltip="tooltip"]').tooltip()
});

//Refresh birthday count
function ajax_refreshBirthdayCounts()
{
  $.ajax({
    url: "<?php echo site_url('notif_request/countBirthday')?>",
    type: 'POST',
    success: function(data) {
      $('#badge_birthday').html(data);
      timer = setTimeOut("ajax_refreshBirthdayCounts()", 5000);
    }
  }
);
}

  //setInterval("<function_name>",<timeinterval in milli seconds>)
  ajax_refreshBirthdayCounts();
  console.log('test');
</script>
</body>
</html>
