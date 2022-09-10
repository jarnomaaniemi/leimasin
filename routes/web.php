<?php

use App\Http\Controllers\BibleverseController;
use App\Http\Controllers\TimestampController;
use App\Models\Bibleverse;
use App\Models\Timestamp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Jenssegers\Agent\Agent;

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

Route::get('/', function () {
    return view('welcome', ['agent' => new Agent]);
});

Route::post('/stamp', [TimestampController::class, 'store']);

Route::get('/verse', [BibleverseController::class, 'index']);

Route::post('/verse', function (Request $request) {
    
    $verse = session()->get('verse');

    Timestamp::create([
        'message' => $verse->verse_text,
        'unix-time' => time(),
        'remote-ip' => $request->ip(),
        'user-agent' => 'Bible Verse'
    ]);

    return redirect('/verse')->with([
        'status' => 'Tykkäys onnistui!',
        'prev_verse' => $verse
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
