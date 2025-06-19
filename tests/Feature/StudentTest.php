<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_student_can_be_created()
    {

        $user = \App\Models\User::factory()->create();
        $theme = \App\Models\Theme::factory()->create();

        $this->actingAs($user);

        $response = $this->post('api/students', [
            'name' => $this->faker->name,
            'year' => $this->faker->numberBetween(1, 5),
            'class' => $this->faker->randomLetter,
            'theme_id' => $theme->id,
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('students', [
            'name' => $response['data']['name'],
            'year' => $response['data']['year'],
            'class' => $response['data']['class'],
            'user_id' => $user->id,
            'theme_id' => $theme->id,
        ]);
    }
}
