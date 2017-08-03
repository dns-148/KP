<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Chat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">

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
    <script src="<?php echo base_url(); ?>asset/JS/moment.js"></script>
    <script src="<?php echo base_url(); ?>asset/JS/moment-timezone.js"></script>
    <script src="<?php echo base_url(); ?>asset/JS/moment-timezone-with-data.js"></script>
    <script>
        var socket;
        var check = false;
        var connect_attemp = 0;
        var server_url = "<?php echo base_url('chat/room?room=') ?>";
        var modal_1_url = "<?php echo base_url('chat/modal') ?> #select_friend  > *";
        var modal_2_url = "<?php echo base_url('chat/modal') ?> #au_select_friend  > *";
        var sendmsg_url = "<?php echo base_url('chat_manager/send_msg') ?>";
        var adduser_url = "<?php echo base_url('chat_manager/add_user') ?>";
        var leavechat_url = "<?php echo base_url('chat_manager/leave_chat') ?>";
        var createchat_url = "<?php echo base_url('chat_manager/create_roomchat') ?>";
        var uploadfile_url = "<?php echo base_url('chat_manager/upload_file') ?>";
        var imagebase_url = '<?php echo base_url('pro_pict/')?>';

        function join(nama, id, img, room, room_list){
            isscriptloaded();
            if(check){
                window.socket = io('http://localhost:3000', {
                    reconnection: true, 
                    reconnectionDelay: 1000,
                    reconnectionDelayMax: 5000,
                    reconnectionAttempts: 5
                });
                window.socket.emit("join", id, nama, room, room_list, img);
            }else{
                serrorconnect();
            }
        };

        function update_page(nama, id, img, room, room_list){
            window.socket.emit("update data", id, nama, room, JSON.parse(room_list), img);
        };

        $(function() { 
            if(window.check){
                socket.on('user logout', function(logout_id, remaining_id){
                    logoutuser(logout_id, remaining_id);
                });

                socket.on('new message notif', function(msg, time, room_id, tipe){
                    var server_tz = 'Europe/Berlin';
                    var local_tz = '<?php echo $timezone ?>';
                    var temp_time = moment.tz(time, server_tz);
                    f_time = temp_time.tz(local_tz).format("DD/MM/YYYY HH:mm");
                    var update_url = '<?php echo base_url('chat_manager/update_unread') ?>';
                    newmessage(msg, f_time, $('#send_room').val(), room_id, update_url, tipe);
                });

                socket.on('update user', function (list_user){
                    updateuser(list_user);
                });

                socket.on('connect', function() {
                    $('.modal').modal('hide');
                    window.check = true;
                    window.socket.emit("join", $('#send_user').val(), $('#sender').text(), $('#send_room').val(), JSON.parse($('#send_all_room').val()), $('#send_img').attr('value'));
                });

                socket.on('add chat', function(name, image, room) {
                    var new_chat = '<a class="item change_room" style="padding-left: 0px; padding-right: 0px;" id="room_' + room + '"><div class="ui cards"><div class="ui fluid card" style="margin: 0px;"><div class="content"><img class="right floated mini ui image" src="<?php echo base_url('pro_pict/')?>' + image + '"><div class="header">' + name + '</div><div class="meta" id="msg_time_' + room + '"></div><div class="description ui grid"><div class="ten wide column" id="msg_new_' + room + '" style="padding-top:7px; overflow:hidden; max-height: 20.33px; padding-bottom: 0px; margin-bottom:14px;"></div><div class="six wide column" style="padding-top: 0px;"><div class="right floated ui red label hiddened" id="notif_' + room + '"> 0 </div></div></div></div></div></div></a>';
                        $('#irp').prepend(new_chat);
                    socket.emit('join chat', room, $('#send_user').val());
                });

                socket.on('add user', function(response) {
                    au_add(response, '<?php echo base_url('pro_pict/')?>');
                });

                socket.on('remove user', function(id, nama, image){
                    var id_removed = '#user_' + id;
                    var new_available = '<div class="item select_option" data-value="' + id + '" data-text="' + nama + '" id="friend_' + id + '"><img class="ui mini avatar image" src="<?php echo base_url('pro_pict/') ?>' + image + '">' + nama + '</div>'
                    $('#au_select_friend').append(new_available);
                    $(id_removed).remove();
                });

                socket.on('removed', function(status){
                    go_to("-1");
                });

                socket.on('reconnect_failed', function(){
                    $('.modal').modal('hide');
                    serrorreconnect();
                });

                socket.on('disconnect', function(){
                    window.check = false;
                    serrordisconnect();
                });

                socket.on('chat message', function(id, who, msg, s_time, img, tipe) {
                    var server_tz = 'Europe/Berlin';
                    var local_tz = '<?php echo $timezone ?>';
                    var temp_time = moment.tz(s_time, server_tz);
                    s_time = temp_time.tz(local_tz).format("DD/MM/YYYY HH:mm");
                    var time = " • " + s_time;
                    var img_url = '<?php echo base_url('pro_pict/') ?>' + img;
                        
                    receivemessage(id, $('#send_user').val(), who, msg, time, img_url, tipe);
                    scrolltobottom();
                });
            }
        });    
    </script>
