<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\UserRegistered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateNewUser(): void
    {
        Notification::fake();

        $response = $this->post('/user', [
            'name' => 'John Doe',
            'password' => 'password',
            'password_confirmation' => 'password',
            'email' => 'JOWN@doE.CoM',
        ]);

        $response
            ->assertCreated()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                ],
            ])
            ->assertJsonFragment([
                'name' => 'John Doe',
                'email' => 'jown@doe.com',
            ]);

        Notification::assertSentTo(
            User::first(),
            UserRegistered::class
        );
    }
}
