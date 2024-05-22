<?php

use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminPaymentController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminSiteSettingController;
use App\Http\Controllers\AdminTagController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedsysController;
use App\Http\Controllers\AdminShippingOptionController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

//Route::middleware([
//    'auth:sanctum',
//    config('jetstream.auth_session'),
//    'verified',
//])->group(function () {
//    Route::get('/dashboard', function () {
//        return Inertia::render('Dashboard');
//    })->name('dashboard');
//});

Route::middleware(['auth'])->group(function () {
    Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::get('/wishlist/check/{productId}', [WishlistController::class, 'check'])->name('wishlist.check');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/wishlist', [ProfileController::class, 'wishlist'])->name('profile.wishlist');
    Route::get('/profile/orders', [ProfileController::class, 'orders'])->name('profile.orders');

    Route::prefix('profile/addresses')->name('profile.addresses.')->group(function () {
        Route::get('/', [AddressController::class, 'index'])->name('index');
        Route::get('/create/{type?}', [AddressController::class, 'create'])->name('create');
        Route::post('/', [AddressController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AddressController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AddressController::class, 'update'])->name('update');
        Route::delete('/{id}', [AddressController::class, 'destroy'])->name('destroy');
    });
});



// Login with Google Account routes

Route::get('/google/redirect', [SocialiteController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [SocialiteController::class, 'handleGoogleCallback'])->name('google.callback');

Route::prefix('redsys')->group(function () {
    Route::get('/', [RedsysController::class, 'index']);
    Route::post('/notification', [RedsysController::class, 'notification']);
    Route::get('/success', [RedsysController::class, 'success'])->name('redsys.success');
    Route::get('/error', [RedsysController::class, 'error'])->name('redsys.error');
});


Route::get('/redsys/success', [RedsysController::class, 'success'])->name('redsys.success');
Route::get('/redsys/error', [RedsysController::class, 'error'])->name('redsys.error');

Route::middleware(['auth'])->group(function () {

    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/add', [CartController::class, 'addToCart'])->name('cart.address');
        Route::patch('/update/{detail}', [CartController::class, 'updateCartDetail'])->name('cart.update');
        Route::delete('/remove/{detail}', [CartController::class, 'destroyCartDetail'])->name('cart.destroy');
        Route::get('/get', [CartController::class, 'getCart'])->name('cart.get');
        Route::post('/clear', [CartController::class, 'clearCart'])->name('cart.clear');

        Route::get('/address', [CheckoutController::class, 'address'])->name('cart.address');
        Route::post('/address/save', [CheckoutController::class, 'saveAddress'])->name('cart.address.save');
        Route::get('/shipping', [CheckoutController::class, 'shipping'])->name('cart.shipping');
        Route::post('/shipping/save', [CheckoutController::class, 'saveShippingOption'])->name('cart.shipping.save');
        Route::get('/payment', [CheckoutController::class, 'payment'])->name('cart.payment');
        Route::get('/success', [OrderController::class, 'success'])->name('cart.success');

    });

    // Address routes

    Route::get('/addresses', [AddressController::class, 'index'])->name('addresses.index');
    Route::get('/addresses/create/{type}', [AddressController::class, 'create'])->name('addresses.create');
    Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');
    Route::get('/addresses/{id}/edit', [AddressController::class, 'edit'])->name('addresses.edit');
    Route::put('/addresses/{id}', [AddressController::class, 'update'])->name('addresses.update');
    Route::delete('/addresses/{id}', [AddressController::class, 'destroy'])->name('addresses.destroy');



});

Route::get('/', [SiteController::class, 'index'])->name('welcome');
Route::get('/search-products', [SiteController::class, 'search'])->name('search.products');


Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
Route::get('/categories/{category:slug}', [CategoriesController::class, 'show'])->name('categories.show');


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::middleware(['admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('admin.dashboard');

    // admin products route

    Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [AdminProductController::class, 'store'])->name('admin.products.store');
    //Route::get('/admin/products/{id}', [AdminProductController::class, 'show'])->name('admin.products.show');
    Route::get('/admin/products/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{id}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');

    Route::get('/admin/products/favorite', [AdminProductController::class, 'favoriteIndex'])->name('admin.favorite.products.index');
    Route::get('/admin/products/favorite/manage', [AdminProductController::class, 'favoriteManage'])->name('admin.favorite.products.manage');
    Route::put('/admin/products/favorite/save', [AdminProductController::class, 'favoriteStore'])->name('admin.favorite.products.save');


    // admin categories route

    Route::get('/admin/categories', [AdminCategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/admin/categories/create', [AdminCategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/admin/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');

    //Route::get('/admin/categories/{id}', [AdminCategoryController::class, 'show'])->name('admin.categories.show');

    Route::get('/admin/categories/{id}/edit', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/admin/categories/{id}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{id}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');

    //featured

    Route::get('/admin/categories/featured', [AdminCategoryController::class, 'featuredIndex'])->name('admin.featured.categories.index');
    Route::get('/admin/categories/featured/manage', [AdminCategoryController::class, 'featuredManage'])->name('admin.categories.featured.manage');
    Route::put('/admin/categories/featured/save', [AdminCategoryController::class, 'featuredStore'])->name('admin.categories.featured.store');

    // admin tags route

    Route::get('/admin/tags', [AdminTagController::class, 'index'])->name('admin.tags.index');
    Route::get('/admin/tags/create', [AdminTagController::class, 'create'])->name('admin.tags.create');
    Route::post('/admin/tags', [AdminTagController::class, 'store'])->name('admin.tags.store');
    //Route::get('/admin/tags/{id}', [AdminTagController::class, 'show'])->name('admin.tags.show');
    Route::get('/admin/tags/{id}/edit', [AdminTagController::class, 'edit'])->name('admin.tags.edit');
    Route::put('/admin/tags/{id}', [AdminTagController::class, 'update'])->name('admin.tags.update');
    Route::delete('/admin/tags/{id}', [AdminTagController::class, 'destroy'])->name('admin.tags.destroy');

    // admin users route

    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    //Route::get('/admin/users/{id}', [AdminUserController::class, 'show'])->name('admin.users.show');
    Route::get('/admin/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');

    // admin shipping options route

    Route::get('/admin/shipping-options', [AdminShippingOptionController::class, 'index'])->name('admin.shipping-options.index');
    Route::get('/admin/shipping-options/create', [AdminShippingOptionController::class, 'create'])->name('admin.shipping-options.create');
    Route::post('/admin/shipping-options', [AdminShippingOptionController::class, 'store'])->name('admin.shipping-options.store');
    //Route::get('/admin/shipping-options/{id}', [AdminShippingOptionController::class, 'show'])->name('admin.shipping-options.show');
    Route::get('/admin/shipping-options/{id}/edit', [AdminShippingOptionController::class, 'edit'])->name('admin.shipping-options.edit');
    Route::put('/admin/shipping-options/{id}', [AdminShippingOptionController::class, 'update'])->name('admin.shipping-options.update');
    Route::delete('/admin/shipping-options/{id}', [AdminShippingOptionController::class, 'destroy'])->name('admin.shipping-options.destroy');

    // admin orders route

    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');

    // admin payments route

    Route::get('/admin/payments', [AdminPaymentController::class, 'index'])->name('admin.payments.index');

    // admin site settings route

    Route::get('/admin/site-settings', [AdminSiteSettingController::class, 'index'])->name('admin.site-settings.index');
    Route::post('/admin/site-settings/update', [AdminSiteSettingController::class, 'update'])->name('admin.site-settings.update');
});

