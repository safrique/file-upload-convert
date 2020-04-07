<?php

namespace FileReader;

use Helpers\FileHelpers;
use Helpers\FileHelpersInterface;
use Symfony\Component\Yaml\Yaml;

class ConvertFile
{
    protected
        $accepted_ext = ["csv", "json", "yaml"],
        $ext,
        $filename,
        $save_location,
        $to_file_type;

    /** @var FileHelpersInterface */
    protected $file_helper;

    /** @var bool */
    protected $save;

    public function __construct($filename, $to_file_type, $save = false, $save_location = null)
    {
        $this->checkExtensions([
            'original file extension' => ($ext = pathinfo($filename, PATHINFO_EXTENSION)),
            'target file extension'   => $to_file_type
        ]);

        $this->setDefaults([
            'filename'      => $filename,
            'to_file_type'  => $to_file_type,
            'save'          => $save,
            'save_location' => $save_location,
            'ext'           => $ext
        ]);
    }

    private function checkExtensions(array $extensions)
    {
        foreach ($extensions as $type => $ext) {
            if (!in_array($ext, $this->accepted_ext)) {
                throw new \Exception("The $type $ext is not valid");
            }
        }
    }

    private function setDefaults(array $defaults)
    {
        foreach ($defaults as $key => $item) {
            $this->$key = $item;
        }
    }

    public function execute()
    {
        $new_file = $this->convertFile($this->getFileContents($this->filename, $this->ext));

        if ($this->save) {
            if (!$this->save_location) {
                throw new \Exception("A location has to be specified to save the file!!");
            }

            $this->file_helper = new FileHelpers();
            $this->file_helper->saveFile($this->save_location, $new_file);
        }

        return $new_file;
    }

    private function getFileContents($filename, $ext)
    {
        if (!$file = fopen($filename, "r")) {
            throw new \Exception("Unable to open file!");
        }

        switch (strtolower($ext)) {
            case 'json':
                $new_file = json_decode($file, true);
                break;
            case 'yaml':
                $new_file = Yaml::parse($file);
                break;
            default:
                $new_file = $this->getArrayFromCSV($filename);
        }

        fclose($file);
        return $new_file;
    }

    private function getArrayFromCSV($filename)
    {
        $new_file = array_map('str_getcsv', file($filename));
        array_walk($new_file, function (&$a) use ($new_file) {
            $a = array_combine($new_file[0], $a);
        });
        array_shift($new_file);
        return $new_file;
    }

    private function convertFile($original_file)
    {
        switch (strtolower($this->to_file_type)) {
            case 'json':
                return json_encode($original_file);
            case 'yaml':
                return Yaml::dump($original_file);
            default:
                return $this->convertToCSV($original_file);
        }
    }

    private function convertToCSV($original_file)
    {
        $filename = 'file.csv';
        $fp = fopen($filename, 'w');

        foreach ($original_file as $fields) {
            fputcsv($fp, $fields);
        }

        fclose($fp);
        $new_file = $this->getContentCSV($filename);
        unlink($filename);
        return $new_file;
    }

    private function getContentCSV($filename)
    {
        $new_file = '';
        $file = fopen($filename, "r") or die("Unable to open file!");

        while (!feof($file)) {
            $new_file .= fgets($file);
        }

        fclose($file);
        return $new_file;
    }
}