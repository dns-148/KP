<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="<?php echo base_url()?>assets/css/bootstrap.css" rel="stylesheet">
		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>BirthApp- Birthday Application - List Birthday</title>


		  <!-- Custom styles for this template -->
		  <link href="<?php echo base_url()?>assets/css/main.css" rel="stylesheet">

		  <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
		  <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="../css/styles.css" rel="stylesheet">

	<!--/head-->

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
   height: 100%;
   font-family:"Lato";
   src:url('http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic');
   color:#555555;
   background-color:#84806f;
}

.nav {
   font-family:"Lato";
   src:url('http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic');
   font-size:16px;
}

a {
  color:#222222;
}

a:hover {
  text-decoration:none;
}

hr {
  border-color:#dedede;
}

.wrapper, .row {
   height: 100%;
   margin-left:0;
   margin-right:0;
}

.wrapper:before, .wrapper:after,
.column:before, .column:after {
    content: "";
    display: table;
}

.wrapper:after,
.column:after {
    clear: both;
}

.column {
    height: 100%;
    overflow: auto;
    *zoom:1;
}

.column .padding {
    padding: 20px;
}

.full{
	padding-top:70px;
}

.box {
  	bottom: 0; /* increase for footer use */
    left: 50;
    position: absolute;
    right: 0;
    top: 0;
    background-color:#444444;
  /*
    background-image:url('/assets/example/bg_suburb.jpg');
    background-size:cover;
    background-attachment:fixed;
  */
}

.divider {
	margin-top:32px;
}

.navbar-grey {
    border-width:0;
	background-color:#3B5999;
    color:#ffffff;
    font-family:arial,sans-serif;
    top:0;
    position:fixed;
    width:inherit;
}

.navbar-blue li > a,.navbar-toggle  {
   color:#efefef;
}

.navbar-blue .dropdown-menu li a {color:#2A4888;}
.navbar-blue .dropdown-menu li > a {padding-left:30px;}

.navbar-blue li>a:hover, .navbar-blue li>a:focus, .navbar-blue .open, .navbar-blue .open>a, .navbar-blue .open>a:hover, .navbar-blue .open>a:focus {
   background-color:#2A4888;
   color:#fff;
}

#main {
   background-color:#e9eaed;
   padding-left:0;
   padding-right:0;
}
#main .img-circle {
   margin-top:18px;
   height:70px;
   width:70px;
}

#sidebar {
    padding:0px;
	padding-top:15px;
}

#sidebar, #sidebar a, #sidebar-footer a {
    color:#ffffff;
    background-color:transparent;
	text-shadow:0 0 2px #000000;
    padding-left:5px;
}
#sidebar .nav li>a:hover {
    background-color:#393939;
}

.logo {
  display:block;
  padding:3px;
  background-color:#fff;
  color:#3B5999;
  height:28px;
  width:28px;
  margin:9px;
  margin-right:2px;
  margin-left:15px;
  font-size:20px;
  font-weight:700;
  text-align:center;
  text-decoration:none;
  text-shadow:0 0 1px;
  border-radius:2px;
}
#sidebar-footer {
  background-color:#444;
  position:absolute;
  bottom:5px;
  padding:5px;
}
#footer {
  margin-bottom:20px;
}

/* bootstrap overrides */

h1,h2,h3 {
   font-family:"Lato";
   src:url('http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic');
   text-decoration: underline;
}

.navbar-toggle, .close {
	outline:0;
}

.navbar-toggle .icon-bar {
	background-color: #fff;
}

.btn-primary,.label-primary,.list-group-item.active, .list-group-item.active:hover, .list-group-item.active:focus  {
	background-color:#3B5999;
    color:#fffffe;
}
.btn-default {
    color:#666666;
    text-shadow:0 0 1px rgba(1,0,0,.3);
}
.form-control {
	
}

.panel textarea, .well textarea, textarea.form-control
{
   resize: none;
}
  
.badge{
   czolor:#3B5999;
   background-color:#fff;
}
.badge:hover, .badge-inverse{
   background-color:#3B5999;
   color:#fff;
}
    
