<?php

namespace Tests\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */

    public function admin_can_see_products_index_test(): void
    {
        $adminUser = create_admin_user();

        $response = $this->actingAs($adminUser)->get(route('products.index'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */

    public function regular_user_can_see_products_index_test(): void
    {
        $regularUser = create_default_user();

        $response = $this->actingAs($regularUser)->get(route('products.index'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */

    public function unauthenticated_user_can_see_products_index_test(): void
    {
        $response = $this->get(route('products.index'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */

     public function admin_can_see_products_show_test(): void
     {

         $adminUser = create_admin_user();
         $product = create_product();

         $response = $this->actingAs($adminUser)->get(route('products.show', ['id' => $product->id]));
         $response->assertStatus(200);
     }

    /**
     * @test
     */

    public function regular_user_can_see_products_show_test(): void
    {
        $regularUser = create_default_user();
        $product = create_product();

        $response = $this->actingAs($regularUser)->get(route('products.show', ['id' => $product->id]));
        $response->assertStatus(200);
    }

    /**
     * @test
     */

    public function unauthenticated_user_can_see_products_show_test(): void
    {
        $product = create_product();

        $response = $this->get(route('products.show', ['id' => $product->id]));
        $response->assertStatus(200);
    }
}
