<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Destination;
use App\Models\Role;
use App\Models\Setting;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        return response()->json([
            'success' => true,
            'message' => 'Admin dashboard.',
            'data' => [
                'users' => User::count(),
                'customers' => User::whereHas('roles', fn ($q) => $q->where('slug', 'customer'))->count(),
                'suppliers' => Supplier::count(),
                'destinations' => Destination::count(),
                'verified_suppliers' => Supplier::where('verification_status', 'verified')->count(),
                'recent_users' => User::latest()->limit(5)->get(['id', 'first_name', 'last_name', 'email', 'created_at']),
            ],
        ]);
    }

    public function users()
    {
        return response()->json(['success' => true, 'message' => 'Users.', 'data' => User::with('roles')->paginate(25)]);
    }

    public function roles()
    {
        return response()->json(['success' => true, 'message' => 'Roles.', 'data' => Role::orderBy('name')->get()]);
    }

    public function destinations()
    {
        return response()->json(['success' => true, 'message' => 'Destinations.', 'data' => Destination::latest()->paginate(25)]);
    }

    public function storeDestination(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:160'],
            'slug' => ['required', 'string', 'max:180', 'unique:destinations,slug'],
            'country' => ['required', 'string', 'max:100'],
            'region' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'featured' => ['boolean'],
            'status' => ['required', 'in:draft,published,archived'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
        ]);

        $destination = Destination::create(['uuid' => (string) Str::uuid(), ...$data]);
        $this->audit($request, 'destination.created', Destination::class, $destination->id, null, $destination->toArray());

        return response()->json(['success' => true, 'message' => 'Destination created.', 'data' => $destination], 201);
    }

    public function showDestination(int $id)
    {
        return response()->json(['success' => true, 'message' => 'Destination.', 'data' => Destination::with('media')->findOrFail($id)]);
    }

    public function updateDestination(Request $request, int $id)
    {
        $destination = Destination::findOrFail($id);
        $old = $destination->toArray();
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:160'],
            'slug' => ['sometimes', 'string', 'max:180', 'unique:destinations,slug,'.$id],
            'country' => ['sometimes', 'string', 'max:100'],
            'region' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'featured' => ['boolean'],
            'status' => ['sometimes', 'in:draft,published,archived'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
        ]);
        $destination->update($data);
        $this->audit($request, 'destination.updated', Destination::class, $id, $old, $destination->fresh()->toArray());

        return response()->json(['success' => true, 'message' => 'Destination updated.', 'data' => $destination->fresh()]);
    }

    public function deleteDestination(Request $request, int $id)
    {
        $destination = Destination::findOrFail($id);
        $old = $destination->toArray();
        $destination->delete();
        $this->audit($request, 'destination.deleted', Destination::class, $id, $old, null);

        return response()->json(['success' => true, 'message' => 'Destination deleted.', 'data' => null]);
    }

    public function suppliers()
    {
        return response()->json(['success' => true, 'message' => 'Suppliers.', 'data' => Supplier::latest()->paginate(25)]);
    }

    public function storeSupplier(Request $request)
    {
        $data = $request->validate([
            'business_name' => ['required', 'string', 'max:200'],
            'supplier_type' => ['required', 'in:hotel,property_owner,tour_operator,activity_provider,driver,car_rental,guide,transport_provider'],
            'contact_name' => ['required', 'string', 'max:150'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'description' => ['nullable', 'string'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'country' => ['required', 'string', 'max:100'],
        ]);

        $supplier = Supplier::create([
            ...$data,
            'slug' => Str::slug($data['business_name']).'-'.Str::lower(Str::random(5)),
            'status' => 'active',
            'verification_status' => 'pending',
        ]);

        $this->audit($request, 'supplier.created', Supplier::class, $supplier->id, null, $supplier->toArray());
        return response()->json(['success' => true, 'message' => 'Supplier created.', 'data' => $supplier], 201);
    }

    public function showSupplier(int $id)
    {
        return response()->json(['success' => true, 'message' => 'Supplier.', 'data' => Supplier::with('users')->findOrFail($id)]);
    }

    public function updateSupplier(Request $request, int $id)
    {
        $supplier = Supplier::findOrFail($id);
        $old = $supplier->toArray();
        $supplier->update($request->validate([
            'business_name' => ['sometimes', 'string', 'max:200'],
            'contact_name' => ['sometimes', 'string', 'max:150'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'description' => ['nullable', 'string'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'status' => ['sometimes', 'in:active,inactive,suspended'],
        ]));
        $this->audit($request, 'supplier.updated', Supplier::class, $id, $old, $supplier->fresh()->toArray());
        return response()->json(['success' => true, 'message' => 'Supplier updated.', 'data' => $supplier->fresh()]);
    }

    public function verifySupplier(Request $request, int $id)
    {
        return $this->setSupplierVerification($request, $id, 'verified');
    }

    public function rejectSupplier(Request $request, int $id)
    {
        return $this->setSupplierVerification($request, $id, 'rejected');
    }

    private function setSupplierVerification(Request $request, int $id, string $status)
    {
        $supplier = Supplier::findOrFail($id);
        $old = $supplier->toArray();
        $supplier->update(['verification_status' => $status]);
        $this->audit($request, 'supplier.verification_'.$status, Supplier::class, $id, $old, $supplier->fresh()->toArray());
        return response()->json(['success' => true, 'message' => 'Supplier verification updated.', 'data' => $supplier->fresh()]);
    }

    public function settings()
    {
        return response()->json(['success' => true, 'message' => 'Settings.', 'data' => Setting::orderBy('group')->orderBy('key')->get()]);
    }

    public function updateSettings(Request $request)
    {
        $settings = $request->validate(['settings' => ['required', 'array']]);
        foreach ($settings['settings'] as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => is_array($value) ? json_encode($value) : (string) $value]);
        }
        $this->audit($request, 'settings.updated', Setting::class, null, null, $settings);
        return response()->json(['success' => true, 'message' => 'Settings updated.', 'data' => Setting::all()]);
    }

    public function auditLogs()
    {
        return response()->json(['success' => true, 'message' => 'Audit logs.', 'data' => AuditLog::latest('created_at')->paginate(50)]);
    }

    private function audit(Request $request, string $action, ?string $entityType, ?int $entityId, ?array $old, ?array $new): void
    {
        AuditLog::create([
            'uuid' => (string) Str::uuid(),
            'user_id' => $request->user()->id,
            'action' => $action,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'old_values' => $old,
            'new_values' => $new,
            'created_at' => now(),
        ]);
    }
}
