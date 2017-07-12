<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Trust Chat</title>
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
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("active");
        });

        $(function() {
            var socket = io('http://localhost:3000');
            $('form').submit(function() {
                socket.emit('chat message', $('#m').val());
                $('#m').val('');
                return false;
            });

            socket.on('chat message', function(msg) {
                $('.messages').append($('<li>').text(msg));
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
                        <a><span class="sub_icon fa fa-ellipsis-v"></span></a>
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
                                <li></li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
                <div class="chat-inside">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-7">
                                <div class="col-xs-2 chaasee">
                                    <img src="http://gpfarah.com/gpfarahcom/wp-content/uploads/2014/05/13099629981030824019profile.svg_.hi_.png">
                                </div>
                                <div class="col-xs-1 arrow_left">
                                </div>
                                <div class="col-xs-7 messages">
                                    <div class="caption msg_send">
                                        <p>blah blah</p>
                                        <time datetime="2009-11-13T20:00">Lorem ipsum • 51 min</time>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-5">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="navbar navbar-inverse white_color left_border">
                    <div class="container-fluid">
                        <form action="">
                            <div class="col-xs-10">
                                <input id="m" class="in_message" type="text" autocomplete="off" />
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
</body>

</html>