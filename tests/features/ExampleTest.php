<?php


class ExampleTest extends FeatureTestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    function test_basic_example()
    {
        $user = factory(\App\User::class)->create([
            'name' => 'Felipe',
            'email' => 'felipe@gmail.com',
        ]);

        $this->actingAs($user, 'api')
            ->visit('api/user')
             ->see('Felipe')
             ->see('felipe@gmail.com');
    }
}
