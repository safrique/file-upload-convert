<?php

namespace Commands;

use Exception;
use FileReader\ConvertFile;
use Helpers\FileHelpers;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class UploadFileCommand extends Command
{
    /**
     * Configures the CLI Command
     */
    protected function configure()
    {
        $this->setName("ConvertFile")
            ->setDescription("Uploads & converts a file to new format and saves or displays it")
            ->addArgument('FileLocation', InputArgument::REQUIRED, 'Please specify a file location')
            ->addArgument('NewFileType', InputArgument::REQUIRED, 'Please specify the new file type to convert to')
            ->addArgument('SaveOrDisplay', InputArgument::OPTIONAL,
                'Please specify whether to save or display the new file')
            ->addArgument('SaveLocation', InputArgument::OPTIONAL, 'Please specify where to save the new file to');
    }

    /**
     * Executes the Command
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     * @throws Exception
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $location = $input->getArgument('FileLocation');
        $new_file_type = $input->getArgument('NewFileType');
        $save_or_display = $input->getArgument('SaveOrDisplay');
        $save_location = $input->getArgument('SaveLocation');
        (new ConvertFile($location, $new_file_type, new FileHelpers(), $save_or_display, $save_location))->execute();
        return 0;
    }
}