<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            ['name' => 'Directories', 'description' => 'Number of directories in the project'],
            ['name' => 'Files', 'description' => 'Number of files in the project'],
            ['name' => 'Lines of Code', 'description' => 'Total lines of code in the project'],
            ['name' => 'Comment Lines of Code', 'description' => 'Lines of comments in the code'],
            ['name' => 'Non-Comment Lines of Code', 'description' => 'Total non-comment lines of code'],
            ['name' => 'Logical Lines of Code', 'description' => 'Logical lines of code'],
            ['name' => 'Size-Classes', 'description' => 'Number of size classes in the codebase'],
            ['name' => 'Average Class Length', 'description' => 'Average length of classes'],
            ['name' => 'Average Method Length', 'description' => 'Average length of methods'],
            ['name' => 'Average Methods Per Class', 'description' => 'Average number of methods per class'],
            ['name' => 'Functions', 'description' => 'Number of functions in the codebase'],
            ['name' => 'Average Function Length', 'description' => 'Average length of functions'],
            ['name' => 'Not in classes or functions', 'description' => 'Lines of code not inside classes or functions']
        ];

        // Use factory to create each attribute
        foreach ($attributes as $attribute) {
            \App\Models\Attribute::factory()->create($attribute);
        }
    }
}
