<?php

declare(strict_types=1);

namespace App\Job;

use Hyperf\AsyncQueue\Job;

class LogUserVisitJob extends Job
{
    protected $maxAttempts = 2;

    protected $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function handle()
    {
        var_dump($this->params[0]);
        var_dump('log job');
    }
}
