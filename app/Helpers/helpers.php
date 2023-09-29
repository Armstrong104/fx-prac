<?php

function imageUpload($image, $path)
{
    $imgName = $path . time() . rand() . '.' . $image->extension();
    $directory = $path . '/';
    $image->move($directory, $imgName);
    return $directory . $imgName;
}
