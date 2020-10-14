<?php

function validateParams($params, $values, $hasMessagesArray = false)
{
    $valid = true;

    $messages = [];

    if ($hasMessagesArray) {
        global $messages;
    }

    foreach($params as $param){
        $actualParam = $values[$param];

        if (!isset($actualParam) or empty($actualParam)) {
            $param = ucfirst($param);
            array_push($messages, "{$param} inválido");
            $valid = false;
        }
    }
    
    return $valid;
}
