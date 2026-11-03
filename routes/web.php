<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesananLaundryController;

Route::redirect('/', '/pesanan-laundry');

Route::resource(
    'pesanan-laundry',
    PesananLaundryController::class
);