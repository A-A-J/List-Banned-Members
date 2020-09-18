<?php
get_headerMenu();
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
$nWebsit    =   filter_var( $_POST['nWebsit'], FILTER_SANITIZE_STRING );
$dWebsit    =   filter_var( $_POST['dWebsit'], FILTER_SANITIZE_STRING );
$kWebsit    =   filter_var( $_POST['kWebsit'], FILTER_SANITIZE_STRING );
$urlWebsit  =   filter_var( $_POST['urlWebsit'], FILTER_SANITIZE_STRING );
$sWebsit    =   filter_var( $_POST['sWebsit'], FILTER_SANITIZE_NUMBER_INT );
$sText      =   filter_var( $_POST['sText'], FILTER_SANITIZE_STRING );
$copyright  =   filter_var( $_POST['copyright'], FILTER_SANITIZE_NUMBER_INT );
    
    $formErrors = array();

    if ( isset( $nWebsit ) ) {
        if ( strlen( $nWebsit ) == null ) {
            $formErrors[] =  Lang['site_name_empty'];
        }
    }

    if ( empty( $formErrors ) ) {
            $stmt = $con->prepare("UPDATE `sett` SET `nWebsit`= ?,`dWebsit`= ?,`kWebsit`= ?,`sWebsit`= ?,`sText`= ?,`ipWebsit`= ?,`urlWebsit`= ?,`copyright`= ? WHERE `id`= 1");
            $stmt->execute(array($nWebsit,$dWebsit,$kWebsit,$sWebsit,$sText,$_SERVER['REMOTE_ADDR'],$urlWebsit,$copyright));
            $msgsSuccess = Lang['data_success_updated'];
    }
    
}

$row = getAllTableFetch('*','sett','WHERE `id` = 1');

if ( !empty( $formErrors ) ) {
    echo '<div class="m-3"><div class="msg error">';
    foreach ( $formErrors as $error ) {
        echo '- '. $error.'<br>';
    }
    echo '</div></div>';
}

if (!empty($msgsSuccess)){
    echo '<div class="m-3"><div class="msg success m-0">'.$msgsSuccess .'</div></div>';
}
require_once $urlpagetemp.'setting'.$ft;