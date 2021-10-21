<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginPageTest extends TestCase
{

    // Check that user can login
    public function test_user_can_login_using_login_form()
    {

        // create new user for test case in local db
        $user = User::factory()->create();

        // send POST request to login form and save response
        $response = $this->post('/login', [

            // to login we need to send over data
            'email' => $user->email,
            'password' => 'password' // default password when using factory
        ]);

        // send post | checks if there is currenlty a logged in user - asserts TRUE if true
        $this->assertAuthenticated();

        // if logged in successfully, should redirect - check for response
        $response->assertRedirect('/');
    }

    // Check that users can not access admin
    public function test_user_can_not_access_admin_page()
    {

        // create new user for test case in local db | no roles assigned upon creation
        $user = User::factory()->create();

        // send POST request to login form and save response
        $response = $this->post('/login', [

            // to login we need to send over data
            'email' => $user->email,
            'password' => 'password' // default password when using factory
        ]);

        // Check if user has appropriate roles to access admin | user should not be able to "get" from this page
        $this->get('/admin/users');

        // if logged in successfully, should redirect - check for response
        $response->assertRedirect('/');
    }

    // Check that users can access admin
    public function test_user_can_access_admin_page()
    {

        // create new user for test case in local db | attach admin role
        $user = User::factory()->create();

        // attach the role of 1 - admin role
        $user->roles()->attach(1);

        // send POST request to login form
        $this->post('/login', [

            // to login we need to send over data
            'email' => $user->email,
            'password' => 'password' // default password when using factory
        ]);

        // Check if user has appropriate roles to access admin | user be able to "get" from this page
        $response = $this->get('/admin/users');

        // check to see if we can see the title on the page
        $response->assertSeeText('User');
    }
}
