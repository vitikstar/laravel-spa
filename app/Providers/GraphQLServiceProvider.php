<?php
// app/Providers/GraphQLServiceProvider.php

namespace App\Providers;

use App\GraphQL\Mutations\RegisterUser;
use Illuminate\Support\ServiceProvider;
use Nuwave\Lighthouse\Schema\Source\SchemaSourceProvider;

class GraphQLServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Реєстрація сервісу Lighthouse
        $this->app->singleton(SchemaSourceProvider::class, function ($app) {
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Додавання вашої мутації
        $this->app->bind('registerUser', RegisterUser::class);
    }
}

?>
