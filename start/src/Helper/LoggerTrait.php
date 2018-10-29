<?php
/**
 * Created by PhpStorm.
 * User: Tudor
 * Date: 10/29/2018
 * Time: 9:31 AM
 */

namespace App\Helper;


use Psr\Log\LoggerInterface;

trait LoggerTrait
{

    /**
     * @var LoggerInterface|null
     */
    private $logger;

    /**
     * @required
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function logInfo(string $message, array $context = [])
    {
        if($this->logger){
            $this->logger->info($message,$context);
        }
    }
}