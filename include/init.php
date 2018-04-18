<?php
session_start(); // Initialise la session

define('RACINE_WEB', '/picshop/');
define('IMG_IMG', '/img');
define('PHOTO_WEB', RACINE_WEB . 'photo/');
// Sous XAMPP, $_SERVER['DOCUMENT_ROOT'] vaut C:\xampp\htdocs
define('PHOTO_DIR', $_SERVER['DOCUMENT_ROOT'] . 'imgup/');
define('PHOTO_DEFAULT', 'https://dummyimage.com/600x400/ccc/ffffff&text=Pas+d\'image');

require_once __DIR__ . '/cnx.php';
require_once __DIR__ . '/fonctions.php';
?>