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

    public function test_student_cannot_be_created_without_name_field()
    {
        $user = \App\Models\User::factory()->create();
        $theme = \App\Models\Theme::factory()->create();

        $this->actingAs($user);

        $this->post('api/students', [
            'year' => $this->faker->numberBetween(1, 5),
            'class' => $this->faker->randomLetter,
            'theme_id' => $theme->id,
        ]);

        $errors = session('errors')->get('name')[0];
        $this->assertEquals($errors,'The name field is required.');
    }

    public function test_student_cannot_be_created_without_year_field()
    {
        $user = \App\Models\User::factory()->create();
        $theme = \App\Models\Theme::factory()->create();

        $this->actingAs($user);

        $this->post('api/students', [
            'name' => $this->faker->name,
            'class' => $this->faker->randomLetter,
            'theme_id' => $theme->id,
        ]);

        $errors = session('errors')->get('year')[0];
        $this->assertEquals($errors,'The year field is required.');
    }

    public function test_student_cannot_be_created_without_class_field()
    {
        $user = \App\Models\User::factory()->create();
        $theme = \App\Models\Theme::factory()->create();

        $this->actingAs($user);

        $this->post('api/students', [
            'name' => $this->faker->name,
            'year' => $this->faker->numberBetween(1, 5),
            'theme_id' => $theme->id,
        ]);

        $errors = session('errors')->get('class')[0];
        $this->assertEquals($errors,'The class field is required.');
    }

    public function test_student_cannot_be_created_without_theme_id_field()
    {
        $user = \App\Models\User::factory()->create();

        $this->actingAs($user);

        $this->post('api/students', [
            'name' => $this->faker->name,
            'year' => $this->faker->numberBetween(1, 5),
            'class' => $this->faker->randomLetter,
        ]);

        $errors = session('errors')->get('theme_id')[0];
        $this->assertEquals($errors,'The theme id field is required.');
    }

    public function test_student_can_be_retrieved()
    {
        $user = \App\Models\User::factory()->create();
        $theme = \App\Models\Theme::factory()->create();
        \App\Models\Level::create([
            'title' => 'Beginner',
            'level' => 1,
        ])->phases()->create([
            'phase' => 1,
        ]);


        $this->actingAs($user);

        $this->post('api/students', [
            'name' => $this->faker->name,
            'year' => $this->faker->numberBetween(1, 5),
            'class' => $this->faker->randomLetter,
            'theme_id' => $theme->id,
        ]);

        $student = \App\Models\Student::where('user_id', $user->id)->first();

        $response = $this->get("api/students/$student->id");

        $response->assertStatus(200);
    }

    public function test_students_list_can_be_retrieved()
    {
        $user = \App\Models\User::factory()->create();
        $theme = \App\Models\Theme::factory()->create();
        \App\Models\Level::create([
            'title' => 'Beginner',
            'level' => 1,
        ])->phases()->create([
            'phase' => 1,
        ]);

        $this->actingAs($user);

        $this->post('api/students', [
            'name' => $this->faker->name,
            'year' => $this->faker->numberBetween(1, 5),
            'class' => $this->faker->randomLetter,
            'theme_id' => $theme->id,
        ]);

        $response = $this->get('api/students');

        $response->assertStatus(200);
    }

    public function test_student_can_be_updated()
    {
        $user = \App\Models\User::factory()->create();
        $theme = \App\Models\Theme::factory()->create();
        $student = \App\Models\Student::factory()->create(['user_id' => $user->id, 'theme_id' => $theme->id]);

        $this->actingAs($user);

        $response = $this->put("api/students/$student->id", [
            'name' => 'Updated Name',
            'year' => 3,
            'class' => 'B',
            'theme_id' => $theme->id,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'name' => 'Updated Name',
            'year' => 3,
            'class' => 'B',
            'theme_id' => $theme->id,
        ]);
    }

    public function test_student_can_be_deleted()
    {
        $user = \App\Models\User::factory()->create();
        $theme = \App\Models\Theme::factory()->create();
        $student = \App\Models\Student::factory()->create(['user_id' => $user->id, 'theme_id' => $theme->id]);

        $this->actingAs($user);

        $response = $this->delete("api/students/$student->id");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('students', [
            'id' => $student->id,
        ]);
    }

}
