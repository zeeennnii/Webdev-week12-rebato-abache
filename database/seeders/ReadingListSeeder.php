<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ReadingListSeeder extends Seeder
{
    public function run(): void
    {
        // First user
        $user1 = User::create([
            'name' => 'Leonel Rebato',
            'email' => 'leonel@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Second user
        $user2 = User::create([
            'name' => 'Abache',
            'email' => 'abache@example.com',
            'password' => Hash::make('password123'),
        ]);

        // First user's books
        $user1->books()->createMany([
            [
                'title' => 'The Little Prince',
                'author' => 'Antoine de Saint-Exupery',
                'status' => 'finished',
                'rating' => 5,
            ],
            [
                'title' => 'Atomic Habits',
                'author' => 'James Clear',
                'status' => 'reading',
                'rating' => 4,
            ],
            [
                'title' => 'The Alchemist',
                'author' => 'Paulo Coelho',
                'status' => 'to-read',
                'rating' => null,
            ],
        ]);

        // Second user's books
        $user2->books()->createMany([
            [
                'title' => 'Harry Potter',
                'author' => 'J.K. Rowling',
                'status' => 'finished',
                'rating' => 5,
            ],
            [
                'title' => 'Rich Dad Poor Dad',
                'author' => 'Robert Kiyosaki',
                'status' => 'reading',
                'rating' => 4,
            ],
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'status' => 'to-read',
                'rating' => null,
            ],
        ]);
    }
}
