<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Trust Chat</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/JS/material.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/chat.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/search.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/materialkit.css">

</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top" style="background-color: #990000;" >
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">TRUST CHAT</a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li ><a href="#">CHAT</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</div>

<div class="container-fluid">
  <div class="row row-offcanvas">
    <div class="sidebar-offcanvas sidebar">

	    <div class="panel panel-default" >
	        <div class="panel-heading">KONTAK
	        </div>
	        <div class="panel-body">
	        	<div class="thumbnail">
            		<div class="caption">
            		<p>blah blah</p>
            		</div>
            	</div><!--/.thumbnail-->
            		        	<div class="thumbnail">
            		<div class="caption">
            		<p>blah blah</p>
            		</div>
            	</div><!--/.thumbnail-->
            		        	<div class="thumbnail">
            		<div class="caption">
            		<p>blah blah</p>
            		</div>
            	</div><!--/.thumbnail-->
            		        	<div class="thumbnail">
            		<div class="caption">
            		<p>blah blah</p>
            		</div>
            	</div><!--/.thumbnail-->
            		        	<div class="thumbnail">
            		<div class="caption">
            		<p>blah blah</p>
            		</div>
            	</div><!--/.thumbnail-->
            		        	<div class="thumbnail">
            		<div class="caption">
            		<p>blah blah</p>
            		</div>
            	</div><!--/.thumbnail-->
	        </div>
	    </div>
      <!--/.panel-->
    </div><!-- /.cols-->
    
    <div class="content">
      <p class="pull-right">
        <a type="button" class="btn btn-collapse btn-sm" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-down"></i> Sidebar</a>
      </p>
  
      <div class="row">

        <div class="col-md-9" >
          <div class="thumbnail">
            <div class="caption">

              <p>blah blah</p>
              
            </div>
          </div><!--/.thumbnail-->
        </div><!--/.col-3-->
        
  
      </div><!--/.row-->
    </div><!-- /.cols-->
  </div><!-- /.row-->
</div><!-- /.container -->
</body>
<footer></footer>
</html>