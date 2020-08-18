<?php

namespace S1K3\Bangla\Number\To\Word;

use Illuminate\Support\ServiceProvider;

class NumberToWordServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/number_to_word.php' => config_path('number_to_word.php'),
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/number_to_word.php',"number_to_word");
    }

}