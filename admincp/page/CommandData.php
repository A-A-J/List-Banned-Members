<?php
get_headerMenu();
require '../inc/COFING.php';
    try{
        if ( !empty( $_POST['CommandDataa'] ) ) {
            $commanddata =   $_POST['CommandData'];
                $con->exec($commanddata);
                $msg_dump_sql = true;
        }elseif ( !empty( $_POST['dump'] ) ) {
            require '../inc/libs/dumper.php';
            $world_dumper = Shuttle_Dumper::create(array(
                'host' => $GET_SETTING_SCRIPT['db']['localhost'],
                'username' => $GET_SETTING_SCRIPT['db']['username'],
                'password' => $GET_SETTING_SCRIPT['db']['password'],
                'db_name' => $GET_SETTING_SCRIPT['db']['dbname'],
            ));
                $name_dump = 'Backup_data'.date("[d-m-Y]");
                $world_dumper->dump('../inc/Backup/'.$name_dump.'.sql.gz');
                $msg_Backup = '<div class="msg success mb-3 p-2">تم أخذ نسخة إحتياطية في مجلد inc/backup بأسم: '.$name_dump.' لتحميل النسخة أنقر  <a href="../inc/Backup/'.$name_dump.'.sql.gz" style="color: #fff;background: #0000005e;padding: 1px 9px;border-radius: 10px;">هنا</a></div>';
        }
    }catch(PDOException $e) {
        getMsg( 'error', $e->getMessage() );
    }
require_once $urlpagetemp.'CommandData'.$ft;