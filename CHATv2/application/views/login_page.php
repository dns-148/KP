<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/chat.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/login.css">
    <script src="<?php echo base_url(); ?>asset/JS/moment.js"></script>
    <script src="<?php echo base_url(); ?>asset/JS/moment-timezone.js"></script>
    <script src="<?php echo base_url(); ?>asset/JS/moment-timezone-with-data.js"></script>
    <script type="text/javascript">
    	function set_time(){
    		var local_tz = moment.tz.guess();
    		$('#timezone').val(local_tz);
    	}
    </script>
</head>
<body>
<?php echo validation_errors(); ?>
<div class="container-fluid form">
   	<?php echo form_open('user_auth'); ?>
   		<input type="hidden" name="timezone" id="timezone" value=""/>
	    <div class="form-group">
	        <label for="text">Email:</label>
	        <input type="email" class="form-control" name="email" id="email" value="<?php echo set_value('email'); ?>" required/>
	    </div>
	    <div class="form-group">
	        <label for="password">Password:</label>
	        <input type="password" class="form-control" name="password" id="password" required/>
	    </div>
	    <div class="checkbox">
	        <label>
	            <input type="checkbox"> Remember me</label>
	    </div>
	    <button type="submit" class="btn btn-danger">Submit</button>
	</form>
</div>
</body>
<script type="text/javascript">
	set_time();
</script>
</html>