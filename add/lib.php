<?php
error_reporting(E_ALL);
ini_set('display_startup_errors', 1);
ini_set('display_errors', '1');

// function for validation
function formValidator($validate = "") {
    $validate = trim($validate);
        $validate = stripslashes($validate);
            $validate = strip_tags($validate);
                $validate = htmlspecialchars($validate);
    return $validate;
}