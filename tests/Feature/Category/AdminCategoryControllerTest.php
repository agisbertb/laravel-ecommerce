<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;


class AdminCategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */

    public function admin_can_see_admin_categories_index_test(): void
    {
        $adminUser = create_admin_user();
        $category = create_category();

        $response = $this->actingAs($adminUser)->get(route('admin.categories.index'));

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Admin/Categories/Index')
            ->has('categories.data', 1)
            ->where('categories.data.0.id', $category->id)
        );
    }

    /**
     * @test
     */

    public function regular_user_cannot_see_admin_categories_index_test(): void
    {
        $regularUser = create_default_user();

        $response = $this->actingAs($regularUser)->get(route('admin.categories.index'));
        $response->assertStatus(302);
    }

    /**
     * @test
     */

    public function admin_can_see_admin_categories_create_test(): void
    {
        $adminUser = create_admin_user();

        $response = $this->actingAs($adminUser)->get(route('admin.categories.create'));

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Admin/Categories/Create')
        );
    }

    /**
     * @test
     */

    public function regular_user_cannot_see_admin_categories_create_test(): void
    {
        $regularUser = create_default_user();

        $response = $this->actingAs($regularUser)->get(route('admin.categories.create'));
        $response->assertStatus(302);
    }

    /**
     * @test
     */

    public function admin_can_see_admin_categories_edit_test(): void
    {
        $adminUser = create_admin_user();
        $category = create_category();

        $response = $this->actingAs($adminUser)->get(route('admin.categories.edit', $category->id));

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Admin/Categories/Edit')
            ->has('category')
        );
    }

    /**
     * @test
     */

    public function regular_user_cannot_see_admin_categories_edit_test(): void
    {
        $regularUser = create_default_user();
        $category = create_category();

        $response = $this->actingAs($regularUser)->get(route('admin.categories.edit', $category->id));
        $response->assertStatus(302);
    }

    /**
     * @test
     */

    public function admin_can_create_category_test(): void

    {
        $adminUser = create_admin_user();

        $response = $this->actingAs($adminUser)->post(route('admin.categories.store'), [
            'name' => 'Category 1',
            'description' => 'Description of category 1',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.categories.index'));
        $this->assertDatabaseHas('categories', [
            'name' => 'Category 1',
            'description' => 'Description of category 1',
        ]);
    }

    /**
     * @test
     */

    public function regular_user_cannot_create_category_test(): void
    {
        $regularUser = create_default_user();

        $response = $this->actingAs($regularUser)->post(route('admin.categories.store'), [
            'name' => 'Category 1',
            'description' => 'Description of category 1',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('welcome'));
        $this->assertDatabaseMissing('categories', [
            'name' => 'Category 1',
            'description' => 'Description of category 1',
        ]);
    }

    /**
     * @test
     */

     public function admin_can_edit_category_test(): void
     {
         $adminUser = create_admin_user();
         $category = create_category();

         $response = $this->actingAs($adminUser)->put(route('admin.categories.update', $category->id), [
             'name' => 'Category 1 Updated',
             'description' => 'Updated description of category 1',
         ]);

         $response->assertStatus(302);
         $response->assertRedirect(route('admin.categories.index'));

         $this->assertDatabaseHas('categories', [
             'name' => 'Category 1 Updated',
             'description' => 'Updated description of category 1',
         ]);

         $this->assertDatabaseMissing('categories', [
             'name' => 'Category 1',
             'description' => 'Description of category 1',
         ]);
     }

    /**
     * @test
     */

    public function regular_user_cannot_edit_category_test(): void
    {
        $regularUser = create_default_user();
        $category = create_category();

        $response = $this->actingAs($regularUser)->put(route('admin.categories.update', $category->id), [
            'name' => 'Category 1 Updated',
            'description' => 'Updated description of category 1',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('welcome'));

        $this->assertDatabaseHas('categories', [
            'name' => 'Category 1',
            'description' => 'Description of category 1',
        ]);

        $this->assertDatabaseMissing('categories', [
            'name' => 'Category 1 Updated',
            'description' => 'Updated description of category 1',
        ]);
    }

    /**
     * @test
     */

    public function admin_can_delete_category_test(): void
    {
        $adminUser = create_admin_user();
        $category = create_category();

        $response = $this->actingAs($adminUser)->delete(route('admin.categories.destroy', $category->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.categories.index'));

        $this->assertDatabaseMissing('categories', [
            'name' => 'Category 1',
            'description' => 'Description of category 1',
        ]);
    }

    /**
     * @test
     */

    public function regular_user_cannot_delete_category_test(): void
    {
        $regularUser = create_default_user();
        $category = create_category();

        $response = $this->actingAs($regularUser)->delete(route('admin.categories.destroy', $category->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('welcome'));

        $this->assertDatabaseHas('categories', [
            'name' => 'Category 1',
            'description' => 'Description of category 1',
        ]);
    }
}
