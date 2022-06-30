<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Comment;

use App\Models\Student;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_comments_list()
    {
        $comments = Comment::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.comments.index'));

        $response->assertOk()->assertSee($comments[0]->comment);
    }

    /**
     * @test
     */
    public function it_stores_the_comment()
    {
        $data = Comment::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.comments.store'), $data);

        $this->assertDatabaseHas('comments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_comment()
    {
        $comment = Comment::factory()->create();

        $student = Student::factory()->create();

        $data = [
            'comment' => $this->faker->text,
            'student_id' => $student->id,
        ];

        $response = $this->putJson(
            route('api.comments.update', $comment),
            $data
        );

        $data['id'] = $comment->id;

        $this->assertDatabaseHas('comments', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_comment()
    {
        $comment = Comment::factory()->create();

        $response = $this->deleteJson(route('api.comments.destroy', $comment));

        $this->assertModelMissing($comment);

        $response->assertNoContent();
    }
}
