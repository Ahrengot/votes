<?php

use App\Http\Controllers\SetAllowTopicSuggestionsController;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\TopicSuggestionsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function() {
    return Inertia::render('Welcome', [
        'can' => [
            'login'    => Route::has('login'),
            'register' => Route::has('register'),
        ],
    ]);
});

Route::get('/dashboard', function() {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('topics', TopicsController::class)
     ->except('create', 'edit');

Route::post('topics/{topic}/allow-suggestions', SetAllowTopicSuggestionsController::class)
     ->name('topics.allow-suggestions');

Route::resource('topics.suggestions', TopicSuggestionsController::class)
     ->shallow()
     ->only('store', 'destroy');

require __DIR__ . '/auth.php';
