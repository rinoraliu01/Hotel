<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

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

Route::get('/home',[AdminController::class, 'index'])->name('home');

Route::get('/create_room',[AdminController::class, 'create_room'])->middleware(['auth', 'admin'])->name('create_room');
Route::post('/add_room',[AdminController::class, 'add_room'])->middleware(['auth', 'admin'])->name('add_room');
Route::get('/view_rooms',[AdminController::class, 'view_rooms'])->middleware(['auth', 'admin'])->name('view_rooms');
Route::get('/room_delete/{id}',[AdminController::class, 'room_delete'])->middleware(['auth', 'admin'])->name('room_delete');
Route::get('/room_update/{id}',[AdminController::class, 'room_update'])->middleware(['auth', 'admin'])->name('room_update');
Route::post('/edit_room/{id}',[AdminController::class, 'edit_room'])->middleware(['auth', 'admin'])->name('edit_room');
Route::get('/room_details/{id}',[HomeController::class, 'room_details'])->name('room_details');

Route::post('/add_booking/{id}',[HomeController::class, 'add_booking'])->name('add_booking');

Route::get('bookings',[AdminController::class, 'bookings'])->middleware(['auth','admin']);
Route::get('delete_booking/{id}',[AdminController::class, 'delete_booking'])->middleware(['auth', 'admin'])->name('delete_booking');
Route::get('approve_booking/{id}',[AdminController::class, 'approve_booking'])->middleware(['auth', 'admin'])->name('approve_booking');
Route::get('reject_booking/{id}',[AdminController::class, 'reject_booking'])->middleware(['auth', 'admin'])->name('reject_booking');

Route::get('view_gallary',[AdminController::class, 'view_gallary'])->middleware(['auth', 'admin'])->name('view_gallary');
Route::post('add_gallery',[AdminController::class, 'add_gallery'])->middleware(['auth', 'admin'])->name('add_gallery');
Route::get('delete_gallery/{id}',[AdminController::class, 'delete_gallery'])->middleware(['auth', 'admin'])->name('delete_gallery');


Route::post('contact',[HomeController::class, 'contact']);
Route::get('messages',[AdminController::class, 'messages'])->middleware(['auth', 'admin'])->name('messages');

Route::get('send_mail/{id}',[AdminController::class, 'send_mail'])->middleware(['auth', 'admin'])->name('send_mail');
Route::post('mail/{id}',[AdminController::class, 'mail'])->middleware(['auth', 'admin']);


Route::get('our_rooms',[HomeController::class, 'our_rooms'])->name('our_rooms');
Route::get('hotel_gallery',[HomeController::class, 'hotel_gallery'])->name('hotel_gallery');
Route::get('hotel_contact',[HomeController::class, 'hotel_contact'])->name('hotel_contact');




