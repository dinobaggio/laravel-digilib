<?php

if (! function_exists('human_filesize')) {
    function human_filesize($size, $precision = 2) {
        $units = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
        $step = 1024;
        $i = 0;
        while (($size / $step) > 0.9) {
            $size = $size / $step;
            $i++;
        }
        return round($size, $precision).$units[$i];
    }
}

if (! function_exists('trim_all')) {
    function trim_all($value) {
        $result = explode(" ",$value);
        $result = array_filter($result, function ($val) {
            return $val != null;
        });
        $result = implode(' ', $result);
        return $result;
    }
}


