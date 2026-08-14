<?php

use App\Models\User;

test('mdms admin page shows meta fields in add and edit modals', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('mdms.index'))->assertOk();
    $response->assertSee('add_meta_title', false);
    $response->assertSee('add_meta_description', false);
    $response->assertSee('add_meta_keywords', false);
    $response->assertSee('edit_meta_title', false);
    $response->assertSee('edit_meta_description', false);
    $response->assertSee('edit_meta_keywords', false);
});
