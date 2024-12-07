<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/produits', function () {
    return view('produits');
})->name('produits');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact/save', [ContactController::class, 'save'])->name('contact.save');

Route::get('/home/{name?}', [HomeController::class, 'index'])->name('home.index');

Route::get('/hello/{name}/{age}/{gender?}', [HomeController::class, 'hello'])->name('home.hello');

Route::get('/{date}/{num}', [OrderController::class, 'show'])->name('order.show');

Route::get('/notes', [NotesController::class, 'index'])->name('notes.index');
