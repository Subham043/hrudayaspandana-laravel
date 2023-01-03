<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Excel\ExcelDownloadController;

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

Route::group(['middleware' => ['file.response']], function () {

Route::get('excel/download/{file_name}', [ExcelDownloadController::class, 'excel_download', 'as' => 'excel_download']);

});