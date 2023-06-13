<?php


declare(strict_types=1);

use Entity\Image;
use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;

try {
    if (!isset($_GET['Id'])) {
        throw new ParameterException();
    }
    $image = Image::findById((int)$_GET['Id']);
    header('Content-Type: image/jpeg');
    echo $image->getJpeg();
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
}