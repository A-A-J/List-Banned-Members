<?php

function getAllTableFetch($field, $table, $condition=null) {
	global $con;
	$getAll=$con->prepare("SELECT $field FROM $table $condition");
	$getAll->execute();

	return $getAll->fetch();
}

function getAllTable($field, $table, $condition=null) {
	global $con;
	$getAll=$con->prepare("SELECT $field FROM $table $condition");
	$getAll->execute();
	return $getAll->fetchAll();
}

function getAllTableLimit($field, $table, $fn, $limit) {
	global $con;
	$getAll=$con->prepare("SELECT $field FROM $table LIMIT $fn, $limit");
	$getAll->execute();

	return $getAll->fetchAll();
}

function getAllTableCount($field, $table, $condition=null) {
	global $con;
	$getAll=$con->prepare("SELECT count($field) AS $field FROM $table $condition");
	$getAll->execute();

	return $getAll->fetch();
}


function getIfVa($va, $echo_va, $echo_va_else) {
	global $con;

	if($va) {
		echo $echo_va;
	}

	else {
		echo $echo_va_else;
	}

	return $va;
}


function getMsg($status, $msg) {
	global $con;
	echo '<p class="msg p-2 m-2 '.$status.' " style="width:auto">'.$msg.'</p>';

	return $msg;
}


function getMsgButton($link, $text) {
	global $con;
	echo '<div class = "btnget"><a href = "'.$link.'" class = "btn B-wave">'.$text.'</a></div>';

	return $text;
}


function checkTable($select, $from, $value) {
	global $con;
	$statement=$con->prepare("SELECT $select FROM $from WHERE $select = ?");
	$statement->execute(array($value));
	$count=$statement->rowCount();

	return $count;
}

function getInject($var) {
	global $con;
	$vlink=trim($var);
	$vlink=stripslashes($vlink);
	$vlink=nl2br($vlink);
	$xarray=array ("select", "insert", "update", "delet", "great", "drop", "grant", "union", "group", "FROM", "where", "limit", "order", "by", "\.", "\..", "\...", "\/", "\"", "\'", "<", ">", "%", "\*", "\#", "\;", "\\", "\~", "\&", "@", "\!", ":", "+", "-", "_", "(", ") ", );

	foreach ($xarray as $danger) {
		if(@preg_match("/$danger/", $vlink)) {
			die(Lang['Input_da']);
		}
	}

	return $var;
}

function Clean($code,$type){
	if (filter_var($code, $type ) !=true){
		die(Lang['Input_da']);
	}
}

function get_header() {
	return include_once('page/tmp/header.html');
}

function get_headerMenu() {
	global $getUserNameAdmin;
	global $hideMenu;
	return include('page/tmp/headerMenu.html');
}

function get_home() {
	global $con;
	global $urlpagetemp;
	return include('page/home.php');
}

function get_footer() {
	return include('page/tmp/footer.html');
}

require 'classes/function-date.php';

require 'classes/function_block.php';

spl_autoload_register(function($class) {
	require 'classes/'.$class.'.php';
});

$ChekIPLoginPage=new ChekIPLoginPage();
$ChekIPLoginPage->chekIp();

$get_php_class=new phpinfo();

$ShowNoAll=new getNoAll();