<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class AdminProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function admin_can_see_users_index_test(): void
    {
        $adminUser = create_admin_user();

        $response = $this->actingAs($adminUser)->get(route('admin.users.index'));

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Admin/Users/Index')
            ->has('users.data', 1)
            ->where('users.data.0.id', $adminUser->id)
        );
    }

    /**
     * @test
     */
    public function regular_user_cannot_see_admin_products_index_test(): void
    {
        $regularUser = create_default_user();

        $response = $this->actingAs($regularUser)->get(route('admin.products.index'));
        $response->assertStatus(302);
    }

    /**
     * @test
     */
    public function admin_can_see_admin_products_create_test(): void
    {
        $adminUser = create_admin_user();

        $response = $this->actingAs($adminUser)->get(route('admin.products.create'));

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Admin/Products/Create')
        );
    }

    /**
     * @test
     */
    public function regular_user_cannot_see_admin_products_create_test(): void
    {
        $regularUser = create_default_user();

        $response = $this->actingAs($regularUser)->get(route('admin.products.create'));
        $response->assertStatus(302);
    }

    /**
     * @test
     */
    public function admin_can_see_admin_products_edit_test(): void
    {
        $adminUser = create_admin_user();
        $product = create_product();

        $response = $this->actingAs($adminUser)->get(route('admin.products.edit', $product->id));

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Admin/Products/Edit')
            ->has('product')
        );
    }

    /**
     * @test
     */
    public function regular_user_cannot_see_admin_products_edit_test(): void
    {
        $regularUser = create_default_user();
        $product = create_product();

        $response = $this->actingAs($regularUser)->get(route('admin.products.edit', $product->id));
        $response->assertStatus(302);
    }

    /**
     * @test
     */
    public function admin_can_create_product_test(): void
    {
        $adminUser = create_admin_user();
        $category = create_category();

        $response = $this->actingAs($adminUser)->post(route('admin.products.store'), [
            'name' => 'Product 1',
            'description' => 'Description of product 1',
            'price' => 100,
            'stock' => 10,
            'categories' => [$category->id],
            'tags' => [],
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseHas('products', [
            'name' => 'Product 1',
            'description' => 'Description of product 1',
            'price' => 100,
            'stock' => 10,
        ]);
    }

    /**
     * @test
     */
    public function regular_user_cannot_create_product_test(): void
    {
        $regularUser = create_default_user();

        $response = $this->actingAs($regularUser)->post(route('admin.products.store'), [
            'name' => 'Product 1',
            'description' => 'Description of product 1',
            'price' => 100,
            'stock' => 10,
            'categories' => [],
            'tags' => [],
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('welcome'));
        $this->assertDatabaseMissing('products', [
            'name' => 'Product 1',
            'description' => 'Description of product 1',
            'price' => 100,
            'stock' => 10,
        ]);
    }

    /**
     * @test
     */
    public function admin_can_edit_product_test(): void
    {
        $adminUser = create_admin_user();
        $product = create_product('unique-edit');
        $category = create_category();

        $response = $this->actingAs($adminUser)->put(route('admin.products.update', $product->id), [
            'name' => 'Product 1 Updated',
            'description' => 'Updated description of product 1',
            'price' => 150,
            'stock' => 5,
            'categories' => [$category->id],
            'tags' => [],
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseHas('products', [
            'name' => 'Product 1 Updated',
            'description' => 'Updated description of product 1',
            'price' => 150,
            'stock' => 5,
        ]);

        $this->assertDatabaseMissing('products', [
            'name' => 'Product 1',
            'description' => 'Description of product 1',
            'price' => 100,
            'stock' => 10,
        ]);
    }
    /**
     * @test
     */
    public function regular_user_cannot_edit_product_test(): void
    {
        $regularUser = create_default_user();
        $product = create_product('unique-edit');

        $response = $this->actingAs($regularUser)->put(route('admin.products.update', $product->id), [
            'name' => 'Product 1 Updated',
            'description' => 'Updated description of product 1',
            'price' => 150,
            'stock' => 5,
            'categories' => [],
            'tags' => [],
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('welcome'));

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'stock' => $product->stock,
        ]);

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
            'name' => 'Product 1 Updated',
            'description' => 'Updated description of product 1',
            'price' => 150,
            'stock' => 5,
        ]);
    }

    /**
     * @test
     */
    public function admin_can_delete_product_test(): void
    {
        $adminUser = create_admin_user();
        $product = create_product();

        $response = $this->actingAs($adminUser)->delete(route('admin.products.destroy', $product->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseMissing('products', [
            'name' => 'Product 1',
            'description' => 'Description of product 1',
            'price' => 100,
            'stock' => 10,
        ]);
    }

    /**
     * @test
     */
    public function regular_user_cannot_delete_product_test(): void
    {
        $regularUser = create_default_user();
        $product = create_product('unique-delete');

        $response = $this->actingAs($regularUser)->delete(route('admin.products.destroy', $product->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('welcome'));

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'stock' => $product->stock,
        ]);
    }
}
