<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Administrator;
use App\Models\BookingRating;
use App\Models\Booking;
use App\Models\OpeningTime;
use App\Models\ServiceCategory;
use App\Models\ServiceImage;
use App\Models\ServiceProviderImage;
use App\Models\ServiceProviderRating;
use App\Models\ServiceProvider;
use App\Models\Service;
use App\Models\StaffCategory;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // public function run(): void
    // {
    //     // \App\Models\User::factory(10)->create();

    //     // \App\Models\User::factory()->create([
    //     //     'name' => 'Test User',
    //     //     'email' => 'test@example.com',
    //     // ]);
    // }

    public function run(): void
    {
        // Seed administrators with one specific admin
        Administrator::factory()->count(9)->create();
        Administrator::create([
            'AdministratorName' => 'Admin',
            'AdministratorSurname' => 'admin',
            'Username' => 'admin',
            'Password' => Hash::make('password'),
            'Country' => 'admin',
            'City' => 'admin',
            'Address' => 'admin',
            'PostalCode' => 'admin',
            'Email' => 'mduzair@gmail.com',
            'PhoneNumber' => '124531245',
            'AdministratorImage' => '1715276294.jpeg',
        ]);

        // Seed a single user
        User::create([
            'Name' => 'mduser',
            'Username' => 'mduser',
            'Password' => Hash::make('password'),
            'Country' => 'mduser',
            'City' => 'mduser',
            'Address' => 'mduser',
            'PostalCode' => 'mduser',
            'Email' => 'mduzair@gmail.com',
            'PhoneNumber' => 'mduser',
            'UserImageName' => null,
        ]);

        // Seed the rest of the data
        BookingRating::factory(50)->create();
        Booking::factory(100)->create();
        OpeningTime::factory(10)->create();
        ServiceCategory::factory(10)->create();
        ServiceImage::factory(50)->create();
        ServiceProviderImage::factory(50)->create();
        ServiceProviderRating::factory(50)->create();
        ServiceProvider::factory(20)->create();
        Service::factory(100)->create();
        StaffCategory::factory(50)->create();
        Staff::factory(50)->create();
    }
}
