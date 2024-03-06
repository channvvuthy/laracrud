<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\front\HomeController;

// Authentication Routes
Route::group([
    'prefix' => '/auth',
], function () {
    Route::get('/', [LoginController::class, 'index'])->middleware('guest')->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');
});

// Auto-generate routes for controllers in the admin namespace
Route::group([
    'prefix' => '/admin',
    'as' => 'admin',
    'namespace' => 'App\Http\Controllers\admin',
], function () {

    Route::get('/clear-cache', [SettingController::class, 'clearCache']);

    $controllerDirectory = realpath(__DIR__ . '/../app/Http/Controllers/admin');

    // Get all PHP files in the directory
    $phpFiles = glob($controllerDirectory . '/*.php');

    foreach ($phpFiles as $file) {
        if (strpos(file_get_contents($file), 'Controller') !== false) {
            $fileName = pathinfo($file, PATHINFO_FILENAME);

            if (exceptController(basename($fileName))) {
                routeGenerator($fileName);
            }
        }
    }
});

/**
 * Check if a given controller is in the list of excepted controllers.
 *
 * @param string $controller The name of the controller to check.
 * @return bool Returns true if the controller is not in the list of excepted controllers, false otherwise.
 */
function exceptController($controller)
{
    $exceptedControllers = [
        'CRUDBaseController',
        'LaraCRUDController',
        'LoginController'
    ];

    return !in_array($controller, $exceptedControllers);
}

/**
 * Generates routes for a controller.
 *
 * @param string $controller The name of the controller class.
 * @param array $getUrls An optional array of custom GET URLs.
 * @param array $postUrls An optional array of custom POST URLs.
 */
function routeGenerator($controller, $getUrls = [], $postUrls = [])
{
    $controllerPrefix = strtolower(str_replace('Controller', '', $controller));

    $defaultGetUrls = [
        '/' => 'getIndex',
        '/add' => 'getAdd',
        '/edit/{id}' => 'getEdit',
        '/detail/{id}' => 'detail',
        '/delete/{id}' => 'delete',
    ];
    $defaultPostUrls = [
        '/post' => 'postAdd',
        '/update' => 'update'
    ];

    foreach (array_merge($getUrls, $defaultGetUrls) as $url => $method) {
        Route::get($controllerPrefix . $url, "$controller@$method")
            ->name($controllerPrefix . '.' . $method);
    }

    foreach (array_merge($postUrls, $defaultPostUrls) as $url => $method) {
        Route::post($controllerPrefix . $url, "$controller@$method")
            ->name($controllerPrefix . '.' . $method);
    }
}

Route::group([
    'prefix' => '/',
    'middleware' => 'pages',
], function () {
    Route::get('/', [HomeController::class, 'index']);
});

