<?php

namespace Chris\Src;

use function Chris\Src\Handlers\displayWarning;
use function Chris\Src\Handlers\varDump;

class Debug
{
    public function __construct()
    {
        set_error_handler('Chris\Src\Handlers\customErrorHandler');
    }

    public static function dd(...$vars)
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
}
