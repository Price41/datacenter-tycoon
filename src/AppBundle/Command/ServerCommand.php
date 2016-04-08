<?php

namespace AppBundle\Command;

use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\Session\SessionProvider;
use Ratchet\WebSocket\WsServer;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Session\Storage\Handler;

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

        $session = $this->getContainer()->get('session');

        $loop   = \React\EventLoop\Factory::create();
        $server = new \AppBundle\Server\Server($session);

        $memcached = new \Memcached;
        $memcached->addServer('localhost', 11211);

        $context = new \React\ZMQ\Context($loop);
        $pull = $context->getSocket(\ZMQ::SOCKET_PULL);
        $pull->bind('tcp://127.0.0.1:5555');
        $pull->on('message', array($server, 'sendData'));

        $webSock = new \React\Socket\Server($loop);
        $webSock->listen($websocketPort, $websocketIp);
        $webServer = new IoServer(
            new HttpServer(
                new WsServer(
                    new SessionProvider(
                        $server,
                        new Handler\MemcachedSessionHandler($memcached)
                    )
                )
            ),
            $webSock
        );

        echo "WebSocket server started\n";
        $loop->run();
    }
}
