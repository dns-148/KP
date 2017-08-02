<!DOCTYPE html>
<html lang="en">
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
                    <div class="hiddened" id="unread" value="<?php echo $unread ?>"></div>
                    <div class="hiddened" id="list_chat" value="<?php echo ($list_chat? $list_chat[count($list_chat) - 1]['idChat'] : '') ?>"></div>
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
                                <div class="item bt_sendfile">Send File</div>
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
                                        
                                        if($row["tipe"] == 2){
                                            $url = base_url('./file_upload/') . $row["chatMsg"];
                                            $row["chatMsg"] = '<img class="msg_image" src="'.$url.'" alt="'.$row["chatMsg"].'">';
                                        }else if($row['tipe'] == 3){
                                            $url = base_url('./file_upload/') . $row["chatMsg"];
                                            $row["chatMsg"] ='<p>'.$row["chatMsg"].' :</p><a href="'.$url.'" download><div class="ui center aligned segment"><i class="download icon" style="font-size: 6em !important;"></i></div></a>';
                                        }else if($row['tipe'] == 4){
                                            $url = base_url('./file_upload/') . $row["chatMsg"];
                                            $row["chatMsg"] = '<p>'.$row["chatMsg"].' :</p><audio controls class="msg_audio"><source src="'.$url.'" type="audio/mpeg"></audio>';
                                        }else if($row['tipe'] == 5){
                                            $url = base_url('./file_upload/') . $row["chatMsg"];
                                            $row["chatMsg"] = '<video controls class="msg_video"><source src="'.$url.'" type="video/mp4"></video>';
                                        }

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
            <input type="hidden" id="send_user" value="<?php echo ($room > -2? $id : NULL) ?>"/>
            <input type="hidden" id="send_all_room" value="<?php if($room > -2 ){ $temp = []; if($allroom_info){foreach ($allroom_info as $row) { $temp[] = $row['id_room']; }}else{$temp = -1;}; echo json_encode($temp); }else{ echo '';}; ?>"/>
            <div class="ui wide inverted right vertical sidebar menu visible" id="bg_groupuser" style="width: 20vw; overflow: hidden;">
                <div id="user_container">
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
                    <div class="column" id="list_user" style="height: calc(100vh - 102px); overflow: hidden;overflow-y: auto;">
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
</html>