<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Issue;

class IssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Issue::create([
            'name' => 'Test'
        ]);
        
    }
}
