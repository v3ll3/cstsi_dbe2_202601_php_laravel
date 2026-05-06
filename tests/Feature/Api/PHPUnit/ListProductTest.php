<?php

namespace Tests\Feature\Api\PHPUnit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_listar_todos_produtos_com_status_200(): void
    {
        $URL = '/api/v1/produtos';
        $response = $this->get($URL);
        $response->assertStatus(200);
        $response->assertJsonIsArray('data');
        // $response->assertJsonIsArray();// JsonResource::withoutWrapping();
        $response->assertJsonIsObject();
        $response->assertJsonStructure(['data']);
    }
}
