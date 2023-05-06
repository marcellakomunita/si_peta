<?php

use App\Http\Controllers\ADashboardController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookRController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserPanel\UDashboardController;
use App\Http\Controllers\UserPanel\UReviewController;
use App\Http\Controllers\UserPanel\UserFavoritesController;
use App\Http\Controllers\UserPanel\UserPanelController;
use App\Http\Controllers\UserPanel\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// Route::middleware(['CheckIPAccess'])->group(function () {
    // Route::get('/', [HomeController::class, 'index']);

// Route::middleware(['TrackVisitor', 'CheckIPAccess'])->group(function () {    
    // Route::get('/content/cover', [FileController::class, 'cimageShow'])->middleware('CheckImageCAccess')->name('content.cover');
    Route::get('/content/cover', [FileController::class, 'cimageShow'])->name('content.cover');
    Route::get('/content/uprofile', [FileController::class, 'uimageShow'])->name('content.uprofile');
    Route::get('/content/file', [FileController::class, 'fileShow'])->name('content.file');
    Route::get('/content/files', [FileController::class, 'filesShow'])->name('content.files');
    Route::get('/not-found', [FileController::class, 'notfound']);

    Route::get('/', [UDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/about-us', [UDashboardController::class, 'aboutus'])->name('user.about-us');

    Route::get('/bookr', [BookRController::class, 'index'])->name('user.bookr');
    Route::post('/bookr/store', [BookRController::class, 'store'])->name('user.bookr.store');

    Route::prefix('/')->name('user.books.')->controller(UserPanelController::class)->group(function () {
        // Route::get('categories', 'categories')->name('categories');
        Route::get('book', 'show')->name('book');
        Route::get('search', 'search')->name('search');

        Route::prefix('/reviews')->name('reviews.')->controller(UReviewController::class)->group(function () {
            Route::get('/', 'index')->name('index');
        });

        Route::get('authors', 'authors')->name('authors');
        Route::get('author/{id}', 'author')->name('author');
        
        Route::get('publishers', 'publishers')->name('publishers');
        Route::get('publisher/{id}', 'publisher')->name('publisher');
        
    });
    
    Auth::routes();

    /*------------------------------------------
    --------------------------------------------
    All Normal Users Routes List
    --------------------------------------------
    --------------------------------------------*/
    Route::middleware(['auth', 'user-access:0'])->name('user.')->group(function () {
       

        Route::prefix('/profile')->name('profile.')->controller(UserProfileController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::put('/update', 'update')->name('update');

        });

        Route::prefix('/')->name('books.')->controller(UserPanelController::class)->group(function () {
            // Route::get('book', 'show')->name('book');
            // Route::get('search', 'search')->name('search');

            Route::prefix('/reviews')->name('reviews.')->controller(UReviewController::class)->group(function () {
                // Route::get('/', 'index')->name('index');
                Route::post('/store', 'store')->name('store');
            });

            // Route::get('authors', 'authors')->name('authors');
            // Route::get('author/{id}', 'author')->name('author');
            
            // Route::get('publishers', 'publishers')->name('publishers');
            // Route::get('publisher/{id}', 'publisher')->name('publisher');

            Route::prefix('/my-favorites')->name('favorites.')->controller(UserFavoritesController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/destroy', 'destroy')->name('destroy');
                Route::post('/store', 'store')->name('store');
                Route::post('/toggle', 'toggle')->name('toggle');
                Route::get('/is-favorite/{id}', 'isFavorite')->name('isFavorite');
            });
            
        });

    });
    
    /*------------------------------------------
    --------------------------------------------
    All Admin Routes List
    --------------------------------------------
    --------------------------------------------*/
    Route::middleware(['auth', 'user-access:1'])->prefix('/admin')->name('admin.')->group(function () {
    
        Route::get('/dashboard', [ADashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/visitor-data', [ADashboardController::class, 'visitorData']);
        Route::prefix('/profile')->name('profile.')->controller(ProfileController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::put('/update', 'update')->name('update');
        });
        Route::prefix('/users')->name('users.')->controller(UserController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update', 'update')->name('update');
            Route::get('/destroy', 'destroy')->name('destroy');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/print', 'printUser')->name('print');
        });
        Route::prefix('/administrators')->name('administrators.')->controller(UserController::class)->group(function () {
            Route::get('/', 'indexAdmin')->name('index');
            Route::get('/edit/{id}', 'editAdmin')->name('edit');
            Route::put('/update', 'updateAdmin')->name('update');
            Route::get('/destroy', 'destroyAdmin')->name('destroy');
            Route::get('/create', 'createAdmin')->name('create');
            Route::post('/store', 'storeAdmin')->name('store');
            Route::get('/print', 'printAdmin')->name('print');
        });
        Route::prefix('/books')->name('books.')->controller(BookController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            // Route::get('/show/{id}', 'show')->name('show');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update', 'update')->name('update');
            Route::get('/destroy', 'destroy')->name('destroy');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/print', 'print')->name('print');
        });
        Route::prefix('/categories')->name('categories.')->controller(CategoryController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update', 'update')->name('update');
            Route::get('/destroy', 'destroy')->name('destroy');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
        });
        Route::prefix('/reviews')->name('reviews.')->controller(ReviewController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('review', 'show')->name('show');
            Route::get('/destroy', 'destroy')->name('destroy');
        });
        Route::prefix('/sliders')->name('sliders.')->controller(SliderController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update', 'update')->name('update');
        });
        
    });
// });
