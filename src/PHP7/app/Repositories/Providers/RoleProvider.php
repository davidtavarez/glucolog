<?php

namespace App\Repositories\Providers;
use Illuminate\Support\ServiceProvider;

class RoleProvider extends ServiceProvider
{
   public function register()
   {
      $this->app->bind(
         'App\Repositories\Contracts\RoleInterface',
         // To change the data source, replace this class name
         // with another implementation
         'App\Repositories\Eloquent\RoleRepository'
      );
   }
}