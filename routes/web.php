<?php
#    || उद्यम से ही कार्य सिद्ध होते हैं, इच्छा से नहीं। सोते हुए शेर के मुँह में कोई भी मृग नहीं घुसता। ||
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/',[ViewController::class,'homepage'])->name('homepage');

Route::post('/logoutuser', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logoutuser');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('AdminPanel.addnewspaper');
    })->name('createnewspaper');
});


Route::get('/viewaddnews', [ViewController::class, 'viewaddnews'])->name('viewaddnews');
Route::post('/createnewspaper', [StoreController::class, 'createnewspaper'])->name('createnewspaper');
Route::get('/allnewspapers', [ViewController::class, 'allnewspapers'])->name('allnewspapers');
Route::get('/paperdetailsview/{id}', [ViewController::class, 'paperdetailsview'])->name('paperdetailsview');
Route::get('/viewnews/{id}/{date}', [ViewController::class, 'viewnews'])->name('viewnews');
Route::get('/daterecords/{selectedDate}', [ViewController::class, 'daterecords'])->name('daterecords');
