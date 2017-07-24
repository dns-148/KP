<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Chat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://semantic-ui.com/dist/semantic.css">
    <link rel="stylesheet" href="http://semantic-ui.com/dist/semantic.min.css">
    <link rel="stylesheet" href="<?php echo base_url('asset/css/modified.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Latest compiled JavaScript -->
    <script src="http://localhost:3000/socket.io/socket.io.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="http://semantic-ui.com/dist/semantic.js"></script>
    <script src="http://semantic-ui.com/dist/semantic.min.js"></script>
    <script src="<?php echo base_url('asset/JS/modified.js'); ?>"></script>
    <script>
        var socket;

        function join(){
            socket = io('http://localhost:3000');
            var nama = '<?php echo $nama ?>';
            var id = '<?php echo $id ?>';
            var img = '<?php echo $profilepict ?>';
            var room = '<?php echo $room ?>';
            var room_list = <?php $temp = []; foreach ($allroom_info as $row) { $temp[] = $row['id_room']; }; echo json_encode($temp);?>;
            socket.emit("join", id, nama, room, room_list, img);
        };

        function scrolltobottom(){
            var distance = $('.main')[0].scrollHeight;
            $('.main').animate({scrollTop: distance}, 'slow');
        }

        function scroll(){
            var unread = <?php echo $unread ?>;
            if(unread > -1){
                if(unread > 0 && <?php echo count($list_chat); ?> > 1){
                    var child = $('#chat_' + '<?php echo (count($list_chat) - $unread)  ?>');
                    var parent = $('#chat_1');
                    var distance =  child.offset().top-parent.offset().top;
                    $('.main').animate({scrollTop: distance}, 'slow');
                }else{
                    scrolltobottom();
                }
            }
        };


        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("active");
        });

        $(function() {

            socket.on('user logout', function(logout_id, remaining_id){
                var temp_item = "#status_" + logout_id;
                $(temp_item).text("Offline");
                var temp_item = "#ledlamp_" + logout_id;
                $(temp_item).removeClass('led-blue');
                $(temp_item).addClass('led-red');

                for(index = 0; index < remaining_id.length; index++){
                    var temp_item = "#user_" + remaining_id[index];
                    $(temp_item).prependTo("#list_user");
                }
            });

            socket.on('new message notif', function(msg, time, room_id){
                var temp_item = "#room_" + room_id;
                $(temp_item).prependTo("#irp");
                var temp_item = "#msg_new_" + room_id;
                $(temp_item).text(msg);
                var temp_item = "#msg_time_" + room_id;
                $(temp_item).text(time);
                if(room_id != '<?php echo $room ?>'){
                    var temp_item = "#notif_" + room_id;
                    var unread = parseInt($(temp_item).text()) + 1;
                    $(temp_item).text(unread);
                    $(temp_item).removeClass('hidden');

                    $.ajax({
                        url: '<?php echo base_url('chat_manager/update_unread') ?>',
                        type: 'post',
                        dataType : "json",
                        data: { 
                            room: room_id, 
                            user_id: "<?php echo $id ?>",
                            unread : unread
                        },
                        error: function(data){
                            console.log(data);
                        }
                });
                }
            });

            socket.on('update user', function (list_user){
                
                for (index = 0; index < list_user.length; index++) {
                    var temp_item = "#user_" + list_user[index];
                    $(temp_item).prependTo("#list_user");
                    var temp_item = "#status_" + list_user[index];
                    $(temp_item).text("Online");
                    var temp_item = "#ledlamp_" + list_user[index];
                    $(temp_item).removeClass('led-red');
                    $(temp_item).addClass('led-blue');
                }
            });

            $('.formsend').submit(function(e) {
                e.preventDefault();
                e.returnValue = false;

                var dt = new Date();
                var time = ('0' + dt.getDate()).slice(-2) + "/" + ('0' + (dt.getMonth()+1)).slice(-2) + "/" + dt.getFullYear() + "  " + ('0' + dt.getHours()).slice(-2) + ":" + ('0' + dt.getMinutes()).slice(-2);
                var time_db = dt.getFullYear() + "-" + (dt.getMonth()+1) + "-" + dt.getDate() + " " + dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
                var msg_val =  $('.chat_message').val();
                socket.emit('chat message', msg_val, time);
                $('.chat_message').val('');
                
                $.ajax({
                    url: '<?php echo base_url('chat_manager/send_msg') ?>',
                    type: 'post',
                    dataType : "json",
                    data: { 
                        room: "<?php echo $room ?>", 
                        user_id: "<?php echo $id ?>",
                        time : time_db,
                        tipe : 1,
                        msg : msg_val
                    },
                    error: function(data){
                    }
                });

            });

            socket.on('chat message', function(id, who, msg, s_time, img) {
                var time = " • " + s_time;
                var img_url = '<?php echo base_url('pro_pict/') ?>' + img;
                
                if(id == '<?php echo $id ?>'){
                    $('.main_chat').append('<div class="two column row"><div class="four wide column"></div><div class="twelve wide column"><div class="ui right floated comments"> <div class="comment"><a class="avatar c_avatar"></a><div class="content com_con"><a class="author c_author"></a><div class="metadata"></div><div class="text msg_data mod_send"></div></div></div></div></div></div>');
                }else{
                    $('.main_chat').append('<div class="two column row"><div class="twelve wide column"><div class="ui comments"> <div class="comment"><a class="avatar c_avatar"></a><div class="content com_con"><a class="author c_author"></a><div class="metadata"></div><div class="text msg_data mod_receive"></div></div></div></div></div></div>');
                }
                
                var img = $('<img>', {"src": img_url});
                $('.c_avatar').last().append(img);
                $('.c_author').last().text(who);
                var date = $('<div>', {"class": "date"}).text(time);
                $('.metadata').last().append(date);
                var description = $('<p>').text(msg);
                $('.msg_data').last().append(description);
                scrolltobottom();
            });
        });
    </script>
