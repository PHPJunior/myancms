<?php
/**
 * Created by PhpStorm.
 * User: Nyi Nyi Lwin
 * Date: 5/29/2016
 * Time: 2:58 PM
 */

namespace App\Repository;

use App\Models\Task;

class TaskRepository
{
    protected $task;

    /**
     * TaskRepository constructor.
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function taskList($id)
    {
        return $this->task->where('user_id', $id)
            ->orderBy('created_at', 'asc')
            ->get();
    }
}