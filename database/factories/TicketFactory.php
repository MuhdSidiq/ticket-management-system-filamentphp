<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    protected $model = Ticket::class;
    public function definition(): array
    {
        return [
            
            'subject' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'reporter_id' => User::factory(),
            'status' => $this->faker->randomElement(['open', 'closed', 'resolved', 'in_progress']),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
        ];
    }
}
