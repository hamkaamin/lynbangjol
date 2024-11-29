<?php
function json_message($data = [])
{
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
}

/**
 * menampilkan error format JSON
 *
 * boolean error
 * string  message
 */

function j2e($error, $message)
{
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(["ERROR" => $error, "MSG" => $message]);
}

function striper($string)
{
    return strtoupper($string);
}
?>
