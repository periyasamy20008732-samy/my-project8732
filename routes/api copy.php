<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\Ac_AccountController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\WarehouseController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\StoreSettingsController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Api\PurchaseReturnController;
use App\Http\Controllers\Api\PurchaseItemController;
use App\Http\Controllers\Api\PurchaseItemReturnController;
use App\Http\Controllers\Api\PurchasePaymentController;
use App\Http\Controllers\Api\PurchasePaymentReturnController;
use App\Http\Controllers\Api\UnitsController;
use App\Http\Controllers\Api\OnesignalIdController;
use App\Http\Controllers\Api\SalesController;
use App\Http\Controllers\Api\SalesItemController;
use App\Http\Controllers\Api\SalesPaymentsController;
use App\Http\Controllers\Api\SalesPaymentsReturnController;
use App\Http\Controllers\Api\taxController;



// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');
Route::get('/settings-view/{id}', [SettingsController::class, 'settingshow']);
Route::put('/settings-update/{id}', [SettingsController::class, 'settingsupdate']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/sendotp', [UserController::class, 'sendOtp']);
Route::post('/verifyotp', [UserController::class, 'verifyOtp']);


Route::middleware('auth:api')->group(function () {

        Route::get('/user/{id}', [UserController::class, 'getUser']);
        Route::put('/user-update/{id}', [UserController::class, 'update']);

        //Store CRUD
        Route::get('/store-view', [StoreController::class, 'index']);
        Route::get('/store-view/{id}', [StoreController::class, 'show']);
        Route::post('/stores', [StoreController::class, 'index']);
        Route::post('/store-create', [StoreController::class, 'store']);
        Route::put('/store-update/{id}', [StoreController::class, 'update']);
        Route::delete('/store-delete/{id}', [StoreController::class, 'destroy']);

        //Store-app Settings CRUD
        Route::get('/store/settings-view', [StoreSettingsController::class, 'index']);
        Route::get('/store/settings-view/{id}', [StoreSettingsController::class, 'show']);
        Route::post('/store/settings-create', [StoreSettingsController::class, 'store']);
        Route::put('/store/settings-update/{id}', [StoreSettingsController::class, 'update']);
        Route::delete('/store/settings-delete/{id}', [StoreSettingsController::class, 'destroy']);

        //AcAccount CRUD
        Route::get('/acaccount-view', [Ac_AccountController::class, 'index']);
        Route::get('/acaccount-view/{id}', [Ac_AccountController::class, 'show']);
        Route::post('/acaccount-create', [Ac_AccountController::class, 'store']);
        Route::put('/acaccount-update/{id}', [Ac_AccountController::class, 'update']);
        Route::delete('/acaccount-delete/{id}', [Ac_AccountController::class, 'destroy']);

        //Customer CRUD
        Route::get('/customer-view', [CustomerController::class, 'index']);
        Route::get('/customer-view/{store_id}', [CustomerController::class, 'show']);
        Route::post('/customer-create', [CustomerController::class, 'store']);
        Route::put('/customer-update/{id}', [CustomerController::class, 'update']);
        Route::delete('/customer-delete/{id}', [CustomerController::class, 'destroy']);

        //Warhouse CRUD
        Route::get('/warehouse-view', [WarehouseController::class, 'index']);
        Route::get('/warehouse-view/{id}', [WarehouseController::class, 'show']);
        Route::post('/warehouse-create', [WarehouseController::class, 'store']);
        Route::put('/warehouse-update/{id}', [WarehouseController::class, 'update']);
        Route::delete('/warehouse-delete/{id}', [WarehouseController::class, 'destroy']);

        //Supplier CRUD
        Route::get('/supplier-view', [SupplierController::class, 'index']);
        Route::get('/supplier-view/{id}', [SupplierController::class, 'show']);
        Route::post('/supplier-create', [SupplierController::class, 'store']);
        Route::put('/supplier-update/{id}', [SupplierController::class, 'update']);
        Route::delete('/supplier-delete/{id}', [SupplierController::class, 'destroy']);


        //Category CRUD
        Route::get('/category-view', [CategoryController::class, 'index']);
        Route::get('/category-view/{id}', [CategoryController::class, 'show']);
        Route::post('/category-view', [CategoryController::class, 'store_show']);
        Route::post('/category-create', [CategoryController::class, 'store']);
        Route::put('/category-update/{id}', [CategoryController::class, 'update']);
        Route::delete('/category-delete/{id}', [CategoryController::class, 'destroy']);

        //Item CRUD 
        Route::get('/items-view', [ItemController::class, 'index']);
        Route::get('/items-view/{id}', [ItemController::class, 'show']);
        Route::post('/items-view', [ItemController::class, 'store_show']);
        Route::post('/items-create', [ItemController::class, 'store']);
        Route::put('/items-update/{id}', [ItemController::class, 'update']);
        Route::delete('/items-delete/{id}', [ItemController::class, 'destroy']);

        //Brand CRUD
        Route::get('/brand-view', [BrandController::class, 'index']);
        Route::get('/brand-view/{id}', [BrandController::class, 'show']);
        Route::post('/brand-view', [BrandController::class, 'store_show']);
        Route::post('/brand-create', [BrandController::class, 'store']);
        Route::put('/brand-update/{id}', [BrandController::class, 'update']);
        Route::delete('/brand-delete/{id}', [BrandController::class, 'destroy']);


        //Purchase CRUD
        Route::get('/purchase-view', [PurchaseController::class, 'index']);
        Route::get('/purchase-view/{id}', [PurchaseController::class, 'show']);
        Route::post('/purchase-create', [PurchaseController::class, 'store']);
        Route::put('/purchase-update/{id}', [PurchaseController::class, 'update']);
        Route::delete('/purchase-delete/{id}', [PurchaseController::class, 'destroy']);

        //PurchaseReturn CRUD
        Route::get('/purchasereturn-view', [PurchaseReturnController::class, 'index']);
        Route::get('/purchasereturn-view/{id}', [PurchaseReturnController::class, 'show']);
        Route::post('/purchasereturn-create', [PurchaseReturnController::class, 'store']);
        Route::put('/purchasereturn-update/{id}', [PurchaseReturnController::class, 'update']);
        Route::delete('/purchasereturn-delete/{id}', [PurchaseReturnController::class, 'destroy']);


        //PurchaseItem CRUD
        Route::get('/purchaseitem-view', [PurchaseItemController::class, 'index']);
        Route::get('/purchaseitem-view/{id}', [PurchaseItemController::class, 'show']);
        Route::post('/purchaseitem-create', [PurchaseItemController::class, 'store']);
        Route::put('/purchaseitem-update/{id}', [PurchaseItemController::class, 'update']);
        Route::delete('/purchaseitem-delete/{id}', [PurchaseItemController::class, 'destroy']);


        //PurchaseItemReturn CRUD
        Route::get('/purchaseitemreturn-view', [PurchaseItemReturnController::class, 'index']);
        Route::get('/purchaseitemreturn-view/{id}', [PurchaseItemReturnController::class, 'show']);
        Route::post('/purchaseitemreturn-create', [PurchaseItemReturnController::class, 'store']);
        Route::put('/purchaseitemreturn-update/{id}', [PurchaseItemReturnController::class, 'update']);
        Route::delete('/purchaseitemreturn-delete/{id}', [PurchaseItemReturnController::class, 'destroy']);

        //Purchasepayment CRUD
        Route::get('/purchasepayment-view', [PurchasePaymentController::class, 'index']);
        Route::get('/purchasepayment-view/{id}', [PurchasePaymentController::class, 'show']);
        Route::post('/purchasepayment-create', [PurchasePaymentController::class, 'store']);
        Route::put('/purchasepayment-update/{id}', [PurchasePaymentController::class, 'update']);
        Route::delete('/purchasepayment-delete/{id}', [PurchasePaymentController::class, 'destroy']);

        //PurchasepaymentReturn  CRUD
        Route::get('/purchasepaymentreturn-view', [PurchasePaymentReturnController::class, 'index']);
        Route::get('/purchasepaymentreturn-view/{id}', [PurchasePaymentReturnController::class, 'show']);
        Route::post('/purchasepaymentreturn-create', [PurchasePaymentReturnController::class, 'store']);
        Route::put('/purchasepaymentreturn-update/{id}', [PurchasePaymentReturnController::class, 'update']);
        Route::delete('/purchasepaymentreturn-delete/{id}', [PurchasePaymentReturnController::class, 'destroy']);

        //Sales CRUD
        Route::get('/sales-view', [SalesController::class, 'index']);
        Route::get('/sales-view/{id}', [SalesController::class, 'show']);
        Route::post('/sales-create', [SalesController::class, 'store']);
        Route::put('/sales-update/{id}', [SalesController::class, 'update']);
        Route::delete('/sales-delete/{id}', [SalesController::class, 'destroy']);

        //SalesItem CRUD
        Route::get('/salesitem-view', [SalesItemController::class, 'index']);
        Route::get('/salesitem-view/{id}', [SalesItemController::class, 'show']);
        Route::post('/salesitem-create', [SalesItemController::class, 'store']);
        Route::put('/salesitem-update/{id}', [SalesItemController::class, 'update']);
        Route::delete('/salesitem-delete/{id}', [SalesItemController::class, 'destroy']);


        //SalesPayment CRUD
        Route::get('/salespayment-view', [SalesPaymentsController::class, 'index']);
        Route::get('/salespayment-view/{id}', [SalesPaymentsController::class, 'show']);
        Route::post('/salespayment-create', [SalesPaymentsController::class, 'store']);
        Route::put('/salespayment-update/{id}', [SalesPaymentsController::class, 'update']);
        Route::delete('/salespayment-delete/{id}', [SalesPaymentsController::class, 'destroy']);

        //SalesPaymentReturn CRUD
        Route::get('/salespaymentreturn-view', [SalesPaymentsReturnController::class, 'index']);
        Route::get('/salespaymentreturn-view/{id}', [SalesPaymentsReturnController::class, 'show']);
        Route::post('/salespaymentreturn-create', [SalesPaymentsReturnController::class, 'store']);
        Route::put('/salespaymentreturn-update/{id}', [SalesPaymentsReturnController::class, 'update']);
        Route::delete('/salespaymentreturn-delete/{id}', [SalesPaymentsReturnController::class, 'destroy']);

});

//Packages CRUD
Route::get('/packages-view', [PackageController::class, 'index']);
Route::get('/packages-view/{id}', [PackageController::class, 'show']);
Route::post('/packages-create', [PackageController::class, 'store']);
Route::put('/packages-update/{id}', [PackageController::class, 'update']);

//Unit CRUD 
Route::get('/unit-view', [UnitsController::class, 'index']);
Route::get('/unit-view/{id}', [UnitsController::class, 'show']);
Route::post('/unit-create', [UnitsController::class, 'store']);
Route::put('/unit-update/{id}', [UnitsController::class, 'update']);
Route::delete('/unit-delete/{id}', [UnitsController::class, 'destroy']);


//OnesignalIdController CRUD 
//Route::get('/onesignal-view', [OnesignalIdController::class, 'index']);
Route::get('/onesignal-view/{user_id}', [OnesignalIdController::class, 'show']);
Route::post('/onesignal-create', [OnesignalIdController::class, 'store']);
Route::put('/onesignal-update/{user_id}', [OnesignalIdController::class, 'update']);
//Route::delete('/onesignal-delete/{id}', [UnitsController::class, 'destroy']); 

//CountrySettings CRUD 
Route::get('/country/settings-view', [CountryController::class, 'index']);
Route::get('/country/settings-view/{id}', [CountryController::class, 'show']);
Route::post('/country/settings-create', [CountryController::class, 'store']);
Route::put('/country/settings-update/{id}', [CountryController::class, 'update']);
Route::delete('/country/settings-delete/{id}', [CountryController::class, 'destroy']);

//Tax CRUD 
Route::get('/tax-view', [taxController::class, 'index']);
Route::get('/tax-view/{id}', [taxController::class, 'show']);
Route::post('/tax-create', [taxController::class, 'store']);
Route::put('/tax-update/{id}', [taxController::class, 'update']);
Route::delete('/tax-delete/{id}', [taxController::class, 'destroy']);