</head>
<body>
    <div class="ui bottom attached segment pushable" style="margin-bottom: 0px">
        <!-- Modal Leave Group -->
        <div class="ui basic modal md_leavegroup">
            <div class="ui icon header">
                <i class="remove user icon"></i>Leave Group Chat</div>
            <div class="content">
                <p>Are you sure do you want to leave?</p>
                <p>When you leave, all the chat from the group will be removed from your account.</p>
            </div>
            <div class="actions">
                <div class="ui red basic cancel inverted button">
                    <i class="remove icon"></i>No
                </div>
                <div class="ui blue ok inverted button">
                    <i class="checkmark icon"></i>Yes
                </div>
            </div>
        </div>
        <!-- END of Modal Leave Group -->
        <!-- Modal Add Group Chat -->
        <div class="ui modal md_createchat">
            <div class="header">Create New Chat</div>
            <div class="content">
                <form class="ui form" action="<?php echo base_url('chat_manager/create_roomchat') ?>" method="POST">
                    <h4 class="ui dividing header">Group Information</h4>
                    <div class="field">
                        <input type="text" name="group_name" placeholder="Group Name" required/>
                    </div>
                    <h4 class="ui dividing header">User Participate</h4>
                    <div class="field">
                        <label>User:</label>
                        <div class="ui fluid multiple search selection dropdown">
                            <input type="number" name="user_id" value="<?php echo $id ?>" style="display:none;">
                            <input type="hidden" name="friend_list">
                            <i class="dropdown icon"></i>
                            <div class="default text">Friend List</div>
                            <div class="menu" id="select_friend">
                                <?php
                                    if($friend){
                                        foreach ($friend as $row) {
                                            echo '<div class="item select_option" data-value="'.$row['id'].'" data-text="'.$row['nama'].'"><img class="ui mini avatar image" src="'.base_url('pro_pict/').$row['profilepict'].'">'.$row['nama'].'</div>';
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="actions">
                        <div class="ui red basic cancel button" tabindex="0">Cancel</div>
                        <button type="submit" class="ui blue basic ok button" tabindex="0">Create</button>
                    </div>
                </form>
            </div>
            <script>
                
            </script>
        </div>
        <!-- END of Modal Add Group Chat -->
        <!-- Modal Add Friend -->
        <div class="ui modal md_addfriend">
            <div class="header">Add Friend</div>
            <div class="scrolling content">
                <div class="ui category search">
                  <div class="ui icon input">
                    <input class="prompt" type="text" placeholder="Search animals...">
                    <i class="search icon"></i>
                  </div>
                  <div class="results"></div>
                </div>
            </div>
            <div class="actions">
                <div class="ui red basic button cancel" tabindex="0">Cancel</div>
                <div class="ui blue ok button right floated" tabindex="0">Add</div>
            </div>
        </div>
        <!-- END of Modal Add Friend -->
        <div class="ui inverted left vertical sidebar menu" id="sd_chatlist">
            <!-- Move content here -->
        </div>
        <div class="ui inverted right vertical sidebar menu" id="sd_groupuser">
        </div>
        <div class="ui wide inverted left vertical sidebar menu visible" id="bg_chatlist" style="
        overflow-x: hidden;">
            <div id="item_container">
                <div class="item">
                    <div class="ui two column grid">
                        <div class="column"><a>
                            <img class="ui avatar image" src="<?php echo base_url('pro_pict/').$profilepict; ?>">
                        </a></div>
                        <div class="column">
                            <a class="ui right floated animated fade button createchat" tabindex="0" href="<?php echo base_url('login/logout'); ?>">
                                <div class="visible content">Log-out</div>
                                <div class="hidden content">
                                    <i class="sign out icon"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="ui animated fade button" tabindex="0"  onclick="$('.md_createchat').modal('show');">
                        <div class="visible content">New Chat</div>
                        <div class="hidden content">
                            <i class="comments outline icon"></i>
                        </div>
                    </div>
                    <div class="ui animated fade button right floated" tabindex="0" onclick="$('.md_addfriend').modal('show');">
                        <div class="visible content">Add Friend</div>
                        <div class="hidden content">
                            <i class="add user icon"></i>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="ui search">
                        <div class="ui icon input" style="width: 100%;">
                            <input class="prompt" type="text" placeholder="Search Chat">
                            <i class="search icon"></i>
                        </div>
                        <div class="results"></div>
                    </div>
                </div>
                <div id="irp">
                <?php

                    if($allroom_info != NULL){
                        
                        foreach ($allroom_info as $room) {
                            if($room['time']){
                                $timestamp = DateTime::createFromFormat('Y-m-d H:i:s', $room['time']);
                                $formated_timestamp = $timestamp->format('d/m/Y H:i');
                            }

                            echo '<a class="item" style="padding-left: 0px; padding-right: 0px;" href="'.base_url('chat/index?room=').$room['id_room'].'" id="room_'.$room['id_room'].'"><div class="ui cards"><div class="ui fluid card" style="margin: 0px;"><div class="content"><img class="right floated mini ui image" src="'.base_url('pro_pict/').$room['room_pict'].'"><div class="header">'.$room['nama_room'].'</div><div class="meta" id="msg_time_'.$room['id_room'].'">'.($room['time'] ? $formated_timestamp : '').'</div><div class="description ui grid"><div class="ten wide column" id="msg_new_'.$room['id_room'].'" style="padding-top:7px; overflow:hidden; max-height: 20.33px; padding-bottom: 0px; margin-bottom:14px;">'.($room['chat_msg'] ? $room['chat_msg'] : '').'</div><div class="six wide column" style="padding-top: 0px;"><div class="right floated ui red label '.($room['unread_count'] > 0 ? '' : 'hidden').'" id="notif_'.$room['id_room'].'"> '.(int)$room['unread_count'].' </div></div></div></div></div></div></a>';
                        }
                    }
                ?>
                </div>
            </div>
        </div>
        <div class="pusher" id="main_body">
            <div class="ui top attached menu" id="bg_topmenu">
                <?php 
                    if($room_info){
                        echo '<a class="brand item"><img class="ui avatar image" src="'.base_url('pro_pict/').$room_info['room_pict'].'"> &nbsp;&nbsp;&nbsp;'.$room_info['nama_room'].'</a><div class="right menu"><a class="item" onclick=""><i class="record icon"></i> Video Call</a><a class="item" onclick=""><i class="attach icon"></i> Send File</a></div>';
                    }; 
                ?>
            </div>
            <div class="ui top thin fixed labeled icon menu sidebar" id="sm_topmenu">
                <a class="item chatlist">
                    <i class="comments icon"></i>
                </a>
                <div class="right menu">
                    <a class="item groupuser">
                        <i class="users icon"></i>
                    </a>
                    <a class="item leavegroup" onclick="$('.md_leavegroup').modal('show');">
                        <i class="remove user icon"></i>
                    </a>
                </div>
            </div>
            <div class="main">
                <div class="ui basic segment">
                    <div class="ui grid main_chat">
                        <?php
                            if($list_chat){
                                foreach ($list_chat as $row) {
                                    $timestamp = DateTime::createFromFormat('Y-m-d H:i:s', $row['time']);
                                    $formated_timestamp =  $timestamp->format('d/m/Y H:i');
                                    if($id == $row['ID']){
                                        echo '<div class="two column row" id="chat_'.$row["idChat"].'"><div class="four wide column"></div><div class="twelve wide column"><div class="ui comments"><div class="comment"><a class="avatar c_avatar"><img src="'.base_url('pro_pict/').$row["ProfilePict"].'"></a><div class="content com_con"><a class="author">'.$row["Nama"].'</a><div class="metadata"><div class="date"> • '.$formated_timestamp.'</div></div><div class="text msg_data mod_send">'.$row["chatMsg"].'</div></div></div></div></div></div>';
                                    }else{
                                        echo '<div class="two column row" id="chat_'.$row["idChat"].'"><div class="twelve wide column"><div class="ui comments"><div class="comment"><a class="avatar c_avatar"><img src="'.base_url('pro_pict/').$row["ProfilePict"].'"></a><div class="content com_con"><a class="author">'.$row["Nama"].'</a><div class="metadata"><div class="date"> • '.$formated_timestamp.'</div></div><div class="text msg_data mod_receive">'.$row["chatMsg"].'</div></div></div></div></div></div>';
                                    }
                                }
                            }
                        ?>
                    </div>                
                </div>
            </div>
            <div class="footer" id="footer">
                <form action="" class="formsend">
                <div class="ui grid">
                    <div class="fourteen wide column" id="msg_area">
                        <textarea class="chat_message"></textarea>
                    </div>
                    <div class="two wide column" id="btn_send" style="padding-left: 0px;">
                        <button type="submit" class="ui compact icon button" style="height: 5vh; width: 5vh; padding: 1vh;" data-tooltip="Send message" data-inverted="">
                          <i class="send icon"></i>
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="ui wide inverted right vertical sidebar menu visible" id="bg_groupuser" style="width:20vw;">
            <div class="item">
                <div class="ui animated fade button" tabindex="0"  onclick="$('.md_createchat').modal('show');">
                    <div class="visible content">Add User</div>
                    <div class="hidden content">
                        <i class="add user icon"></i>
                    </div>
                </div>
                <div class="ui animated fade button right floated" tabindex="0" onclick="$('.md_leavegroup').modal('show');">
                    <div class="visible content">Leave Chat</div>
                    <div class="hidden content">
                        <i class="remove user icon"></i>
                    </div>
                </div>
            </div>
            <div class="item"><div class="center big_bold">User in group: </div></div>
            <div class="column" id="list_user">
            <?php
                if($user_participate){
                    foreach ($user_participate as $row) {
                        echo '<div class="item" id="user_'.$row['ID'].'"><div class="ui comments white"><div class="comment"><div class="content"><div class="ui grid"><div class="three wide column"><a class="avatar"><img src="'.base_url('pro_pict/').$row['ProfilePict'].'"></a></div><div class="nine wide column"><a class="author">'.$row['Nama'].'</a><div class="text status" id="status_'.$row['ID'].($row['ID'] == $id? '">Online' : '">Offline').'</div></div><div class="three wide column"><div class="led-box">'.( $row['ID'] == $id? '<div class="led-blue" id="ledlamp_'.$row['ID'].'">' : '<div class="led-red" id="ledlamp_'.$row['ID'].'">').'</div></div></div></div></div></div></div></div>';
                    }
                }
            ?>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#sd_chatlist')
        .sidebar({
            context: $('.bottom.segment')
        })
        .sidebar('attach events', '.menu .chatlist');

         $('#sd_groupuser')
        .sidebar({
            context: $('.bottom.segment')
        })
        .sidebar('attach events', '.menu .groupuser');

        $('.dropdown').dropdown({});

        join();
        scroll();
    </script>
</body>
</html>