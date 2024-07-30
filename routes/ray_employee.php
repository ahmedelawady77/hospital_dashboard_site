<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard_ray_employee\InvoiceController;

/*
|--------------------------------------------------------------------------
| ray_employee Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {


    //################################ DASHBOARD ray_employee ########################################

    Route::get('/dashboard/ray_employee', function () {
        return view('dashboard.dashboard_RayEmployee.dashboard');
    })->middleware(['auth:ray_employee', 'verified'])->name('dashboard.ray_employee');

    //################################ end DASHBOARD ray_employee #####################################

    //---------------------------------------------------------------------------------------------------------------
    Route::middleware(['auth:ray_employee'])->group(function ()
    {
      Route::prefix('ray_employe')->group(function () {

       Route::resource('invoices_ray_employee', InvoiceController::class);
       Route::get('completed_invoices', [InvoiceController::class,'completed_invoices'])->name('completed_invoices');
       Route::get('view_rays/{id}', [InvoiceController::class,'viewRays'])->name('view_rays');

        });

    });
    require __DIR__ . '/auth.php';

});





