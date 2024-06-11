<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReviewController;


Route::get('/', [ProductController::class, 'index'])->name('home');

//admin
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/products/delete', [ProductController::class, 'deletePage'])->name('products.delete');
Route::delete('/products/destroy', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::get('/products/index1', [ProductController::class, 'index1'])->name('products.index1'); 
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

// Корзина
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

// Заказы
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::delete('/orders/{orderId}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

// Продукты
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// Регистрация и вход
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// User
Route::get('/users/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
Route::put('/users/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');

// Уведомления
Route::get('/notifications/list', [NotificationController::class, 'list'])->name('notifications.list');

// Отзывы
Route::post('/submit-review', [ReviewController::class, 'submitReview'])->name('submit_review');