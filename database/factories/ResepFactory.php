<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ResepFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'judul_resep' => $this->faker->sentence(mt_rand(2,8)),
            'slug' => $this->faker->slug(),
            'deskripsi' => $this->faker->paragraph(),
            // 'resepnya' => '<p>' . implode('</p><p>', $this->faker->paragraphs(mt_rand(5,10))). '</p>',
            'resepnya' => collect($this->faker->paragraphs(mt_rand(5,10)))
                            ->map(fn($p) => "<p>$p</p>")
                            ->implode(''),
            'user_id' => mt_rand(1,3),
            'kategori_id' => mt_rand(1,2)
        ];
    }
}
