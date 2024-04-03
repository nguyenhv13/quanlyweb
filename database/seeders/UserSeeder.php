<?php

namespace Database\Seeders;

use App\Models\Promotion;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $time = now();
        // User::create([
        //     'name' => 'Nguyen',
        //     'email' => 'nguyenhv13@gmail.com',
        //     'role_name' => 'Admin',
        //     'password' => bcrypt(123456789),
        // ]);
        // User::create([
        //     'name' => 'gv3',
        //     'email' => 'gv3@gmail.com',
        //     'role_name' => 'Teacher',
        //     'password' => bcrypt(123456789),
        // ]);
        for ($i = 1; $i <= 30; $i++) {

            $user = User::create([
                'name' => $faker->name,
                'email'=> $faker->email,
                'role_name'=> 'Student',
                'password' => bcrypt(123456789),
            ]);

            $student = Student::create([
                'name' => $user->name,
                // 'class_id' => 1,
                'batch_id' => 1,
                'first_name'=> $user->name,
                'last_name' =>$user->name,
                'user_id' =>$user->id,
                'dateOfBirth' => $faker->date('y-m-d'),
                'email'=> $user->email,
                'gender' => rand(1, 2),
                // 'mobileNumber' => $faker->phoneNumber,
                'father_name' => $faker->name,
                'mother_name' => $faker->name,
                'father_number' => $faker->phoneNumber,
                'mother_number' => $faker->phoneNumber,
                'address' => $faker->address,
                'created_at' => $time,
                'updated_at' => $time,
            ]);
            Promotion::firstOrcreate([
            'student_id'    => $student->id,
            'class_id'      => rand(1,3), // cho nay la 3 lop, neu tao them 1 lop tang so 3 len 1 kieu nay  'class_id'      => rand(1,4)
            'session_id'    => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]);
            Promotion::firstOrcreate([
                'student_id'    => $student->id,
                'class_id'      => rand(1,10),
                'session_id'    => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                ]);

        }
    }
}
