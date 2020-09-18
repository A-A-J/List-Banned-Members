<?php

class phpinfo
{
    public function get_phpinfo(){

        ob_start();

        phpinfo();

        $phpinfo = ob_get_contents();

        ob_end_clean();

        $phpinfo = preg_replace('%^.*<body>(.*)</body>.*$%ms', '$1', $phpinfo);

        echo "
            <style type='text/css'>
                div>#phpinfo {}
                div>#phpinfo pre {margin: 0; font-family: monospace;}
                div>#phpinfo a:link {color: #009; text-decoration: none; background-color: #fff;}
                div>#phpinfo a:hover {text-decoration: underline;}
                div>#phpinfo table {border-collapse: collapse; border: 0; width: 934px; box-shadow: 1px 2px 3px #ccc;}
                div>#phpinfo .center {text-align: center;}
                div>#phpinfo .center table {margin: 1em auto; text-align: left;}
                div>#phpinfo .center th {text-align: center !important;}
                div>#phpinfo td, div>#phpinfo th {border: 1px solid #666; font-size: 75%; vertical-align: baseline; padding: 4px 5px;}
                div>#phpinfo h1 {font-size: 150%;}
                div>#phpinfo h2 {font-size: 125%;}
                div>#phpinfo .p {text-align: left;}
                div>#phpinfo .e {background-color: #ccf; width: 300px; font-weight: bold;}
                div>#phpinfo .h {background-color: #99c; font-weight: bold;}
                div>#phpinfo .v {background-color: #ddd; max-width: 300px; overflow-x: auto; word-wrap: break-word;}
                div>#phpinfo .v i {color: #999;}
                div>#phpinfo img {float: right; border: 0;}
                div>#phpinfo hr {width: 934px; background-color: #ccc; border: 0; height: 1px;}
            </style>
            <div id='phpinfo'>
                $phpinfo
            </div>
        ";

        return;

    }
    
}

