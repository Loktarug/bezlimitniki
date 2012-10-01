<?php
session_start();

//session_destroy();

if (!isset($_SESSION['cart']['packes']))
    $_SESSION['cart']['packes'] = array();

if (!isset($_SESSION['cart']['phoneNumbers']))
    $_SESSION['cart']['phoneNumbers'] = array();

if (!$_SESSION['cart']['quantity'])
    $_SESSION['cart']['quantity'] = 0;