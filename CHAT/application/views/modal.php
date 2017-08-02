<!DOCTYPE html>
<html lang="en">
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

<div class="menu" id="select_friend">
    <?php
        if($friend){
            foreach ($friend as $row) {
                echo '<div class="item select_option" data-value="'.$row['ID'].'" data-text="'.$row['Nama'].'"><img class="ui mini avatar image" src="'.base_url('pro_pict/').$row['ProfilePict'].'">'.$row['Nama'].'</div>';
            }
        }
    ?>
</div>
</html>