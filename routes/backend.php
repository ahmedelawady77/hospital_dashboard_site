<?php
 
use Livewire\Livewire;
use App\Events\myevent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\RayEmployeeController;
use App\Http\Controllers\Dashboard\SingleServiceController;
use App\Http\Controllers\Dashboard\PaymentAccountController;
use App\Http\Controllers\Dashboard\ReceiptAccountController;
use App\Http\Controllers\Dashboard\SingleInvoicesController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\LaboratorieEmployeeController;
      
/*  
|--------------------------------------------------------------------------
| Web backend
|--------------------------------------------------------------------------
*/ 
// Route::get('dashboardadmin',[DashboardController::class,'index']);
 
Route::group 
(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],function()
    { 
        //______________DASHBOARD USER____________________
        Route::get('/dashboard/user', function () {
            return view('dashboard.user.dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard.user');
         //______________DASHBOARD ADMIN____________________
        Route::get('/dashboard/admin', function () {

            // event(new myevent('hello pusher'));

            return view('dashboard.admin.dashboard');
        })->middleware(['auth:admin', 'verified'])->name('dashboard.admin'); 
        //______________DASHBOARD DOCTOR____________________

        //__________________ auth __________________________
        require __DIR__.'/auth.php';
        //__________________________________________________ 

        Route::middleware(['auth:admin'])->group(function() 
        {
         //______________SECTIONS ROUTE____________________
         Route::resource('sections',SectionController::class);
         //______________END SECTIONS ROUTE____________________

         //______________DOCTORS ROUTE____________________
         Route::resource('doctors', DoctorController::class);
         Route::post('update_status/{id}', [DoctorController::class, 'update_status'])->name('update_status');
         Route::post('update_password', [DoctorController::class, 'update_password'])->name('update_password');
         //______________END DOCTORS ROUTE____________________
         //############################# sections route ##########################################
         Route::resource('Service', SingleServiceController::class); 
         //############################# end sections route ######################################

         //############################# GroupServices route ########################################## 
          Route::view('Add_GroupServices','livewire.GroupServices.include_create')->name('Add_GroupServices');
          Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/custom/livewire/update', $handle);
          });
         //############################# end GroupServices route ######################################

         //############################# insurance route ##########################################
          Route::resource('insurance', InsuranceController::class);
         //############################# end insurance route ######################################
         
         //############################# Ambulance route ##########################################
         Route::resource('Ambulance', AmbulanceController::class);
         //############################# end Ambulance route ######################################

          //############################# patients route ##########################################
          Route::resource('patients', PatientController::class);
          //############################# end patients route ######################################

           //############################# single_invoices and groub_invoices route ##########################################
           Route::view('single_invoices','livewire.single_invoices.index')->name('single_invoices');
           Route::view('Print_single_invoices','livewire.single_invoices.print')->name('Print_single_invoices');
           Route::view('group_invoices','livewire.Group_invoices.index')->name('group_invoices');
           Route::view('group_Print_single_invoices','livewire.Group_invoices.print')->name('group_Print_single_invoices');
            //############################# Receipt route ##########################################
            Route::resource('Receipt', ReceiptAccountController::class);
            //############################# end Receipt route ######################################

            //############################# Payment route ##########################################
            Route::resource('Payment', PaymentAccountController::class);
            //############################# end Payment route ######################################

            //############################# RayEmployee route ######################################
            Route::resource('ray_employee', RayEmployeeController::class);
            //############################# end RayEmployee route ##################################

            //############################# laboratorie_employee route ##########################################
            Route::resource('laboratorie_employee', LaboratorieEmployeeController::class);
            //############################# end laboratorie_employee route ######################################


        });
      
    }
);
 
  