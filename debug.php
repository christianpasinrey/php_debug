<?php

include('debug_error.php');
include('debug_warning.php');
include('debug_error_handler.php');
include('debug_deep.php');

set_error_handler('customErrorHandler');

function dd(...$vars)
{
    ob_start();

    echo '<style>';
    echo file_get_contents("debug.css");
    echo '</style>';
    echo '<div class="dd-container">';

    if (!empty($GLOBALS['warnings'])) {
        foreach ($GLOBALS['warnings'] as $warning) {
            displayWarning($warning);
        }
    }

    foreach ($vars as $var) {
        varDump($var);
    }

    echo '</div>';

    $output = ob_get_clean();
    while (ob_get_level()) {
        ob_end_clean();
    }
    echo $output;
    exit;
}
