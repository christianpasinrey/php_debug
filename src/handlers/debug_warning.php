<?php

namespace App\Handlers;

function displayWarning($warningData)
{
    echo "<div class='dd-item'>";
    echo "<span class='dd-type dd-warning'>warning</span>";
    echo "<span class='dd-warning-message'>{$warningData['message']}</span>";

    echo "<br><span class='dd-warning-code'>File: {$warningData['file']}, Line: {$warningData['line']}</span>";
    echo "</div>";
}
