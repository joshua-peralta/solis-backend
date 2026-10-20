<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('SOLIS | Specialty Coffee API')
            ->assertSee('Good coffee begins with good connections.')
            ->assertSee('/graphql')
            ->assertSee('/graphiql');
    }
}
