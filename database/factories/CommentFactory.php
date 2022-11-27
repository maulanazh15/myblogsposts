<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $post_id = mt_rand(1, 200);
        $user_id = mt_rand(1, 50);
        $comment_id = $post_id . $user_id . time();
        $comment = $this->faker->sentence(mt_rand(2, 5));
        return [
            'post_id' => $post_id,
            'user_id' => $user_id,
            'comment_id' => $comment_id,
            'comment' => $comment,
            'created_at' => $this->faker->dateTimeBetween('-5 week','now')
        ];
    }
}
