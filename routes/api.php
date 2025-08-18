<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\Ac_AccountController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\CustomerAdvanceController;
use App\Http\Controllers\Api\CustomerPaymentController;
use App\Http\Controllers\Api\CustomerShippingAddressController;
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
use App\Http\Controllers\Api\SalesReturnController;
use App\Http\Controllers\Api\SalesItemController;
use App\Http\Controllers\Api\SalesItemReturnController;
use App\Http\Controllers\Api\SalesPaymentsController;
use App\Http\Controllers\Api\SalesPaymentsReturnController;
use App\Http\Controllers\Api\TaxController;
use App\Http\Controllers\Api\StockAdjustmentController;
use App\Http\Controllers\Api\StockAdjustmentItemController;
use App\Http\Controllers\Api\StockTransferController;
use App\Http\Controllers\Api\StockTransferItemController;
use App\Http\Controllers\Api\AccountSettingsController;
use App\Http\Controllers\Api\Ac_MoneydepositsController;
use App\Http\Controllers\Api\Ac_MoneyTransferController;
use App\Http\Controllers\Api\Ac_TransactionsController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderStatusController;
use App\Http\Controllers\Api\OrderItemController;
use App\Http\Controllers\Api\OrderLogController;
use App\Http\Controllers\Api\PosController;
use App\Http\Controllers\Api\PosholdItemsController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\WarehouseItemContrtoller;
use App\Http\Controllers\Api\BusinessProfileController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\BusinessTypeController;
use App\Http\Controllers\Api\storeReportController;
use App\Http\Controllers\Api\SubscriptionPurchaseController;



