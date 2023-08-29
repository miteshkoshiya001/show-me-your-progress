<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\SettingController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ChallengeController;
use App\Http\Controllers\API\TrendingOfferController;
use App\Http\Controllers\API\DeliveryAddressController;
use App\Http\Controllers\API\StickerCategoryController;
use App\Http\Controllers\api\StickerCollectionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Register user
Route::post('app-register', [AuthController::class, 'store'])->name('user.register');
Route::post('app-login', [AuthController::class, 'login']);

Route::get('cms', [SettingController::class, 'index']);
Route::get('total-user-coupons-order', [AuthController::class, 'countUserDeliveredOrderCoupon']);



Route::group(['middleware' => 'valid.token'], function () {
    Route::get('my-members', [AuthController::class, 'getParentMembers']);
    Route::post('change-password', [AuthController::class, 'changePassword']);
    Route::get('trending-offers', [TrendingOfferController::class, 'index']);
    Route::get('trending-offers/get-pop-up', [TrendingOfferController::class, 'getPopUp']);
    Route::post('user/language/update', [AuthController::class, 'userLanguageUpdate']);
    Route::post('edit/profile', [AuthController::class, 'update']);
    Route::get('wallet-history', [AuthController::class, 'walletHistory']);
    Route::group(['prefix' => 'user-categories'], function () {
        Route::get('list', [CategoryController::class, 'index']);
    });
    Route::group(['prefix' => 'sticker'], function () {
        Route::get('categories-list', [StickerCategoryController::class, 'index']);
        Route::get('collections-list', [StickerCollectionController::class, 'index']);
    });
    Route::group(['prefix' => 'challenges'], function () {
        // Route::get('/', [ChallengeController::class, 'index']);
        // Route::get('/{id}', [ChallengeController::class, 'show']);
        Route::post('create', [ChallengeController::class, 'store']);
        // Route::put('/update/{id}', [ChallengeController::class, 'update']);
        // Route::delete('delete/{id}', [ChallengeController::class, 'destroy']);
    });
    // Category routes

    Route::get('check-delivery-status', [TrendingOfferController::class, 'index']);

    //  Delivery address routes
    Route::get('check-delivery-status', [DeliveryAddressController::class, 'checkDeliveryStatus']);
    Route::group(['prefix' => 'delivery-address'], function () {
        Route::get('list', [DeliveryAddressController::class, 'index']);
        Route::post('create', [DeliveryAddressController::class, 'store']);
        Route::post('update/{id}', [DeliveryAddressController::class, 'update']);
        Route::delete('delete/{id}', [DeliveryAddressController::class, 'destroy']);
        Route::post('mark-as-primary/{id}', [DeliveryAddressController::class, 'markAsPrimary']);
    });

    Route::group(['prefix' => 'product'], function () {
        Route::get('list', [ProductController::class, 'index']);
        Route::get('detail/{id}', [ProductController::class, 'detail']);
        Route::post('add-to-wishlist/{id}', [ProductController::class, 'addToWishlist']);
        Route::post('remove-from-wishlist/{id}', [ProductController::class, 'removeFromWishlist']);
        Route::get('wishlist', [ProductController::class, 'wishlist']);
    });

    Route::group(['prefix' => 'order'], function () {
        Route::get('list', [OrderController::class, 'index']);
        Route::post('create', [OrderController::class, 'store']);
        Route::delete('delete/{id}', [OrderController::class, 'destroy']);
    });

    Route::group(['prefix' => 'delivery/person'], function () {
        Route::get('orders', [OrderController::class, 'deliveryPersonOrders']);
    });
    Route::get('mark-or-as-delivered', [OrderController::class, 'markOrAsDelivered']);

    // Coupon route
    Route::get('my-coupons', [OrderController::class, 'myCoupons']);
    Route::post('coupon/mark-scratched/{id}', [OrderController::class, 'couponMarkScratched']);
});
