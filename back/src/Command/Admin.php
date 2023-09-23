<?php

namespace App\Command;

use App\Entity\User;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


#[AsCommand(
    name: 'admin:create',
    description: 'Create admin',
)]
class Admin extends Command
{
    protected $container;
    private $encoder;


    public function __construct(ContainerInterface $container,  UserPasswordHasherInterface $encoder)
    {
        $this->container = $container;
        parent::__construct();
        $this->encoder = $encoder;

    }

    protected function configure(): void
    {
        $this->setName('admin:create')
            ->setDescription('Create admin')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $this->addAdmin();

        $io->success("Admin created succefuly");
        return Command::SUCCESS;
    }

    private function addAdmin(){
        $em = $this->container->get('doctrine')->getManager();

        $role = [
            'ROLE_ADMIN',
        ];

        $email = 'admin@gmail.com';

        $username = 'admin@gmail.com';

            $admin = new User();

            $existingAdmin = $em->getRepository(User::class)->findOneBy(['roles' => $role]);
            if ($existingAdmin) {
                return 'Admin already exists';
            }
            $password = $this->encoder->hashPassword($admin, 'admin');
            
            $admin->setRoles($role);
            $admin->setPassword($password);
            $admin->setUsername($username);
            $admin->setEmail($email);

            $em->persist($admin);
        
            $em->flush();
    }

}