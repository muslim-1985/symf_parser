<?php
declare(strict_types=1);

namespace App\Command\Tesseract;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use thiagoalessio\TesseractOCR\TesseractOCR;


class CheckParser extends Command
{
    private $publicDir;
    public function __construct(KernelInterface $kernel)
    {
        $this->publicDir = $kernel->getProjectDir();
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('parse:check')
            ->setDescription('Check parser');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
//        $cc = new TesseractOCR($this->publicDir.'/src/Command/Tesseract/sales_4.jpg');
//        print_r($cc->lang('rus')->run()) ;
        //echo $this->publicDir.'/src/Command/Tesseract';
        $filesystem = file_get_contents($this->publicDir.'/src/Command/Tesseract/nn.txt');
       // dump(explode(PHP_EOL, $filesystem));
        $output->writeln(explode(PHP_EOL, $filesystem));
        return 0;
    }
}