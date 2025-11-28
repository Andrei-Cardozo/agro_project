<?php

spl_autoload_register(function ($class) {
    $parts = explode("\\", $class);

    $dir = strtolower(array_shift($parts));
    $className = array_pop($parts);

    // converte CamelCase → snake_case
    $snake = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $className));

    $root = dirname(__FILE__);
    $file = $root . "/" . $dir . "/" . $snake . ".php";

    if (file_exists($file)) {
        require_once $file;
    } else {
        echo "⚠️ Autoload não encontrou: $file<br>";
    }
});
