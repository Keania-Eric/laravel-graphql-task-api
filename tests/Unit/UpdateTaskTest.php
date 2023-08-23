<?php

namespace Tests\Unit;

use App\Models\Task;
use App\Models\User;
use Tests\TestCase;

class UpdateTaskTest extends TestCase
{
    /**
     * Authenticated user can update task
     */
    public function test_authenticated_user_can_update_task(): void
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id'=> $user->id]);
        $title = 'Data Science with Kotlin & Numpy and Spring';

        $response = $this->actingAs($user, 'sanctum')->graphQL(/** @lang GraphQL */ '
            mutation($title : String!, $id: Int!, $taskId: ID!){ 
                updateTask(id: $taskId,input: {
                 user_id: $id
                  title: $title
                  description: "Buy an Udemy course to build an API"
                  due_date: "2023/08/24"
                  status: "Pending"
                }) {
                  title
                  
                }
              }
        ', [
            'title' => $title,
            'id' => $user->id,
            'taskId'=> $task->id
        ]);

        $response->assertJson([
            'data' => [
                'updateTask' => [
                    'title' => $title,
                ],
            ],
        ]);
    }

    /**
     * Authenticated user cannot update task
     */
    public function test_unauthenticated_user_cannot_update_task(): void
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id'=> $user->id]);
        $title = 'Data Science with Kotlin & Numpy and Spring';

        $response = $this->graphQL(/** @lang GraphQL */ '
            mutation($title : String!, $id: Int!, $taskId: ID!){ 
                updateTask(id: $taskId,input: {
                 user_id: $id
                  title: $title
                  description: "Buy an Udemy course to build an API"
                  due_date: "2023/08/24"
                  status: "Pending"
                }) {
                  title
                  
                }
              }
        ', [
            'title' => $title,
            'id' => $user->id,
            'taskId'=> $task->id
        ]);

        $response->assertGraphQLErrorMessage('Unauthenticated.');
    }

    public function test_authenticated_user_cannot_update_task_with_failed_validation(): void
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id'=> $user->id]);
        $title = 'Data Science with Kotlin & Numpy and Spring';

        $response = $this->actingAs($user, 'sanctum')->graphQL(/** @lang GraphQL */ '
            mutation($title : String!, $id: Int!, $taskId: ID!){ 
                updateTask(id: $taskId,input: {
                 user_id: $id
                  title: $title
                  description: ""
                  due_date: "2023/08/24"
                  status: "Pending"
                }) {
                  title
                  
                }
              }
        ', [
            'title' => $title,
            'id' => $user->id,
            'taskId'=> $task->id
        ]);

        $response->assertGraphQLValidationError('input.description', 'The input.description field is required.');
    }
}
