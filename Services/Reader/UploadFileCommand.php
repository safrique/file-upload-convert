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
            ->addArgument('FileLocation', InputArgument::REQUIRED, 'Please specify a file location')
            ->addArgument('NewFileType', InputArgument::REQUIRED, 'Please specify the new file type to convert to')
            ->addArgument('SaveOrDisplay', InputArgument::OPTIONAL, 'Please specify whether to save or display the new file')
            ->addArgument('SaveLocation', InputArgument::OPTIONAL, 'Please specify where to save the new file to');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $location = $input->getArgument('FileLocation');
        $new_file_type = $input->getArgument('NewFileType');
        $save_or_display = $input->getArgument('SaveOrDisplay');
        $save_location = $input->getArgument('SaveLocation');

        (new ConvertFile($location, $new_file_type, $save_or_display, $save_location))->execute();

        $output->writeln("location=$location");
        $output->writeln("new_file_type=$new_file_type");
        $output->writeln("save_or_display=$save_or_display");
        $output->writeln("save_location=$save_location");

        return 1;
    }

}