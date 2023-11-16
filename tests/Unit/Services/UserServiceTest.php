<?php

namespace Tests\Unit\Services;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
* @runTestsInSeparateProcesses
* @preserveGlobalState disabled
*/
class UserServiceTest extends TestCase {
    use DatabaseMigrations, RefreshDatabase, WithFaker;

    /**
     * @var UserService
     */
    protected $userService;

    public function setUp(): void
    {
        parent::setUp();

        $this->userService = new UserService(new User(), app('request'));
    }


    /**
    * @test
    * @return void
    */
    public function it_can_return_a_paginated_list_of_users(){
        // Arrangements
        $user1 = [
            'prefixname' => 'Mr.',
            'firstname' => 'Mehmet',
            'middlename' => '',
            'lastname' => 'Tepeli',
            'suffixname' => '',
            'username' => 'mehmet',
            'email' => 'mehmet@mehmettepeli.com',
            'password' => '12345678',
            'photo' => '',
            'type' => 'User',
            'remember_token' => '',
            'email_verified_at' => '',
            'created_at' => '2023-12-12 12:12:12',
            'updated_at' => '2023-12-12 12:12:12',
            'deleted_at' => '',
        ];
        $user2 = [
            'prefixname' => 'Mr.',
            'firstname' => 'Mehmet',
            'middlename' => '',
            'lastname' => 'Tepeli',
            'suffixname' => '',
            'username' => 'mehmet',
            'email' => 'mehmet@mehmettepeli.com',
            'password' => '12345678',
            'photo' => '',
            'type' => 'User',
            'remember_token' => '',
            'email_verified_at' => '',
            'created_at' => '2023-12-12 12:12:12',
            'updated_at' => '2023-12-12 12:12:12',
            'deleted_at' => '',
        ];

        // Actions
        $result = $this->userService->list();

        // Assertions
        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
    }

    /**
    * @test
    * @return void
    */
    public function it_can_store_a_user_to_database(){
        // Arrangements
        $userAttributes = [
            'firstname' => $this->faker->firstName,
            // Add other attributes as needed
        ];

        // Actions
        $createdUser = $this->userService->store($userAttributes);

        // Assertions
        $this->assertInstanceOf(User::class, $createdUser);
    }

    /**
    * @test
    * @return void
    */
    public function it_can_find_and_return_an_existing_user(){
        // Arrangements
        $existingUser = factory(User::class)->create();

        // Actions
        $foundUser = $this->userService->find($existingUser->id);

        // Assertions
        $this->assertInstanceOf(User::class, $foundUser);
        $this->assertEquals($existingUser->id, $foundUser->id);
    }

    /**
    * @test
    * @return void
    */
    public function it_can_update_an_existing_user(){
        // Arrangements
        $user = factory(User::class)->create();
        $updatedAttributes = [
            'firstname' => $this->faker->firstName,
            // Add other attributes to update
        ];

        // Actions
        $result = $this->userService->update($user->id, $updatedAttributes);

        // Assertions
        $this->assertTrue($result);
    }

    /**
    * @test
    * @return void
    */
    public function it_can_soft_delete_an_existing_user(){
        // Arrangements
        $user = factory(User::class)->create();

        // Actions
        $this->userService->destroy($user->id);

        // Assertions
        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }

    /**
    * @test
    * @return void
    */
    public function it_can_return_a_paginated_list_of_trashed_users(){
        // Arrangements
        factory(\App\User::class, 5)->create(['deleted_at' => now()]);

        // Actions
        $result = $this->userService->listTrashed();

        // Assertions
        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $result);
    }

    /**
    * @test
    * @return void
    */
    public function it_can_restore_a_soft_deleted_user(){
        // Arrangements
        $user = factory(User::class)->create(['deleted_at' => now()]);

        // Actions
        $this->userService->restore($user->id);

        // Assertions
        $this->assertDatabaseHas('users', ['id' => $user->id, 'deleted_at' => null]);
    }

    /**
    * @test
    * @return void
    */
    public function it_can_permanently_delete_a_soft_deleted_user(){
        // Arrangements
        $user = factory(User::class)->create(['deleted_at' => now()]);

        // Actions
        $this->userService->delete($user->id);

        // Assertions
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    /**
    * @test
    * @return void
    */
    public function it_can_upload_photo(){
        // Arrangements
        Storage::fake('public');
        $file = UploadedFile::fake()->image('avatar.jpg');

        // Actions
        $result = $this->userService->upload($file);

        // Assertions
        $this->assertNotNull($result);
    }
}