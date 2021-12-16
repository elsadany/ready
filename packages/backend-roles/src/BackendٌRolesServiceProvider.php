<?php
namespace Elsayednofal\BackendRoles;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
class BackendRolesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config' => config_path(''),
                ]);
				
		 $this->publishes([
            __DIR__ . '/assets' => public_path('vendor\elsayed_nofal\backend-roles'),
                ], 'public');
				
        $this->publishes([
        __DIR__.'/resources/views/backend' => resource_path('Views/backend'),
        ]);
        
        $this->loadTranslationsFrom(__DIR__.'lang/vendor/backend-roles', 'backend-roles');

        $this->publishes([
        __DIR__.'/resources/langs' => resource_path('lang/vendor/backend-roles'),
        ]);
        
        //load migrations
        if(floatval(Application::VERSION) >= 5.3){
            $this->loadMigrationsFrom(__DIR__.'/migrations');
        }else{
            $this->publishes([
            __DIR__ . '/migrations' => database_path('migrations'),
                ]);
        }
        
        // load view
        $this->loadViewsFrom(realpath(__DIR__ . '/resources/views'), 'BackendRoles');
        
        
        
        
        
        /*
         * loading routes and sometimes add middelware group
         */
        include __DIR__.'/Http/routes.php';
        
        //include __DIR__.'/helpers/functions.php';
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}