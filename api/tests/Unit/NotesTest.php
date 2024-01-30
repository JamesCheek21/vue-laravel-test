<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Notes;

class NotesTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_notes()
    {
        $response = $this->get('api/notes');
        $response->assertStatus(200);
    }

    public function test_can_get_note_by_id()
    {
        $note = Notes::factory()->create();

        $response = $this->get('api/notes/' .$note->id);
        $response->assertStatus(200)
                 ->assertJson($note->toArray());
    }

    public function test_can_create_note()
    {
        $noteData = [
            'title' => 'Test Note Title',
            'content' => 'Test Note Content',
        ];

        $response = $this->post('api/notes', $noteData);
        $response->assertStatus(201)
                 ->assertJson($noteData);

        $this->assertDatabaseHas('notes', $noteData);
    }

    public function test_can_update_note()
    {
        $note = Notes::factory()->create();

        $noteData = [
            'title' => 'Updated Test Note Title',
            'content' => 'Updated Test Note Content',
        ];

        $response = $this->put('api/notes/' . $note->id, $noteData);
        $response->assertStatus(200)
                 ->assertJson($noteData);

        $this->assertDatabaseHas('notes', $noteData);
    }

    public function test_can_delete_note()
    {
        $note = Notes::factory()->create();

        $response = $this->delete('api/notes/' . $note->id);
        $response->assertStatus(200)
                 ->assertJson(['message' => 'Note deleted successfully']);

        $this->assertDatabaseMissing('notes', ['id' => $note->id]);
    }

    public function test_show_note_not_found_error()
    {
        $response = $this->get('api/notes/999');

        $response->assertStatus(404);
    }

    public function test_create_note_validation_error()
    {
        $noteData = ['content' => 'Test Note Content'];

        $response = $this->postJson('api/notes', $noteData);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['title']);
    }

    public function test_update_note_validation_error()
    {
        $note = Notes::factory()->create();

        $invalidNoteData = [
            'title' => '',
            'content' => 'Updated Test Note Content'
        ];

        $response = $this->putJson('api/notes/' . $note->id, $invalidNoteData);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['title']);
    }

    public function test_update_note_not_found_error()
    {
        $noteData = [
            'title' => 'Updated Test Note Title',
            'content' => 'Updated Test Note Content',
        ];

        $response = $this->putJson('api/notes/999', $noteData);

        $response->assertStatus(404);
    }

    public function test_delete_note_not_found_error()
    {
        $response = $this->delete('api/notes/999');

        $response->assertStatus(404);
    }
}
