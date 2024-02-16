<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

/*
 * This route will always bring the first 100 records from page 1 of the legacy API,
 * this was the understanding I had when reading the challenge.
 */
Route::get('items', [ItemController::class, 'items'])->name('items');

/*
 * Route created alternatively for a slightly different understanding of the previous route.
 * For this route, the page parameter will be passed to the legacy API so that pagination will be
 * based on the data returned and not the first 100 records.
 */
Route::get('items-api-legacy', [ItemController::class, 'indexApiLegacy'])->name('items-api-legacy');
