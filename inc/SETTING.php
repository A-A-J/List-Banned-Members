<?php

require 'connection.php';

require 'functions.php';

$getDataInfoScript = getAllTableFetch('*','sett');

$i = 1;

$limit_page_table_data_ban = 8;

$coding = new coding; define('Get__', $coding->run()); 