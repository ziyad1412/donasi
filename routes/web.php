<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\FundraiserController;
use App\Http\Controllers\FundraisingController;
use App\Http\Controllers\FundraisingPhaseController;
use App\Http\Controllers\FundraisingWithdrawalController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //prefix admin name admin group
    Route::prefix('admin')->name('admin.')->group(function () {
        // resource categories, categorycontroller, middleware role owner
        Route::resource('categories', CategoryController::class)->middleware('role:owner');
        //donaturs
        Route::resource('donaturs', DonaturController::class)->middleware('role:owner');
        //fundraisers, except index
        Route::resource('fundraisers', FundraiserController::class)->middleware('role:owner')->except('index');
        //get index fundraiser name
        Route::get('fundraisers', [FundraiserController::class, 'index'])->name('fundraisers.index');
        //resource fundraising_withdrawals, middleware role owner | fundraiser
        Route::resource('fundraising_withdrawals', FundraisingWithdrawalController::class)->middleware('role:owner|fundraiser');
        // post fundraising_withdrawals/request/{fundraising:id}, middleware fundraiser,name
        Route::post('fundraising_withdrawals/request/{fundraising}', [FundraisingWithdrawalController::class, 'store'])->middleware('role:fundraiser')->name('fundraising_withdrawals.store');
        // fundraising phases
        Route::resource('fundraising_phases', FundraisingPhaseController::class)->middleware('role:owner|fundraiser');
        // post fundraising_phases/update/{fundraising:id}, middleware fundraiser,name, store
        Route::post('fundraising_phases/update/{fundraising}', [FundraisingPhaseController::class, 'store'])->middleware('role:fundraiser')->name('fundraising_phases.store');
        // fundraising
        Route::resource('fundraisings', FundraisingController::class)->middleware('role:owner|fundraiser');
        // post fundraisings/active/{fundraising:id}, middleware owner,name, activate_fundraising
        Route::post('fundraisings/active/{fundraising}', [FundraisingController::class, 'activate_fundraising'])->middleware('role:owner')->name('fundraising_withdrawals.activate_fundraising');

        //post fundraiser/apply, DashboardController, apply_fundraiser,name
        Route::post('fundraiser/apply', [DashboardController::class, 'apply_fundraiser'])->name('fundraiser.apply');
        //get my-withdrawals, DashboardController, my_withdrawals,name
        Route::get('my-withdrawals', [DashboardController::class, 'my_withdrawals'])->name('my-withdrawals');
        //get my-withdrawals/details/{FundraisingWithdrawal}, DashboardController, my_withdrawals_details,name
        Route::get('my-withdrawals/details/{fundraising_withdrawal}', [DashboardController::class, 'my_withdrawals_details'])->name('my_withdrawals.details');
    });
});

require __DIR__ . '/auth.php';
