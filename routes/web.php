<?php

use App\Http\Controllers\Admin\FrontendController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Favorite\FavoriteController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

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
//Admin Controller
Route::get('/admin/login',[AdminController::class, 'adminLoginPage']);
Route::post('/admin/login',[AdminController::class, 'adminLogin']);


Route::middleware(['admin'])->group(function () {
    
    //Admin Controller
    Route::get('/admin/dashboard',[AdminController::class, 'showDashboard']);
    Route::get('/logout',[AdminController::class, 'logout']);

    //Category Controller
    Route::get('/category/add',[CategoryController::class, 'addCategory']);
    Route::post('/category/store',[CategoryController::class, 'storeCategory']);
    Route::get('/category/manage',[CategoryController::class, 'manageCategory']);
    Route::get('/category/edit/{id}',[CategoryController::class, 'editCategory']);
    Route::post('/category/update/{id}',[CategoryController::class, 'updateCategory']);
    Route::get('/category/delete/{id}',[CategoryController::class, 'deleteCategory']);
    Route::get('/category/active/{id}',[CategoryController::class, 'activeCategory']);
    Route::get('/category/inactive/{id}',[CategoryController::class, 'inactiveCategory']);

    //TypeController
    Route::get('/type/add',[TypeController::class, 'addType']);
    Route::post('/type/store',[TypeController::class, 'storeType']);
    Route::get('/type/manage',[TypeController::class, 'manageType']);
    Route::get('/type/edit/{id}',[TypeController::class, 'editType']);
    Route::post('/type/update/{id}',[TypeController::class, 'updateType']);
    Route::get('/type/delete/{id}',[TypeController::class, 'deleteType']);


    //BrandController
    Route::get('/brand/add', [BrandController::class, 'showBrandForm']);
    Route::post('/brand/store', [BrandController::class, 'brandStore']);
    Route::get('/brand/manage', [BrandController::class, 'brandManage']);
    Route::get('/brand/edit/{id}', [BrandController::class, 'brandEdit']);
    Route::post('/brand/update/{id}', [BrandController::class, 'brandUpdate']);
    Route::get('/brand/inactive/{id}', [BrandController::class, 'brandInactive']);
    Route::get('/brand/active/{id}', [BrandController::class, 'brandActive']);
    Route::get('/brand/delete/{id}', [BrandController::class, 'brandDelete']);


    //ProductController
    Route::get('/product/add', [ProductController::class, 'addProduct']);
    Route::post('/product/store', [ProductController::class, 'storeProduct']);
    Route::get('/product/manage', [ProductController::class, 'manageProduct']);
    Route::get('/product/edit/{id}', [ProductController::class, 'editProduct']);
    Route::post('/product/update/{id}', [ProductController::class, 'updateProduct']);



});


//FronendController
Route::get('/',[FrontendController::class,'index']);
Route::get('/category/{id}/{slug}',[FrontendController::class,'store']);
Route::get('/new-product/{id}/{slug}',[FrontendController::class,'newProductCategory']);
Route::get('/top-selling-product/{id}/{slug}',[FrontendController::class,'topProductCategory']);
Route::get('/product-details/{id}/{slug}',[FrontendController::class,'productDetails']);

//FavoriteController
Route::post('/add/to/favorite',[FavoriteController::class,'addToFavorite']);
Route::get('/favourite/{id}',[FavoriteController::class,'userfavouriteList']);
Route::get('/favourite',[FavoriteController::class,'favouriteList']);
Route::get('/remove/from/favorite/{id}',[FavoriteController::class,'deleteFromFavorite']);



//UserController
Route::get('/register',[UserController::class,'userRegisterPage']);
Route::get('/login',[UserController::class,'userLoginPage']);
Route::post('/user-register',[UserController::class,'userRegister']);
Route::post('/user-login',[UserController::class,'userLogin']);
Route::get('/user-logout',[UserController::class,'userLogout']);
