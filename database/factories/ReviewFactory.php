<?php
namespace Database\Factories;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory {
    
    protected $model = Review::class;
    public function definition() {

        return [
            'name' => $this->faker->name(),
            'email'=>$this->faker->email(),
            'message'=>$this->faker->paragraph,
            'show_or_hide'=>'1',
        ];
    }
}
