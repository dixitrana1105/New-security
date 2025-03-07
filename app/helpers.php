<?php

if (! function_exists('pr')) {
    function pr($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        exit;
    }
}

if (! function_exists('fileToBytes')) {
    function fileToBytes($file)
    {
        $image = fopen($file->getPathName(), 'r');

        return fread($image, $file->getSize());
    }
}
