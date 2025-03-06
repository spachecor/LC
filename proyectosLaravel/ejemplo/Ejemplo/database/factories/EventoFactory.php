<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Evento;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evento>
 */
class EventoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Evento::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombreEvento' => $this->faker->sentence(3),
            'fechaInicio' => $this->faker->date(),
            'fechaFin' => $this->faker->date(),
            'tipo' => $this->faker->randomElement(['reunión', 'conferencia', 'taller', 'presentación', 'concierto']),
            'participantes' => $this->faker->numberBetween(1, 15),
            'descripcion' => $this->faker->text(100),
        ];
    }
}
