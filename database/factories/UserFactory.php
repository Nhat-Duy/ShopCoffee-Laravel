<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\Roles;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'admin_name' => $this->faker->name(),
            'admin_email' => $this->faker->unique()->safeEmail(),
            'admin_phone' => '0364349546',
            'admin_password' => 'e10adc3949ba59abbe56e057f20f883e', // password
        ];
    }

    /**
     * Configure the model after being created.
     */
    public function configure()
    {
        return $this->afterCreating(function (Admin $admin) {
            $roles = Roles::where('name', 'user')->get();
            $admin->roles()->sync($roles->pluck('id_roles')->toArray());
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}