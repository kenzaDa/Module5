<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Repository\UserRepository;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

class MailsenderCommand extends Command
{protected static $defaultName = 'Mailsender';
    protected static $defaultDescription = 'Sends Emails to users';
    private $userRepository;
   
    public function __construct(UserRepository $userRepository, MailerInterface $mailer )
    {
        parent::__construct(null);
        $this->userRepository = $userRepository;
        $this->mailer=$mailer;
    }
  
    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
          
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
           
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    { 
        $io = new SymfonyStyle($input, $output);
        $users = $this->userRepository->findAll();
        foreach ($users as $user) {
            if (!in_array('ROLE_ADMIN',$user->getRoles())) {
                $address[] = $user->getEmail();
              
            }
        }
        
        $email = (new Email())
                    ->from('kenza.daghgrir@talan.com')
                    ->to(...$address)
                    ->subject('Bonjour')
                    ->text('Bonjour bienvenue à Talan Academy ')
                    ;
                    $this->mailer->send($email);

        $io->success('Emails sends successfully !');

        return 0;
    }

    }