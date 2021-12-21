<?php

namespace Hexlay\FpGenerator\Facades;

use Illuminate\Support\Facades\Facade;

class FpGenerator extends Facade
{

    protected static function getFacadeAccessor(): string
    {
        return \Hexlay\FpGenerator\FpGenerator::class;
    }

}
