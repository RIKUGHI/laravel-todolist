<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todoListService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->todoListService = $this->app->make(TodolistService::class);
    }

    public function testTodoListNotNull()
    {
        self::assertNotNull($this->todoListService);
    }
}
