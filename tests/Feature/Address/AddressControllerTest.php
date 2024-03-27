<?php

namespace Tests\Feature\Address;

use App\Models\Address;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddressControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function default_user_can_view_create_address_for_shipping()
    {
        $user = create_default_user();

        $response = $this->actingAs($user)->get('/addresses/create/Shipping');

        $response->assertStatus(200);
        $response->assertSee('Shipping');
    }

    /**
     * @test
     */
    public function default_user_can_view_create_address_for_billing()
    {
        $user = create_default_user();

        $response = $this->actingAs($user)->get('/addresses/create/Billing');

        $response->assertStatus(200);
        $response->assertSee('Billing');
    }

    /**
     * @test
     */
    public function default_user_can_create_an_address()
    {
        $user = create_default_user();

        $response = $this->actingAs($user)->post(route('addresses.store'), [
            'name' => 'House',
            'type' => 'Shipping',
            'address' => 'Street 123',
            'city' => 'Bcn',
            'state' => 'Cat',
            'country' => 'Spain',
            'zip_code' => '12345',
            'default' => true,
        ]);

        $response->assertRedirect('/addresses');
        $this->assertCount(2, Address::all());
    }

    /**
     * @test
     */
    public function default_user_can_update_an_address()
    {
        $data = create_default_user_and_address();
        $user = $data['user'];
        $address = $data['address'];

        $updatedData = [
            'name' => 'Updated House',
            'type' => 'Billing',
            'address' => 'Updated Street 123',
            'city' => 'Updated Bcn',
            'state' => 'Updated Cat',
            'country' => 'Updated Spain',
            'zip_code' => '54321',
            'default' => false,
        ];

        $response = $this->actingAs($user)->put(route('addresses.update', $address->id), $updatedData);

        $response->assertRedirect('/addresses');
        $this->assertDatabaseHas('addresses', array_merge(['id' => $address->id], $updatedData));
    }

    /**
     * @test
     */
    public function default_user_can_delete_an_address()
    {
        $data = create_default_user_and_address();
        $user = $data['user'];
        $address = $data['address'];

        $response = $this->actingAs($user);

        $response = $this->delete(route('addresses.destroy', $address->id));
        $response->assertRedirect('/addresses');

        $this->assertDatabaseMissing('addresses', ['id' => $address->id]);
    }

    /**
     * @test
     */
    public function guest_cannot_view_addresses_index()
    {
        $response = $this->get('/addresses');
        $response->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function guest_cannot_view_create_address_page()
    {
        $response = $this->get('/addresses/create/Shipping');
        $response->assertRedirect('/login');

        $response = $this->get('/addresses/create/Billing');
        $response->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function test_guest_cannot_create_an_address()
    {
        $addressData = [
            'name' => 'House',
            'type' => 'Shipping',
            'address' => 'Street 123',
            'city' => 'Bcn',
            'state' => 'Cat',
            'country' => 'Spain',
            'zip_code' => '12345',
            'default' => true,
        ];

        $response = $this->post(route('addresses.store'), $addressData);
        $response->assertRedirect('/login');

        $this->assertDatabaseMissing('addresses', ['address' => 'Street 123']);
    }
}
