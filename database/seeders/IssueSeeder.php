<?php

namespace Database\Seeders;

use App\Models\Issue;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class IssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 0; $x <= 10; $x++) {
            Issue::create([
                'name' => Str::random(50)
            ]);
        }
        
        
    }
}
