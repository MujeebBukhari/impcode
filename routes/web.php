<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\ProController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\WorkerController;
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


Route::get('/', [ProductController::class, 'productList'])->name('products.list');
Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');

Route::get('add-employee', [EmployeeController::class, 'addEmployees']);
Route::get('export-excel', [EmployeeController::Class, 'exportIntoExcel']);
Route::get('export-csv', [EmployeeController::Class, 'exportIntoCSV']);


Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');
Route::get('orders', [OrdersController::class, 'index'])->name('orders');
Route::get('checkout', [CartController::class, 'stripeCheck'])->name('stripecheckout');

Route::get('lang/home', [LangController::class, 'index']);
Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');
    
Route::get('/stripe-payment', [CartController::class, 'handleGet']);
Route::post('/stripe-payment', [CartController::class, 'cardPayment'])->name('stripe.payment');
Route::post('payment', [CartController::class, 'payment'])->name('payment');
Route::get('cancel',  [CartController::class, 'cancel'])->name('payment.cancel');
Route::get('payment/success', [CartController::class, 'success'])->name('payment.success');

Route::get('/generate-barcode', [ProController::class, 'index'])->name('generate.barcode');

Route::get('/students', [StudentController::class, 'index'])->name('students');

Route::post('/add-students', [StudentController::class, 'addStudent'])->name('addstudents');
Route::get('/students/{id}', [StudentController::class, 'getStudentById']);
Route::put('/student', [StudentController::class, 'updateStudent'])->name('updateStudent');
Route::delete('/students/{id}', [StudentController::class, 'deleteStudents'])->name('deleteStudent');

Route::get('/chart', [ChartController::class, 'index']);

Route::get('echarts', [ChartController::class, 'echart']);





Route::get('workers', [WorkerController::class,'index'])->name('workers.index');
  
Route::get('workers/create-step-one', [WorkerController::class,'createStepOne'])->name('workers.create.step.one');

Route::post('workers/create-step-one', [WorkerController::class,'postCreateStepOne'])->name('workers.create.step.one.post');

Route::get('workers/create-step-two', [WorkerController::class,'createStepTwo'])->name('workers.create.step.two');

Route::post('workers/create-step-two', [WorkerController::class,'postCreateStepTwo'])->name('workers.create.step.two.post');

Route::get('workers/create-step-three', [WorkerController::class,'createStepThree'])->name('workers.create.step.three');

Route::post('workers/create-step-three', [WorkerController::class,'postCreateStepThree'])->name('workers.create.step.three.post');



/* Use Tinker to create fake Data through DB seed
    Language translater 
    Stripe and Paypal 

*/