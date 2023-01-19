<?php

use App\Http\Controllers\ADashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPanel\UDashboardController;
use App\Http\Controllers\UserPanel\UserPanelController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/content/cover/{id}', [FileController::class, 'cimageShow'])->middleware('CheckImageCAccess');
Route::get('/not-found', [FileController::class, 'notfound']);

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:0'])->name('user.')->group(function () {
    Route::get('/home', [UDashboardController::class, 'index'])->name('home');

    Route::prefix('/')->name('books.')->controller(UserPanelController::class)->group(function () {
        Route::get('categories', 'categories')->name('categories');
        Route::get('book', 'book')->name('book');
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
    Route::prefix('/users')->name('users.')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update', 'update')->name('update');
        Route::get('/destroy', 'destroy')->name('destroy');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
    });
    Route::prefix('/administrators')->name('administrators.')->controller(UserController::class)->group(function () {
        Route::get('/', 'indexAdmin')->name('index');
        Route::get('/edit/{id}', 'editAdmin')->name('edit');
        Route::put('/update', 'updateAdmin')->name('update');
        Route::get('/destroy', 'destroyAdmin')->name('destroy');
        Route::get('/create', 'createAdmin')->name('create');
        Route::post('/store', 'storeAdmin')->name('store');
    });
    Route::prefix('/books')->name('books.')->controller(BookController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        // Route::get('/show/{id}', 'show')->name('show');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update', 'update')->name('update');
        Route::get('/destroy', 'destroy')->name('destroy');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
    });
    Route::prefix('/categories')->name('categories.')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update', 'update')->name('update');
        Route::get('/destroy', 'destroy')->name('destroy');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
    });
    
});

Route::get('/test', function () {
    return view('admin.users.index');
});