<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;
use App\Models\Admin\Project;

use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for( $i = 0; $i < 20; $i++ ){
            $new_project = new Project();
            $new_project->title = $faker->sentence(3);
            $new_project->content = $faker->text(200);
            $new_project->cover_image = $faker->imageUrl(400, 260, "animals", true);
            $new_project->slug = Str::slug($new_project->title, '-');
            $new_project->save();
        }
    }
}
