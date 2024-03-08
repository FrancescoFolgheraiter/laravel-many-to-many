<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\Project;
use App\Models\Type;

// Helpers 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

//importazione carbon
use Carbon\Carbon;
class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //primo modo per eseguire in modo sicuro il truncate
        Schema::disableForeignKeyConstraints();
        Project::truncate();
        Schema::enableForeignKeyConstraints();

        for ($i = 0; $i < 10; $i++) {
            //estraggo un type a caso
            $rndType = Type::inRandomOrder()->first();
            $name = fake()->sentence();
            $slug = Str::slug($name);
            $project = Project::create([
                'name' => $name,
                'slug' => $slug,
                'description' => fake()->paragraph(),
                'type_id'=> $rndType->id,
                'start_date'=>Carbon::now(),
                'last_update_date'=>Carbon::now(),
                'total_hours'=> fake()->randomFloat(1,0.5,100)
            ]);
        }
    }
}
