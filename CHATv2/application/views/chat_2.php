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
    <script>
        var socket = io('http://localhost:3000');

        function join(){
            var nama = '<?php echo $nama ?>';
            var username = '<?php echo $username ?>';
            var img = '<?php echo $profilepict ?>'
            var room = '<?php echo $room ?>';
            socket.emit("join", username, nama, room, img);
        };

        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("active");
        });

        $(function() {
            $('.formsend').submit(function(e) {
                e.preventDefault();
                e.returnValue = false;
                var dt = new Date();
                var time = dt.getDate() + "/" +(dt.getMonth()+1) + "/" + dt.getFullYear() + "  " + dt.getHours() + ":" + dt.getMinutes();
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
                        id_user: "<?php echo $id ?>",
                        time : time_db,
                        tipe : 1,
                        msg : msg_val
                    },
                    error: function(data){
                    }
                });

            });

            socket.on('chat message', function(username, who, msg, s_time, img) {
                var time = " • " + s_time;
                var img_url = '<?php echo base_url('pro_pict/') ?>' + img;
                if(username == '<?php echo $username ?>'){
                    $('.main_chat').append('<div class="two column row"><div class="four wide column"></div><div class="twelve wide column"><div class="ui right floated comments"> <div class="comment"><a class="avatar c_avatar"></a><div class="content com_con"><a class="author"></a><div class="metadata"></div><div class="text msg_data mod_send"></div></div></div></div></div></div>');
                }else{
                    $('.main_chat').append('<div class="two column row"><div class="twelve wide column"><div class="ui comments"> <div class="comment"><a class="avatar c_avatar"></a><div class="content com_con"><a class="author"></a><div class="metadata"></div><div class="text msg_data mod_receive"></div></div></div></div></div></div>');
                }
                var img = $('<img>', {"src": img_url});
                $('.c_avatar').last().append(img);
                $('.author').last().text(who);
                var date = $('<div>', {"class": "date"}).text(time);
                $('.metadata').last().append(date);
                var description = $('<p>').text(msg);
                $('.msg_data').last().append(description);
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
                        <input type="text" name="group_name" placeholder="Group Name">
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
                                    foreach ($friend as $row) {
                                        echo '<div class="item select_option" data-value="'.$row['id'].'" data-text="'.$row['nama'].'"><img class="ui mini avatar image" src="';
                                        echo base_url('pro_pict/');
                                        echo $row['profilepict'];
                                        echo '">'.$row['nama'].'</div>';
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
        <div class="ui inverted left vertical sidebar menu sd_chatlist">
            <div class="item">
                <div class="ui two column grid">
                    <div class="column"><a>
                        <img class="ui avatar image" src="<?php echo base_url('pro_pict/user_0.png'); ?>">
                    </a></div>
                    <div class="column">
                        <a class="ui animated fade button createchat" tabindex="0" href="<?php echo base_url('login/logout'); ?>">
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
                <div class="ui animated fade button" tabindex="0" onclick="$('.md_addfriend').modal('show');">
                    <div class="visible content">Add Friend</div>
                    <div class="hidden content">
                        <i class="add user icon"></i>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ui search">
                    <div class="ui icon input">
                        <input class="prompt" type="text" placeholder="Search Chat">
                        <i class="search icon"></i>
                    </div>
                    <div class="results"></div>
                </div>
            </div>
            <?php
                if($list_room != NULL){
                    foreach ($list_room as $room) {
                        echo '<a class="item" style="padding-left: 0px; padding-right: 0px;" href="';
                        echo base_url('chat/index?room=');
                        echo $room[0]->idRoom;
                        echo '"><div class="ui cards"><div class="ui fluid card" style="margin: 0px;"><div class="content"><img class="right floated mini ui image" src="';
                        echo base_url('pro_pict/');
                        echo $room[0]->roomPict;
                        echo '"><div class="header">'.$room[0]->namaRoom.'</div></div></div></div></a>';
                    }
                }
            ?>
        </div>
        <div class="ui inverted left vertical sidebar menu">
        </div>
        <div class="ui inverted right vertical sidebar menu sd_groupuser">
        </div>
        <div class="pusher">
            <div class="ui top fixed labeled icon menu">
                <a class="item chatlist">
                    <i class="comments icon"></i> List Chat
                </a>
                <div class="right menu">
                    <a class="item groupuser">
                        <i class="users icon"></i> Group User
                    </a>
                    <a class="item leavegroup" onclick="$('.md_leavegroup').modal('show');">
                        <i class="remove user icon"></i> Leave Group
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
                                        echo '<div class="two column row"><div class="four wide column"></div><div class="twelve wide column"><div class="ui comments"><div class="comment"><a class="avatar c_avatar"><img src="'.base_url('pro_pict/').$row["ProfilePict"].'"></a><div class="content com_con"><a class="author">'.$row["Nama"].'</a><div class="metadata"><div class="date"> • '.$formated_timestamp.'</div></div><div class="text msg_data mod_send">'.$row["chatMsg"].'</div></div></div></div></div></div>';
                                    }else{
                                        echo '<div class="two column row"><div class="twelve wide column"><div class="ui comments"><div class="comment"><a class="avatar c_avatar"><img src="'.base_url('pro_pict/').$row["ProfilePict"].'"></a><div class="content com_con"><a class="author">'.$row["Nama"].'</a><div class="metadata"><div class="date"> • '.$formated_timestamp.'</div></div><div class="text msg_data mod_receive">'.$row["chatMsg"].'</div></div></div></div></div></div>';
                                    }
                                }
                            }
                        ?>
                    </div>                
                </div>
            </div>
            <div class="footer">
                <form action="" class="formsend">
                <div class="ui grid">
                    <div class="twelve wide column">
                        <textarea class="chat_message"></textarea>
                    </div>
                    <div class="four wide column" style="padding-left: 0px;">
                        <button type="submit" class="ui compact icon button" style="height: 5vh; width: 5vh; padding: 1vh;" data-tooltip="Send message" data-inverted="">
                          <i class="send icon"></i>
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('.sd_chatlist')
        .sidebar({
            context: $('.bottom.segment')
        })
        .sidebar('attach events', '.menu .chatlist');

         $('.sd_groupuser')
        .sidebar({
            context: $('.bottom.segment')
        })
        .sidebar('attach events', '.menu .groupuser');

        $('.dropdown').dropdown({});

        join();
    </script>
</body>
</html>