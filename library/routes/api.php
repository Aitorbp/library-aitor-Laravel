<?php

use App\Http\Controllers\LibrosController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/search', 'LibrosController@search');
Route::get('/showmylends', 'PrestamosController@showmylends');
Route::post('/generartoken/{id}', 'UsersController@generarToken');

//Libros
Route::get('/libros', 'LibrosController@showAllBooks');
Route::get('/libros/genero/{genre}', 'LibrosController@getByGenre');
Route::get('/libros/autor/{author}', 'LibrosController@getByAuthor');

Route::middleware('auth:api')->post('/libros/crearlibro', 'LibrosController@postBook');
Route::middleware('auth:api')->put('/libros/actualizarlibro/{id}', 'LibrosController@updateBook');
Route::middleware('auth:api')->delete('/libros/borrarlibro/{id}', 'LibrosController@deleteBook');

//Préstamos
Route::middleware('auth:api')->post('/prestamos/prestar', 'PrestamosController@booksToLend');
Route::middleware('auth:api')->put('/prestamos/devolver/{id}', 'PrestamosController@booksToReturn');

