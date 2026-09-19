<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['Super Admin', 'super_admin'],
            ['Reservations Manager', 'reservations_manager'],
            ['Finance Manager', 'finance_manager'],
            ['Tour Manager', 'tour_manager'],
            ['Property Owner', 'property_owner'],
            ['Hotel Partner', 'hotel_partner'],
            ['Activity Provider', 'activity_provider'],
            ['Driver', 'driver'],
            ['Tour Guide', 'tour_guide'],
            ['Travel Agent', 'travel_agent'],
            ['Customer', 'customer'],
        ];

        foreach ($roles as [$name, $slug]) {
            Role::firstOrCreate(['slug' => $slug], ['name' => $name]);
        }

        $admin = User::firstOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@example.com')],
            [
                'uuid' => (string) Str::uuid(),
                'first_name' => 'VICOM',
                'last_name' => 'Administrator',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'change-me-before-seeding')),
                'status' => 'active',
            ]
        );
        $admin->roles()->syncWithoutDetaching([Role::where('slug', 'super_admin')->value('id')]);

        $destinations = [
            ['Mombasa', 'mombasa', true],
            ['Diani', 'diani', true],
            ['Kilifi', 'kilifi', false],
            ['Malindi', 'malindi', false],
            ['Watamu', 'watamu', false],
            ['Lamu', 'lamu', true],
            ['Tsavo East', 'tsavo-east', true],
            ['Tsavo West', 'tsavo-west', false],
            ['Amboseli', 'amboseli', true],
            ['Maasai Mara', 'maasai-mara', true],
            ['Lake Nakuru', 'lake-nakuru', false],
            ['Nairobi', 'nairobi', true],
            ['Naivasha', 'naivasha', false],
            ['Nanyuki', 'nanyuki', false],
            ['Mount Kenya', 'mount-kenya', true],
        ];

        foreach ($destinations as [$name, $slug, $featured]) {
            Destination::updateOrCreate(
                ['slug' => $slug],
                [
                    'uuid' => (string) Str::uuid(),
                    'name' => $name,
                    'country' => 'Kenya',
                    'featured' => $featured,
                    'status' => 'published',
                    'short_description' => "Discover {$name} with VICOM Travel & Safaris.",
                    'seo_title' => "{$name} Travel | VICOM Travel & Safaris",
                ]
            );
        }

        $settings = [
            'site.name' => ['VICOM TRAVEL & SAFARIS', 'string', 'site'],
            'site.tagline' => ['Discover Kenya. Experience Africa.', 'string', 'site'],
            'site.country' => ['Kenya', 'string', 'site'],
            'site.currency' => ['KES', 'string', 'site'],
            'site.default_language' => ['en', 'string', 'site'],
            'site.timezone' => ['Africa/Nairobi', 'string', 'site'],
            'site.support_email' => ['', 'string', 'contact'],
            'site.support_phone' => ['', 'string', 'contact'],
            'site.whatsapp_number' => ['', 'string', 'contact'],
        ];

        foreach ($settings as $key => [$value, $type, $group]) {
            Setting::updateOrCreate(['key' => $key], compact('value', 'type', 'group'));
        }
    }
}
