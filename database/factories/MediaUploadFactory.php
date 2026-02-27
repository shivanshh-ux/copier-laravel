<?php

namespace Database\Factories;

use App\Models\MediaUpload;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaUploadFactory extends Factory
{
    protected $model = MediaUpload::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'type' => $this->faker->randomElement(['video', 'pdf']),
            'file_path' => 'media/' . $this->faker->uuid() . '.dat',
            'original_name' => $this->faker->word() . ($this->faker->boolean() ? '.mp4' : '.pdf'),
        ];
    }
}
