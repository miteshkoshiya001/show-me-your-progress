<?php

use App\Helpers\Helper;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TendingOffer;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UOMController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CommonActionController;
use App\Http\Controllers\Admin\TrendingOfferController;
use App\Http\Controllers\Admin\DeliveryAddressController;
use App\Http\Controllers\Admin\StickerCategoryController;
use App\Http\Controllers\Admin\AvailableZipcodeController;
use App\Http\Controllers\Admin\StickerCollectionController;

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

Route::multilingual('/', [HomeController::class, 'index'])->names(Helper::getMultiLangRoute('landing.page'));
Route::multilingual('/privacy-policy', [HomeController::class, 'privacyPolicy'])->names(Helper::getMultiLangRoute('privacy.policy'));
Route::multilingual('/terms-and-conditions', [HomeController::class, 'tnc'])->names(Helper::getMultiLangRoute('tnc'));

Route::multilingual('/password/forgot', [PasswordController::class, 'index'])->names(Helper::getMultiLangRoute('password.forgot'));
Route::multilingual('/password-forgot/change', [PasswordController::class, 'change'])->method('post')->names(Helper::getMultiLangRoute('save.password.forgot'));
Route::multilingual('/password/forgot/success', [PasswordController::class, 'passwordForgotSuccess'])->names(Helper::getMultiLangRoute('password.forgot.success'));

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::multilingual('/dashboard', [DashboardController::class, 'index'])->names(Helper::getMultiLangRoute('dashboard'));
    Route::multilingual('/analytics', [DashboardController::class, 'analytics'])->method('post')->names(Helper::getMultiLangRoute('analytics'));

    // User routes
    Route::group(['prefix' => 'user'], function () {
        Route::multilingual('', [UserController::class, 'index'])->names(Helper::getMultiLangRoute('users'));
        Route::multilingual('/{id}', [UserController::class, 'show'])->names(Helper::getMultiLangRoute('users.show'));
        Route::multilingual('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::multilingual('/{id}', [UserController::class, 'update'])->name('users.update')->method('POST');
        // Route::multilingual('/{id}', [UserController::class, 'destroy'])->name('users.destroy')->method('delete');
    });

    // profile
    Route::group(['prefix' => 'profile'], function () {
        Route::multilingual('', [ProfileController::class, 'index'])->names(Helper::getMultiLangRoute('admin.profile'));
        Route::post('change-password', [ProfileController::class, 'ChangePassword'])->name('admin.profile.changePassword');

        // Route::multilingual('/{id}', [UserController::class, 'destroy'])->name('users.destroy')->method('delete');
    });
    // Category routes
    Route::group(['prefix' => 'category'], function () {
        Route::multilingual('', [CategoryController::class, 'index'])->names(Helper::getMultiLangRoute('categories'));
        Route::multilingual('create', [CategoryController::class, 'create'])->names(Helper::getMultiLangRoute('create.category'));
        Route::multilingual('edit/{id}', [CategoryController::class, 'edit'])->names(Helper::getMultiLangRoute('edit.category'));
        Route::multilingual('store', [CategoryController::class, 'store'])->method('post')->names(Helper::getMultiLangRoute('store.category'));
        Route::multilingual('sorting', [CategoryController::class, 'sorting'])->names(Helper::getMultiLangRoute('sorting.category'));
        Route::multilingual('update-sorting', [CategoryController::class, 'updateSorting'])->method('post')->names(Helper::getMultiLangRoute('update.sorting.category'));
        Route::multilingual('update-sorting/product', [CategoryController::class, 'updateSortingProduct'])->method('post')->names(Helper::getMultiLangRoute('update.sorting.product.category'));
        Route::multilingual('sorting/list/{id}', [CategoryController::class, 'productSortingList'])->names(Helper::getMultiLangRoute('product.sorting.list.category'));
    });

    Route::group(['prefix' => 'sticker-categories'], function () {
        Route::multilingual('', [StickerCategoryController::class, 'index'])->names(Helper::getMultiLangRoute('sticker-categories'));
        Route::multilingual('create', [StickerCategoryController::class, 'create'])->names(Helper::getMultiLangRoute('create.sticker-category'));
        Route::multilingual('edit/{id}', [StickerCategoryController::class, 'edit'])->names(Helper::getMultiLangRoute('edit.sticker-category'));
        Route::multilingual('store', [StickerCategoryController::class, 'store'])->method('post')->names(Helper::getMultiLangRoute('store.sticker-category'));
        Route::multilingual('{id}', [StickerCategoryController::class, 'update'])->method('put')->names(Helper::getMultiLangRoute('update.sticker-category'));
        Route::multilingual('{id}', [StickerCategoryController::class, 'destroy'])->names(Helper::getMultiLangRoute('delete.sticker-category'));
    });

    Route::group(['prefix' => 'sticker-collection'], function () {
        Route::multilingual('', [StickerCollectionController::class, 'index'])->names(Helper::getMultiLangRoute('sticker-collection.index'));
        Route::multilingual('create', [StickerCollectionController::class, 'create'])->names(Helper::getMultiLangRoute('sticker-collection.create'));
        Route::multilingual('edit/{id}', [StickerCollectionController::class, 'edit'])->names(Helper::getMultiLangRoute('sticker-collection.edit'));
        Route::multilingual('store', [StickerCollectionController::class, 'store'])->method('post')->names(Helper::getMultiLangRoute('sticker-collection.store'));
        Route::multilingual('{id}', [StickerCollectionController::class, 'update'])->method('put')->names(Helper::getMultiLangRoute('sticker-collection.update'));
        Route::multilingual('{id}', [StickerCollectionController::class, 'destroy'])->names(Helper::getMultiLangRoute('sticker-collection.destroy'));
    });
    // Product routes
    Route::group(['prefix' => 'product'], function () {
        Route::multilingual('', [ProductController::class, 'index'])->names(Helper::getMultiLangRoute('products'));
        Route::multilingual('create', [ProductController::class, 'create'])->names(Helper::getMultiLangRoute('create.product'));
        Route::multilingual('edit/{id}', [ProductController::class, 'edit'])->names(Helper::getMultiLangRoute('edit.product'));
        Route::multilingual('store', [ProductController::class, 'store'])->method('post')->names(Helper::getMultiLangRoute('store.product'));
        Route::post('store-images/{id}', [ProductController::class, 'storeImages'])->name('store.images.product');
        Route::get('images/{id}', [ProductController::class, 'productImages'])->name('images.product');
    });
    // UOM routes
    Route::group(['prefix' => 'units-of-measurement'], function () {
        Route::multilingual('', [UOMController::class, 'index'])->names(Helper::getMultiLangRoute('uoms'));

        Route::multilingual('store', [UOMController::class, 'store'])->method('post')->names(Helper::getMultiLangRoute('store.uom'));
    });

    // Trending offer routes
    Route::group(['prefix' => 'trending-offer'], function () {
        Route::multilingual('', [TrendingOfferController::class, 'index'])->names(Helper::getMultiLangRoute('trending.offers'));
        Route::multilingual('create', [TrendingOfferController::class, 'create'])->names(Helper::getMultiLangRoute('create.trending.offer'));
        Route::multilingual('edit/{id}', [TrendingOfferController::class, 'edit'])->names(Helper::getMultiLangRoute('edit.trending.offer'));
        Route::multilingual('store', [TrendingOfferController::class, 'store'])->method('post')->names(Helper::getMultiLangRoute('store.trending.offer'));
    });

    // Delivery address routes
    Route::group(['prefix' => 'delivery-address'], function () {
        Route::multilingual('', [DeliveryAddressController::class, 'index'])->names(Helper::getMultiLangRoute('delivery.address'));
    });

    // Zipcode routes
    Route::group(['prefix' => 'available-zipcodes'], function () {
        Route::multilingual('', [AvailableZipcodeController::class, 'index'])->names(Helper::getMultiLangRoute('available.zipcodes'));
        Route::multilingual('store', [AvailableZipcodeController::class, 'store'])->method('post')->names(Helper::getMultiLangRoute('store.available.zipcodes'));
    });

    // Setting routes
    Route::group(['prefix' => 'setting'], function () {
        Route::multilingual('', [SettingController::class, 'index'])->names(Helper::getMultiLangRoute('setting'));
        Route::multilingual('store', [SettingController::class, 'store'])->method('post')->names(Helper::getMultiLangRoute('store.setting'));
    });

    // Order routes
    Route::group(['prefix' => 'order'], function () {
        Route::multilingual('', [OrderController::class, 'index'])->names(Helper::getMultiLangRoute('orders'));
        Route::multilingual('list', [OrderController::class, 'orderList'])->names(Helper::getMultiLangRoute('order.list'));
        Route::multilingual('status-change', [OrderController::class, 'statusChange'])->method('post')->names(Helper::getMultiLangRoute('status.change'));
        Route::multilingual('assigned-id', [OrderController::class, 'assignedId'])->method('post')->names(Helper::getMultiLangRoute('assigned.id'));
        Route::multilingual('details', [OrderController::class, 'show'])->method('post')->names(Helper::getMultiLangRoute('order.details'));
    });

    Route::group(['prefix' => 'purchase'], function () {
        Route::multilingual('', [PurchaseController::class, 'index'])->names(Helper::getMultiLangRoute('purchases'));
        Route::multilingual('store', [PurchaseController::class, 'store'])->method('post')->names(Helper::getMultiLangRoute('store.purchase'));
    });

    Route::multilingual('/contact-form-data', [ContactFormController::class, 'showData'])->names(Helper::getMultiLangRoute('contact.data'));

    Route::delete("delete-item", [CommonActionController::class, "destroy"])->name('delete.item');
});

Route::middleware('auth')->group(function () {
    Route::multilingual('/profile', [ProfileController::class, 'edit'])->names(Helper::getMultiLangRoute('profile.edit'));
    Route::multilingual('/profile', [ProfileController::class, 'update'])->method('patch')->names(Helper::getMultiLangRoute('profile.update'));
    Route::multilingual('/profile', [ProfileController::class, 'destroy'])->method('delete')->names(Helper::getMultiLangRoute('profile.destroy'));
});

Route::get('/job/mark-coupon-as-expired', function () {
    if (request()->has('start') && request()->get('start') == 'MM') {
        Artisan::call('schedule:work');
    }
    return 'Scheduler executed.';
});



require __DIR__ . '/auth.php';

Route::multilingual('/contact', [ContactFormController::class, 'submitForm'])->method('post')->names(Helper::getMultiLangRoute('contact.submit'));
