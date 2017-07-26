<?php

error_reporting(~E_NOTICE);
session_start();


require_once 'init.php';

// 入口文件

$baseControl = new BaseControl();


$baseControl->run();
?>