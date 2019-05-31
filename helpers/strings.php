<?php

if (!function_exists('camelize')) {
    function camelize(string $string)
    {
        return str_replace(' ', '', ucwords(str_replace(['_','-'], ' ', $string)));
    }
}

if (!function_exists('to_pdo_bindings')) {
    function to_pdo_bindings(array $keys)
    {
        return implode(',', preg_filter('/^/', ':', $keys));
    }
}

if (!function_exists('to_pdo_columns')) {
    function to_pdo_columns(array $keys)
    {
        return implode(',', $keys);
    }
}