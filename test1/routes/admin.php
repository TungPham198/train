<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::get('login',function(){
        return view('Admin.pages.login');
    });
    Route::post('login',[AdminController::class,'login'])->name('login');
    Route::get('logout',function(){
        Auth::logout();
        return redirect('login');
    })->name('logout');

    Route::group(['prefix' => 'admin','middleware'=>'checklogin'], function () {
        Route::get('dashboard', [AdminController::class,'dashboard'])->name('dashboard');
        Route::resource('user', AdminController::class);
        Route::get('test',function(){
            return view('Admin.pages.user.index',['users' => User::all()]);
        });
        
    });
    

?>