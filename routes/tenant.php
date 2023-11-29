<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Models\Membership;
/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

use App\Http\Controllers\Tenant\MembershipController;

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {

        $data['member'] = Membership::get();
        return view('tenants/welcome',$data);
    });
    Route::get('/memberships', [MembershipController::class, 'index'])->name('memberships.index');
});

Route::middleware([
    'auth:sanctum',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/mydashboard', function () {
        return 'Test';
    })->name('mydashboard');
});
