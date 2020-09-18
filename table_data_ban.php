<?php require_once 'inc/SETTING.php';

try {

    $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    if(isset($_POST["search_ban"])) {
        $msgError=array();
        $Search_Ban=$_POST["search_ban"];
        $ShowNoAll->getNo($Search_Ban, Lang['No_Data_search_ban']);

        if(strlen($Search_Ban) > 20) {
            $msgError[]=Lang['Must_msg_search_ban'];
        }

        if( !empty($msgError)) {
            foreach ($msgError as $msgError): die('<div class="msg">'. $msgError.'!<br></div>');
            endforeach;
        }

        if(empty($msgError)) {
            $getAll=$con->prepare("SELECT * FROM ban WHERE name LIKE '%".$Search_Ban."%' Limit $limit_page_table_data_ban");
        }
    }

    else {
        $getAll=$con->prepare("SELECT * FROM ban Limit $limit_page_table_data_ban");
    }

    $getAll->execute();
    $get_table_ban=$getAll->fetchAll();
    $get_table_ban_count=$getAll->rowCount();

    if(empty($msgError)) {
        
        if($get_table_ban_count==0) {
            $get_search_ban='<div class="msg">'.Lang['Not_search_empity_ban'].'</div>';
            
        }
        
        else {
            $get_search_ban=' <div class="table-responsive"> <table class="table text-center"> <thead> <tr> <td>#</td> <td>'.Lang['Name_ban_index'].'</td> <td>'.Lang['Side'].'</td> <td>'.Lang['reason'].'</td> <td>'.Lang['The_guide'].'</td> <td>'.Lang['by'].'</td> <td>'.Lang['Date_ban'].'</td> </tr> </thead> <tbody> ';

            foreach($get_table_ban as $rows) {
                $get_search_ban .=' <tr> <td>'.$i++.'</td> <td>'.$rows['name'].'</td> <td>'.$rows['side'].'</td> <td>'.$rows['reason_ban'].'</td> <td><a target="_blank" href="'.$rows['evidence'].'"><i class="fa fa-eye"></i> '.Lang['Watch'].'</a></td> <td>'.$rows['by'].'</td> <td>'.$rows['data'].'</td> </tr> ';
            }

            $get_search_ban .='</tbody></table></div>';
        }

        echo $get_search_ban;
    }

} catch (PDOException $e) {

    echo '<div class="msg error">'.$e->getMessage().'<br></div>';

}