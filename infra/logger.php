<?php
namespace Infra;

class Logger {
    private static ?Logger $instance = null;

    private function __construct() {}

    public static function getInstance(): Logger {
        if (self::$instance === null) {
            self::$instance = new Logger();
        }
        return self::$instance;
    }

    public function log(string $msg) {
        echo "[LOG]: $msg\n";
    }
}
