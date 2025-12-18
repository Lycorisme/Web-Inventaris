<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::redirect('/', '/login');

// Login routes
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    $credentials = request()->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
        request()->session()->regenerate();
        return redirect('/dashboard');
    }

    return back()->withErrors([
        'username' => 'The provided credentials do not match our records.',
    ])->onlyInput('username');
})->name('login.store');

// Dashboard route
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
});

// Logout routes
Route::get('/logout', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }
    return view('auth.logout-confirm');
})->name('logout.confirm')->middleware('auth');

Route::post('/logout', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }
    return view('auth.logout-confirm');
})->name('logout.confirm.post')->middleware('auth');

Route::post('/logout-confirm', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login')->with('success', 'You have been logged out successfully.');
})->name('logout.store')->middleware('auth');

// Data Kendaraan routes
Route::middleware('auth')->group(function () {
    Route::get('/data/kendaraan/total', [\App\Http\Controllers\TotalKendaraanController::class, 'index'])->name('kendaraan.total');
    Route::get('/data/kendaraan/total/{totalKendaraan}', [\App\Http\Controllers\TotalKendaraanController::class, 'show']);
    Route::post('/data/kendaraan/total', [\App\Http\Controllers\TotalKendaraanController::class, 'store'])->name('kendaraan.total.store');
    Route::put('/data/kendaraan/total/{totalKendaraan}', [\App\Http\Controllers\TotalKendaraanController::class, 'update'])->name('kendaraan.total.update');
    Route::delete('/data/kendaraan/total/{totalKendaraan}', [\App\Http\Controllers\TotalKendaraanController::class, 'destroy'])->name('kendaraan.total.destroy');
    Route::get('/data/kendaraan/total/export/excel', [\App\Http\Controllers\TotalKendaraanController::class, 'export'])->name('kendaraan.total.export');
});

// Kendaraan Aktif routes
Route::middleware('auth')->group(function () {
    Route::get('/data/kendaraan/aktif', [\App\Http\Controllers\KendaraanAktifController::class, 'index'])->name('kendaraan.aktif');
    Route::get('/data/kendaraan/aktif/{kendaraanAktif}', [\App\Http\Controllers\KendaraanAktifController::class, 'show']);
    Route::post('/data/kendaraan/aktif', [\App\Http\Controllers\KendaraanAktifController::class, 'store'])->name('kendaraan.aktif.store');
    Route::put('/data/kendaraan/aktif/{kendaraanAktif}', [\App\Http\Controllers\KendaraanAktifController::class, 'update'])->name('kendaraan.aktif.update');
    Route::delete('/data/kendaraan/aktif/{kendaraanAktif}', [\App\Http\Controllers\KendaraanAktifController::class, 'destroy'])->name('kendaraan.aktif.destroy');
    Route::get('/data/kendaraan/aktif/export/excel', [\App\Http\Controllers\KendaraanAktifController::class, 'export'])->name('kendaraan.aktif.export');
});

// Unit Breakdown routes
Route::middleware('auth')->group(function () {
    Route::get('/data/kendaraan/breakdown', [\App\Http\Controllers\UnitBreakdownController::class, 'index'])->name('kendaraan.breakdown');
    Route::get('/data/kendaraan/breakdown/{unitBreakdown}', [\App\Http\Controllers\UnitBreakdownController::class, 'show']);
    Route::post('/data/kendaraan/breakdown', [\App\Http\Controllers\UnitBreakdownController::class, 'store'])->name('kendaraan.breakdown.store');
    Route::put('/data/kendaraan/breakdown/{unitBreakdown}', [\App\Http\Controllers\UnitBreakdownController::class, 'update'])->name('kendaraan.breakdown.update');
    Route::delete('/data/kendaraan/breakdown/{unitBreakdown}', [\App\Http\Controllers\UnitBreakdownController::class, 'destroy'])->name('kendaraan.breakdown.destroy');
    Route::get('/data/kendaraan/breakdown/export/excel', [\App\Http\Controllers\UnitBreakdownController::class, 'export'])->name('kendaraan.breakdown.export');
});

