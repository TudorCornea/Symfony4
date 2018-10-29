<?php
/**
 * Created by PhpStorm.
 * User: Tudor
 * Date: 10/29/2018
 * Time: 9:13 AM
 */

namespace App\Service;

use App\Helper\LoggerTrait;
use Nexy\Slack\Client;
use Psr\Log\LoggerInterface;

class SlackClient
{
    use LoggerTrait;

    private $slack;

    private $logger;

    public function __construct(Client $slack)
    {
        $this->slack = $slack;
    }

    public function sendMessage(string $from, string $message)
    {
        $this->logInfo('Beaming a message to Stack',[
            'message' => $message
        ]);

        $message = $this->slack->createMessage()
            ->from($from)
            ->withIcon(':ghost:')
            ->setText($message)
        ;

        $this->slack->sendMessage($message);
    }
}