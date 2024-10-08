<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Livewire\Guest\Index::class)->name('index');
Route::get('/pay-later', App\Livewire\Guest\Pages\BuyNow::class)->name('pay-later');
Route::get('/category/{category}', App\Livewire\Guest\Index::class .'@category')->name('index.category');
Route::get('/product/{product}', App\Livewire\Guest\Product\Single::class)->name('product.single');
Route::get('/products/all', App\Livewire\Guest\Product\Index::class)->name('products.all');
Route::get('/products/search/{search}', App\Livewire\Guest\Product\Search::class)->name('products.search');
Route::get('/shop', App\Livewire\Guest\Product\Index::class);
Route::get('/about', App\Livewire\Guest\Pages\BuyNow::class)->name('about');


Route::get('/checkout/cart', App\Livewire\Guest\Order\Cart::class)->name('cart');
Route::get('/checkout', App\Livewire\Guest\Order\Checkout::class)->name('checkout');
Route::get('/checkout/successful/{order}', App\Livewire\Guest\Order\Successful::class)->name('checkout.success');

/**
 * Admin Routes
 */
Route::group([
    'middleware' => ['auth:sanctum', 'auth:web', config('jetstream.auth_session'), 'verified'],
    'prefix' => 'admin',
    'as' => 'admin.',
], static function () {
    Route::get('/dashboard', \App\Livewire\Dash\Dashboard::class)->name('dashboard');

    Route::middleware(['permission:role-list'])
        ->get('/roles', \App\Livewire\Dash\Admin\Roles\Index::class)->name('roles.index');
    Route::middleware(['permission:role-create'])
        ->get('/roles/create', \App\Livewire\Dash\Admin\Roles\Create::class)->name('roles.create');
    Route::middleware(['permission:role-edit'])
        ->get('/roles/{role}/update', \App\Livewire\Dash\Admin\Roles\Update::class)->name('roles.update');

    Route::middleware(['permission:user-list'])
        ->get('/users', \App\Livewire\Dash\Admin\Users\Index::class)->name('users.index');

    Route::middleware(['permission:category-list'])
        ->get('/categories', \App\Livewire\Dash\Category\Index::class)->name('category.index');
    Route::middleware(['permission:category-create'])
        ->get('/categories/create', \App\Livewire\Dash\Category\Create::class)->name('category.create');
    Route::middleware(['permission:brand-list'])
        ->get('/brands/', \App\Livewire\Dash\Brand\Index::class)->name('brand.index');
    Route::middleware(['permission:brand-create'])
        ->get('/brands/create', \App\Livewire\Dash\Brand\Create::class)->name('brand.create');
    Route::middleware(['permission:brand-update'])
        ->get('/brands/update/{brand}', \App\Livewire\Dash\Brand\Update::class)->name('brand.update');

    Route::middleware(['permission:product-list'])
        ->get('/products', \App\Livewire\Dash\Products\Index::class)->name('product.index');
    Route::middleware(['permission:product-create'])
        ->get('/products/create', \App\Livewire\Dash\Products\Create::class)->name('product.create');
    Route::middleware(['permission:product-edit'])
        ->get('/product/update/{product}', \App\Livewire\Dash\Products\Update::class)->name('product.update');

    Route::middleware(['permission:slider-list'])
        ->get('/sliders', \App\Livewire\Dash\Home\Slider\Index::class)->name('slider.index');
    Route::middleware(['permission:slider-create'])
        ->get('/sliders/create', \App\Livewire\Dash\Home\Slider\Create::class)->name('slider.create');
    Route::middleware(['permission:slider-update'])
        ->get('/sliders/update/{slider}', \App\Livewire\Dash\Home\Slider\Update::class)->name('slider.update');

    Route::middleware(['permission:store-info'])
        ->get('/store/info', \App\Livewire\Dash\Store\Info::class)->name('store.info');

     Route::middleware(['permission:order-list'])
        ->get('/orders/pending', \App\Livewire\Dash\Order\Pending::class)->name('order.pending');
    Route::middleware(['permission:order-list'])
        ->get('/orders', \App\Livewire\Dash\Order\Index::class)->name('order.index');
    Route::middleware(['permission:order-view'])
        ->get('/order/show/{order}', \App\Livewire\Dash\Order\Show::class)->name('order.show');

});

// /**
//  * User Routes
//  */
// Route::group([
//     'middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified'],
//     'prefix' => 'user',
//     'as' => 'user.',
// ], static function () {
//     Route::get('/profile', \App\Livewire\User\Profile\Show::class)->name('profile.show');

// });

