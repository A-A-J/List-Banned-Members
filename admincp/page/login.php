<?php

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    $username	 = filter_var( $_POST['username'], FILTER_SANITIZE_STRING );
    $password	 = filter_var( $_POST['password'], FILTER_SANITIZE_STRING );

    $formErrors = array();

    if ( isset( $username ) ) {
        if ( strlen( $username ) == '' ) {
            $formErrors[] =  Lang['Error_username'];
        }
    }

    if ( isset( $password ) ) {
        if ( strlen( $password ) == '' ) {
            $formErrors[] =  Lang['Error_password'];
        }
    }

    $hashedPass = sha1( $password );
    if ( empty( $formErrors ) ) {
        $serch_account = $con->prepare( 'SELECT * FROM members WHERE username = ? AND password = ?  LIMIT 1' );
        $serch_account->execute( array( $username, $hashedPass ) );
        $row = $serch_account->fetch();
        $count = $serch_account->rowCount();
        
            if ( $count == 0 ) {
                $ChekUsers = Lang['Null_account'];
                $ip = $_SERVER['REMOTE_ADDR'];
                $updataloginerror = $con->prepare( "INSERT INTO `datalogin`(`username`, `countError`, `dateLogin`, `country`, `ip`) VALUES (?,?,?,?,?)" );
                $updataloginerror->execute(array($username,1,date("d-m-Y h:i:s"),'ksa',$_SERVER['REMOTE_ADDR']));
            } else {
                if ($row['group'] >= 1){
                    $stmt = $con->prepare( "UPDATE members SET ip = '".$_SERVER['REMOTE_ADDR']."' WHERE id = '".$row['id']."' " );
                    $stmt->execute();
                    $stmt->rowCount();
                    $_SESSION['ID'] = $row['id'];
                    setcookie("login" , $_SESSION['ID'] , time() + 60*60*24*7);
                    header('Location: index.php?page=home'); 
                }else{
                    $ChekUsers = Lang['No_show_pages_admin'];
                }
            }
    }
    
}

require_once $urlpagetemp.'login'.$ft;