<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;


Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
Route::get('/', HomeController::class)->name('home');
Route::get('/produits', [ProductController::class, 'index'])->name('products.index');
Route::get('/produits/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'create'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'store'])->name('login.store');
    });

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::redirect('/', '/admin/produits')->name('dashboard');
        Route::get('/produits', [AdminProductController::class, 'index'])->name('products.index');
        Route::get('/produits/creer', [AdminProductController::class, 'create'])->name('products.create');
        Route::post('/produits', [AdminProductController::class, 'store'])->name('products.store');
        Route::get('/produits/{product}/modifier', [AdminProductController::class, 'edit'])->name('products.edit');
        Route::put('/produits/{product}', [AdminProductController::class, 'update'])->name('products.update');
        Route::patch('/produits/{product}/statut', [AdminProductController::class, 'toggle'])->name('products.toggle');
        Route::delete('/produits/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');

        Route::get('/admins', [AdminUserController::class, 'index'])->name('admins.index');
        Route::get('/admins/creer', [AdminUserController::class, 'create'])->name('admins.create');
        Route::post('/admins', [AdminUserController::class, 'store'])->name('admins.store');
        Route::get('/admins/{adminUser}/modifier', [AdminUserController::class, 'edit'])->name('admins.edit');
        Route::put('/admins/{adminUser}', [AdminUserController::class, 'update'])->name('admins.update');
        Route::patch('/admins/{adminUser}/statut', [AdminUserController::class, 'toggle'])->name('admins.toggle');
        Route::delete('/admins/{adminUser}', [AdminUserController::class, 'destroy'])->name('admins.destroy');
    });

    Route::post('/logout', [AdminAuthController::class, 'destroy'])->middleware('auth')->name('logout');
});

// apartment
Route::get('/apartment/left', function () {
    return view('apartment.left');
});
Route::get('/apartment/right', function () {
    return view('apartment.right');
});
Route::get('/apartment/single', function () {
    return view('apartment.single');
});
Route::get('/apartment/v1', function () {
    return view('apartment.v1');
});
Route::get('/apartment/v2', function () {
    return view('apartment.v2');
});
Route::get('/apartment/v3', function () {
    return view('apartment.v3');
});
Route::get('/apartment/v4', function () {
    return view('apartment.v4');
});
Route::get('/apartment/v5', function () {
    return view('apartment.v5');
});
Route::get('/apartment/v6', function () {
    return view('apartment.v6');
});

// blogs
Route::get('/blogs/blog', function () {
    return view('blogs.blog');
});
Route::get('/blogs/left', function () {
    return view('blogs.left');
});
Route::get('/blogs/right', function () {
    return view('blogs.right');
});
Route::get('/blogs/single', function () {
    return view('blogs.single');
});

// demo
Route::get('/demo/index2', function () {
    return view('demo.index2');
});
Route::get('/demo/index3', function () {
    return view('demo.index3');
});
Route::get('/demo/index4', function () {
    return view('demo.index4');
});
Route::get('/demo/index5', function () {
    return view('demo.index5');
});
Route::get('/demo/index6', function () {
    return view('demo.index6');
});
Route::get('/demo/index7', function () {
    return view('demo.index7');
});
Route::get('/demo/index8', function () {
    return view('demo.index8');
});
Route::get('/demo/index9', function () {
    return view('demo.index9');
});
Route::get('/demo/index10', function () {
    return view('demo.index10');
});

// pages
Route::get('/pages/about', function () {
    return view('pages.about');
});
Route::get('/pages/contact', function () {
    return view('pages.contact');
});
Route::get('/pages/gallery-v1', function () {
    return view('pages.gallery-v1');
});
Route::get('/pages/gallery-v2', function () {
    return view('pages.gallery-v2');
});
Route::get('/pages/testimonial', function () {
    return view('pages.testimonial');
});

// single
Route::get('/single/index1', function () {
    return view('single.index1');
});
Route::get('/single/index2', function () {
    return view('single.index2');
});
Route::get('/single/index3', function () {
    return view('single.index3');
});
Route::get('/single/index4', function () {
    return view('single.index4');
});
Route::get('/single/index5', function () {
    return view('single.index5');
});
Route::get('/single/index6', function () {
    return view('single.index6');
});
Route::get('/single/index7', function () {
    return view('single.index7');
});
Route::get('/single/index8', function () {
    return view('single.index8');
});
Route::get('/single/index9', function () {
    return view('single.index9');
});
Route::get('/single/index10', function () {
    return view('single.index10');
});