// Data Mess routes
Route::middleware('auth')->group(function () {
    Route::get('/data/mess/senior', [\App\Http\Controllers\MessSeniorController::class, 'index'])->name('mess.senior');
    Route::get('/data/mess/senior/{messSenior}', [\App\Http\Controllers\MessSeniorController::class, 'show']);
    Route::post('/data/mess/senior', [\App\Http\Controllers\MessSeniorController::class, 'store'])->name('mess.senior.store');
    Route::put('/data/mess/senior/{messSenior}', [\App\Http\Controllers\MessSeniorController::class, 'update'])->name('mess.senior.update');
    Route::delete('/data/mess/senior/{messSenior}', [\App\Http\Controllers\MessSeniorController::class, 'destroy'])->name('mess.senior.destroy');
    Route::get('/data/mess/senior/export/excel', [\App\Http\Controllers\MessSeniorController::class, 'export'])->name('mess.senior.export');

    Route::get('/data/mess/junior', [\App\Http\Controllers\MessJuniorController::class, 'index'])->name('mess.junior');
    Route::get('/data/mess/junior/{messJunior}', [\App\Http\Controllers\MessJuniorController::class, 'show']);
    Route::post('/data/mess/junior', [\App\Http\Controllers\MessJuniorController::class, 'store'])->name('mess.junior.store');
    Route::put('/data/mess/junior/{messJunior}', [\App\Http\Controllers\MessJuniorController::class, 'update'])->name('mess.junior.update');
    Route::delete('/data/mess/junior/{messJunior}', [\App\Http\Controllers\MessJuniorController::class, 'destroy'])->name('mess.junior.destroy');
    Route::get('/data/mess/junior/export/excel', [\App\Http\Controllers\MessJuniorController::class, 'export'])->name('mess.junior.export');

    Route::get('/data/mess/nonstaff', [\App\Http\Controllers\MessNonStaffController::class, 'index'])->name('mess.nonstaff');
    Route::get('/data/mess/nonstaff/{messNonStaff}', [\App\Http\Controllers\MessNonStaffController::class, 'show']);
    Route::post('/data/mess/nonstaff', [\App\Http\Controllers\MessNonStaffController::class, 'store'])->name('mess.nonstaff.store');
    Route::put('/data/mess/nonstaff/{messNonStaff}', [\App\Http\Controllers\MessNonStaffController::class, 'update'])->name('mess.nonstaff.update');
    Route::delete('/data/mess/nonstaff/{messNonStaff}', [\App\Http\Controllers\MessNonStaffController::class, 'destroy'])->name('mess.nonstaff.destroy');
    Route::get('/data/mess/nonstaff/export/excel', [\App\Http\Controllers\MessNonStaffController::class, 'export'])->name('mess.nonstaff.export');
});

// Form routes
Route::get('/forms/kendaraan/total', function () {
    if (!Auth::check()) return redirect('/login');
    return view('forms.kendaraan.total-form');
})->name('form.kendaraan.total');

Route::get('/forms/kendaraan/aktif', function () {
    if (!Auth::check()) return redirect('/login');
    return view('forms.kendaraan.aktif-form');
})->name('form.kendaraan.aktif');

Route::get('/forms/kendaraan/breakdown', function () {
    if (!Auth::check()) return redirect('/login');
    return view('forms.kendaraan.breakdown-form');
})->name('form.kendaraan.breakdown');

Route::get('/forms/mess/senior', function () {
    if (!Auth::check()) return redirect('/login');
    return view('forms.mess.senior-form');
})->name('form.mess.senior');

Route::get('/forms/mess/junior', function () {
    if (!Auth::check()) return redirect('/login');
    return view('forms.mess.junior-form');
})->name('form.mess.junior');

Route::get('/forms/mess/nonstaff', function () {
    if (!Auth::check()) return redirect('/login');
    return view('forms.mess.nonstaff-form');
})->name('form.mess.nonstaff');

// User management routes
Route::middleware('auth')->group(function () {
    Route::resource('users', \App\Http\Controllers\UserController::class);
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::put('/profile/update', [\App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/password/update', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('password.update');
});

// ATK routes
Route::middleware('auth')->group(function () {
    Route::get('/data/atk/items', [\App\Http\Controllers\AtkItemController::class, 'index'])->name('atk.items');
    Route::get('/data/atk/items/{atkItem}', [\App\Http\Controllers\AtkItemController::class, 'show']);
    Route::post('/data/atk/items', [\App\Http\Controllers\AtkItemController::class, 'store'])->name('atk.items.store');
    Route::put('/data/atk/items/{atkItem}', [\App\Http\Controllers\AtkItemController::class, 'update'])->name('atk.items.update');
    Route::delete('/data/atk/items/{atkItem}', [\App\Http\Controllers\AtkItemController::class, 'destroy'])->name('atk.items.destroy');
    Route::get('/data/atk/items/export/excel', [\App\Http\Controllers\AtkItemController::class, 'export'])->name('atk.items.export');

    Route::get('/data/atk/transactions', [\App\Http\Controllers\AtkTransactionController::class, 'index'])->name('atk.transactions');
    Route::get('/data/atk/transactions/{atkTransaction}', [\App\Http\Controllers\AtkTransactionController::class, 'show']);
    Route::post('/data/atk/transactions', [\App\Http\Controllers\AtkTransactionController::class, 'store'])->name('atk.transactions.store');
    Route::put('/data/atk/transactions/{atkTransaction}', [\App\Http\Controllers\AtkTransactionController::class, 'update'])->name('atk.transactions.update');
    Route::delete('/data/atk/transactions/{atkTransaction}', [\App\Http\Controllers\AtkTransactionController::class, 'destroy'])->name('atk.transactions.destroy');
    Route::get('/data/atk/transactions/export/excel', [\App\Http\Controllers\AtkTransactionController::class, 'export'])->name('atk.transactions.export');
});

// Search route
Route::middleware('auth')->group(function () {
    Route::get('/api/search', [\App\Http\Controllers\SearchController::class, 'search'])->name('search');
});
