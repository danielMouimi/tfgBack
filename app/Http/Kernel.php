<?php
namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     */
    protected $middleware = [
        // middleware globales
    ];

    /**
     * The application's route middleware groups.
     */
    protected $middlewareGroups = [
        'web' => [

        ],

        'api' => [
        ],
    ];

    /**
     * Route middleware individuales (para usar con Route::middleware()).
     */
    protected $routeMiddleware = [

        'firebase.auth' => \App\Http\Middleware\FirebaseAuth::class,
    ];
}
