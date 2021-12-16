<?php

namespace ElsayedNofal\BackendUsers;

use Illuminate\Support\ServiceProvider;

class BackendUsersServiceProvider extends ServiceProvider{

    function boot(){
        
        $this->loadViewsFrom(__DIR__.'/views','BackendUsers');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->publishes([
            __DIR__.'/config'=>config_path()
        ]);
        include __DIR__.'/routes.php';

    }

    function register(){

    }


}