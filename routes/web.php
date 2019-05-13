<?php
use App\User;
use Illuminate\Support\Facades\Input;
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
    return view('welcome');
});

Route::post(/**
 *
 */ '/search', function() {
    $q = Input::get('q');
    if($q != ' ') {
       $user = User::where('name', 'LIKE', '%' . $q . '%')
                        ->orWhere('email', 'LIKE', '%' . $q . '%')
                        ->get();
       if(count($user) > 0)
           return view('welcome')->withDetails($user)
       ->with('details', $user)->withQuery($q);

    }
    return view('welcome')->withMessage("No Users Found! Please search again.");

});
