<?php

use App\Http\Controllers\Admin\PermissionController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PermissionController::class, 'index'])->name('admin.index');
Route::post('/store_role', [PermissionController::class, 'store_role'])->name('admin.store_role');

Route::post('/store_permission', [PermissionController::class, 'store_permission'])->name('admin.store_permission');
Route::put('/edit_permission/{permission}', [PermissionController::class, 'edit_permission'])->name('admin.edit_permission');
Route::patch('/update_permission/{permission}', [PermissionController::class, 'update_permission'])->name('admin.update_permission');