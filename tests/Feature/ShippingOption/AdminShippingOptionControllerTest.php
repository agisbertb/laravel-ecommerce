<?php

namespace Tests\Feature\ShippingOption;

use App\Models\ShippingOption;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as AssertableInertia;
use Tests\TestCase;

class AdminShippingOptionControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function admin_can_see_shipping_options_index()
    {
        $adminUser = create_admin_user();
        $shippingOption = create_shipping_option();

        $response = $this->actingAs($adminUser)->get(route('admin.shipping-options.index'));

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Admin/ShippingOptions/Index')
            ->has('shippingOptions.data', 1)
            ->where('shippingOptions.data.0.id', $shippingOption->id)
        );
    }

    /**
     * @test
     */
    public function admin_can_create_shipping_option()
    {
        $adminUser = create_admin_user();

        $response = $this->actingAs($adminUser)->post(route('admin.shipping-options.store'), [
            'name' => 'Express Shipping',
            'price' => 20.00,
            'estimated_delivery' => '1-2 business days',
        ]);

        $response->assertRedirect(route('admin.shipping-options.index'));
        $this->assertDatabaseHas('shipping_options', [
            'name' => 'Express Shipping',
            'price' => 20.00,
            'estimated_delivery' => '1-2 business days',
        ]);
    }

    /**
     * @test
     */
    public function admin_can_update_shipping_option()
    {
        $adminUser = create_admin_user();
        $shippingOption = create_shipping_option();

        $response = $this->actingAs($adminUser)->put(route('admin.shipping-options.update', $shippingOption->id), [
            'name' => 'Updated Shipping',
            'price' => 15.00,
            'estimated_delivery' => '2-4 business days',
        ]);

        $response->assertRedirect(route('admin.shipping-options.index'));
        $this->assertDatabaseHas('shipping_options', [
            'id' => $shippingOption->id,
            'name' => 'Updated Shipping',
            'price' => 15.00,
            'estimated_delivery' => '2-4 business days',
        ]);
    }

    /**
     * @test
     */
    public function admin_can_delete_shipping_option()
    {
        $adminUser = create_admin_user();
        $shippingOption = create_shipping_option();

        $response = $this->actingAs($adminUser)->delete(route('admin.shipping-options.destroy', $shippingOption->id));

        $response->assertRedirect(route('admin.shipping-options.index'));
        $this->assertDatabaseMissing('shipping_options', ['id' => $shippingOption->id]);
    }

    /**
     * @test
     */
    public function guest_cannot_access_shipping_options()
    {
        $response = $this->get(route('admin.shipping-options.index'));
        $response->assertRedirect(route('welcome'));

        $response = $this->post(route('admin.shipping-options.store'), []);
        $response->assertRedirect(route('welcome'));

        $response = $this->put(route('admin.shipping-options.update', 1), []);
        $response->assertRedirect(route('welcome'));

        $response = $this->delete(route('admin.shipping-options.destroy', 1));
        $response->assertRedirect(route('welcome'));
    }

}
