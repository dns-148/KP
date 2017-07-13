<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Chat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/JS/material.js"></script>
    <script src="http://localhost:3000/socket.io/socket.io.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.js"></script>
    <script>
        var socket = io('http://localhost:3000');

        function join(){
            var nama = '<?php echo $nama ?>';
            var username = '<?php echo $username ?>';
            socket.emit("join", username, nama);
        };

        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("active");
        });

        $(function() {
            $('form').submit(function() {
                var msg_val =  $('#m_send').val();
                socket.emit('chat message', $('#m_send').val());
                $('#m_send').val('');
                return false;
            });

            socket.on('chat message', function(username, who, msg) {
                var dt = new Date();
                var time = who + " • " +dt.getDate() + "-" +(dt.getMonth()+1) + "-" + dt.getFullYear() + " " + dt.getHours() + ":" + dt.getMinutes();
                if(username == '<?php echo $username ?>'){
                    $('.message_field').append('<div class="row"><div class="col-xs-5"></div><div class="col-xs-7"><div class="col-xs-2 spaced"></div><div class="col-xs-2 chaasee float_right"><img src="http://gpfarah.com/gpfarahcom/wp-content/uploads/2014/05/13099629981030824019profile.svg_.hi_.png"></div><div class="col-xs-1 arrow_right float_right"></div><div class="col-xs-7 messages msg_send float_right"><div class="caption"></div></div></div></div>');
                }else{
                    $('.message_field').append('<div class="row "><div class="col-xs-7"><div class="col-xs-2 chaasee"><img src="http://gpfarah.com/gpfarahcom/wp-content/uploads/2014/05/13099629981030824019profile.svg_.hi_.png"></div><div class="col-xs-1 arrow_left"></div><div class="col-xs-7 messages"><div class="caption msg_receive"></div></div></div><div class="col-xs-5"></div></div>');
                }
                $('.caption').last().append($('<p>').text(msg));
                $('.caption').last().append($('<time>').text(time));
            });
        });
    </script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/chat.css">
</head>

<body>
    <div class="active" id="wrapper">
        <div id="sidebar-wrapper">
            <div class="sidebar-nav" id="sidebar">
                <div class="insidebar-nav red_color">
                    <div class="float_left in_left red_color hovering">
                        <a style="height: 10vh;">
                            <div class="avatar" style="width: 10vh;">
                                <img alt="" src="http://gpfarah.com/gpfarahcom/wp-content/uploads/2014/05/13099629981030824019profile.svg_.hi_.png">
                            </div>
                        </a>
                    </div>
                    <div class="float_right in_right">
                        <a><span class="fa fa-ellipsis-v sub_icon"></span></a>
                    </div>
                    <div class="float_right in_right">
                        <a><span class="sub_icon fa fa-comments-o"></span></a>
                    </div>
                </div>
                <ul class="sidebar-nav" id="sidebar">
                    <li class="sidebar-nav blue_border il_chat">
                        <a class="il_chat">
                            <div class="col-sm-3 rigged-3">
                                <div class="chatar">
                                    <img alt="" src="http://gpfarah.com/gpfarahcom/wp-content/uploads/2014/05/13099629981030824019profile.svg_.hi_.png">
                                </div>
                            </div>
                            <div class="col-sm-6 rigged-6">
                                <div class="row r-rigged">
                                    <p>Title Chat #1</p>
                                </div>
                                <div class="row r-rigged">
                                    <p>Lorem Ipsum #1</p>
                                </div>
                            </div>
                            <div class="col-sm-3 rigged-3">
                                <div class="row">
                                    <p class="chat_time">00:00</p>
                                </div>
                                <div class="row">
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="page-content-wrapper">
            <div class="page-content inset">
                <div class="navbar navbar-inverse no_all red_color left_border">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <div class="avatar n-chat" style="width: 10vh;">
                                <img alt="" src="http://gpfarah.com/gpfarahcom/wp-content/uploads/2014/05/13099629981030824019profile.svg_.hi_.png">
                            </div>
                        </div>

                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li><a class="m_icon" style="padding-top: 1vh;" href="<?php echo base_url('login/logout'); ?>"><span class="sub_icon fa fa-sign-out"></span></a></li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
                <div class="chat-inside">
                    <div class="container-fluid message_field">
                    </div>
                </div>
                <div class="navbar navbar-inverse white_color left_border">
                    <div class="container-fluid">
                        <form action="">
                            <div class="col-xs-10">
                                <input id="m_send" class="in_message" autocomplete="off" />
                            </div>
                            <div class="col-xs-2 box_sendbutton">
                                <button class="btn btn-success send_msg">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container -->
    </div>
    <script type="text/javascript">
        join();
    </script>
</body>
</html>