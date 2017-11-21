<?php
$url = $_SERVER['REQUEST_URI'];
$urlParts = explode('/', $url);
$controller = empty($urlParts[1]) ? 'Index' : $urlParts[1];
$actionType = empty($urlParts[2]) ? 'Default': $urlParts[2];
$adminAccess = !empty($urlParts[3]) ? $urlParts[3] : null;
