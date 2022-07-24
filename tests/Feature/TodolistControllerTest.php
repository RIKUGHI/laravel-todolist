<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            'user' => 'Bambang',
            'todolist' => [
                [
                    'id' => '1',
                    'todo' => 'Nice'
                ],
                [
                    'id' => '2',
                    'todo' => 'Es'
                ]
            ]
        ])->get('/todolist')
            ->assertSeeText('1')
            ->assertSeeText('Nice')
            ->assertSeeText('2')
            ->assertSeeText('Es');
    }

    public function testAddTodoFailed()
    {
        $this->withSession([
            'user' => 'bambang'
        ])->post('/todolist', [])
            ->assertSeeText('Todo is required');
    }

    public function testAddTodoSuccess()
    {
        $this->withSession([
            'user' => 'bambang'
        ])->post('/todolist', [
            'todo' => 'Nice'
        ])->assertRedirect('/todolist');
    } 

    public function testRemoveTodolist()
    {
        $this->withSession([
            'user' => 'Bambang',
            'todolist' => [
                [
                    'id' => '1',
                    'todo' => 'Nice'
                ],
                [
                    'id' => '2',
                    'todo' => 'Es'
                ]
            ]
        ])->post('/todolist/1/delete')
            ->assertRedirect('/todolist');
    }
}