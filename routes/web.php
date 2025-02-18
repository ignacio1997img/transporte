<?php

use App\Http\Controllers\AjaxController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\SaleController;

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



Route::get('login', function () {
    return redirect('admin/login');
})->name('login');

Route::get('/', function () {
    return redirect('admin');
});

Route::get('/development', [ErrorController::class , 'error503'])->name('development');

Route::group(['prefix' => 'admin', 'middleware' => ['loggin']], function () {
    Voyager::routes();

    Route::get('people', [PeopleController::class, 'index'])->name('voyager.people.index');
    Route::get('people/ajax/list', [PeopleController::class, 'list']);

    Route::get('vehicles', [VehicleController::class, 'index'])->name('voyager.vehicles.index');
    Route::get('vehicles/ajax/list', [VehicleController::class, 'list']);
    Route::get('vehicles/{id}', [VehicleController::class, 'show'])->name('voyager.vehicles.show');
    Route::post('save-seats', [VehicleController::class, 'saveSeats'])->name('save.seats');

    // Route::get('sales', [SaleController::class, 'index'])->name('sales.index');
    // Route::get('sales/create', [SaleController::class, 'create'])->name('sales.create');
    // Route::post('sales/store', [SaleController::class, 'create'])->name('sales.create');
    
    Route::resource('sales', SaleController::class);




    

    Route::get('people/list/ajax', [AjaxController::class, 'peopleList']);
    Route::post('people/store', [AjaxController::class, 'peopleStore']);




});


// Clear cache
Route::get('/admin/clear-cache', function() {
    Artisan::call('optimize:clear');
    return redirect('/admin/profile')->with(['message' => 'Cache eliminada.', 'alert-type' => 'success']);
})->name('clear.cache');