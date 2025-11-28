<?php
namespace Observers;

class Notifier
{
    private array $observers = [];

    public function registrar(Observer $observer): void
    {
        $this->observers[] = $observer;
    }

    public function notificar(string $tipo, $payload): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($tipo, $payload);
        }
    }
}
