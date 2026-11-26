
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatatanController;

Route::apiResource('catatan', CatatanController::class);
