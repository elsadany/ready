<?php

namespace ElsayedNofal\Helpers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class HelpersServiceProvider extends ServiceProvider{

    function boot(){
        
        $this->loadViewsFrom(__DIR__.'/views','Helpers');
        // Blade::include('Helpers::components.success', 'success');
        // Blade::include('Helpers::components.errors', 'errors');
        // Blade::include('Helpers::components.deletejs', 'deletejs');

    }

    function register(){

    }


}