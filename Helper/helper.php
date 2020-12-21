<?php

/**
 * @param string|int|array $var
 */
function dd($var): void
{
    echo '<pre>';
    var_dump($var);
    die();
}

/**
 * @param $url
 */
function redirect(string $url): void
{
    ob_start();
    header('Location: '.App\Config::APP_URL.$url);
    ob_end_flush();
    die();
}

/**
 * @param string|int|array $var
 */
function dump($var): void
{
    echo '<pre>';
    var_dump($var);
}