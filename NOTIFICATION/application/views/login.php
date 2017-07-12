<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properties -->
  <title>Login Example - Semantic</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>dist/components/reset.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>dist/components/site.css">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>dist/components/container.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>dist/components/grid.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>dist/components/header.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>dist/components/image.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>dist/components/menu.css">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>dist/components/divider.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>dist/components/segment.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>dist/components/form.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>dist/components/input.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>dist/components/button.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>dist/components/list.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>dist/components/message.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>dist/components/icon.css">

  <script src="<?php echo base_url() ?>assets/library/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>dist/components/form.js"></script>
  <script src="<?php echo base_url() ?>dist/components/transition.js"></script>

  <style type="text/css">
  body {
    background-color: #DADADA;
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
  <script>
  $(document)
  .ready(function() {
    $('.ui.form')
    .form({
      fields: {
        email: {
          identifier  : 'email',
          rules: [
            {
              type   : 'empty',
              prompt : 'Please enter your e-mail'
            },
            {
              type   : 'email',
              prompt : 'Please enter a valid e-mail'
            }
          ]
        },
        password: {
          identifier  : 'password',
          rules: [
            {
              type   : 'empty',
              prompt : 'Please enter your password'
            },
            {
              type   : 'length[4]',
              prompt : 'Your password must be at least 4 characters'
            }
          ]
        }
      }
    })
    ;
  })
  ;
  </script>
</head>
<body>

  <div class="ui middle aligned center aligned grid">
    <div class="column">
      <h2 class="ui teal image header">
        <img src="<?php echo base_url() ?>assets/images/logo.png" class="image">
        <div class="content">
          Login
        </div>
      </h2>
      <?php echo form_open('user_login/login', array('class'=>'ui large form')); ?>
    <!-- <form class="ui large form"> -->
      <div class="ui stacked segment">
        <div class="field">
          <div class="ui left icon input">

            <i class="user icon"></i>
             <?php echo form_input('email', '', array('placeholder'=> 'Email Address', 'type'=>'email')); ?>
            <!-- <input type="text" name="NRP" placeholder="NRP"> -->
          </div>
        </div>
        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <?php echo form_password('password', '', array('placeholder'=> 'Password', 'type'=>'password')); ?>
            <!-- <input type="password" name="password" placeholder="Password"> -->
          </div>
        </div>
        <?php echo form_submit('submit', 'Login', array('class'=>'ui fluid large teal submit button')); ?>
        <!-- <div class="ui fluid large teal submit button">Login</div> -->
      </div>

      <div class="ui error message"></div>
      <?php echo form_close(); ?>
    </div>
  </div>

</body>

</html>
