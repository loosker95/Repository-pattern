<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;

class AppTest extends TestCase
{
  
    use RefreshDatabase;

    public function test_home_page_display_properly(){
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_home_page_is_not_empty(){
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertDontSee('No data available...');
    }

    public function test_page_create_display_successfylly(): void
    {
        $response = $this->get('/create');
        $response->assertStatus(200);
    }

    public function test_create_validation_throw_error(){
        $user = User::factory()->create();

        $post = Post::factory()->create([
            'author' => '',
            'title' => '',
            'summary' => '',
            'body' => '',
        ]);
        $response = $this->actingAs($user)->post('/', $post->toArray());
        $response->assertStatus(302);
        // $response->assertInvalid(['author', 'title', 'summary', 'body']);
        // $reponse->assertSessionHasErrors([''])
    }

    public function test_create_post_display_properly(){
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $response = $this->actingAs($user)->post('/', $post->toArray());
        $response->assertStatus(302);
        $response->assertRedirect(route('index.post'));
        // To check if data inserted exist in database
        $this->assertDatabaseHas('posts', $post->toArray());

        // Compare the data inserted with latest entry in the database
        $last = Post::latest()->first();
        $this->assertEquals($post->toArray()['author'], $last->author);
        $this->assertEquals($post->toArray()['title'], $last->title);
        $this->assertEquals($post->toArray()['summary'], $last->summary);
        $this->assertEquals($post->toArray()['body'], $last->body);
    }

    public function test_edit_page_display_properly(){
        $user = User::factory()->create();
        $post = Post::factory()->create();
        $response = $this->actingAs($user)->get('post/'.$post->toArray()['id'].'/edit');
        $response->assertStatus(200);

        // Check if it return the data in the form
        $response->assertSee('value="'.$post->toArray()['title'].'"', false); 
        $response->assertSee($post->toArray()['summary']);
        $response->assertSee($post->toArray()['body']);
        // alternative
        // $response->assertViewHas('posts', ...)
    }

    public function test_post_updated_successfully(){
        $user = User::factory()->create();
        $post = Post::factory()->create();
        $response = $this->actingAs($user)->put('update/'.$post->toArray()['id'], $post->toArray());

        $response->assertStatus(302);
        $response->assertRedirect('/');

        // check the if the latest update match the input
        $last = Post::latest()->first();
        $this->assertEquals($post->toArray()['author'], $last->author);
        $this->assertEquals($post->toArray()['title'], $last->title);
    }

    public function test_post_deleted_successfully(){
        $user = User::factory()->create();
        $post = Post::factory()->create();
        
        $response = $this->actingAs($user)->delete('remove/'.$post->toArray()['id'], $post->toArray());
        $response->assertStatus(302);
        $response->assertRedirect('/');

        // check if data still exist in DB
        $this->assertDatabaseMissing('posts', $post->toArray());

        // Count to check of DB is empty to confirm data has been deleted
        $this->assertDatabaseCount('posts', 0);
        // assertCount(); can be used as alternative
    }

    public function test_show_page_display_data(){
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $response = $this->actingAs($user)->get('show/'.$post->toArray()['id']);
        $response->assertStatus(200);

        $response->assertSee($post->toArray()['title']);
        $response->assertSee($post->toArray()['summary']);
        $response->assertSee($post->toArray()['body']);

        // alternative
        // $response->assertViewHas()
    }
}
