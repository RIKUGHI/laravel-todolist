<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
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

    public function testSaveTodo()
    {
        $this->todoListService->saveTodo('1', 'Bambang');

        $todolist = Session::get('todolist');
        foreach ($todolist as $value) {
            self::assertEquals('1', $value['id']);
            self::assertEquals('Bambang', $value['todo']);
        }
    }

    public function testGetTodolistEmpty()
    {
        self::assertEquals([], $this->todoListService->getTodolist());
    }

    public function testGetTodoListNotEmpty()
    {
        $expected = [
            [
                'id' => '1',
                'todo' => 'Bambang'
            ],
            [
                'id' => '2',
                'todo' => 'Nice'
            ]
        ];

        $this->todoListService->saveTodo('1', 'Bambang');
        $this->todoListService->saveTodo('2', 'Nice');

        self::assertEquals($expected, $this->todoListService->getTodolist());
    }
}
