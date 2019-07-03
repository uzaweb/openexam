<?php

namespace Uzaweb\Openexam;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class OpenexamServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Class event subscribers.
     *
     * @var array
     */
    protected $subscribe = [
    		// \Uzaweb\Openexam\Listeners\OpenexamListener::class,
    ];
    
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerConfig();
    }
    
    /**
     * Boot the application events.
     */
    public function boot()
    {        
        $this->bootRoute();
        $this->bootViews();
        $this->bootViewComposer();        
        $this->bootTranslations();
        
        $this->defineVendorPublish();
        $this->defineMigrate();
    }    
    
    public function defineMigrate()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }
    
    /**
     * Boot Route.
     */
    public function bootRoute()
    {
        include_route_files(__DIR__.'/../routes');
    }
        
    public function defineVendorPublish()
    {
        $this->publishes([__DIR__.'/../public' => public_path('vendor/uzaweb/openexam')], 'public');
    }
    
    /**
     * boot views.
     */
    public function bootViews()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'openexam');
    }

    public function bootViewComposer()
    {
        /*
        View::composer(
            ['openexam::user.index'], 'Uzaweb\Openexam\Http\Composers\ViewComposer'
        );
        */             
    }
    
    /**
     * boot translations.
     */
    public function bootTranslations()
    { 
       $this->loadTranslationsFrom(__DIR__ .'/../resources/lang', 'openexam');
    }
        
    /**
     * Register config.
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'openexam');
    } 
}
