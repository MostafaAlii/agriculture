<?php

namespace Database\Factories;

use App\Models\Department;

use Illuminate\Database\Eloquent\Factories\Factory;


class departmentFactory extends Factory
{
    protected $model = Department::class;
    public function definition()
    {
            return [
                'name'  => $this->faker->randomElement(['اداره الثروه السمكيه','اداره المنتجات الحيوانيه','اداره المنتجات الزراعيه']),
            ];



    }


}
