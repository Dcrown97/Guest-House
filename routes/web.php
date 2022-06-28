<?php

use App\Http\Controllers\FoodController;
use App\Http\Controllers\LeavereportController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::match(['get', 'post'], '/', [LeavereportController::class, 'Dashboard'])->name('dashboard');
Route::match(['get', 'post'], '/add_staffs', [LeavereportController::class, 'AddStaffs'])->name('add_staffs');
Route::match(['get', 'post'], '/all_staffs', [LeavereportController::class, 'AllStaffs']);
Route::match(['get', 'post'], '/signup', [UserController::class, 'SignUp'])->name('signup');
Route::match(['get', 'post'], '/login', [UserController::class, 'Login'])->name('login');
Route::match(['get', 'post'], '/logout', [UserController::class, 'logout'])->name('logout');
Route::match(['get', 'post'], '/leave_request', [LeavereportController::class, 'LeaveRequest'])->name('leave_request');
Route::match(['get', 'post'], '/leave_request/{id}', [LeavereportController::class, 'LeaveRequest']);
Route::match(['get', 'post'], '/add_leave_type', [LeavereportController::class, 'AddLeaveType'])->name('add_leave_type');
Route::match(['get', 'post'], '/staffs_on_leave', [LeavereportController::class, 'StaffsOnLeave']);
Route::match(['get', 'post'], '/get_date', [LeavereportController::class, 'getResumptionDate']);
Route::match(['get', 'post'], '/leave_days', [LeavereportController::class, 'getLeaveTypeDays']);
Route::match(['get', 'post'], '/staff_leave', [LeavereportController::class, 'getStaffLeaveDays']);
Route::match(['get', 'post'], '/staffs_about_to_resume', [LeavereportController::class, 'StaffsAboutToResume']);

Route::get('search_staffs', [LeavereportController::class, 'searchStaffs'])->name('search_staffs');

Route::get('search_staffs_on_leave', [LeavereportController::class, 'searchStaffsOnLeave'])->name('search_staffs_on_leave');


Route::match(['get', 'post'], '/food', [FoodController::class, 'Food']);
Route::match(['get', 'post'], '/add_food', [FoodController::class, 'addFood'])->name('add_food');
Route::match(['get', 'post'], '/order_food', [FoodController::class, 'orderFood'])->name('order_food');
Route::match(['get', 'post'], '/food_price/{id}', [FoodController::class, 'getFoodPrice']);
Route::match(['get', 'post'], '/drinks', [FoodController::class, 'Drinks']);
Route::match(['get', 'post'], '/add_drinks', [FoodController::class, 'addDrinks'])->name('add_drinks');
Route::match(['get', 'post'], '/order_drinks', [FoodController::class, 'orderDrink'])->name('order_drinks');
Route::match(['get', 'post'], '/drink_price/{id}', [FoodController::class, 'getDrinkPrice']);
