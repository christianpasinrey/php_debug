<?php

function varDump($var, $depth = 0, $key = null)
{
    $indent = str_repeat('    ', $depth);
    $type = gettype($var);

    echo "<div class='dd-item' style='margin-left: " . ($depth * 20) . "px;'>";
    if ($key !== null) {
        echo "<span class='dd-key'>$key:</span>";
    }

    switch ($type) {
        case 'NULL':
            echo "<span class='dd-type dd-null'>null</span><span class='dd-value'>null</span>";
            break;
        case 'boolean':
            echo "<span class='dd-type dd-boolean'>boolean</span><span class='dd-value'>" . ($var ? 'true' : 'false') . "</span>";
            break;
        case 'integer':
        case 'double':
            echo "<span class='dd-type dd-number'>number</span><span class='dd-value'>$var</span>";
            break;
        case 'string':
            $json = json_decode($var, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                if (isset($json['error'])) {
                    displayError($json, $var);
                } else {
                    echo "<span class='dd-type dd-string'>json</span>";
                    echo "<span class='dd-meta'>(length=" . strlen($var) . ")</span>";
                    echo "<div class='dd-value'>";
                    varDump($json, $depth + 1);
                    echo "</div>";
                }
            } else {
                $escapedVar = htmlspecialchars($var);
                echo "<span class='dd-type dd-string'>string</span>";
                echo "<span class='dd-value'>\"$escapedVar\"</span>";
                echo "<span class='dd-meta'>(length=" . strlen($var) . ")</span>";
            }
            break;
        case 'array':
            if (isset($var['error'])) {
                displayError($var, json_encode($var));
            } else {
                echo "<span class='dd-type dd-array'>array</span>";
                echo "<span class='dd-meta'>(size=" . count($var) . ")</span>";
                echo "<div class='dd-value'>";
                foreach ($var as $k => $v) {
                    varDump($v, $depth + 1, $k);
                }
                echo "</div>";
            }
            break;
        case 'object':
            $className = get_class($var);
            echo "<span class='dd-type dd-object'>object</span>";
            echo "<span class='dd-meta'>($className #" . spl_object_id($var) . ")</span>";
            echo "<div class='dd-value'>";
            $reflector = new ReflectionObject($var);
            $properties = $reflector->getProperties();
            foreach ($properties as $property) {
                $property->setAccessible(true);
                $propName = $property->getName();
                $propValue = $property->getValue($var);
                varDump($propValue, $depth + 1, $propName);
            }
            echo "</div>";
            break;
        default:
            echo "<span class='dd-type'>" . ucfirst($type) . "</span>";
            echo "<span class='dd-value'>" . var_export($var, true) . "</span>";
    }
    echo "</div>";
}
