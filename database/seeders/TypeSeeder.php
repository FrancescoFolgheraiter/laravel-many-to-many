<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\Type;
use Illuminate\Support\Facades\Schema;

// Helpers per slug
use Illuminate\Support\Str;
class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //secondo modo per eseguire in modo sicuro il truncate
        Schema::withoutForeignKeyConstraints(function () {
            type::truncate();
        });

        $allCategories = [
            'HTML',
            'CSS',
            'Bootstrap',
            'JavaScript',
            'Vue',
            'SQL',
            'PHP',
            'Laravel'
        ];

        foreach ($allCategories as $singleCategory) {
            $category = type::create([
                'name' => $singleCategory
            ]);
        }
    }
}
