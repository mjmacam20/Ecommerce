<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    // Admin Login Route without admin group
    Route::match(['get','post'], 'login','AdminController@login');
    Route::group(['middleware'=>['admin']],function(){
    // Admin Dashboard Route without admin group
    Route::get('dashboard','AdminController@dashboard');
    // Update Admin Password
    Route::match(['get','post'],'update-admin-password','AdminController@updateAdminPassword');
    // Check Admin Password
    Route::post('check-admin-password','AdminController@checkAdminPassword');
    // Check Admin Details
    Route::match(['get','post'],'update-admin-details','AdminController@updateAdminDetails');
    // Update Vendor Details
    Route::match(['get','post'],'update-vendor-details/{slug}','AdminController@updateVendorDetails');
    // Update View Admins, Subadmins and Vendors
    Route::get('admins/{type?}','AdminController@admins');
    // View Vendor Details
    Route::get('view-vendor-details/{id}','AdminController@viewVendorDetails');
    // Update Admin Status
    Route::post('update-admin-status','AdminController@updateAdminStatus');
    // Admin Logout
    Route::get('logout','AdminController@logout');
    
    // Sections
    Route::get('sections','SectionController@sections');
    Route::post('update-section-status','SectionController@updateSectionStatus');
    Route::get('delete-section/{id}','SectionController@deleteSection');
    Route::match(['get','post'],'add-edit-section/{id?}','SectionController@addEditSection');

    // Authors
    Route::get('authors','AuthorController@authors');
    Route::post('update-author-status','AuthorController@updateAuthorStatus');
    Route::get('delete-author/{id}','AuthorController@deleteAuthor');
    Route::match(['get','post'],'add-edit-author/{id?}','AuthorController@addEditAuthor');

    //Categories
    Route::get('categories','CategoryController@categories');
    Route::post('update-category-status','CategoryController@updateCategoryStatus');
    Route::match(['get','post'],'add-edit-category/{id?}','CategoryController@addEditCategory');
    
    //Sub Categories
    Route::get('append-categories-level','CategoryController@appendCategoryLevel');
    Route::get('delete-category/{id}','CategoryController@deleteCategory');   
    Route::get('delete-category-image/{id}','CategoryController@deleteCategoryImage');    

    // Products
    Route::get('products','ProductsController@products');
    Route::post('update-product-status','ProductsController@updateProductStatus');
    Route::get('delete-product/{id}','ProductsController@deleteProduct');   
    });
});

