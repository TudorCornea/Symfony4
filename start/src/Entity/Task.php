<?php
/**
 * Created by PhpStorm.
 * User: Tudor
 * Date: 11/5/2018
 * Time: 4:37 PM
 */

namespace App\Entity;
/*
 * THIS IS FOR FORM TUTORIAL SCRIS , NU E CEL PRINCIPAL DIN VIDEOURI
 */

class Task
{

    protected $task;

    protected $dueDate;

    public function getTask()
    {
        return $this->task;
    }

    public function setTask($task): void
    {
        $this->task = $task;
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param mixed $dueDate
     */
    public function setDueDate(\DateTime $dueDate = null)
    {
        $this->dueDate = $dueDate;
    }

}