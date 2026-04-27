<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genres = ['Technology', 'Fiction', 'Philosophy', 'History', 'Poetry', 'Mystery', 'Sci-Fi', 'Biography', 'Business', 'Art', 'Psychology', 'Self-Help'];
        
        $titles = [
            'The Art of ', 'Journey to ', 'Echoes of ', 'The Secret of ', 'Whispers in ', 
            'Chronicles of ', 'Beyond the ', 'The Midnight ', 'Shadows of ', 'Lost in ',
            'Principles of ', 'The Hidden ', 'Legacy of ', 'Vision of ', 'Path to '
        ];
        
        $subjects = [
            'Knowledge', 'Tomorrow', 'The Stars', 'Ancient Wisdom', 'Silence', 
            'The Soul', 'Reality', 'Infinity', 'Modern Life', 'Greatness',
            'Leadership', 'Innovation', 'Success', 'The Mind', 'Humanity'
        ];

        return [
            'judul' => $this->faker->randomElement($titles) . $this->faker->randomElement($subjects),
            'penulis' => $this->faker->name(),
            'genre' => $this->faker->randomElement($genres),
            'deskripsi' => $this->faker->paragraph(4),
            'cover_image' => null,
            'file_path' => 'ebooks/placeholder.pdf',
        ];
    }
}
