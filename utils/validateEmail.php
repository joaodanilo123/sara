<?php 

function validateEmail($email){
    if (empty($email)) return false;
    if (!isset($email)) return false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;

    return true;
}
