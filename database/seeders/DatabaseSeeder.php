<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use App\Models\LandmarkUser;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        LandmarkUser::create([
            'id_user' => 1,
            'id_landmark' => 207279185,
            'is_favourite' => 1,
            'status' => 'to_see',
        ]);

        LandmarkUser::create([
            'id_user' => 1,
            'id_landmark' => 207279186,
            'is_favourite' => 1,
            'status' => 'seen',
            'mark' => 3
        ]);

        Comment::create([
            'id_user' => 1,
            'id_landmark' => 207279186,
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi itaque eos voluptas ipsum. Corporis nostrum qui eius reprehenderit harum nesciunt consequuntur, enim maxime voluptatem at, soluta vero? Ratione, impedit eum.'
        ]);
    }
}
