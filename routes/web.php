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
Route::get('/mybookings','PagesController@mybookings');
Route::get('/test','PagesController@test');
Route::resource('posts','PostController');
Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

//google2fa
Route::get('/complete-registration', 'Auth\RegisterController@completeRegistration');
Route::post('/2fa', function () {
    return redirect(URL()->previous());
})->name('2fa')->middleware('2fa');

//reauthentication

Route::get('/re-authenticate', 'DashboardController@reauthenticate');



Route::resource('labs','labController');

// Route::group(['prefix'=>'labour'],function(){//insert middleware

//     Route::get('/home', 'LabourController@index');
//     Route::get('/profile', 'LabourController@profile');
//     Route::get('/register','LabourController@register');

// });

Route::get('/carpenter', 'PagesController@carpenter');
Route::get('/plumber', 'PagesController@plumber');
Route::get('/electrician', 'PagesController@electrician');
Route::get('/construction', 'PagesController@construction');

Route::get('/labs/{id}/book','labController@book');
Route::get('/labs/{id}/endBooking','labController@endbook');
Route::POST('/', [
    'uses' => 'labController@booking'
  ]);