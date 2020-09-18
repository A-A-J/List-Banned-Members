<?php
get_headerMenu();


if (!empty($_POST['note'])) {
    $note   =   htmlspecialchars($_POST['note'], ENT_QUOTES);

    $updataNote = $con->prepare('UPDATE `sett` SET `note`=?');

    $updataNote->execute( array( $note ) );

    $successNote = array();

    $successNote[] = Lang['msg_note_updated']; 
}

$getNote = getAllTableFetch('*','sett');

if(!empty($successNote)){

    foreach($successNote as $successNote){

        echo '<div class="m-3"><div class="msg success">'.$successNote.'</div></div>';
        
    }
}

$get_ban_page_home = getAllTable('*','ban','ORDER BY id DESC LIMIT 5');

require_once $urlpagetemp.'home.html';