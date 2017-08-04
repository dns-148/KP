<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Pratt - Free Bootstrap 3 Theme">
  <meta name="author" content="Alvarez.is - BlackTie.co">
  <link rel="shortcut icon" href="<?php echo base_url()?>assets/ico/favicon.png">

  <title>NotifApp - Notification Application</title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url()?>assets/css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  <!-- Custom styles for this template -->
  <link href="<?php echo base_url()?>assets/css/main.css" rel="stylesheet">
	<link href="<?php echo base_url()?>assets/css/comment.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>

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
    overflow-y: auto;
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
          <a class="navbar-brand" href="#"><img src="<?php echo base_url() ?>assets/images/notif-logo.png" class="image">&nbspNotifApp</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo base_url()?>notif_request">Home</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" onclick=" " id="birthday">
                Notifications <span class="badge pull-right" id="badge_notif"></span>
              </a>
              <ul class="dropdown-menu notify-drop">
                <div class="notify-drop-title">
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">Notifications
                      <div class="col-md-6 col-sm-6 col-xs-6 text-right"><a href="" class="rIcon allRead" data-tooltip="tooltip" data-placement="bottom"></a></div>
                    </div>
                  </div>
                  <!-- end notify title -->
                  <!-- notify content -->
                  <div class="drop-content">
                    <?php $no=0;

                    if($notif_birthday != NULL )
                    {
                      foreach ($notif_birthday as $row) {
                        $no++;
                        if($no % 2 == 0) {
                          $strip = 'strip1';
                        }
                        else {
                          $strip = 'strip2';
                        }
                        $id_get = $row->id_karyawan;
                        $id_session = $this->session->userdata("id_karyawan");
                        if($id_get == $id_session){
                          echo'<li>
                          <div class="col-md-3 col-sm-3 col-xs-3"><div class="notify-img"><img src="';echo base_url('assets/images/gift.png'); echo '"></div></div>
                          <div class="col-md-9 col-sm-9 col-xs-9 pd-l0">
                          <a href="';echo base_url('birthday/load_birthday?id='); echo $row->id_karyawan; echo '" class=\"'.$strip.'\">Happy birthday '.$row->nama.'!</a>
                          <hr>
                          <div>
                            <span>
                              <abbr>';echo date('D, d M Y');'</abbr>
                            </span>
                          </div>
                          </div>
                          </li>';
                        }
                        else{
                          echo'<li>
                          <div class="col-md-3 col-sm-3 col-xs-3"><div class="notify-img"><img src="';echo base_url('assets/images/gift.png'); echo '"></div></div>
                          <div class="col-md-9 col-sm-9 col-xs-9 pd-l0">
                          <a href="';echo base_url('birthday/load_birthday?id='); echo $row->id_karyawan; echo '" class=\"'.$strip.'\">'.$row->nama.' is birthday today!</a>
                          <hr>
                          <div>
                            <span>
                              <abbr>';echo date('D, d M Y');'</abbr>
                            </span>
                          </div>
                          </div>
                          </li>';
                        }
                      }
                    }

                    if($notif_event != NULL)
                    {
                      foreach ($notif_event as $row) {
                        $no++;
                        if($no % 2 == 0) {
                          $strip = 'strip1';
                        }
                        else {
                          $strip = 'strip2';
                        }
                      }
                      echo'<li>
                      <div class="col-md-3 col-sm-3 col-xs-3"><div class="notify-img"><img src="';echo base_url('assets/images/calendar.png'); echo '"></div></div>
                      <div class="col-md-9 col-sm-9 col-xs-9 pd-l0">
                      <a href=\"#\" class=\"'.$strip.'\">Today is '.$row->nama_event.'</a>
                      <hr>
                      <div>
                        <span>
                          <abbr>';echo date('D, d M Y');'</abbr>
                        </span>
                      </div>
                      </div>
                      </li>';
                    }

                    if($notif_greeting != NULL )
                    {
                      foreach ($notif_greeting as $row) {
                        $no++;
                           if($no % 2 == 0) {
                             $strip = 'strip1';
                           }
                           else {
                             $strip = 'strip2';
                           }
                        echo'<li>
                        <div class="col-md-3 col-sm-3 col-xs-3"><div class="notify-img"><img src="';echo base_url('assets/images/comments.png'); echo '"></div></div>
                        <div class="col-md-9 col-sm-9 col-xs-9 pd-l0">
                        <a href="';echo base_url('birthday/show_greeting?id='); echo $row->id_ultah; echo '" class=\"'.$strip.'\">'.$row->nama.' is sending you a wish</a>
                        <hr>
                        <div>
                          <span>
                            <abbr>Today at ';echo date('H:i A', strtotime($row->waktu));'</abbr>
                          </span>
                        </div>
                        </div>
                        </li>';
                      }
                    }

                    if($notif_birthday == NULL && $notif_event == NULL && $notif_greeting == NULL) {
                      echo'<li>
                      <div class="col-md-3 col-sm-3 col-xs-3"></div>
                      <div class="col-md-9 col-sm-9 col-xs-9 pd-l0">
                      <div class=\"text-center\">There is no notification for today</div>
                      </div>
                      </li>';
                    }
                    ?>
                  </div>
                </div>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp<?php echo $this->session->userdata("nama"); ?><span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url('user_login/logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbspLogout</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.row -->
    </nav>
  </div>
</div>
<div class="container">
    <div class="col-sm-7">
        <div class="panel panel-white post panel-shadow">
            <div class="post-heading">
                <div class="pull-left image">
                  <?php
                    $gender =  $get_id[0]->jenis_kelamin;
                    if ($gender == "Perempuan"){
                      echo "<img class='img-circle avatar' src='";
                      echo base_url('assets/images/user_2.jpg'); echo "'";
                      echo"alt='user profile image'>";
                    }
                    else{
                      echo "<img class='img-circle avatar' src='";
                      echo base_url('assets/images/user_3.jpg'); echo "'";
                      echo"alt='user profile image'>";
                    }
                  ?>
                </div>
                <div class="pull-left meta">
                    <div class="title h5">
                        <a href="#"><b><?php echo $get_id[0]->nama ?></b></a>
                        is birthday today!
                    </div>
                    <h6 class="text-muted time"><?php echo date('D, d M Y'); ?></h6>
                </div>
            </div>
            <div class="post-footer">
              <form method="post" action="<?php echo base_url('birthday/add_greeting'); ?>">
                <input class="form-control" type="hidden" name="created_by" value="<?php echo $id_beneran ?>">
                <input class="form-control" type="hidden" name="id_ultah" value="<?php echo $id_beneran ?>">
                <div class="input-group">
                    <input class="form-control" placeholder="Add greeting" type="text" name="isi_ucapan">
                    <span class="input-group-btn">
                        <button class="btn btn-secondary" type="submit"><i class="fa fa-edit"></i></button>
                    </span>
                </div>
              </form>
              <?php if(count($list_ucapan) > 0)
              {
                echo "<ul class='comments-list' style='min-height: 280px; max-height: 280px; overflow-y: auto;'>";
                      foreach ($list_ucapan as $row) {
                        echo "<li class='comment'>
                        <a class='pull-left' style='margin-left:9px; margin-right:9px;'>";
                        $gender = $row->jenis_kelamin;
                        if($gender == 'Perempuan') {
                          echo "<img class='img-circle avatar' src='";
                          echo base_url('assets/images/user_2.jpg'); echo "'";
                          echo "alt='avatar'>";
                        }
                        else {
                          echo "<img class='img-circle avatar' src='";
                          echo base_url('assets/images/user_3.jpg'); echo "'";
                          echo"alt='avatar'>";
                        }
                        echo "</a>";
                        echo "<div class='comment-body' style='margin-left:10px;'>
                              <div class='comment-heading'>
                              <h4 class='user'>$row->nama</h4>";
                        $date = date('H:i A', strtotime($row->waktu));
                        echo "<h5 class='time'>";
                        echo $date; echo "</h5>";
                        echo "</div>
                              <p>$row->isi_ucapan</p>
                              </div>
                        </li>";
                      }
              echo "</ul>"; } ?>
            </div>
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
function ajax_refreshEventCounts()
{
  $.ajax({
    url: "<?php echo site_url('notif_request/countNotif')?>",
    type: 'POST',
    success: function(data) {
      $('#badge_notif').html(data);
      timer = setTimeOut("ajax_refreshEventCounts()", 5000);
    }
  });
}
//setInterval("<function_name>",<timeinterval in milli seconds>)
ajax_refreshEventCounts();
console.log('test');
</script>

</body>
</html>
