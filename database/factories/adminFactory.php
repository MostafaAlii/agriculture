<?php

namespace Database\Factories;

use App\Models\AdminDepartment;
use App\Models\Area;
use App\Models\Country;
use App\Models\Department;
use App\Models\Province;
use App\Models\State;
use App\Models\Village;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    /**
     * Define the model's default states.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->name(),
            'lastname' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->numerify('###########'),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'address1'         => $this->faker->streetAddress,
            'address2'         => $this->faker->streetAddress,
            'country_id'       => $this->faker->numberBetween(1, Country::count()),
            'province_id'      => $this->faker->numberBetween(1, Province::count()),
            'area_id'          => $this->faker->numberBetween(1, Area::count()),
            'state_id'         => $this->faker->numberBetween(1, State::count()),
            'village_id'       => $this->faker->numberBetween(1, Village::count()),
            'department_id'    => $this->faker->numberBetween(1, Department::count()),
            'admin_department_id'    => $this->faker->numberBetween(1, AdminDepartment::count()),

            'birthdate'        => $this->faker->date,

            'remember_token' => Str::random(10),
        ];
    }

    public function unverified() {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}