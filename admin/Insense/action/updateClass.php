<?php
require_once('./checkAdmin.php'); //引入登入判斷
require_once('./db.inc.php'); //引用資料庫連線

$sql = "UPDATE `class` SET 
        `className`,`classPeopleLimit`,`classPrice`,`classCategoryId`,`classDate`,
        `classTime`
        WHERE `classId` = ? ";
