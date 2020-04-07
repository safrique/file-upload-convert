<?php

namespace FileReader;

require_once __DIR__ . '/ConvertFile.php';

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class UploadFileCommand extends Command
{
    protected function configure()
    {
        $this->setName("ConvertFile")
            ->setDescription("Uploads & converts a file to new format and saves or displays it")
            ->addArgument('FileLocation', InputArgument::REQUIRED,
                'Please specify a file location')
            ->addArgument('NewFileType', InputArgument::REQUIRED,
                'Please specify the new file type to convert to')
            ->addArgument('SaveOrDisplay', InputArgument::OPTIONAL,
                'Please specify whether to save or display the new file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $location = $input->getArgument('FileLocation');
        $new_file_type = $input->getArgument('NewFileType');
        $save_or_display = $input->getArgument('SaveOrDisplay');

        $reader = new ConvertFile($location, $new_file_type);

        $result = $reader->getFile($save_or_display);
        print_r($result);
        echo "\n\n\n";

        $output->writeln("location=$location");
        $output->writeln("new_file_type=$new_file_type");
        $output->writeln("save_or_display=$save_or_display");

        return 1;
    }

}