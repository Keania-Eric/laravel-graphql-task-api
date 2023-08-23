<?php

namespace Tests\Unit;

use App\Models\Task;
use App\Models\User;
use Tests\TestCase;

class DeleteTaskTest extends TestCase
{
    /**
     * Authenticated user can delete task
     */
    public function test_authenticated_user_can_delete_task(): void
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user, 'sanctum')->graphQL(/** @lang GraphQL */ '
            mutation($taskId: ID!){ 
                deleteTask(id: $taskId) {
                  title
                  
                }
              }
        ', [
            'taskId' => $task->id,
        ]);

        $response->assertJson([
            'data' => [
                'deleteTask' => null,
            ],
        ]);
    }

    /**
     * Authenticated user cannot update task
     */
    public function test_unauthenticated_user_cannot_delete_task(): void
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        $response = $this->graphQL(/** @lang GraphQL */ '
            mutation($taskId: ID!){ 
                deleteTask(id: $taskId) {
                  title
                  
                }
              }
        ', [
            'taskId' => $task->id,
        ]);

        $response->assertGraphQLErrorMessage('Unauthenticated.');
    }

    
}
