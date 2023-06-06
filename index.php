<?php

require_once 'iterator.php';

// задаем пути
$file = 'lib\file.txt';
$newFile = 'lib\newfile.txt';

// очищаем содержимое файла для перезаписи
file_put_contents($newFile, '');

// вызываем итератор для прогона и записываем результат из условий

$file_iterator = new FileIterator($file);
foreach ($file_iterator as $line) {
    // str_contains() для PHP 8.0, но у меня 7.2
    if (strpos($line, 'title') ||
        strpos($line, 'description') ||
        strpos($line, 'keywords')) {
        $line = '';
    }
    echo $line;

    file_put_contents($newFile, $line, FILE_APPEND);
}