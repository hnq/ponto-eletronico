<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\PointReportController;

Route::get('/', function () {    
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('employees', EmployeeController::class);
    Route::get('/ponto/registrar', [PointController::class, 'create'])->name('ponto.registrar');
    Route::post('/ponto/registrar', [PointController::class, 'store'])->name('ponto.store');
    
    Route::group(['middleware' => function ($request, $next) {
        $user = auth()->user();
        if (!$user || $user->role !== 'admin') {
            abort(403, 'Acesso negado');
        }
        return $next($request);
    }], function () {
        Route::resource('funcionarios', EmployeeController::class);
        Route::get('/pontos', [PointController::class, 'adminIndex'])->name('pontos.index');
        Route::get('/points/report', [PointReportController::class, 'index'])->name('points.report');;
    });
    
    
    Route::get('/password/change', [PasswordController::class, 'change'])->name('password.change');    
    Route::post('/password/change', [PasswordController::class, 'update'])->name('password.update');

   
});

require __DIR__.'/auth.php';
