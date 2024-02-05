<?php

namespace AchyutN\LaravelHelpers\Tests;

use AchyutN\LaravelHelpers\Tests\BaseTestCase;

class ValidationTest extends BaseTestCase
{
    public function test_call_lat_long_route_with_valid_data()
    {
        $response = $this->post('/lat-long', [
            'latitude' => 27.7172,
            'longitude' => 85.3240
        ]);
        $response->assertStatus(200);
    }

    public function test_call_lat_long_route_with_string()
    {
        $response = $this->post('/lat-long', [
            'latitude' => 'test',
            'longitude' => 'test'
        ]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['latitude']);
        $response->assertSessionHasErrors(['longitude']);

        $this->assertEquals('The latitude must be a number.', session('errors')->get('latitude')[0]);
        $this->assertEquals('The longitude must be a number.', session('errors')->get('longitude')[0]);
    }

    public function test_call_lat_long_route_with_invalid_latitude()
    {
        $response = $this->post('/lat-long', [
            'latitude' => 91,
            'longitude' => 85.3240
        ]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['latitude']);
        $this->assertEquals('The latitude must be between -90 and 90.', session('errors')->get('latitude')[0]);
    }

    public function test_call_lat_long_route_with_invalid_longitude()
    {
        $response = $this->post('/lat-long', [
            'latitude' => 27.7172,
            'longitude' => 181
        ]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['longitude']);
        $this->assertEquals('The longitude must be between -180 and 180.', session('errors')->get('longitude')[0]);
    }

    public function test_call_lat_long_route_with_invalid_latitude_and_longitude()
    {
        $response = $this->post('/lat-long', [
            'latitude' => 91,
            'longitude' => 181
        ]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['latitude', 'longitude']);
        $this->assertEquals('The latitude must be between -90 and 90.', session('errors')->get('latitude')[0]);
        $this->assertEquals('The longitude must be between -180 and 180.', session('errors')->get('longitude')[0]);
    }
}