<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Donor;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test users
        $users = User::factory(10)->create();

        // Create a specific test user (only if doesn't exist)
        $testUser = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );

        // Blood groups for random selection
        $bloodGroups = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
        $genders = ['male', 'female', 'other'];
        $cities = ['Mumbai', 'Delhi', 'Bangalore', 'Chennai', 'Kolkata', 'Hyderabad', 'Pune', 'Ahmedabad', 'Jaipur', 'Lucknow'];
        $states = ['Maharashtra', 'Delhi', 'Karnataka', 'Tamil Nadu', 'West Bengal', 'Telangana', 'Maharashtra', 'Gujarat', 'Rajasthan', 'Uttar Pradesh'];
        $travelDistances = ['5', '10', '20', '50', 'unlimited'];
        $approvalStatuses = ['pending', 'approved', 'rejected'];

        // Create donors for each user
        foreach ($users as $index => $user) {
            $cityIndex = array_rand($cities);
            Donor::create([
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'email' => $user->email,
                'phone' => fake()->numerify('##########'),
                'date_of_birth' => fake()->dateTimeBetween('-50 years', '-18 years')->format('Y-m-d'),
                'gender' => $genders[array_rand($genders)],
                'blood_group' => $bloodGroups[array_rand($bloodGroups)],
                'weight' => fake()->numberBetween(50, 100),
                'height' => fake()->numberBetween(150, 190),
                'medical_conditions' => fake()->optional(0.3)->sentence(),
                'address' => fake()->streetAddress(),
                'city' => $cities[$cityIndex],
                'state' => $states[$cityIndex],
                'pincode' => fake()->numerify('######'),
                'availability' => ['weekdays', 'weekends'],
                'travel_distance' => $travelDistances[array_rand($travelDistances)],
                'consent_medical' => true,
                'consent_contact' => true,
                'consent_privacy' => true,
                'user_id' => $user->id,
                'approval_status' => $approvalStatuses[array_rand($approvalStatuses)],
            ]);

            // Increment donations count for the user
            $user->increment('donations_count');
        }

        // Create additional donors (some without user accounts)
        for ($i = 0; $i < 15; $i++) {
            $cityIndex = array_rand($cities);
            Donor::create([
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'email' => fake()->unique()->safeEmail(),
                'phone' => fake()->numerify('##########'),
                'date_of_birth' => fake()->dateTimeBetween('-50 years', '-18 years')->format('Y-m-d'),
                'gender' => $genders[array_rand($genders)],
                'blood_group' => $bloodGroups[array_rand($bloodGroups)],
                'weight' => fake()->numberBetween(50, 100),
                'height' => fake()->numberBetween(150, 190),
                'medical_conditions' => fake()->optional(0.3)->sentence(),
                'address' => fake()->streetAddress(),
                'city' => $cities[$cityIndex],
                'state' => $states[$cityIndex],
                'pincode' => fake()->numerify('######'),
                'availability' => ['weekdays'],
                'travel_distance' => $travelDistances[array_rand($travelDistances)],
                'consent_medical' => true,
                'consent_contact' => true,
                'consent_privacy' => true,
                'user_id' => null,
                'approval_status' => $approvalStatuses[array_rand($approvalStatuses)],
            ]);
        }

        // Seed admin
        $this->call(AdminSeeder::class);

        $this->command->info('Database seeded successfully!');
        $this->command->info('Test User: test@example.com / password');
        $this->command->info('Admin: admin@example.com / 12345678');
    }
}
