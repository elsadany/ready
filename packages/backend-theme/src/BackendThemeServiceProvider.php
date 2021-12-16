<?php

namespace ElsayedNofal\BackendTheme;

use Illuminate\Support\ServiceProvider;

class BackendThemeServiceProvider extends ServiceProvider{

    function boot(){
        $this->publishes([
            __DIR__.'/views'=>resource_path('views/backend'),
            __DIR__.'/assets'=>public_path('assets/backend')
        ]);
    }

    function register(){

    }


}