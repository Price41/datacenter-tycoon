<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ServerCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('dct:server')
            ->setDescription('Start the DCT WebSocket server')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $websocketIp = $this->getContainer()->getParameter('ws_server_ip');
        $websocketPort = $this->getContainer()->getParameter('ws_server_port');

        $loop   = \React\EventLoop\Factory::create();
        $server = new \AppBundle\Server\Server();

        $context = new \React\ZMQ\Context($loop);
        $pull = $context->getSocket(\ZMQ::SOCKET_PULL);
        $pull->bind('tcp://127.0.0.1:5555');
        $pull->on('message', array($server, 'send'));

        $webSock = new \React\Socket\Server($loop);
        $webSock->listen($websocketPort, $websocketIp);
        $webServer = new \Ratchet\Server\IoServer(
            new \Ratchet\Http\HttpServer(
                new \Ratchet\WebSocket\WsServer(
                    $server
                )
            ),
            $webSock
        );

        $loop->run();
    }
}
