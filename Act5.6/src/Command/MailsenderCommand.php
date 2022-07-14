<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Repository\UserRepository;

class MailsenderCommand extends Command
{
   
    
        protected static $defaultName = 'app:Mailsender';
        private $userRepository;
        public function __construct(UserRepository $userRepository)
        {
            parent::__construct(null);
            $this->userRepository = $userRepository;
        }
        protected function configure()
        {
            $this
                ->setDescription('Send daily emails to users')
            ;
        }
        protected function execute(InputInterface $input, OutputInterface $output)
        {
            $io = new SymfonyStyle($input, $output);
            $users = $this->userRepository
                ->findAll();
            $io->progressStart(count($users));
            foreach ($users as $user) {
                $io->progressAdvance();
            }
            $io->progressFinish();
            $io->success('Weekly reports were sent to authors!');
        }
    }