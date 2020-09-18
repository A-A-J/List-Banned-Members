<?php
ob_start();
session_start();

require '../inc/connection.php';

require '../inc/functions.php';

$identif = 'page';

$init_default_pages = 'page/';

$getPage = isset( $_GET['getpage'] ) ? getInject( $_GET['getpage'] ) : '';

$id_Chek = isset( $_GET['id'] ) && is_numeric( getInject( $_GET['id'] ) ) ? intval( getInject( $_GET['id'] ) ) : 0;

$i = '0' ;

$i_page = 1;

$urlpagetemp = 'tmp/';

$ft = '.html';

get_header();

if ( isset( $_COOKIE['login'] ) && isset( $_SESSION['ID'] ) ) {

    if ( !empty( $_GET[$identif] ) ) {

        $menupageurl = $_GET[$identif];

        echo '<style>.A-Menu-active-'.$_GET[$identif].'{background: #2e89e6 !important; color: #fff !important;}</style>';

    } elseif ( $_SERVER['PHP_SELF'] ) {

        echo ' <style>.A-Menu-active-home{background: #2e89e6 !important; color: #fff !important;}</style> ';

    }
    
    $getUserNameAdmin = getAllTableFetch( '*', 'members', 'WHERE id= "'.$_SESSION['ID'].'" ' );

    if ( isset( $_GET[$identif] ) AND !empty(in_array(getInject($_GET[$identif]), page_block_groub() )) AND !empty( $getUserNameAdmin['group'] == 2 ) ) {

        header( 'Location: index.php' );

    }

    if ( !empty( $getUserNameAdmin['group'] == 2 ) ) {

        $hideMenu = false;

    } else {

        $hideMenu = true;

    }
    

    if ( isset( $_GET[$identif] ) && !empty( getInject( $_GET[$identif] ) ) ) {

        if ( file_exists( $init_default_pages . getInject( $_GET['page'] ).'.php' ) ) {

            include( $init_default_pages . getInject( $_GET[$identif] ).'.php' );

        } else {

            header( 'Location: index.php' );

        }

    } else {

        get_home();

    }

} else {

    include( $init_default_pages . 'login.php' );

}

get_footer();

ob_end_flush();