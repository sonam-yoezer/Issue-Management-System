<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Issues;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IssueSubmissionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_submit_an_issue()
    {
        $user = User::factory()->create(); // Create a test user

        $response = $this->actingAs($user)->post(route('submit.issue'), [
            'module' => 'user-management',
            'issue_type' => 'bug',
            'description' => 'Test issue description',
            'priority' => 'high',
            'assigned_user_id' => $user->id,
        ]);

        $response->assertRedirect(); // Check for redirect
        $this->assertDatabaseHas('issues', [
            'module' => 'user-management',
            'issue_type' => 'bug',
            'description' => 'Test issue description',
            'priority' => 'high',
            'assigned_user_id' => $user->id,
        ]);
    }
}
