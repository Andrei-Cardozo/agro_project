<?php
namespace Observers;

interface Observer {
    public function update(string $tipo, $payload): void;
}
