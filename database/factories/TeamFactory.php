<?php
namespace Database\Factories;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory {
    
    protected $model = Team::class;
    public function definition() {

        $images=['1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg'];
        return [
            'name' => $this->faker->name(),
            'position'=>$this->faker->jobTitle(),
            'description'=>$this->faker->paragraph,
            'image' =>$this->faker->randomElement($images),
        ];
    }
}
