<?php

namespace App\Service\System;

trait SystemInfo
{
    public function getTableName()
    {
        return $this->model->getTable();
    }
}
