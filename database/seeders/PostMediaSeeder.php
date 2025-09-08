<?php

namespace Database\Seeders;

use App\Models\PostMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $media = [
            [
                'post_id' => 1,
                'file_type' => 'image',
                'file' => 'https://example.com/images/post1.jpg',
                'position' => 1
            ],
            [
                'post_id' => 1,
                'file_type' => 'video',
                'file' => 'https://example.com/videos/post1.mp4',
                'position' => 2
            ],
            [
                'post_id' => 2,
                'file_type' => 'image',
                'file' => 'https://example.com/images/post2.jpg',
                'position' => 1
            ],
        ];

        foreach ($media as $data) {
            PostMedia::create($data);
        }
    }
}
