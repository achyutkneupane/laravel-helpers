<?php

namespace AchyutN\LaravelHelpers\Tests;

use AchyutN\LaravelHelpers\Tests\Models\User;

class MatchOldPasswordTest extends BaseTestCase
{

    public \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_call_password_change_route_with_valid_data()
    {
        $response = $this->actingAs($this->user)->post('/change-password', [
            'password' => 'password'
        ]);
        $response->assertStatus(200);
    }

    public function test_call_password_change_route_with_invalid_data()
    {
        $response = $this->actingAs($this->user)->post('/change-password', [
            'password' => 'Password'
        ]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['password']);

        $this->assertEquals('The old password does not match.', session('errors')->get('password')[0]);
    }
}
