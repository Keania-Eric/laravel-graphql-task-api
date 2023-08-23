<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class CreateTaskTest extends TestCase
{
    /**
     * Authenticated user can create task
     */
    public function test_authenticated_user_can_create_task(): void
    {
        $user = User::factory()->create();
        $title = 'Data Science with Kotlin & Numpy and Spring';

        $response = $this->actingAs($user, 'sanctum')->graphQL(/** @lang GraphQL */ '
            mutation($title : String!, $id: Int!){ 
                createTask(input: {
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
        ]);

        $response->assertJson([
            'data' => [
                'createTask' => [
                    'title' => $title,
                ],
            ],
        ]);
    }

    /**
     * Authenticated user can create task
     */
    public function test_unauthenticated_user_cannot_create_task(): void
    {
        $user = User::factory()->create();
        $title = 'Data Science with Kotlin & Numpy and Spring';

        $response = $this->graphQL(/** @lang GraphQL */ '
            mutation($title : String!, $id: Int!){ 
                createTask(input: {
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
        ]);

        $response->assertGraphQLErrorMessage('Unauthenticated.');
    }

    public function test_authenticated_user_cannot_create_task_with_failed_validation(): void
    {
        $user = User::factory()->create();
        $title = 'Data Science with Kotlin & Numpy and Spring';

        $response = $this->actingAs($user, 'sanctum')->graphQL(/** @lang GraphQL */ '
            mutation($title : String!, $id: Int!){ 
                createTask(input: {
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
        ]);

        $response->assertGraphQLValidationError('input.description', 'The input.description field is required.');
    }
}
