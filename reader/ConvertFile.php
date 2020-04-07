<?php

namespace FileReader;

use Symfony\Component\Yaml\Yaml;

class ConvertFile
{
    protected $filename;
    protected $to_file_type;
    protected $ext;
    protected $accepted_ext = ["csv", "json", "yaml"];

    /** @var bool */
    protected $save;

    public function __construct($filename, $to_file_type, $save = false)
    {
        if (!in_array($ext = pathinfo($this->filename, PATHINFO_EXTENSION), $this->accepted_ext)) {
            throw new \Exception("The file extension $ext is not valid");
        }

        if (!in_array($to_file_type, $this->accepted_ext)) {
            throw new \Exception("The file extension $to_file_type is not valid");
        }

        $this->save = $save;
        $this->ext = $ext;
        $this->filename = $filename;
        $this->to_file_type = $to_file_type;
    }

    public function getFile()
    {
        $file = fopen($this->filename, "r") or die("Unable to open file!");
        $new_file = $file;

        if (strtolower($this->ext) == "csv") {
            $new_file = array_map('str_getcsv', file($this->filename));
            array_walk($new_file, function (&$a) use ($new_file) {
                $a = array_combine($new_file[0], $a);
            });
            array_shift($new_file);
        }

        if (strtolower($this->ext) == 'json') {
            $new_file = json_decode($file, true);
        }

        if (strtolower($this->ext) == 'yaml') {
            $new_file = Yaml::parse($file);
        }

        fclose($file);

        if (strtolower($this->to_file_type) == 'json') {
            $new_file = json_encode($new_file);
        }

        if (strtolower($this->to_file_type) == 'yaml') {
            $new_file = Yaml::dump($new_file);
        }

        // TODO: Convert to CSV

        // TODO: save or display new file

        return $new_file;
    }
}