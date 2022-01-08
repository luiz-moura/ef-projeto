<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PessoaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome'          => $this->faker->name(),
            'email'         => $this->faker->email(),
            'telefone'      => $this->faker->phoneNumber(),
            'rua'           => $this->faker->streetAddress(),
            'complemento'   => $this->faker->address(),
        ];
    }
}
