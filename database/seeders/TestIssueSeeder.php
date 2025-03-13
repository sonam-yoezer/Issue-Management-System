<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Issues;

class TestIssueSeeder extends Seeder
{
    public function run()
    {
        Issues::create([
            'module' => 'Test Module',
            'issue_type' => 'Bug',
            'description' => 'This is a test issue.',
            'priority' => 'medium',
            'img' => null, // No image for the test issue
            'assigned_user_id' => null, // No user assigned for the test issue
        ]);
    }
}
