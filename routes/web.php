<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/',[AdminController::class, 'home']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get(
    '/home',
    [AdminController::class, 'index']
)->name('home');

Route::get(
    '/create_room',
    [AdminController::class, 'create_room']
)->name('create_room');

Route::post(
    '/add_room',
    [AdminController::class, 'add_room']
)->name('add_room');
Route::get(
    '/view_rooms',
    [AdminController::class, 'view_rooms']
)->name('view_rooms');
Route::get(
    '/room_delete/{id}',
    [AdminController::class, 'room_delete']
)->name('room_delete');
Route::get(
    '/room_update/{id}',
    [AdminController::class, 'room_update']
)->name('room_update');
Route::post(
    '/edit_room/{id}',
    [AdminController::class, 'edit_room']
)->name('edit_room');
