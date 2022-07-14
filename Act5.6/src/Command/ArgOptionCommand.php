<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

class ArgOptionCommand extends Command
{
    protected static $defaultName = 'Send';
    protected static $defaultDescription = 'Add a short description for your command';




    public function __construct(mailerInterface $mailerInterface)
    {
        $this->mailer = $mailerInterface;
       

        parent::__construct();
    }
    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('arg', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('type', null, InputOption::VALUE_REQUIRED, 'type')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    { $io = new SymfonyStyle($input, $output);
      $email = (new Email())
      ->from('kenza.daghrir@talan.com');

            
            if($input->getArgument('arg')){
                $email->to($input->getArgument('arg'));

                if ($input->getOption('type')) {

                    if ($input->getOption('type') == 'inscription') {
                        $email->subject('inscription')
                        ->text('nous vous remercions pour votre inscription sur notre site ');
                    } elseif($input->getOption('type') == 'confirmation') {
                        $email->subject('confirmation')
                        ->text('votre compte est maintenant activé');
                    }else{
                        return 1;
                    }
                } else{
                   $email->subject('confirmation')
                   ->text('Helloo !');
                }
            }
            
        $this->mailer->send($email);


        $io->success('Emails sends successfully !');

        return 0;
    }
    }







