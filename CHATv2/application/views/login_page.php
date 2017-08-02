<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://semantic-ui.com/dist/semantic.css">
    <link rel="stylesheet" href="http://semantic-ui.com/dist/semantic.min.css">
    
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <!-- Latest compiled JavaScript -->
    <script src="http://semantic-ui.com/dist/semantic.js"></script>
    <script src="http://semantic-ui.com/dist/semantic.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/JS/moment.js"></script>
    <script src="<?php echo base_url(); ?>asset/JS/moment-timezone.js"></script>
    <script src="<?php echo base_url(); ?>asset/JS/moment-timezone-with-data.js"></script>
    <script type="text/javascript">
    	function set_time(){
    		var local_tz = moment.tz.guess();
    		$('#timezone').val(local_tz);
    	}
        $(document).ready(function() {
            $('.ui.form').form({
                fields: {
                    email: {
                        identifier  : 'email',
                        rules: [{
                            type   : 'empty',
                            prompt : 'Please enter your e-mail'
                        },{
                            type   : 'email',
                            prompt : 'Please enter a valid e-mail'
                        }]
                    }, password: {
                        identifier  : 'password',
                        rules: [{
                            type   : 'empty',
                            prompt : 'Please enter your password'
                        }]
                    }
                }
            });
        });
        </script>
    <style type="text/css">
        body {
          background-color: #DADADA;
          overflow: hidden;
        }
        body > .grid {
          height: 100%;
        }
        .image {
          margin-top: -100px;
        }
        .column {
          max-width: 450px;
        }
    </style>
</head>
<body>
    <div class="ui middle aligned center aligned grid">
      <div class="column">
        <h2 class="ui teal image header">
          <i class="comments icon" style="color: rgba(180, 30, 30, 1);"></i>
          <div class="content" style="color: rgba(180, 30, 30, 1);">
            Log-in 
          </div>
        </h2>
        <form method="POST" class="ui large form" action="<?php echo base_url('user_auth');?>">
          <div class="ui stacked segment">
            <div class="field">
            <input type="hidden" name="timezone" id="timezone" value=""/>
              <div class="ui left icon input">
                <i class="user icon"></i>
                <input type="text" name="email" placeholder="E-mail address" value="<?php echo set_value('email'); ?>">
              </div>
            </div>
            <div class="field">
              <div class="ui left icon input">
                <i class="lock icon"></i>
                <input type="password" name="password" placeholder="Password">
              </div>
            </div>
            <div class="ui fluid large blue submit button">Login</div>
          </div>
          <div class="ui error message"><?php echo validation_errors(); ?></div>
        </form>
      </div>
    </div>
</body>
<script type="text/javascript">
	set_time();
</script>
</html>