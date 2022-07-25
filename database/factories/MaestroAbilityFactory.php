<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaestroAbility>
 */
class MaestroAbilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    function get_user_id()
    {
        $user = User::factory()->create();
        return $user->id;
    }

    public function definition()
    {
        return [
            'maestro_id' => $this->get_user_id(),
            'ability' => fake()->randomElement(['violin', 'guitar', 'setar', 'piano']),
        ];
    }
}
