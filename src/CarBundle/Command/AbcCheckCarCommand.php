<?php

namespace CarBundle\Command;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AbcCheckCarCommand extends Command
{

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * AbcCheckCarCommand constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;

        parent::__construct();
    }


    protected function configure()
    {
        $this
            ->setName('abc:check-car')
            ->setDescription('...')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $argument = $input->getArgument('argument');

        if ($input->getOption('option')) {
            // ...
        }

        $carRepo = $this->em->getRepository('CarBundle:Car');
        $cars = $carRepo->findAll();

        $bar = new ProgressBar($output, count($cars));
        $bar->start();

        foreach($cars as $car) {
            $output->writeln($car->getModel()->getName());
            $bar->advance();
        }
        $bar->finish();


        $output->writeln('Command result.');
    }

}
