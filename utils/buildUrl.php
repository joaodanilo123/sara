<?php

function buildUrl(array $messages = [])
{
    $messagesUrl = http_build_query(array('messages' => $messages));
    $url = "location: ../painel/admin.php?$messagesUrl";
    return $url;
}
