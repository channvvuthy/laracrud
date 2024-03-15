<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\front\TestimonyController;
use App\Http\Controllers\front\BibleStudyController;
use App\Http\Controllers\admin\BibleStudyController as AdminBibleStudyController;
use App\Http\Controllers\admin\ChurchServiceController as AdminChurchServiceController;
use App\Http\Controllers\front\ChurchServiceController;
use App\Http\Controllers\front\ContactUsController;
use App\Http\Controllers\front\WhoWeAreController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\front\OfferingController;
use App\Http\Controllers\front\PayPalController;
use App\Http\Controllers\front\VisionAndMissionController;

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
    Route::get('/biblestudy/add-doc/{id}', [AdminBibleStudyController::class, 'addDoc']);
    Route::get('/biblestudy/view-doc/{id}', [AdminBibleStudyController::class, 'viewDoc']);
    Route::get('/biblestudy/view-doc/{bibleId}/detail/{id}', [AdminBibleStudyController::class, 'viewDocDetail']);
    Route::get('/biblestudy/view-doc/{bibleId}/edit/{id}', [AdminBibleStudyController::class, 'editDoc']);
    Route::post('/biblestudy/add-doc', [AdminBibleStudyController::class, 'postDoc'])->name('add-doc');
    Route::post('/biblestudy/doc/update', [AdminBibleStudyController::class, 'updateDoc'])->name('update-doc');
    Route::get('/biblestudy/view-doc/{bibleId}/delete/{id}', [AdminBibleStudyController::class, 'deleteDoc'])->name('delete-doc');
    Route::get('/churchservice/{id}/delete/{index}', [AdminChurchServiceController::class, 'deleteSession'])->name('delete-session');
    



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
    'prefix' => '/paypal',
], function () {
    Route::post('/payment', [PayPalController::class, 'payment'])->name('paypal_payment');
    Route::get('/success', [PayPalController::class, 'success'])->name('paypal_success');
    Route::get('/cancel', [PayPalController::class, 'cancel'])->name('paypal_cancel');
});

Route::group([
    'prefix' => '/',
    'middleware' => 'pages',
], function () {
    Route::get('/', [HomeController::class, 'index']);

    Route::get('/who-we-are', [WhoWeAreController::class, 'index'])->name('who-we-are');

    Route::get('/vision-and-mission', [VisionAndMissionController::class, 'index'])->name('vision-and-mission');

    Route::get('/church-services', [ChurchServiceController::class, 'index'])->name('church-services');

    Route::get('/bible-studies', [BibleStudyController::class, 'index'])->name('bible-studies');

    Route::get('/testimonies', [TestimonyController::class, 'index'])->name('testimonies');

    Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact-us');

    Route::get('/offerings', [OfferingController::class, 'index'])->name('offerings');

    Route::get('/home', function () {
        return view('home');
    });
});
