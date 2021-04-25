<?php

namespace Database\Factories;

use App\Models\Publication;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PublicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Publication::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $created_at = $this->faker->dateTimeBetween('-6 months', 'now');
        return [
            'title' => $this->faker->text(30),
            'body' => $this->faker->text(),
            'created_by' => null,
            'created_at' => $created_at,
            'updated_at' => $this->faker->dateTimeBetween($created_at, 'now')
        ];
    }
}
