<?php


function displayError($errorData, $fullData)
{
    echo "<span class='dd-type dd-error'>error</span>";
    echo "<span class='dd-error-message'>{$errorData['error']}</span>";
    if (isset($errorData['error_description'])) {
        echo "<br><span class='dd-meta'>{$errorData['error_description']}</span>";
    }

    $relevantCode = extractRelevantCode($fullData, $errorData['error']);
    if ($relevantCode) {
        echo "<div class='dd-error-code'>" . htmlspecialchars($relevantCode) . "</div>";
    }
}

function extractRelevantCode($fullData, $errorKey)
{
    $lines = explode(",", $fullData);
    foreach ($lines as $line) {
        if (strpos($line, $errorKey) !== false) {
            return trim($line);
        }
    }
    return false;
}
