<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Record;

class TestRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $birthdate_count = 1;

        for ($i = 0; $i < $birthdate_count; $i++) {
            $birthdate = Carbon::now()->subYears(rand(18, 22))->subDays(rand(0, 365)); // Random birthdate between 18 and 22 years ago
    
            $age = $birthdate->age;
            
            Record::factory()->create([
                'user_id' => User::where('id', '8')->first()->id,
                'birth_date' => $birthdate->format('Y-m-d'),
                'age' => $age,
                'address' => '9',
                'street' => 'Pine Street',
                'city' => 'Muntinlupa',
                'province' => 'Quezon Province',
                'zip' => '1774',
            ]);
        }

        for ($i = 0; $i < $birthdate_count; $i++) {
            $birthdate = Carbon::now()->subYears(rand(18, 22))->subDays(rand(0, 365)); // Random birthdate between 18 and 22 years ago
    
            $age = $birthdate->age;
            
            Record::factory()->create([
                'user_id' => User::where('id', '18')->first()->id,
                'birth_date' => $birthdate->format('Y-m-d'),
                'age' => $age,
                'address' => '41',
                'street' => 'Acacia',
                'city' => 'Parañaque',
                'province' => 'Parañaque Province',
                'zip' => '1713',
            ]);
        }

        for ($i = 0; $i < $birthdate_count; $i++) {
            $birthdate = Carbon::now()->subYears(rand(18, 22))->subDays(rand(0, 365)); // Random birthdate between 18 and 22 years ago
    
            $age = $birthdate->age;
            
            Record::factory()->create([
                'user_id' => User::where('id', '28')->first()->id,
                'birth_date' => $birthdate->format('Y-m-d'),
                'age' => $age,
                'address' => '27',
                'street' => '4th Street',
                'city' => 'Cainta',
                'province' => 'Rizal Province',
                'zip' => '1900',
            ]);
        }

        for ($i = 0; $i < $birthdate_count; $i++) {
            $birthdate = Carbon::now()->subYears(rand(18, 22))->subDays(rand(0, 365)); // Random birthdate between 18 and 22 years ago
    
            $age = $birthdate->age;
            
            Record::factory()->create([
                'user_id' => User::where('id', '34')->first()->id,
                'birth_date' => $birthdate->format('Y-m-d'),
                'age' => $age,
                'address' => '31',
                'street' => 'Pearl',
                'city' => 'San Pedro',
                'province' => 'Cavite Province',
                'zip' => '4023',
            ]);
        }

        for ($i = 0; $i < $birthdate_count; $i++) {
            $birthdate = Carbon::now()->subYears(rand(18, 22))->subDays(rand(0, 365)); // Random birthdate between 18 and 22 years ago
    
            $age = $birthdate->age;
            
            Record::factory()->create([
                'user_id' => User::where('id', '20')->first()->id,
                'birth_date' => $birthdate->format('Y-m-d'),
                'age' => $age,
                'address' => '49',
                'street' => 'Aurora Pijuan Street',
                'city' => 'Talon Dos, Las Piñas',
                'province' => 'Cavite Province',
                'zip' => '1741',
            ]);
        }

        for ($i = 0; $i < $birthdate_count; $i++) {
            $birthdate = Carbon::now()->subYears(rand(18, 22))->subDays(rand(0, 365)); // Random birthdate between 18 and 22 years ago
    
            $age = $birthdate->age;
            
            Record::factory()->create([
                'user_id' => User::where('id', '21')->first()->id,
                'birth_date' => $birthdate->format('Y-m-d'),
                'age' => $age,
                'address' => '10',
                'street' => 'Scout Ybardolaza Street',
                'city' => 'Project 1, Quezon City',
                'province' => 'Quezon Province',
                'zip' => '1103',
            ]);
        }

        for ($i = 0; $i < $birthdate_count; $i++) {
            $birthdate = Carbon::now()->subYears(rand(18, 22))->subDays(rand(0, 365)); // Random birthdate between 18 and 22 years ago
    
            $age = $birthdate->age;
            
            Record::factory()->create([
                'user_id' => User::where('id', '6')->first()->id,
                'birth_date' => $birthdate->format('Y-m-d'),
                'age' => $age,
                'address' => '43',
                'street' => 'Guererro',
                'city' => 'Quezon City',
                'province' => 'Quezon Province',
                'zip' => '1100',
            ]);
        }

        for ($i = 0; $i < $birthdate_count; $i++) {
            $birthdate = Carbon::now()->subYears(rand(18, 22))->subDays(rand(0, 365)); // Random birthdate between 18 and 22 years ago
    
            $age = $birthdate->age;
            
            Record::factory()->create([
                'user_id' => User::where('id', '3')->first()->id,
                'birth_date' => $birthdate->format('Y-m-d'),
                'age' => $age,
                'address' => '1158',
                'street' => 'P. Ortega Street',
                'city' => 'Tondo, Manila',
                'province' => 'Manila Province',
                'zip' => '1012',
            ]);
        }

        for ($i = 0; $i < $birthdate_count; $i++) {
            $birthdate = Carbon::now()->subYears(rand(18, 22))->subDays(rand(0, 365)); // Random birthdate between 18 and 22 years ago
    
            $age = $birthdate->age;
            
            Record::factory()->create([
                'user_id' => User::where('id', '4')->first()->id,
                'birth_date' => $birthdate->format('Y-m-d'),
                'age' => $age,
                'address' => '17',
                'street' => 'Kaunlaran',
                'city' => 'General Trias',
                'province' => 'Cavite Province',
                'zip' => '4107',
            ]);
        }

        for ($i = 0; $i < $birthdate_count; $i++) {
            $birthdate = Carbon::now()->subYears(rand(18, 22))->subDays(rand(0, 365)); // Random birthdate between 18 and 22 years ago
    
            $age = $birthdate->age;
            
            Record::factory()->create([
                'user_id' => User::where('id', '29')->first()->id,
                'birth_date' => $birthdate->format('Y-m-d'),
                'age' => $age,
                'address' => '514',
                'street' => 'Shaw Boulevard',
                'city' => 'Mandaluyong',
                'province' => 'Quezon Province',
                'zip' => '1552',
            ]);
        }

        for ($i = 0; $i < $birthdate_count; $i++) {
            $birthdate = Carbon::now()->subYears(rand(18, 22))->subDays(rand(0, 365)); // Random birthdate between 18 and 22 years ago
    
            $age = $birthdate->age;
            
            Record::factory()->create([
                'user_id' => User::where('id', '30')->first()->id,
                'birth_date' => $birthdate->format('Y-m-d'),
                'age' => $age,
                'address' => '7',
                'street' => 'Chelsea',
                'city' => 'Pasig',
                'province' => 'Quezon Province',
                'zip' => '1600',
            ]);
        }

        for ($i = 0; $i < $birthdate_count; $i++) {
            $birthdate = Carbon::now()->subYears(rand(18, 22))->subDays(rand(0, 365)); // Random birthdate between 18 and 22 years ago
            
            $age = $birthdate->age;
            
            Record::factory()->create([
                'user_id' => User::where('id', '12')->first()->id,
                'birth_date' => $birthdate->format('Y-m-d'),
                'age' => $age,
                'address' => '34',
                'street' => 'Ibsen Lane',
                'city' => 'Cainta',
                'province' => 'Rizal Province',
                'zip' => '1871',
            ]);
        }

        for ($i = 0; $i < $birthdate_count; $i++) {
            $birthdate = Carbon::now()->subYears(rand(18, 22))->subDays(rand(0, 365)); // Random birthdate between 18 and 22 years ago
    
            $age = $birthdate->age;
            
            Record::factory()->create([
                'user_id' => User::where('id', '15')->first()->id,
                'birth_date' => $birthdate->format('Y-m-d'),
                'age' => $age,
                'address' => 'Waterside Restobar, 1,',
                'street' => 'Asean Avenue',
                'city' => 'Parañaque',
                'province' => 'Parañaque Province',
                'zip' => '1701',
            ]);
        }

        for ($i = 0; $i < $birthdate_count; $i++) {
            $birthdate = Carbon::now()->subYears(rand(18, 22))->subDays(rand(0, 365)); // Random birthdate between 18 and 22 years ago
    
            $age = $birthdate->age;
            
            Record::factory()->create([
                'user_id' => User::where('id', '16')->first()->id,
                'birth_date' => $birthdate->format('Y-m-d'),
                'age' => $age,
                'address' => '12',
                'street' => 'Lakandula Street',
                'city' => 'Marikina Heights, Marikina',
                'province' => 'Marikina Province',
                'zip' => '1810',
            ]);
        }

        for ($i = 0; $i < $birthdate_count; $i++) {
            $birthdate = Carbon::now()->subYears(rand(18, 22))->subDays(rand(0, 365)); // Random birthdate between 18 and 22 years ago
    
            $age = $birthdate->age;
            
            Record::factory()->create([
                'user_id' => User::where('id', '14')->first()->id,
                'birth_date' => $birthdate->format('Y-m-d'),
                'age' => $age,
                'address' => '35',
                'street' => 'A. Bonifacio Avenue',
                'city' => 'Cainta',
                'province' => 'Rizal Province',
                'zip' => '1900',
            ]);
        }
    }
}
