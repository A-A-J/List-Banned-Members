<?php

class BAN {

    public $a = array(
        'COFING',
        'LANGUAGE'
    );

    public function run() {



        foreach($this->a as $rows){
            require_once dirname(__FILE__) . '/' .$rows.'.php';
        }


        if(phpversion()[0] > $GET_SETTING_SCRIPT['VERSION']['PHP'][0]) {
            $PRINT_MSG=die('<title>Connection Error | Versoin php </title> <div style="font-family: tahoma; margin: 0; border: 1px solid #D0D0D0; box-shadow: 0 0 8px #D0D0D0; "> <h3 style="margin: 0;padding: 0.5pc;border-bottom: 1px solid #0002;">The program is not compatible</h3> <p style=" padding: 0.5pc; ">Due to the incompatibility of the script developed by the Basho programmer, the program is not fully compatible with the PHP version installed in your hosting, so PHP should only be version 7.4.8.</p> </div>');
        }


        try {
            $PRINT_MSG=new PDO('mysql:host='.$GET_SETTING_SCRIPT['db']['localhost'].';dbname='.$GET_SETTING_SCRIPT['db']['dbname'].'', $GET_SETTING_SCRIPT['db']['username'], $GET_SETTING_SCRIPT['db']['password'], array(PDO:: MYSQL_ATTR_INIT_COMMAND=> $GET_SETTING_SCRIPT['db']['Undefined'], ));
            $PRINT_MSG->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die(' <title>Error Connection | '.Lang['Connection_error'].' </title> <div style=" margin: 0; border: 1px solid #D0D0D0; box-shadow: 0 0 8px #D0D0D0; "> <h3 style="margin: 0;padding: 0.5pc;border-bottom: 1px solid #0002;">'.Lang['Connection_error'].'</h3> <p style=" padding: 0.5pc; ">'.$e->getMessage().'</p> </div> ');
        }


        return $PRINT_MSG;
        
    }
}

$cont = new BAN();
$con = $cont->run();