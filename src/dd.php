<?php

include('handlers/debug_error.php');
include('handlers/debug_warning.php');
include('handlers/debug_error_handler.php');
include('handlers/debug_deep.php');
include('assets/index.php');

set_error_handler('customErrorHandler');

function dd(...$vars)
{
    ob_start();
    echo file_get_contents("./assets/partials/head.html");
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

    echo file_get_contents("./assets/partials/foot.html");
    $output = ob_get_clean();
    while (ob_get_level()) {
        ob_end_clean();
    }
    echo $output;
    exit;
}