Route::get('/settings-view/{id}', [SettingsController::class, 'settingshow']);
Route::put('/settings-update/{id}', [SettingsController::class, 'settingsupdate']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/sendotp', [UserController::class, 'sendOtp']);
Route::post('/verifyotp', [UserController::class, 'verifyOtp']);
Route::post('/verifyotp', [UserController::class, 'verifyOtp']);


Route::middleware('auth:api')->group(function () {

  Route::get('/dashboard', [DashboardController::class, 'getDashboard']);
  Route::get('/search', [DashboardController::class, 'search']);


  Route::post('/check-session', [UserController::class, 'checkSession']);
  Route::post('/logout', [UserController::class, 'logout']);


  Route::get('/user/{id}', [UserController::class, 'getUser']);
  Route::get('/store-users', [UserController::class, 'getStoreUsers']);
  Route::put('/user-update/{id}', [UserController::class, 'update']);

  //subscription-purchase
  Route::get('/subscription-purchase', [SubscriptionPurchaseController::class, 'index']);


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


  //Account Settings CRUD
  Route::get('/accountsettings-view', [AccountSettingsController::class, 'index']);
  Route::get('/accountsettings-view/{id}', [AccountSettingsController::class, 'show']);
  Route::post('/accountsettings-create', [AccountSettingsController::class, 'store']);
  Route::put('/accountsettings-update/{id}', [AccountSettingsController::class, 'update']);
  Route::delete('/accountsettings-delete/{id}', [AccountSettingsController::class, 'destroy']);


  //Ac_Moneydeposits CRUD
  Route::get('/acmoneydeposits-view', [Ac_MoneydepositsController::class, 'index']);
  Route::get('/acmoneydeposits-view/{id}', [Ac_MoneydepositsController::class, 'show']);
  Route::post('/acmoneydeposits-create', [Ac_MoneydepositsController::class, 'store']);
  Route::put('/acmoneydeposits-update/{id}', [Ac_MoneydepositsController::class, 'update']);
  Route::delete('/acmoneydeposits-delete/{id}', [Ac_MoneydepositsController::class, 'destroy']);


  //Ac_MoneyTransfer CRUD
  Route::get('/acmoneytransfer-view', [Ac_MoneyTransferController::class, 'index']);
  Route::get('/acmoneytransfer-view/{id}', [Ac_MoneyTransferController::class, 'show']);
  Route::post('/acmoneytransfer-create', [Ac_MoneyTransferController::class, 'store']);
  Route::put('/acmoneytransfer-update/{id}', [Ac_MoneyTransferController::class, 'update']);
  Route::delete('/acmoneytransfer-delete/{id}', [Ac_MoneyTransferController::class, 'destroy']);



  //Ac_Transactions CRUD                     
  Route::get('/actransactions-view', [Ac_TransactionsController::class, 'index']);
  Route::get('/actransactions-view/{id}', [Ac_TransactionsController::class, 'show']);
  Route::post('/actransactions-create', [Ac_TransactionsController::class, 'store']);
  Route::put('/actransactions-update/{id}', [Ac_TransactionsController::class, 'update']);
  Route::delete('/actransactions-delete/{id}', [Ac_TransactionsController::class, 'destroy']);

  //Customer CRUD
  Route::get('/customer-view', [CustomerController::class, 'index']);
  Route::get('/customer-view/{store_id}', [CustomerController::class, 'show']);
  Route::post('/customer-create', [CustomerController::class, 'store']);
  Route::put('/customer-update/{id}', [CustomerController::class, 'update']);
  Route::delete('/customer-delete/{id}', [CustomerController::class, 'destroy']);

  //CustomerAdvance CRUD
  Route::get('/customeradvance-view', [CustomerAdvanceController::class, 'index']);
  Route::get('/customeradvance-view/{store_id}', [CustomerAdvanceController::class, 'show']);
  Route::post('/customeradvance-create', [CustomerAdvanceController::class, 'store']);
  Route::put('/customeradvance-update/{id}', [CustomerAdvanceController::class, 'update']);
  Route::delete('/customeradvance-delete/{id}', [CustomerAdvanceController::class, 'destroy']);

  //CustomerPayments CRUD
  Route::get('/customerpayment-view', [CustomerPaymentController::class, 'index']);
  Route::get('/customerpayment-view/{store_id}', [CustomerPaymentController::class, 'show']);
  Route::post('/customerpayment-create', [CustomerPaymentController::class, 'store']);
  Route::put('/customerpayment-update/{id}', [CustomerPaymentController::class, 'update']);
  Route::delete('/customerpayment-delete/{id}', [CustomerPaymentController::class, 'destroy']);

  //CustomerShippingCRUD
  Route::get('/customershipping-view', [CustomerShippingAddressController::class, 'index']);
  Route::get('/customershipping-view/{store_id}', [CustomerShippingAddressController::class, 'show']);
  Route::post('/customershipping-create', [CustomerShippingAddressController::class, 'store']);
  Route::put('/customershipping-update/{id}', [CustomerShippingAddressController::class, 'update']);
  Route::delete('/customershipping-delete/{id}', [CustomerShippingAddressController::class, 'destroy']);

  //Warhouse CRUD
  Route::get('/warehouse-view', [WarehouseController::class, 'index']);
  Route::get('/warehouse-view/{id}', [WarehouseController::class, 'index']);
  Route::post('/warehouse-create', [WarehouseController::class, 'store']);
  Route::put('/warehouse-update/{id}', [WarehouseController::class, 'update']);
  Route::delete('/warehouse-delete/{id}', [WarehouseController::class, 'destroy']);

  //Supplier CRUD
  Route::get('/supplier-view', [SupplierController::class, 'index']);
  Route::get('/supplier-view/{store_id}', [SupplierController::class, 'show']);
  Route::post('/supplier-create', [SupplierController::class, 'store']);
  Route::put('/supplier-update/{id}', [SupplierController::class, 'update']);
  Route::delete('/supplier-delete/{id}', [SupplierController::class, 'destroy']);


  //Category CRUD
  // Route::post('/category-view', [CategoryController::class, 'store_show']);
  Route::post('/category-create', [CategoryController::class, 'store']);
  Route::get('/category-view/{id?}', [CategoryController::class, 'index']);
  Route::put('/category-update/{id}', [CategoryController::class, 'update']);
  Route::delete('/category-delete/{id}', [CategoryController::class, 'destroy']);
  Route::get('/category/{categoryId}/items', [CategoryController::class, 'getItemsBasedOnCateId']);


  //Item CRUD 
  Route::get('/items-view', [ItemController::class, 'index']);
  Route::get('/items-view/{id}', [ItemController::class, 'index']);
  Route::post('/item-bulk', [ItemController::class, 'item_bulkpost']);
  //Route::get('/items-views/{user_id}/{store_id}', [ItemController::class, 'show']);
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

  //SalesReturn CRUD
  Route::get('/salesreturn-view', [SalesReturnController::class, 'index']);
  Route::get('/salesreturn-view/{id}', [SalesReturnController::class, 'show']);
  Route::post('/salesreturn-create', [SalesReturnController::class, 'store']);
  Route::put('/salesreturn-update/{id}', [SalesReturnController::class, 'update']);
  Route::delete('/salesreturn-delete/{id}', [SalesReturnController::class, 'destroy']);

  //SalesItem CRUD
  Route::get('/salesitem-view', [SalesItemController::class, 'index']);
  Route::get('/salesitem-view/{id}', [SalesItemController::class, 'show']);
  Route::post('/salesitem-create', [SalesItemController::class, 'store']);
  Route::put('/salesitem-update/{id}', [SalesItemController::class, 'update']);
  Route::delete('/salesitem-delete/{id}', [SalesItemController::class, 'destroy']);

  //SalesItemReturn CRUD
  Route::get('/salesitemreturn-view', [SalesItemReturnController::class, 'index']);
  Route::get('/salesitemreturn-view/{id}', [SalesItemReturnController::class, 'show']);
  Route::post('/salesitemreturn-create', [SalesItemReturnController::class, 'store']);
  Route::put('/salesitemreturn-update/{id}', [SalesItemReturnController::class, 'update']);
  Route::delete('/salesitemreturn-delete/{id}', [SalesItemReturnController::class, 'destroy']);


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

  //StockAdjustment CRUD
  Route::get('/stockadjustment-view', [StockAdjustmentController::class, 'index']);
  Route::get('/stockadjustment-view/{id}', [StockAdjustmentController::class, 'show']);
  Route::post('/stockadjustment-create', [StockAdjustmentController::class, 'store']);
  Route::put('/stockadjustment-update/{id}', [StockAdjustmentController::class, 'update']);
  Route::delete('/stockadjustment-delete/{id}', [StockAdjustmentController::class, 'destroy']);

  //StockAdjustment CRUD
  Route::get('/stockadjustmentitem-view', [StockAdjustmentItemController::class, 'index']);
  Route::get('/stockadjustmentitem-view/{id}', [StockAdjustmentItemController::class, 'show']);
  Route::post('/stockadjustmentitem-create', [StockAdjustmentItemController::class, 'store']);
  Route::put('/stockadjustmentitem-update/{id}', [StockAdjustmentItemController::class, 'update']);
  Route::delete('/stockadjustmentitem-delete/{id}', [StockAdjustmentItemController::class, 'destroy']);

  //stocktransfer CRUD
  Route::get('/stocktransfer-view', [StockTransferController::class, 'index']);
  Route::get('/stocktransfer-view/{id}', [StockTransferController::class, 'show']);
  Route::post('/stocktransfer-create', [StockTransferController::class, 'store']);
  Route::put('/stocktransfer-update/{id}', [StockTransferController::class, 'update']);
  Route::delete('/stocktransfer-delete/{id}', [StockTransferController::class, 'destroy']);

  //stocktransferitem CRUD
  Route::get('/stocktransferitem-view', [StockTransferItemController::class, 'index']);
  Route::get('/stocktransferitem-view/{id}', [StockTransferItemController::class, 'show']);
  Route::post('/stocktransferitem-create', [StockTransferItemController::class, 'store']);
  Route::put('/stocktransferitem-update/{id}', [StockTransferItemController::class, 'update']);
  Route::delete('/stocktransferitem-delete/{id}', [StockTransferItemController::class, 'destroy']);


  //Orders CRUD
  Route::get('/order-view', [OrderController::class, 'index']);
  Route::get('/order-view/{id}', [OrderController::class, 'show']);
  Route::post('/order-create', [OrderController::class, 'store']);
  Route::put('/order-update/{id}', [OrderController::class, 'update']);
  Route::delete('/order-delete/{id}', [OrderController::class, 'destroy']);

  //OrdersItem CRUD
  Route::get('/orderitem -view', [OrderItemController::class, 'index']);
  Route::get('/orderitem-view/{id}', [OrderItemController::class, 'show']);
  Route::post('/orderitem-create', [OrderItemController::class, 'store']);
  Route::put('/orderitem-update/{id}', [OrderItemController::class, 'update']);
  Route::delete('/orderitem-delete/{id}', [OrderItemController::class, 'destroy']);

  //OrderStatus CRUD
  Route::get('/orderstatus-view', [OrderStatusController::class, 'index']);
  Route::get('/orderstatus-view/{id}', [OrderStatusController::class, 'show']);
  Route::post('/orderstatus-create', [OrderStatusController::class, 'store']);
  Route::put('/orderstatus-update/{id}', [OrderStatusController::class, 'update']);
  Route::delete('/orderstatus-delete/{id}', [OrderStatusController::class, 'destroy']);

  //OrdersLog CRUD
  Route::get('/orderlog-view', [OrderLogController::class, 'index']);
  Route::get('/orderlog-view/{id}', [OrderLogController::class, 'show']);
  Route::post('/orderlog-create', [OrderLogController::class, 'store']);
  Route::put('/orderlog-update/{id}', [OrderLogController::class, 'update']);
  Route::delete('/orderlog-delete/{id}', [OrderController::class, 'destroy']);


  //PosController CRUD
  Route::get('/pos-view', [PosController::class, 'index']);
  Route::get('/pos-view/{id}', [PosController::class, 'show']);
  Route::post('/pos-create', [PosController::class, 'store']);
  Route::put('/pos-update/{id}', [PosController::class, 'update']);
  Route::delete('/pos-delete/{id}', [PosController::class, 'destroy']);


  //PosholdItemsController CRUD
  Route::get('/posholditems-view', [PosholdItemsController::class, 'index']);
  Route::get('/posholditems-view/{id}', [PosholdItemsController::class, 'show']);
  Route::post('/posholditems-create', [PosholdItemsController::class, 'store']);
  Route::put('/posholditems-update/{id}', [PosholdItemsController::class, 'update']);
  Route::delete('/posholditems-delete/{id}', [PosholdItemsController::class, 'destroy']);

  //ReportController CRUD 
  Route::post('/timeline/report-view', [ReportController::class, 'time_index']);
  Route::post('/supplier/report-view', [ReportController::class, 'supplier_index']);
  Route::post('/purchase/report-view', [ReportController::class, 'purchase_report']);
  Route::post('/purchaseitem/report-view', [ReportController::class, 'purchase_item']);
  Route::post('/sales/report-view', [ReportController::class, 'sale_report']);
  Route::post('/salestimeline/report-view', [ReportController::class, 'sale_index']);
  Route::post('/salesitem/report-view', [ReportController::class, 'sale_item']);


  //single data view
  Route::get('/items/ind-view', [ItemController::class, 'single_show']);
  Route::get('/brand/ind-view', [BrandController::class, 'single_show']);
  Route::get('/category/ind-view', [CategoryController::class, 'single_show']);
  Route::get('/customer/ind-view', [CustomerController::class, 'single_show']);
  Route::get('/customershipping/ind-view', [CustomerShippingAddressController::class, 'single_show']);
  Route::get('/onesignal/ind-view', [OnesignalIdController::class, 'single_show']);
  Route::get('/order/ind-view', [OrderController::class, 'single_show']);
  Route::get('/orderitem/ind-view', [OrderItemController::class, 'single_show']);
  Route::get('/purchase/ind-view', [PurchaseController::class, 'single_show']);
  Route::get('/purchaseitem/ind-view', [PurchaseItemController::class, 'single_show']);
  Route::get('/sales/ind-view', [SalesController::class, 'single_show']);
  Route::get('/salesitem/ind-view', [SalesItemController::class, 'single_show']);
  Route::get('/store/ind-view', [StoreController::class, 'single_show']);
  Route::get('/supplier/ind-view', [SupplierController::class, 'single_show']);
  Route::get('/warehouse/ind-view', [WarehouseController::class, 'single_show']);
  Route::get('/warehouseitem/ind-view', [WarehouseItemContrtoller::class, 'single_show']);


  //BusinessProfileController
  Route::post('/profile-create', [BusinessProfileController::class, 'store']);
  Route::get('/profile-view/{id}', [BusinessProfileController::class, 'profileshow']);
  Route::put('/profile-update/{id}', [BusinessProfileController::class, 'profileupdate']);

  //NotificationController
  Route::post('/notification-create', [NotificationController::class, 'store']);
  // Route::get('/profile-view/{id}', [NotificationController::class, 'profileshow']);
  // Route::put('/profile-update/{id}', [NotificationController::class, 'profileupdate']); 



  //Unit CRUD 
  Route::get('/unit-view', [UnitsController::class, 'index']);
  // Route::get('/unit-view/{id}', [UnitsController::class, 'show']);
  Route::post('/unit-create', [UnitsController::class, 'store']);
  Route::put('/unit-update/{id}', [UnitsController::class, 'update']);
  Route::delete('/unit-delete/{id}', [UnitsController::class, 'destroy']);

  // Mobile App Sales purchase report controller latest - created by savio

  Route::post('/reports/purchase-report', [storeReportController::class, 'purchase_report']);
  Route::post('/reports/sales-report', [storeReportController::class, 'sales_report']);
  Route::post('/reports/purchase-item-report', [storeReportController::class, 'purchase_item_report']);
  Route::post('/reports/sales-item-report', [storeReportController::class, 'sales_item_report']);
});

//Packages CRUD
Route::get('/packages-view', [PackageController::class, 'index']);
Route::get('/packages-view/{id}', [PackageController::class, 'show']);
Route::post('/packages-create', [PackageController::class, 'store']);
Route::put('/packages-update/{id}', [PackageController::class, 'update']);


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


//Business Type
Route::get('/business-types', [BusinessTypeController::class, 'index']);
