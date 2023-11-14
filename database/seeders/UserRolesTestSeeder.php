<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;

class UserRolesTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create Users with Roles
        User::create([
            'name' => 'Nurse',
            'email' => 'nurse@apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Nurse')->first()->id,
        ]);

        User::create([
            'name' => 'Doctor',
            'email' => 'doctor@apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Doctor')->first()->id,
        ]);

        User::create([
            'name' => 'Dentist',
            'email' => 'dentist@apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Dentist')->first()->id,
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Admin')->first()->id,
        ]);
        
        //Student
        User::factory()->create([
            'name' => 'Christine Ferry',
            'email' => 'cferry@student.apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Student')->first()->id,
        ]);
        
        User::factory()->create([
            'name' => 'Carolyne Amore',
            'email' => 'camore@student.apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Student')->first()->id,
        ]);
        
        User::factory()->create([
            'name' => 'Delaney Spinka',
            'email' => 'dspinka@student.apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Student')->first()->id,
        ]);
        
        User::factory()->create([
            'name' => 'Andrew Towne',
            'email' => 'atowne@student.apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Student')->first()->id,
        ]);
        
        User::factory()->create([
            'name' => 'Avis Schinner',
            'email' => 'aschinner@student.apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Student')->first()->id,
        ]);
        
        User::factory()->create([
            'name' => 'Rylee Medhurst',
            'email' => 'rmedhurst@student.apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Student')->first()->id,
        ]);
        
        User::factory()->create([
            'name' => 'Ova Paucek',
            'email' => 'opaucek@student.apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Student')->first()->id,
        ]);
        
        User::factory()->create([
            'name' => 'Emmanuelle Collins',
            'email' => 'ecollins@student.apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Student')->first()->id,
        ]);
        
        User::factory()->create([
            'name' => 'Vicenta Bednar',
            'email' => 'vbednar@student.apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Student')->first()->id,
        ]);
        
        User::factory()->create([
            'name' => 'Jonathan Moen',
            'email' => 'jmoen@student.apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Student')->first()->id,
        ]);
        
        User::factory()->create([
            'name' => 'Darrick Zieme',
            'email' => 'dzieme@student.apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Student')->first()->id,
        ]);

        User::factory()->create([
            'name' => 'Wilber Mayer',
            'email' => 'wmayer@student.apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Student')->first()->id,
        ]);
        
        User::factory()->create([
            'name' => 'Mabelle Lehner',
            'email' => 'mlehner@student.apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Student')->first()->id,
        ]);
        
        User::factory()->create([
            'name' => 'Clementina Mayer',
            'email' => 'cmayer@student.apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Student')->first()->id,
        ]);
        
        User::factory()->create([
            'name' => 'Astrid Hintz',
            'email' => 'ahintz@student.apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Student')->first()->id,
        ]);

        User::factory()->create([
            'name' => 'Marion Skiles',
            'email' => 'mskiles@student.apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Student')->first()->id,
        ]);
        
        User::factory()->create([
            'name' => 'Everette Jaskolski',
            'email' => 'ejaskolski@student.apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Student')->first()->id,
        ]);
        
        User::factory()->create([
            'name' => 'Heaven Carter',
            'email' => 'hcarter@student.apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Student')->first()->id,
        ]);
        
        User::factory()->create([
            'name' => 'Halle Runolfsson',
            'email' => 'hrunolfsson@student.apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Student')->first()->id,
        ]);
        
        User::factory()->create([
            'name' => 'Thaddeus Zboncak',
            'email' => 'tzboncak@student.apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Student')->first()->id,
        ]);

        User::factory()->create([
            'name' => 'Sophia Leuschke',
            'email' => 'sleuschke@student.apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Student')->first()->id,
        ]);
        
        User::factory()->create([
            'name' => 'Samson Hilpert',
            'email' => 'shilpert@student.apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Student')->first()->id,
        ]);
        
        User::factory()->create([
            'name' => 'Weldon Kunze',
            'email' => 'wkunze@student.apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Student')->first()->id,
        ]);
        
        User::factory()->create([
            'name' => 'Aurelio Casper',
            'email' => 'acasper@student.apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Student')->first()->id,
        ]);
        
        User::factory()->create([
            'name' => 'Gunnar Macejkovic',
            'email' => 'gmacejkovic@student.apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Student')->first()->id,
        ]);
        
        
        //Faculty
        User::factory()->worker()->create([
            'name' => 'Kelton Hoeger',
            'email' => 'khoeger@apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Faculty')->first()->id,
        ]);
        User::factory()->worker()->create([
            'name' => 'Jesse Schoen',
            'email' => 'jschoen@apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Faculty')->first()->id,
        ]);
        User::factory()->worker()->create([
            'name' => 'Aiyana Schmidt',
            'email' => 'aschmidt@apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Faculty')->first()->id,
        ]);
        User::factory()->worker()->create([
            'name' => 'Mose Doyle',
            'email' => 'mdoyle@apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Faculty')->first()->id,
        ]);
        User::factory()->worker()->create([
            'name' => 'Charley Moore',
            'email' => 'cmoore@apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Faculty')->first()->id,
        ]);
        
        //Faculty
        User::factory()->worker()->create([
            'name' => 'Jaron Strosin',
            'email' => 'jstrosin@apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Staff')->first()->id,
        ]);
        User::factory()->worker()->create([
            'name' => 'Eden Cole',
            'email' => 'ecole@apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Staff')->first()->id,
        ]);
        User::factory()->worker()->create([
            'name' => 'Wilson Auer',
            'email' => 'wauer@apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Staff')->first()->id,
        ]);
        User::factory()->worker()->create([
            'name' => 'Derick Konopelski',
            'email' => 'dkonopelski@apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Staff')->first()->id,
        ]);
        User::factory()->worker()->create([
            'name' => 'Ottilie Wolff',
            'email' => 'owolff@apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'Staff')->first()->id,
        ]);
        
        //No Roles
        User::factory()->worker()->create([
            'name' => 'Darrell Macejkovic',
            'email' => 'dmacejkovic@apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'No Role')->first()->id,
        ]);
        User::factory()->worker()->create([
            'name' => 'Oswald Jacobs',
            'email' => 'ojacobs@apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'No Role')->first()->id,
        ]);
        User::factory()->worker()->create([
            'name' => 'Giles Schulist',
            'email' => 'gschulist@apc.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => Role::where('role', 'No Role')->first()->id,
        ]);
    }
}


