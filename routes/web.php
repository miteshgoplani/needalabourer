<?php

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

/*Route::get('/', function () {
    return view('welcome');
    
});

Route::get('/users/{id}/{name}', function ($id,$name) {
    return 'This is user ' .$name  .'with an id' . $id;
});

*/

Route::get('/','PagesController@index');

Route::get('/about','PagesController@about');

Route::get('/services','PagesController@services');
Route::get('/profile','PagesController@profile');

Route::resource('posts','PostController');
Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

//google2fa
Route::get('/complete-registration', 'Auth\RegisterController@completeRegistration');
Route::post('/2fa', function () {
   // return 'gg';
    return redirect(URL()->previous());
})->name('2fa')->middleware('2fa');
//reauthentication
Route::get('/re-authenticate', 'PostController@reauthenticate');
Route::get('/re-authenticate', 'Dashboard
Controller@reauthenticate');


Route::group(['prefix'=>'labour'],function(){//insert middleware

    Route::get('/home', 'LabourController@index');
    Route::get('/profile', 'LabourController@profile');
    Route::get('/register','LabourController@register');

});
