<?php
namespace Database\Factories;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory {
    
    protected $model = Team::class;
    public function definition() {
        return [
            'name' => $this->faker->name(),
            'position'=>$this->faker->jobTitle(),
            'description'=>$this->faker->paragraph,
            'image'=> '',
        ];
    }
}