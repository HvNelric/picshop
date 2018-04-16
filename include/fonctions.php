<?php
function setFlashMessage($message, $type = 'success'){
    $_SESSION['flashMessage'] = [
        'message' => $message,
        'type' => $type
    ];
}

function displayFlashMessage(){
    if(isset($_SESSION['flashMessage'])){
        $message = $_SESSION['flashMessage']['message'];
        $type = ($_SESSION['flashMessage']['type'] == 'error')
        ? 'danger' // Pour la classe alert-danger de bootstrap
        : $_SESSION['flashMessage']['type']
        ;

        echo '<div class="alert alert-' . $type . '">' . '<h5 class="alert-heading">' . $message . '</h5>' . '</div>';

        unset($_SESSION['flashMessage']); // Supression du message de la session pour affichage "one shot"
    }
}

function sanitizeValue(&$value){
    $value = trim(strip_tags($value)); // trim() supprime les espaces en début et fin de chaîne, strip_tags() supprime les balises HTML
}

function sanitizeArray(array &$array){
    array_walk($array, 'sanitizeValue');  // Applique la fonction sanitizeValue() sur tous les éléments du tableau
}

function sanitizePost(){
    sanitizeArray($_POST);
}

function goAdminPage() {
    if(isUserAdmin()) {
        return 'page-admin.php';
    }
}

function isUserConnected(){
    return isset($_SESSION['user']);
}

function getUserFullName(){
    if(isUserConnected()){
        return $_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom'];
    }
}

function isUserAdmin(){
    return isUserConnected() && $_SESSION['user']['role'] == 'admin';
}

function isUserVip(){
    return isUserConnected() && $_SESSION['user']['role'] == 'vip';
}

function adminSecurity(){
    if (!isUserAdmin()){
        if (!isUserConnected()) {
            header('Location: ' . RACINE_WEB . 'connexion.php');
        } else {
            header('HTTP/1.1 403 Forbidden');
            echo '<div class="alert alert-danger text-center"><h2>Vous n\'avez pas le droit d\'accéder à cette page</h2></div>';
        }

        die;
    }
}

function prixFr($prix) {
    return number_format($prix, 2, ',', ' ') . ' €';
}