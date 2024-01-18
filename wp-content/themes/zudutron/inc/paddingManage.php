<?php

function disablePadding($paddingArr = []) {
    $disabled = '';
    if (isset($paddingArr)) {
        if (!in_array("top", $paddingArr)) {$disabled = $disabled.' pt0';};
        if (!in_array("bottom", $paddingArr)) {$disabled = $disabled.' pb0';};
    }
 
    return $disabled;
}