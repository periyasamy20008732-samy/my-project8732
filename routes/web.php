<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\StoreLoginController;
use App\Http\Controllers\Auth\WebLoginController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\BusinessTypeController;
use App\Http\Controllers\Admin\BusinessCategoryController;
use App\Http\Controllers\Admin\PagesController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Payment\RazorpayPaymentController;
use App\Http\Controllers\Payment\PhonePePaymentController;
use App\Http\Controllers\Account\PaymentController;
use App\Http\Controllers\Account\AccountDashboardController;
use App\Http\Controllers\Store\SalesController;
use App\Http\Controllers\Store\ItemController;
use App\Http\Controllers\Store\BrandController;
use App\Http\Controllers\Store\StoreController;
use App\Http\Controllers\Store\CategoryController;
use App\Http\Controllers\Store\StoreCustomerController;
use App\Http\Controllers\Store\WarehouseController;





use Illuminate\Foundation\PackageManifest;
use Illuminate\Support\Facades\Route;

// ---------- Home Website Start----------//

Route::get('/', function () {
    return view('index');
});
Route::get('/pricing', function () {
    return view('pricing');
});
Route::get('/pricing', [PackageController::class, 'home_index'])->name('packages');

Route::get('/about-us', function () {
    return view('about');
});
Route::get('/partner-program', function () {
    return view('partnerprogram');
});

Route::get('/contact-us', function () {
    return view('contact');
});


Route::get('/paynow/{mobile}/{package_id}', [PaymentController::class, 'paynow'])->name('paynow');

//razorpay paymentgateway
Route::post('/paynow/razorpay/order', [RazorpayPaymentController::class, 'createOrder'])->name('razorpay.order');
Route::post('/paynow/razorpay/success', [RazorpayPaymentController::class, 'paymentSuccess'])->name('razorpay.success');

Route::get('/paynow/success', function () {
    return view('success');
})->name('razorpay.success.view');

Route::get('/paynow/failed', function () {
    return view('fail');
})->name('razorpay.fail.view');

//razorpay paymentgateway end


//phonepe paymentgatwway
Route::post('/paynow/phonepe', [PhonePePaymentController::class, 'initiatePayment'])->name('phonepe.payment');
Route::post('/paynow/phonepe/callback', [PhonePePaymentController::class, 'handleCallback'])->name('phonepe.callback');
Route::get('/paynow/phonepe/status/{transactionId}', [PhonePePaymentController::class, 'verifyPaymentStatus'])->name('phonepe.status');


//phonepe paymentgateway end
// ---------- Home Website End ----------

// ---------- Account start ----------

Route::get('/account', [WebLoginController::class, 'showLoginForm'])->name('accountlogin.form');
Route::get('/account/login-password', [WebLoginController::class, 'showLoginpasswordForm'])->name('accountloginpassword.form');
Route::get('/account/signup', [WebLoginController::class, 'showsignupForm'])->name('accountsignup.form');
Route::post('/account/login', [WebLoginController::class, 'login'])->name('accountlogin');
Route::post('/account/getotp', [WebLoginController::class, 'getotp'])->name('getotp');
Route::post('/account/verify', [WebLoginController::class, 'verifyotp'])->name('verifyotp');
Route::post('/account/login-password', [WebLoginController::class, 'accountlogin'])->name('accountlogin');

Route::prefix('account')->middleware(['auth'])->name('account.')->group(function () {
    Route::get('/dashboard', [WebLoginController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [AccountDashboardController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [WebLoginController::class, 'logout'])->name('logout');
});

// ---------- Account End ----------

// ---------- Admin side ----------

//Admin Login routes
Route::get('/admin', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/admin/login', [LoginController::class, 'login'])->name('login');

Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::post('/admin/logout', [LoginController::class, 'logout'])->name('logout');

    Route::resource('package', PackageController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('tax', TaxController::class);
    Route::resource('unit', UnitController::class);
    Route::resource('country', UnitController::class);
    Route::resource('business-types', BusinessTypeController::class);
    Route::resource('business-category', BusinessCategoryController::class);
    Route::resource('pages', PagesController::class);
    Route::get('add-page', [PagesController::class, 'addpage'])->name('addpage');

    Route::get('edit-page/{id}', [PagesController::class, 'editpage'])->name('editpage');
    Route::put('update-page/{id}', [PagesController::class, 'update'])->name('updatepage');


    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::put('/settings/{id}', [SettingsController::class, 'update'])->name('settings.update');
});

// ---------- Admin side END ----------//

// ---------- Store side Start ----------//

//Store Login Routes 
Route::post('/upload-images', [StoreController::class, 'storeImages'])->name('storeImages');
Route::get('/images', [StoreController::class, 'showImage'])->name('showImage');


Route::get('/store', [StoreLoginController::class, 'showLoginForm'])->name('storelogin.form');
Route::post('/store/login', [StoreLoginController::class, 'login'])->name('storelogin');
Route::get('/store/register', [StoreLoginController::class, 'showRegisterForm'])->name('storeregister.form');

Route::prefix('store')->middleware(['auth'])->name('store.')->group(function () {
    Route::get('items/get_warehouse', [ItemController::class, 'getwarehouse'])->name('item.get_warehouse');

    Route::post('/store/logout', [StoreLoginController::class, 'logout'])->name('logout');
    Route::resource('package', PackageController::class);

    Route::resource('sales', SalesController::class);
    Route::resource('customer', StoreCustomerController::class);
    Route::resource('brand', BrandController::class);
    Route::resource('store', StoreController::class);
    Route::resource('category', CategoryController::class);
    Route::post('items/add_cate', [ItemController::class, 'add_category'])->name('item.add_cate');
    Route::post('items/add_brand', [ItemController::class, 'add_brand'])->name('item.add_brand');
    Route::post('items/add_unit', [ItemController::class, 'add_unit'])->name('item.add_unit');
    Route::resource('items', ItemController::class);
    Route::resource('warehouse', WarehouseController::class);









    Route::get('/dashboard', [DashboardController::class, 'store_index'])->name('dashboard');
});
