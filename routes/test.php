<?php

use App\Models\User;
use App\Models\Order;
use App\Notifications\NewOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('test', function(){
//     return 'test';
// });



Route::get('send-notify', function(){

        $user = Auth::user();

        $order = Order::find(1);

        $user->notify(New NewOrder($order));
});




Route::get('read-notify', function(){

    return view('read_notify');
});


Route::get('read-notify/{id}', function($id){

    Auth::user()->notifications->find($id)->update(['read_at' => now()]);
   // Auth::user()->notifications->find($id)->markAsRead();
    return redirect(Auth::user()->notifications->find($id)->data['url']);
})->name('readd');
