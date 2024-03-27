<?php

namespace Tests\Feature\Tag;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;


class AdminTagControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */

    public function admin_can_see_admin_tags_index_test(): void
    {
        $adminUser = create_admin_user();

        $response = $this->actingAs($adminUser)->get(route('admin.tags.index'));

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Admin/Tags/Index')
            ->has('tags', Tag::count())
        );
    }

    /**
     * @test
     */

    public function regular_user_cannot_see_admin_tags_index_test(): void
    {
        $regularUser = create_default_user();

        $response = $this->actingAs($regularUser)->get(route('admin.tags.index'));
        $response->assertStatus(302);
    }

    /**
     * @test
     */

    public function admin_can_see_admin_tags_create_test(): void
    {
        $adminUser = create_admin_user();

        $response = $this->actingAs($adminUser)->get(route('admin.tags.create'));

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Admin/Tags/Create')
        );
    }

    /**
     * @test
     */

    public function regular_user_cannot_see_admin_tags_create_test(): void
    {
        $regularUser = create_default_user();

        $response = $this->actingAs($regularUser)->get(route('admin.tags.create'));
        $response->assertStatus(302);
    }

    /**
     * @test
     */

    public function admin_can_see_admin_tags_edit_test(): void
    {
        $adminUser = create_admin_user();
        $tag = create_tag();

        $response = $this->actingAs($adminUser)->get(route('admin.tags.edit', $tag->id));

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Admin/Tags/Edit')
            ->has('tag')
        );
    }

    /**
     * @test
     */

    public function regular_user_cannot_see_admin_tags_edit_test(): void
    {
        $regularUser = create_default_user();
        $tag = create_tag();

        $response = $this->actingAs($regularUser)->get(route('admin.tags.edit', $tag->id));
        $response->assertStatus(302);
    }

    /**
     * @test
     */

    public function admin_can_create_tag_test(): void

    {
        $adminUser = create_admin_user();

        $response = $this->actingAs($adminUser)->post(route('admin.tags.store'), [
            'name' => 'Tag 1',
            'description' => 'Description of tag 1',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.tags.index'));
        $this->assertDatabaseHas('tags', [
            'name' => 'Tag 1',
            'description' => 'Description of tag 1',
        ]);
    }

    /**
     * @test
     */

    public function regular_user_cannot_create_tag_test(): void
    {
        $regularUser = create_default_user();

        $response = $this->actingAs($regularUser)->post(route('admin.tags.store'), [
            'name' => 'Tag 1',
            'description' => 'Description of tag 1',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('welcome'));
        $this->assertDatabaseMissing('tags', [
            'name' => 'Tag 1',
            'description' => 'Description of tag 1',
        ]);
    }

    /**
     * @test
     */

     public function admin_can_edit_tag_test(): void
     {
         $adminUser = create_admin_user();
         $tag = create_tag();

         $response = $this->actingAs($adminUser)->put(route('admin.tags.update', $tag->id), [
             'name' => 'Tag 1 Updated',
             'description' => 'Updated description of tag 1',
         ]);

         $response->assertStatus(302);
         $response->assertRedirect(route('admin.tags.index'));

         $this->assertDatabaseHas('tags', [
             'name' => 'Tag 1 Updated',
             'description' => 'Updated description of tag 1',
         ]);

         $this->assertDatabaseMissing('tags', [
             'name' => 'Tag 1',
             'description' => 'Description of tag 1',
         ]);
     }

    /**
     * @test
     */

    public function regular_user_cannot_edit_tag_test(): void
    {
        $regularUser = create_default_user();
        $tag = create_tag();

        $response = $this->actingAs($regularUser)->put(route('admin.tags.update', $tag->id), [
            'name' => 'Tag 1 Updated',
            'description' => 'Updated description of tag 1',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('welcome'));

        $this->assertDatabaseHas('tags', [
            'name' => 'Tag 1',
            'description' => 'Description of tag 1',
        ]);

        $this->assertDatabaseMissing('tags', [
            'name' => 'Tag 1 Updated',
            'description' => 'Updated description of tag 1',
        ]);
    }

    /**
     * @test
     */

    public function admin_can_delete_tag_test(): void
    {
        $adminUser = create_admin_user();
        $tag = create_tag();

        $response = $this->actingAs($adminUser)->delete(route('admin.tags.destroy', $tag->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.tags.index'));

        $this->assertDatabaseMissing('tags', [
            'name' => 'Tag 1',
            'description' => 'Description of tag 1',
        ]);
    }

    /**
     * @test
     */

    public function regular_user_cannot_delete_tag_test(): void
    {
        $regularUser = create_default_user();
        $tag = create_tag();

        $response = $this->actingAs($regularUser)->delete(route('admin.tags.destroy', $tag->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('welcome'));

        $this->assertDatabaseHas('tags', [
            'name' => 'Tag 1',
            'description' => 'Description of tag 1',
        ]);
    }
}
