<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Server\Worker;

class WorkerCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('dct:worker')
            ->setDescription('Start the DCT worker')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        \Predis\Autoloader::register();

        $zmqcontext = new \ZMQContext();
        $socket = $zmqcontext->getSocket(\ZMQ::SOCKET_PUSH);
        $socket->connect("tcp://localhost:5555");

        $worker = new Worker();

        while(true)
        {
            $timeStart = microtime(true);

            $data = $worker->updateServer(array(0, 1));

            $jsonencode = json_encode($data);
            $socket->send($jsonencode);

            $timeEnd = microtime(true);
            $output->writeln(number_format($timeEnd - $timeStart, 4) * 1000 . " ms");
            usleep(1000000 - ($timeEnd - $timeStart) * 1000000);
        }
    }
}
