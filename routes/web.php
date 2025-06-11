<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\admin\{
    DashboardAdminController,
    AugmentedRealityController,
    MateriController,
    QuizController,
    ProfilAdminController,
};
use App\Http\Controllers\web\{
    MenuController,
    KameraController,
    WebMateriController,
    QuizWebController,
    };
use App\Http\Controllers\{
    LoginController,
};


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
Route::get('/phpinfo', function () {
    phpinfo();
});

Route::get('/run-admin', function () {
    Artisan::call('db:seed', [
        '--class' => 'SuperAdminSeeder'
    ]);

    return "AdminSeeder has been create successfully!";
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard-admin', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('augmented-reality', AugmentedRealityController::class);
    Route::resource('materi', MateriController::class);
    Route::resource('master-quiz', QuizController::class);
    Route::resource('profil-admin', ProfilAdminController::class);
});
// ADMIN

// WEB
Route::get('/', [MenuController::class, 'index'])->name('menu');
Route::get('/kamera', [KameraController::class, 'index'])->name('kamera');
Route::get('/web-materi', [WebMateriController::class, 'index'])->name('web-materi');
Route::get('/web-materi/{id}', [WebMateriController::class, 'detail'])->name('web-materi.detail');
Route::get('/web-quiz', [QuizWebController::class, 'index'])->name('web-quiz');
// WEB