.jumbotron {
  background-color:blue;
}
.label-default {
  background-color:#dddddd;
}
.page-header {
  margin-top: 55px;
  padding-top: 9px;
  border-top:1px solid #eeeeee;
  font-weight:700;
  text-transform:uppercase;
  letter-spacing:2px;
}

.panel-default .panel-heading {
  background-color:#f9fafb;
  color:#555555;
}

.col-sm-9.full {
    width: 100%;
}

.modal-header, .modal-footer {
	background-color:#f2f2f2;
    font-weight:800;
    font-size:12px;
}

.modal-footer i, .well i {
    font-size:20px;
    align-content: center;
    color:#c0c0c0;
}

.modal-body {
	padding:0px;
}

.modal-body textarea.form-control
{
   resize: none;
   border:0;
   box-shadow:0 0 0;
}

small.text-muted {
  font-family:courier,courier-new,monospace;
}

/* adjust the contents on smaller devices */
@media (max-width: 768px) {

  .column .padding {
    padding: 7px;
  }

  .full{
	padding-top:20px;
  }

  .navbar-blue {
	background-color:#3B5999;
    top:0;
    width:100%;
    position:relative;
  }

}


/*
 * off canvas sidebar
 * --------------------------------------------------
 */

/*------------------css navbar-----------------*/

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
  h2
  {
    text-align: center;
    color: white;
  }
  </style>

  <script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
  <script src="<?php echo base_url()?>assets/js/smoothscroll.js"></script>
  <script src="<?php echo base_url()?>assets/js/bootstrap.js"></script>
  <script src="<?php echo base_url()?>assets/js/jquery-2.1.1.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js"></script>
</head>

<body>

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
	                  <li><a href="<?php echo base_url(); ?>profil/edit_profile">Profile</a></li>
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
<h2>List of birthday</h2>
<div class="wrapper">
    <div class="box-center">
        <div class="row row-offcanvas row-offcanvas-center">
                      
            <div class="column col-sm-4 col-xs-1 sidebar-offcanvas" id="sidebar">
              <ul class="nav">
                <li><a href="#" data-toggle="offcanvas" class="visible-xs text-center"><i class="glyphicon glyphicon-chevron-right"></i></a></li>
              </ul>
            <!-- sidebar --
                <!-- /top nav -->
                             <div class="well"> 
                                   <form class="form-horizontal-center" role="form">
                                    <h4>Simon Cowwel</h4>
                                     <div class="form-group" style="padding:14px;">
                                      <textarea class="form-control" placeholder="Write a birthday wish" href= "<?php echo base_url('test/insert_wish '); ?>" ></textarea>
                                    </div>
                                    <button class="btn btn-primary pull-right" type="button">Send</button>
                                    <ul class="list-inline"><li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li><li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li><li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li></ul>
                                  </form>
                              </div>
                              <div class="well"> 
                                   <form class="form-horizontal" role="form">
                                    <h4>Katherin</h4>
                                     <div class="form-group" style="padding:14px;">
                                      <textarea class="form-control" placeholder="Write a birthday wish"></textarea>
                                    </div>
                                    <button class="btn btn-primary pull-right" type="button">Send</button><ul class="list-inline"><li><a href=""><i class=""></i></a></li><li><a href=""><i class=""></i></a></li><li><a href=""><i class=""></i></a></li></ul>
                                  </form>
                              </div>

                              <div class="well"> 
                                   <form class="form-horizontal" role="form">
                                    <h4>Katherin</h4>
                                     <div class="form-group" style="padding:14px;">
                                      <textarea class="form-control" placeholder="Write a birthday wish"></textarea>
                                    </div>
                                    <button class="btn btn-primary pull-right" type="button">Send</button><ul class="list-inline"><li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li><li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li><li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li></ul>
                                  </form>
                              </div>
                      
                        <!-- content -->                      
                      	<div class="row">
                </div>
          </div> 
        </div>
    </div>
</div>

</body>
</html>