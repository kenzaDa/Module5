<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailsenderCommand extends Command
{
   
        private $MailerInterface;

        protected static $defaultName = 'app:Mailsender';
       
       
        public function __construct( MailerInterface $MailerInterface)
        {
            
            $this->MailerInterface = $MailerInterface;
            parent::__construct(null);
        }
       

        protected function configure()
        {
            $this
                ->setDescription('Send daily emails to users')
            ;
        }
        protected function execute(InputInterface $input, OutputInterface $output )
        {   
            
            $email = (new Email())
            ->from('kenza.daghrir@talan.com')
            ->to('kenza.daghrir@talan.com')
          
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>Bonjour </p>');

            $this->MailerInterface->send($email);
         
            
         
           
           
        }
    }