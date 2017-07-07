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
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/chat.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/search.css">
</head>
<body>
	<div class="col-sm-3 noleftrightpad" style="height: 100%;">
		<div class="row red_color" >
			<div class=" col-sm-12">
				<ul>
				  <li><a class="active" href="#home">Home</a></li>
				  <li><a href="#news">News</a></li>
				  <li><a href="#contact">Contact</a></li>
				  <li><a href="#about">About</a></li>
				</ul>
			</div>
		</div>
		<div class="row gray_color" style="height: 100%;">
			<div class="container">
				<div class="col-sm-12">
			       	<div id="custom-search-input">
			            <div class="input-group col-md-3">
                            <input type="text" class="  search-query form-control" placeholder="Search" />
                            <span class="input-group-btn">
                                <button class="btn btn-danger" type="button">
                                    <span class=" glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-9 noleftrightpad" style="height: 100%">
		<div class="row red_color" style="border-left: 1px solid white;">
			<div class="col-sm-12">
				<ul>
				  <li><a class="active" href="#home">Home</a></li>
				  <li><a href="#news">News</a></li>
				  <li><a href="#contact">Contact</a></li>
				  <li><a href="#about">About</a></li>
				</ul>
			</div>
		</div>
		<div class="row white_color" style="height: 100%">
			<div  class=" col-sm-12">


			</div>
		</div>

	</div>

</body>
<footer></footer>
</html>