<?php
namespace Infra;

class Config {
    private static ?Config $instance = null;
    public array $settings = [];

    private function __construct() {}

    public static function getInstance(): Config {
        if (self::$instance === null) {
            self::$instance = new Config();
        }
        return self::$instance;
    }
}
