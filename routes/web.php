<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

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

// Routes that require authentication
Route::group(['middleware' => ['auth']], function () {
    // Superadmin routes
    Route::group(['middleware' => ['superadmin']], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admins.dashboard');
        // Create admin or user
        Route::get('/admins/create', [AdminController::class, 'create'])->name('admins.create');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/admins', [AdminController::class, 'store'])->name('admins.store');
        Route::post('/users/new', [UserController::class, 'store']);
        // View admin or user lists
        Route::get('/admins/view', [AdminController::class, 'index'])->name('admins.index');
        Route::get('/users/view', [UserController::class, 'userIndex'])->name('users.index1');
        // Edit admin or user
        Route::get('/admins/edit/{id}', [AdminController::class, 'edit'])->name('superadmins.edit');
        Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('superadminUsers.edit');
        // Update admin or user
        Route::put('/admins/update/{id}', [AdminController::class, 'update'])->name('superadmins.update');
        Route::put('/users/update/{id}', [UserController::class, 'update'])->name('superadminUsers.update');
        // Delete admin or user
        Route::get('/admins/{id}', [AdminController::class, 'destroy'])->name('superadmins.destroy');
        Route::get('/users/{id}', [UserController::class, 'destroy'])->name('superadminUsers.destroy');
    });

    // Admin routes
    Route::group(['middleware' => ['admin']], function () {
        Route::get('/admindashboard', [AdminController::class, 'admindashboard'])->name('admins.admindashboard');
        // Create user
        Route::get('/admins/createAdmin/create', [AdminController::class, 'createAdmin'])->name('admins.createAdmin');
        Route::post('/admins/createAdmin/register/new', [AdminController::class, 'registerAdmin'])->name('admins.registerAdmin');
        Route::get('/admin/users/create', [UserController::class, 'adminCreate'])->name('users.adminCreate');
        Route::post('/admin/users/new', [UserController::class, 'adminStore'])->name('users.adminStore');
        // View user list
        Route::get('/admin/users/view', [UserController::class, 'index'])->name('users.adminIndex');
        Route::get('/admin/view', [UserController::class, 'adminViewIndex'])->name('users.adminViewIndex');
        Route::get('/superAdmin/view', [UserController::class, 'superAdminViewIndex'])->name('users.superAdminViewIndex');
        // Edit user
        Route::get('/users/userEdit/{id}', [UserController::class, 'userEdit'])->name('users.userEdit');
        Route::get('/users/adminEdit/{id}', [AdminController::class, 'adminEdit'])->name('admins.adminEdit');
        // Update user
        Route::put('/users/adminUpdate/{id}', [AdminController::class, 'adminUpdate'])->name('admins.adminUpdate');
        Route::put('/users/userUpdate/{id}', [UserController::class, 'userUpdate'])->name('users.userUpdate');
        // Delete user
        Route::get('/admins/delete/{id}', [AdminController::class, 'adminDelete'])->name('admins.adminDelete');
        Route::get('/users/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
    });

    // User routes
    Route::group(['middleware' => ['user']], function () {
        Route::get('/userdashboard', [UserController::class, 'userdashboard'])->name('admins.userdashboard');
        // View own details
        Route::get('/users/details/show', [UserController::class, 'show'])->name('users.showDetails');
    });

    // Home route
    Route::get('/', [HomeController::class, 'index'])->name('home');
});
Route::get('/', function () {
    return view('welcome');
});
// Authentication routes (login, register, etc.)
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
