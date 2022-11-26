<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $body = collect($this->faker->paragraphs(mt_rand(10,25)))->map(fn($p) => "<p>$p</p>")->implode('');
        $excerpt = Str::limit(strip_tags($body), 200);
        
        return [
            'title' => $this->faker->sentence(mt_rand(2, 8)),
            'slug' => $this->faker->slug(),
            'excerpt' => $excerpt,
            // 'body' => $this->faker->paragraphs(mt_rand(10,25)),
            'body' => $body,
            'user_id' => mt_rand(1,30),
            'category_id' => mt_rand(1,3),
            'created_at' => $this->faker->dateTimeBetween('-4 week','+4 week'),
            'published_at' => $this->faker->dateTimeBetween('-4 week','+4 week')
        ];
    }
}
