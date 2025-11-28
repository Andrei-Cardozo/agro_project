<?php
namespace Decorators;

abstract class CustoDecorator implements CustoCalculavel {
    protected CustoCalculavel $base;

    public function __construct(CustoCalculavel $base) {
        $this->base = $base;
    }

    abstract public function calculate(): float;
}
