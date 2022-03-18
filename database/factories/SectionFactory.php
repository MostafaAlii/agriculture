<?php

namespace Database\Factories;

use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SectionFactory extends Factory
{
   protected $model = Section::class;
    public function definition()
    {
        $section_name = $this->faker->unique()->words($nb=2,$asText=true);
        $slug = Str::slug($section_name);

        return [
            'section_name'=>$section_name,
            'slug'=>$slug,
        ];
    }
}
