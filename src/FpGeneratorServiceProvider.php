<?php

namespace Hexlay\FpGenerator;

use Illuminate\Support\ServiceProvider;

class FpGeneratorServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(FpGenerator::class);
    }

}