</head>
<body>
    <!-- Modal Loading -->
    <div class="ui basic modal md_loading">
        <div class="ui icon header">
            <div class="ui segment" style="background: transparent;">
                <div class="ui large loader"></div>
            </div>
        </div>
        <div class="content">
            <div class="ui  center aligned segment" style="background: transparent;">
                <p>Loading...</p>
                <p>Processing your request, please wait a moment. Do not refresh the page.</p>
            </div>
        </div>
    </div>
    <!-- END of Loading -->
    <!-- Modal Error -->
    <div class="ui basic modal md_error">
        <div class="ui icon header">
            <i class="frown icon"></i><text id="error_header">Request Failed</text>
        </div>
        <div class="content">
            <div class="ui center aligned segment" style="background: transparent;">
                <p id="error_content">Sorry! There is error occuring, your request cannot be proccesed this time. Please, check your internet connection.</p>
                <p id="error_content2">If the error is persistent. Try to contact your administrator.</p>
                <div class="actions">
                    <div class="ui blue ok inverted button">
                        <i class="checkmark icon"></i>Ok
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END of Error -->
    <!-- Modal Error File -->
    <div class="ui basic modal" id="md_errorfile">
        <div class="ui icon header">
            <i class="warning sign icon"></i>Upload File Failed
        </div>
        <div class="content">
            <div class="ui center aligned segment" style="background: transparent;">
                <p>Sorry! There is error occuring.</p>
                <p>Please check file that you're going to upload not excess 10 MB and have one of allowed extension:</p>
                <p>gif, jpg, png, rar, zip, doc, docx, ppt, pptx, xls, xlsx, pdf, txt, mp3, mp4</p>
                <div class="actions">
                    <div class="ui blue ok inverted button">
                        <i class="checkmark icon"></i>Ok
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END of Error File -->
    <!-- Modal Image -->
    <div class="ui basic modal" id="md_imagemodal">
        <div class="header actions">
            <button class="circular red ui icon cancel button">
                <i class="icon remove"></i>
            </button>
        </div>
        <div class="image content" style="display: inline-block;">
            <img class="ui centered image" id="image_modal">
        </div>
    </div>
    <!-- END of Modal Image -->
    <!-- Modal Reconnect -->
    <div class="ui basic modal md_reconnect">
        <div class="ui icon header">
            <div class="ui segment" style="background: transparent;">
                <div class="ui large loader"></div>
            </div>
        </div>
        <div class="content">
            <div class="ui  center aligned segment" style="background: transparent;">
                <p>Reconnecting to server...</p>
                <p>You're discconnected from server, please wait a few minute while the application try to reconnect.</p>
            </div>
        </div>
    </div>
    <!-- END of Reconnect -->
    <!-- Modal Upload -->
    <div class="ui modal md_sendfile">
        <div class="header">Send file to chat</div>
           <div class="content" enctype="multipart/form-data">
                <form class="ui form" id="form_file">
                    <h4 class="ui dividing header">Choose File:</h4>
                    <div class="field">
                        <!-- <label>User:</label> -->
                        <input type="file" name="upload_file" id="upload_file"/>
                    </div>
                </form>
            <div class="ui pointing red basic label hiddened" id="sf_warn_file"><i class="warning icon"></i> Please choose a file</div>
        </div>
        <div class="actions">
            <button class="ui red basic button" id="sf_cancel" tabindex="0">Cancel</button>
            <button class="ui blue basic button" id="sf_send" tabindex="0">Send</button>
        </div>
    </div>
    <!-- END of Modal Upload -->
    <!-- Modal Add Group Chat -->
    <div class="ui modal" id="md_createchat">
        <div class="header">Create New Chat</div>
        <div class="content">
            <!-- <form class="ui form"> -->
                <h4 class="ui dividing header">Group Information</h4>
                <div class="field ui fluid input">
                    <input type="text" id="cc_chat_name" name="group_name" placeholder="Group Name"/>
                </div>
                <div class="ui pointing red basic label hiddened" id="cc_warn_name"><i class="warning icon"></i> Please enter the group name</div>
                <h4 class="ui dividing header">User Participate</h4>
                <div class="field">
                    <label>User:</label>
                    <div class="ui fluid multiple search selection dropdown" id="cc_selection">
                        <input type="hidden" id="cc_friend_list" name="friend_list">
                        <i class="dropdown icon"></i>
                        <div class="default text">Friend List</div>
                        <div class="menu" id="select_friend">
                                <?php
                                    if($friend){
                                        foreach ($friend as $row) {
                                            echo '<div class="item select_option" data-value="'.$row['ID'].'" data-text="'.$row['Nama'].'"><img class="ui mini avatar image" src="'.base_url('pro_pict/').$row['ProfilePict'].'">'.$row['Nama'].'</div>';
                                        }
                                    }
                                ?>
                        </div>
                    </div>
                    <div class="ui pointing red basic label hiddened" id="cc_warn_list"><i class="warning icon"></i> Please choose a user</div>
                </div>
            <!-- </form> -->
        </div>
        <div class="actions">
            <button class="ui red basic button" id="cancel_createchat" tabindex="0">Cancel</button>
            <button class="ui blue basic button" id="ok_createchat" tabindex="0">Create</button>
        </div>
    </div>
    <!-- END of Modal Add Group Chat -->
    <!-- Modal Leave Group -->
    <div class="ui basic modal md_leavegroup">
        <div class="ui icon header">
            <i class="remove user icon"></i>Leave Group Chat</div>
        <div class="content">
            <p>Are you sure do you want to leave?</p>
            <p>When you leave, the chat history will be deleted from your account.</p>
        </div>
        <div class="actions">
            <div class="ui red basic cancel inverted button">
                <i class="remove icon"></i>No
            </div>
            <div class="ui blue inverted button" id="lc_ok">
                <i class="checkmark icon"></i>Yes
            </div>
        </div>
    </div>
    <!-- END of Modal Leave Group -->
    <!-- Modal Add User -->
    <div class="ui modal md_adduser">
        <div class="header">Add User to Chat</div>
           <div class="content">
                <form class="ui form">
                    <h4 class="ui dividing header">User Participate</h4>
                    <div class="field">
                        <label>User:</label>
                        <div class="ui fluid multiple search selection dropdown" id="au_selection">
                            <input type="hidden" name="friend_list" id="au_list">
                            <i class="dropdown icon"></i>
                            <div class="default text">Friend List</div>
                            <div class="menu" id="au_select_friend">
                                <?php
                                    if($friend && $list_user){
                                        foreach ($friend as $row) {
                                            if(!in_array($row['ID'], $list_user)){
                                                echo '<div class="item select_option" data-value="'.$row['ID'].'" data-text="'.$row['Nama'].'" id="friend_'.$row['ID'].'"><img class="ui mini avatar image" src="'.base_url('pro_pict/').$row['ProfilePict'].'">'.$row['Nama'].'</div>';
                                            }
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </form>
            <div class="ui pointing red basic label hiddened" id="au_warn_user"><i class="warning icon"></i> Please choose a user</div>
        </div>
        <div class="actions">
            <button class="ui red basic button" id="au_cancel" tabindex="0">Cancel</button>
            <button type="submit" class="ui blue basic button" id="au_add" tabindex="0">Add</button>
        </div>
    </div>
    <!-- END Modal Add User -->
    <div class="ui bottom attached segment pushable" id="body_page" style="margin: 0px;height: 100vh;width: 100vw;overflow: hidden;border: none;">
        <div class="ui inverted left vertical sidebar menu" id="sd_chatlist" style="
        overflow: hidden !important;">
        <!-- Move content here -->
        </div>
        <div class="ui inverted right vertical sidebar menu" id="sd_groupuser">
        </div>
        <div class="ui wide inverted left vertical sidebar menu visible" id="bg_chatlist" style="
        overflow: hidden !important;">
            <div id="item_container">
                <div class="item">
                    <img class="ui avatar image" id="send_img" value="<?php echo $profilepict ?>" src="<?php echo base_url('pro_pict/').$profilepict; ?>">
                    <span>&nbsp;&nbsp;&nbsp;<text id="sender"><?php echo $nama ?></text></span>
                </div>
                <div class="item">
                    <div class="ui animated fade button" tabindex="0" id="nc_button">
                        <div class="visible content">New Chat</div>
                        <div class="hidden content">
                            <i class="comments outline icon"></i>
                        </div>
                    </div>
                    <a class="ui right floated animated fade button createchat" tabindex="0" href="<?php echo base_url('login/logout'); ?>">
                        <div class="visible content">Log-out</div>
                        <div class="hidden content">
                            <i class="sign out icon"></i>
                        </div>
                    </a>
                </div>
                <div class="item">
                    <div class="ui search">
                        <div class="ui icon input" style="width: 100%;">
                            <input class="prompt" id="search_room" type="text" placeholder="Search Chat">
                            <i class="search icon"></i>
                        </div>
                    </div>
                </div>
                <div id="irp" style="overflow-x: hidden; overflow-y: auto; height: calc(100vh - 186px);">
                <?php

                    if($allroom_info != NULL){
                        $user_tz = new DateTimeZone($timezone);
                        foreach ($allroom_info as $row) {
                            if($row['time']){
                                $past_timestamp = DateTime::createFromFormat('Y-m-d H:i:s', $row['time']);
                                $past_timestamp->setTimeZone($user_tz);
                                $formated_timestamp =  $past_timestamp->format('d/m/Y H:i');
                            }

                            if($row['tipe']){
                                if($row['tipe'] == 2){
                                    $row['chat_msg'] = "[system] Image send by user";
                                }else if($row['tipe'] == 3){
                                    $row['chat_msg'] = "[system] File send by user";
                                }else if($row['tipe'] == 4){
                                    $row['chat_msg'] = "[system] Audio send by user";
                                }else if($row['tipe'] == 5){
                                    $row['chat_msg'] = "[system] Video send by user";
                                }
                            }

                            echo '<div class="item change_room" style="padding-left: 0px; padding-right: 0px;cursor:pointer;" id="room_'.$row['id_room'].'"><div class="ui cards"><div class="ui fluid card" style="margin: 0px;"><div class="content '.($row['id_room'] == $room ? 'activated' : '').'"><img class="right floated mini ui image" src="'.base_url('pro_pict/').$row['room_pict'].'"><div class="header">'.$row['nama_room'].'</div><div class="meta" id="msg_time_'.$row['id_room'].'">'.($row['time'] ? $formated_timestamp : '').'</div><div class="description ui grid"><div class="ten wide column" id="msg_new_'.$row['id_room'].'" style="padding-top:7px; overflow:hidden; max-height: 21px; padding-bottom: 0px; margin-bottom:14px;">'.($row['chat_msg'] ? $row['chat_msg'] : '').'</div><div class="six wide column" style="padding-top: 0px;"><div class="right floated ui red label '.($row['unread_count'] > 0 ? '' : 'hiddened').'" id="notif_'.$row['id_room'].'"> '.(int)$row['unread_count'].' </div></div></div></div></div></div></div>';
                        }
                    }
                ?>
                </div>
            </div>
        </div>
        <div class="pusher" id="main_body">
            <div id="main_container">
                <div class="ui top attached menu" id="bg_topmenu">
                    <?php 
                        if($room_info){
                            echo '<a class="brand item" id="grouproom_name" value="'.$room_info['nama_room'].'"><img class="ui avatar image" id="grouproom_image" value="'.$room_info['room_pict'].'" src="'.base_url('pro_pict/').$room_info['room_pict'].'"> &nbsp;&nbsp;&nbsp;'.$room_info['nama_room'].'</a><div class="right menu"><a class="item bt_sendfile"><i class="attach icon"></i> Send File</a></div>';
                        }; 
                    ?>
                </div>
                <div class="ui top attached mini menu hiddened" id="sm_topmenu" style="border-radius: 0px">
                    <?php 
                        if($room_info){
                            echo '<a class="brand item"><img class="ui avatar image" src="'.base_url('pro_pict/').$room_info['room_pict'].'"> &nbsp;&nbsp;&nbsp;'.$room_info['nama_room'].'</a>';
                        }; 
                    ?>
                    <div class="right menu">
                        <div class="ui dropdown icon item">
                            <i class="sidebar icon"></i>
                            <div class="menu">
                                <div class="item" id="sd_clbutton">List Chat</div>
                                <div class="item" id="sd_gubutton">List User</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main" style="height: 84vh;">
                    <div class="ui basic segment">
                        <div class="ui grid main_chat">
                            <?php
                                $user_tz = new DateTimeZone($timezone);
                                if($list_chat){
                                    foreach ($list_chat as $row) {
                                        $past_timestamp = DateTime::createFromFormat('Y-m-d H:i:s', $row['time']);
                                        $past_timestamp->setTimeZone($user_tz);
                                        $formated_timestamp =  $past_timestamp->format('d/m/Y H:i');
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
                    <form class="formsend">
                    <div class="ui grid">
                        <div class="fourteen wide column" id="msg_area">
                            <textarea class="chat_message"></textarea>
                        </div>
                        <div class="two wide column" id="btn_send" style="padding-left: 0px;">
                            <button type="submit" class="ui compact icon button" id="bt_sndmsg" data-tooltip="Send message" data-inverted="">
                              <i class="send icon"></i>
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <input type="hidden" id="send_room" value="<?php echo $room ?>"/>
            <input type="hidden" id="send_user" value="<?php echo $id ?>"/>
            <input type="hidden" id="send_all_room" value="<?php $temp = array(); if($allroom_info){foreach ($allroom_info as $row) { array_push($temp, (int)$row['id_room']); }}else{$temp = -1;}; echo json_encode($temp);?>"/>
            <div class="ui wide inverted right vertical sidebar menu visible" id="bg_groupuser" style="width: 20vw; overflow: hidden;">
                <div id="user_container" style="overflow:hidden;">
                    <?php if($room_info){ ?>
                    <div class="item">
                        <div class="ui animated fade button" tabindex="0" id="au_button">
                            <div class="visible content">Add User</div>
                            <div class="hidden content">
                                <i class="add user icon"></i>
                            </div>
                        </div>
                        <div class="ui animated fade button right floated" tabindex="0" id="lg_button">
                            <div class="visible content">Leave Chat</div>
                            <div class="hidden content">
                                <i class="remove user icon"></i>
                            </div>
                        </div>
                    </div>
                    <?php }; ?>
                    <div class="item"><div class="center big_bold">User in group: </div></div>
                    <div class="column" id="list_user" style="overflow-x: hidden;overflow-y: auto;">
                    <?php
                        if($user_participate){
                            foreach ($user_participate as $row) {
                                echo '<div class="item" id="user_'.$row['ID'].'"><div class="ui comments white"><div class="comment"><div class="content"><div class="ui grid"><div class="three wide column"><a class="avatar"><img src="'.base_url('pro_pict/').$row['ProfilePict'].'"></a></div><div class="nine wide column"><a class="author">'.$row['Nama'].'</a><div class="text status" id="status_'.$row['ID'].'">Offline</div></div><div class="three wide column"><div class="led-box"><div class="led-red" id="ledlamp_'.$row['ID'].'"></div></div></div></div></div></div></div></div>';
                            }
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    attach_basic();
    init();
    join('<?php echo $nama ?>', '<?php echo $id ?>', '<?php echo $profilepict ?>', '<?php echo $room ?>', <?php $temp = array(); if($allroom_info){foreach ($allroom_info as $row) { array_push($temp, $row['id_room']); }}else{$temp = -1;}; echo json_encode($temp);?>);
</script>
</html>