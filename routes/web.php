<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CatagoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\StateController as UserStateController;
use App\Http\Controllers\CityController as UserCityController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MailController;

Route::get('/test',[MailController::class,'sendMail']);


// Route::get('/', function () {
//     return view('welcome');
// });

// Language controllers
Route::post('change/language',[FrontEndController::class,'changeLanguage'])->name('changeLanguage');


Route::get('/wishlist',[WishlistController::class,'index'])->name('wishlist-index');
Route::post('/wishlist/store',[WishlistController::class,'store'])->name('wishlist-store');
Route::get('/wishlist/delete',[WishlistController::class,'destroy'])->name('wishlist-delete');
Route::get('/wishlist/count',[WishlistController::class,'count'])->name('wishlist-count');

// Route for user when click a country then show its state
Route::get('/user-state',[UserStateController::class,'index'])->name('user-state');
// Route for user when click a country then show its city
Route::get('/user-city',[UserCityController::class,'index'])->name('user-city');

Route::get('/',[FrontEndController::class,'index'])->name('homepage');
// Get product of specific catagory by using catagory id
Route::get('/catagory/products/{id}',[FrontEndController::class,'searchCatagoryProduct'])->name('catagory-product');
// Get product detail by using product id
Route::get('/product-detail/{productSlug}/{id}',[FrontEndController::class,'productDetail'])->name('product-detail');
// Get all products in the cart of a specific user
Route::get('/cart',[CartController::class,'index'])->name('cart-index');
// Store new product in the cart
Route::post('/cart/store',[CartController::class,'addProductToCart'])->name('cart-store');
// Delete a product from the cart
Route::delete('/cart/delete/{id}',[CartController::class,'destroy'])->name('cart-delete');
// Get all products in the cart of a specific user by ajax call
Route::get('/cart/products',[CartController::class,'searchCartRecord'])->name('cart-product');
// Count products in the cart of a specific user by ajax call
Route::get('/cart/count',[CartController::class,'countCartProduct'])->name('cart-count');
// Update cart products in the cart of a specific user by ajax call
Route::put('/cart/update/{id}',[CartController::class,'update'])->name('cart-update');
// Count cart total price 
Route::get('/cart/price',[CartController::class,'cartTotalPrice'])->name('cart-total-price');

// Call to checkout controller
Route::get('/checkout',[CheckoutController::class,'index'])->name('checkout-index');

// Place user order 
Route::get('/place/order',[CheckoutController::class,'placeOrder'])->name('place-order');
// Payment page for paypall
Route::get('/payment/{orderid}',[PaymentController::class,'index'])->name('payment-index');
Route::put('/payment/update/{orderid}',[PaymentController::class,'updateOrderPayment'])->name('payment-update');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Routes for user to change their profile detail
Route::get('/user/profile/{id}',[UserController::class,'viewProfile'])->name('view-user-profile');
Route::get('/user/edit/profile/{id}',[UserController::class,'editProfile'])->name('edit-user-profile');
Route::get('/user/edit/password/{id}',[UserController::class,'editPassword'])->name('edit-user-password');
Route::get('/user/edit/photo/{id}',[UserController::class,'editPhoto'])->name('edit-user-photo');
Route::post('/user/delete/{id}',[UserController::class,'destroy'])->name('delete-user-profile');
Route::put('/user/update/profile/{id}',[userController::class,'updateProfile'])->name('update-user-profile');
Route::put('/user/update/password/{id}',[userController::class,'updatePassword'])->name('update-user-password');
Route::put('/user/update/photo/{id}',[userController::class,'updatePhoto'])->name('update-user-photo');
Route::put('/user/update/status/{id}',[userController::class,'updateStatus'])->name('update-user-status');


// Routes for admin
Route::middleware(['auth','isAdmin'])->group(function()
{
Route::get('/dashboard',[AdminController::class,'index'])->name('dashboard');
// Routes for catagory
Route::get('/catagory',[CatagoryController::class,'index'])->name('catagory-index');
Route::get('/catagory/create',[CatagoryController::class,'create'])->name('catagory-create');
Route::post('/catagory/store',[CatagoryController::class,'store'])->name('catagory-store');
Route::get('/catagory/delete/{id}',[CatagoryController::class,'destroy'])->name('catagory-delete');
Route::get('/catagory/edit/{id}',[CatagoryController::class,'edit'])->name('catagory-edit');
Route::put('/catagory/update/{id}',[CatagoryController::class,'update'])->name('catagory-update');

// Routes for product
Route::get('/product',[ProductController::class,'index'])->name('product-index');
Route::get('/product/create',[ProductController::class,'create'])->name('product-create');
Route::post('/product/store',[ProductController::class,'store'])->name('product-store');
Route::get('/product/delete/{id}',[ProductController::class,'destroy'])->name('product-delete');
Route::get('/product/edit/{id}',[ProductController::class,'edit'])->name('product-edit');
Route::put('/product/update/{id}',[ProductController::class,'update'])->name('product-update');

// Routes for order by admin
Route::get('/order',[OrderController::class,'index'])->name('order-index');
Route::get('/order/pending',[OrderController::class,'orderPending'])->name('order-pending');
Route::get('/order/shipped',[OrderController::class,'orderShipped'])->name('order-shipped');
Route::get('/order/delivered',[OrderController::class,'orderDelivered'])->name('order-delivered');
Route::get('/order/{id}',[OrderController::class,'orderDetail'])->name('order-detail');
Route::put('/order/status/{id}',[OrderController::class,'updateOrder'])->name('update-order-status');

// Route for admin for user View, Edit, Update and Delete 
Route::get('/user',[UserController::class,'index'])->name('user-index');
Route::get('/user/create',[UserController::class,'create'])->name('user-create');
Route::post('/user/store',[UserController::class,'store'])->name('user-store');

// Routes for admin for user role
Route::get('/role',[RoleController::class,'index'])->name('role-index');
Route::get('/role/create',[RoleController::class,'create'])->name('role-create');
Route::post('/role/store',[RoleController::class,'store'])->name('role-store');
Route::get('/role/edit/{id}',[RoleController::class,'edit'])->name('role-edit');
Route::put('/role/update/{id}',[RoleController::class,'update'])->name('role-update');
Route::get('/role/delete/{id}',[RoleController::class,'destroy'])->name('role-delete');

// Manage countries from API
Route::get('/country',[CountryController::class,'index'])->name('country-index');
Route::get('/state',[StateController::class,'index'])->name('state-index');
Route::get('/city',[CityController::class,'index'])->name('city-index');
Route::get('/country/create',[CountryController::class,'create'])->name('country-create');
Route::get('/state/create',[StateController::class,'create'])->name('state-create');
Route::get('/city/create',[CityController::class,'create'])->name('city-create');
Route::post('/country/store',[CountryController::class,'store'])->name('country-store');
Route::post('/state/store',[StateController::class,'store'])->name('state-store');
Route::post('/city/store',[CityController::class,'store'])->name('city-store');
Route::get('/country/delete/{id}',[CountryController::class,'destroy'])->name('country-delete');
Route::get('/state/delete/{id}',[StateController::class,'destroy'])->name('state-delete');
Route::get('/city/delete/{id}',[CityController::class,'destroy'])->name('city-delete');

});