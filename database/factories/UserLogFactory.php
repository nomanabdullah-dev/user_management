<?php

namespace Database\Factories;

use App\Models\UserLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserLog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'   => 250,
            'slug'      => 'random_action',
            'message'   => $this->faker->sentence(12)
        ];
    }
}
