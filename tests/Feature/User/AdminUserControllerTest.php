<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;


class AdminUserControllerTest extends TestCase
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
            ->has('users.data', 1) // Verificar que hay 1 usuario
            ->where('users.data.0.id', $adminUser->id) // Verificar que el usuario administrador está presente
            ->has('users.meta')
            ->where('users.meta.total', 1) // Total de usuarios es 1
            ->where('users.meta.current_page', 1) // La página actual es 1
            ->where('users.meta.per_page', 10) // Por página es 10
        );
    }

    /**
     * @test
     */

    public function regular_user_cannot_see_users_index_test(): void
    {
        $regularUser = create_default_user();

        $response = $this->actingAs($regularUser)->get(route('admin.users.index'));
        $response->assertStatus(302);
    }

    /**
     * @test
     */

    public function admin_can_see_users_create_test(): void
    {
        $adminUser = create_admin_user();

        $response = $this->actingAs($adminUser)->get(route('admin.users.create'));

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Admin/Users/Create')
        );
    }

    /**
     * @test
     */

    public function regular_user_cannot_see_users_create_test(): void
    {
        $regularUser = create_default_user();

        $response = $this->actingAs($regularUser)->get(route('admin.users.create'));
        $response->assertStatus(302);
    }

    /**
     * @test
     */

    public function admin_can_see_users_edit_test(): void
    {
        $adminUser = create_admin_user();
        $user = create_user();

        $response = $this->actingAs($adminUser)->get(route('admin.users.edit', $user->id));

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Admin/Users/Edit')
            ->has('user')
        );
    }

    /**
     * @test
     */

    public function regular_user_cannot_see_users_edit_test(): void
    {
        $regularUser = create_default_user();
        $user = create_user();

        $response = $this->actingAs($regularUser)->get(route('admin.users.edit', $user->id));
        $response->assertStatus(302);
    }

    /**
     * @test
     */

    public function admin_can_create_user_test(): void

    {
        $adminUser = create_admin_user();

        $response = $this->actingAs($adminUser)->post(route('admin.users.store'), [
            'name' => 'User',
            'email' => 'user1@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('users', [
            'name' => 'User',
            'email' => 'user1@example.com',
        ]);
    }

    /**
     * @test
     */

    public function regular_user_cannot_create_user_test(): void
    {
        $regularUser = create_default_user();

        $response = $this->actingAs($regularUser)->post(route('admin.users.store'), [
            'name' => 'User Test',
            'email' => 'usertest@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('welcome'));
        $this->assertDatabaseMissing('users', [
            'name' => 'User',
            'email' => 'user1@example.com',
        ]);
    }

    /**
     * @test
     */

     public function admin_can_edit_user_test(): void
     {
         $adminUser = create_admin_user();
         $user = create_user();

         $response = $this->actingAs($adminUser)->put(route('admin.users.update', $user->id), [
             'name' => 'User Updated',
             'email' => 'user1@example.com',
         ]);

         $response->assertStatus(302);
         $response->assertRedirect(route('admin.users.index'));

         $this->assertDatabaseHas('users', [
             'name' => 'User Updated',
             'email' => 'user1@example.com',
         ]);

         $this->assertDatabaseMissing('users', [
             'name' => 'User',
             'email' => 'user1@example.com',
         ]);
     }

    /**
     * @test
     */

    public function regular_user_cannot_edit_user_test(): void
    {
        $regularUser = create_default_user();
        $user = create_user();

        $response = $this->actingAs($regularUser)->put(route('admin.users.update', $user->id), [
            'name' => 'User Updated',
            'email' => 'user1@example.com',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('welcome'));

        $this->assertDatabaseHas('users', [
            'name' => 'User',
            'email' => 'user1@example.com',
        ]);

        $this->assertDatabaseMissing('users', [
            'name' => 'User Updated',
            'email' => 'user1@example.com',
        ]);
    }

    /**
     * @test
     */

    public function admin_can_delete_user_test(): void
    {
        $adminUser = create_admin_user();
        $user = create_user();

        $response = $this->actingAs($adminUser)->delete(route('admin.users.destroy', $user->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseMissing('users', [
            'name' => 'User',
            'email' => 'user1@example.com',
        ]);
    }

    /**
     * @test
     */

    public function regular_user_cannot_delete_user_test(): void
    {
        $regularUser = create_default_user();
        $user = create_user();

        $response = $this->actingAs($regularUser)->delete(route('admin.users.destroy', $user->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('welcome'));

        $this->assertDatabaseHas('users', [
            'name' => 'User',
            'email' => 'user1@example.com',
        ]);
    }
}

