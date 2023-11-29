<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use App\Models\Tenant;

class TenantController extends Controller
{
    public function createTenant(Request $request)
    {
        $subdomain = $request->subdomain;

        // Cek apakah tenant sudah ada
        if (!$this->tenantExists($subdomain)) {
            // Buat tenant baru
            $this->createTenantRecord($subdomain);

            // Set konfigurasi untuk tenant
            Config::set('database.connections.tenant.database', 'tenant_' . $subdomain);
            Config::set('tenancy.database.auto-delete-tenant', true);

       
            Artisan::call('tenants:migrate');

            return response()->json([
                'status' => 'success',
                'message' => 'Tenant created successfully.',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Tenant already exists.',
            ], 400);
        }
    }

    private function tenantExists($subdomain)
    {
        return Tenant::where('data', $subdomain)->exists();
    }

    private function createTenantRecord($subdomain)
    {

        $central_domain = env('APP_CENTRAL_DOMAIN','localhost');
        
        $tenant = Tenant::create([
            'subdomain' => $subdomain.'.'.$central_domain,
        ]);

        $tenant->domains()->create([
            'domain' => $subdomain.'.'.$central_domain,
        ]);
    }

    public function deleteTenant($id)
    {
        // Cari tenant berdasarkan ID
        $tenant = Tenant::find($id);
    
        // Periksa apakah tenant ditemukan
        if (!$tenant) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tenant not found.',
            ], 404);
        }
    
        // Hapus tenant dari database
        $tenant->delete();
    
        return response()->json([
            'status' => 'success',
            'message' => 'Tenant deleted successfully.',
        ]);
    }
    
}
