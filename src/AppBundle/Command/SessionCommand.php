<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SessionCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('dct:session')
            ->setDescription('Get session from its ID')
            ->addArgument(
                'id',
                InputArgument::OPTIONAL,
                'ID of the session'
            )
            ->addOption(
                'yell',
                null,
                InputOption::VALUE_NONE,
                'If set, the task will yell in uppercase letters'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $session = $this->getContainer()->get('session');
        $id = $input->getArgument('id');

        $session->setId($id);
        $username = $session->get('username');

        $output->writeln('Session : '.$id);
        $output->writeln('Username : '.$username);
    }
}
