<?php

class getNoAll{

    public function getNo($var,$op){

        global $con;

        global $msgError;

        $vlink = trim($var);  

        $vlink = stripslashes($vlink); 

        $vlink = nl2br($vlink);

        $xarray = array ( "\.", "\..", "\...", "\/", "\"", "\'", "<", ">", "%", "\*", "\#", "\;", "\\", "\~", "\&", "@", "\!", ":", "+", "-", "_", "(", ") ", );

        foreach ($xarray as $danger) { 

            if(@preg_match("/$danger/",$vlink)){
                $msgError[] = $op;
            } 

        }

        return $var;

    }
}
