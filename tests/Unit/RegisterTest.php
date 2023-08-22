<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * User can register successfully
     */
    public function test_user_can_register_successfully(): void
    {

        $response = $this->graphQL(/** @lang GraphQL */ '
            mutation {
                registerUser(input: {
                    name: "John Doe"
                    email: "johndoe@gmail.com"
                    password: "secret"
                    passwordConfirmation: "secret"
                }) {
                    name
                    email
                }
            }
        ');

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'registerUser' => [
                    'name' => 'John Doe',
                    'email' => 'johndoe@gmail.com',
                ],
            ],
        ]);
    }

    public function test_user_registration_fails_on_existing_email(): void
    {
        User::factory()->create([
            'email' => 'johndoe@gmail.com',
        ]);

        $response = $this->graphQL(/** @lang GraphQL */ '
            mutation {
                registerUser(input: {
                    name: "John Doe"
                    email: "johndoe@gmail.com"
                    password: "secret"
                    passwordConfirmation: "secret"
                }) {
                    name
                    email
                }
            }
        ');

        $response->assertGraphQLValidationError('input.email', 'The input.email has already been taken.');
    }

    public function test_user_registration_fails_on_wrong_password_confirm(): void
    {

        $response = $this->graphQL(/** @lang GraphQL */ '
            mutation {
                registerUser(input: {
                    name: "John Doe"
                    email: "johndoe@gmail.com"
                    password: "secret1"
                    passwordConfirmation: "secret"
                }) {
                    name
                    email
                }
            }
        ');

        $response->assertGraphQLValidationError('input.password', 'The input.password field must match input.password confirmation.');
    }
}
