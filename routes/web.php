<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImportCsvController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\SkuController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\GlobalController;
use Illuminate\Support\Facades\Route;


Route::get('/check', [GlobalController::class, 'show'])->name('check');
Route::post('/warranty/info', [GlobalController::class, 'info'])->name('deviceInfo');
Route::get('/share/{id}', [GlobalController::class, 'share'])->name('shareDevice');
Route::get('/warranty/retrieve/{id}', [GlobalController::class, 'retrieveDetails'])->name('retrieveDeviceDetails');
Route::get('/warranty/{id}', [GlobalController::class, 'details'])->name('deviceDetails');
Route::get('contact', [GlobalController::class, 'contact'])->name('contact');

// Register
route::get('/register', [LoginController::class, 'register'])->name('register');
route::post('/register/user', [LoginController::class, 'registeruser'])->name('registeruser');

// Reset
route::get('/forgot-password', [LoginController::class, 'forgotPassword'])->name('password.request');
route::post('/send-reset-email', [LoginController::class, 'sendResetEmail'])->name('password.update');
route::get('/reset-password/{token}', [LoginController::class, 'showResetForm'])->name('password.reset');
route::post('/reset-password', [LoginController::class, 'resetPassword'])->name('password.confirmReset');

// Login
route::get('/login', [LoginController::class, 'login'])->name('login');
route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Assets
route::get('/assets/listing', [AssetController::class, 'index'])->name('assets');
route::get('/bulk/qr-code/{ids}', [AssetController::class, 'bulk'])->name('bulk');
route::get('/asset/view', [AssetController::class, 'view'])->name('viewAsset');
route::post('/asset/add', [AssetController::class, 'store'])->name('addAsset');
route::post('/asset/bulk-upload', [ImportCsvController::class, 'store'])->name('bulkUploadAsset');
route::get('/asset/edit/{id}', [AssetController::class, 'show'])->name('showAsset');
route::post('/asset/update/{id}', [AssetController::class, 'update'])->name('updateAsset');
route::delete('/asset/delete/{id}', [AssetController::class, 'destroy'])->name('deleteAsset');

// Components
route::get('/components/listing', [ComponentController::class, 'index'])->name('components');
route::post('/component/add', [ComponentController::class, 'store'])->name('addComponent');
route::get('/component/edit/{id}', [ComponentController::class, 'show'])->name('showComponent');
route::post('/component/update/{id}', [ComponentController::class, 'update'])->name('updateComponent');
route::delete('/component/delete/{id}', [ComponentController::class, 'destroy'])->name('deleteComponent');

// Brands
route::get('/brands/listing', [BrandController::class, 'index'])->name('brands');
route::post('/brand/add', [BrandController::class, 'store'])->name('addBrand');
route::get('/brand/edit/{id}', [BrandController::class, 'show'])->name('showBrand');
route::post('/brand/update/{id}', [BrandController::class, 'update'])->name('updateBrand');
route::delete('/brand/delete/{id}', [BrandController::class, 'destroy'])->name('deleteBrand');

// Models
route::get('/models/listing', [ModelController::class, 'index'])->name('models');
route::get('/models/{id}', [ModelController::class, 'getModelByBrandId'])->name('getModelByBrandId');
route::post('/model/add', [ModelController::class, 'store'])->name('addModel');
route::get('/model/edit/{id}', [ModelController::class, 'show'])->name('showModel');
route::post('/model/update/{id}', [ModelController::class, 'update'])->name('updateModel');
route::delete('/model/delete/{id}', [ModelController::class, 'destroy'])->name('deleteModel');

// Skus
route::get('/skus/listing', [SkuController::class, 'index'])->name('skus');
route::post('/sku/add', [SkuController::class, 'store'])->name('addSku');
route::get('/sku/edit/{id}', [SkuController::class, 'show'])->name('showSku');
route::post('/sku/update/{id}', [SkuController::class, 'update'])->name('updateSku');
route::delete('/sku/delete/{id}', [SkuController::class, 'destroy'])->name('deleteSku');

// User
route::get('/users/listing', [UserController::class, 'index'])->name('users');
route::post('/user/add', [UserController::class, 'store'])->name('addUser');
route::get('/user/edit/{id}', [UserController::class, 'show'])->name('showUser');
route::post('/user/update/{id}', [UserController::class, 'update'])->name('updateUser');
route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('deleteUser');

// Customer
route::get('/customers/listing', [CustomerController::class, 'index'])->name('customers');
route::post('/customer/add', [CustomerController::class, 'store'])->name('addCustomer');
route::get('/customer/edit/{id}', [CustomerController::class, 'show'])->name('showCustomer');
route::post('/customer/update/{id}', [CustomerController::class, 'edit'])->name('editCustomer');
route::delete('/customer/delete/{id}', [CustomerController::class, 'destroy'])->name('deleteCustomer');

// Timezone
route::get('/timezone/listing', [GlobalController::class, 'getTimezone'])->name('timezoneListing');

// redirect the guest to login page, while user will be navigate to dashboard page
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
});

route::group(['middleware' => ['auth']], function () {
    route::get('/', function () {
        // Define your default path here
        $defaultPath = '/assets'; // Change this to your desired default path
        
        // Redirect to the default path
        return redirect($defaultPath);
    });
    Route::get('/view-asset/{id}', [GlobalController::class, 'viewAssetDetails'])->name('viewAssetDetails');
    route::get('/{any}', [ImportCsvController::class, 'index'])->where('any', '.*');
});