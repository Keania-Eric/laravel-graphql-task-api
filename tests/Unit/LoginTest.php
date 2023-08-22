<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * User can login
     */
    public function test_existing_user_can_login_with_right_credentials(): void
    {
        User::factory()->create([
            'email' => 'johndoe@gmail.com',
            'password' => bcrypt('secret'),
        ]);

        $response = $this->graphQL(/** @lang GraphQL */ '
            mutation {
                login(input: {
                    email: "johndoe@gmail.com"
                    password: "secret"
                }) {
                    token
                }
            }
        ');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'login' => [
                    'token',
                ],
            ],
        ]);
    }

    public function test_existing_user_cannot_login_with_wrong_credentials(): void
    {
        User::factory()->create([
            'email' => 'johndoe@gmail.com',
            'password' => bcrypt('secret'),
        ]);

        $response = $this->graphQL(/** @lang GraphQL */ '
            mutation {
                login(input: {
                    email: "johndoe@gmail.com"
                    password: "secrer1"
                }) {
                    token
                }
            }
        ');

        $response->assertGraphQLValidationError('email', 'The provided credentials are incorrect');
    }
}
