<?php
function customErrorHandler($errno, $errstr, $errfile, $errline)
{
    $GLOBALS['warnings'][] = [
        'type' => $errno,
        'message' => $errstr,
        'file' => $errfile,
        'line' => $errline,
    ];
    return true;
}
