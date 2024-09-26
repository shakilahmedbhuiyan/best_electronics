<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Livewire\Guest\Index::class)->name('index');
Route::get('/{category}', App\Livewire\Guest\Index::class .'@category')->name('index.category');

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

    Route::middleware(['permission:product-list'])
        ->get('/products', \App\Livewire\Dash\Products\Index::class)->name('product.index');
    Route::middleware(['permission:product-create'])
        ->get('/products/create', \App\Livewire\Dash\Products\Create::class)->name('product.create');
    Route::middleware(['permission:product-edit'])
        ->get('/product/update/{product}', \App\Livewire\Dash\Products\Update::class)->name('product.update');
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

