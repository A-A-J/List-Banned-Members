<?php

class ChekIPLoginPage{
    
    public function chekIp(){

        if($_SERVER['REMOTE_ADDR'] == null){

            die(Lang['Error_page_ip']);

        }

        return;

    }
    
}