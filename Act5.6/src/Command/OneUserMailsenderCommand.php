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

class OneUserMailsenderCommand extends Command
{
    protected static $defaultName = 'OneUserMailsender';
    protected static $defaultDescription = 'Add a short description for your command';
    public function __construct( MailerInterface $mailer )
    {
        parent::__construct(null);
     
        $this->mailer=$mailer;
    }
    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('arg', InputArgument::REQUIRED, 'The email of the user.')
           ->addOption('option1', null, InputOption::VALUE_REQUIRED, 'Option description')
        
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg = $input->getArgument('arg');
      
        if ($arg) {
            $io->note(sprintf('You passed an argument: %s', $arg));
            $output->writeln('email: '.$input->getArgument('arg'));
            $email = (new Email())
            ->from('kenza.daghgrir@talan.com')
            ->to($arg)
            ->subject('Bonjour')
            ->text('Bonjour bienvenue à Talan Academy ')
            ;
            $this->mailer->send($email);

        $io->success('your email was sent with success');

         } return 0;
    }
}
