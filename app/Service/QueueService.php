<?php


namespace App\Service;


use App\Job\LogUserVisitJob;
use Hyperf\AsyncQueue\Driver\DriverFactory;
use Hyperf\AsyncQueue\Driver\DriverInterface;

class QueueService
{
    /**
     * @var DriverInterface
     */
    protected $driver;

    public function __construct(DriverFactory $driverFactory)
    {
//        $this->driver = $driverFactory->get('default');
        $this->driver = $driverFactory->get('other');
    }

    public function push($params = [], int $delay = 0)
    {
        return $this->driver->push(new LogUserVisitJob($params), $delay);
    }
}