<?php

namespace Helpers;

use Exception;
use Helpers\Interfaces\FileHelpersInterface;
use Symfony\Component\Yaml\Yaml;

class FileHelpers extends Helpers implements FileHelpersInterface
{
    /**
     * Saves a file at the given location
     *
     * @param $location
     * @param $content
     *
     * @return false|int
     */
    public function saveFile($location, $content)
    {
        if (!file_exists(dirname($location))) {
            mkdir(dirname($location));
        }
        return file_put_contents($location, $content);
    }

    /**
     * Returns the contents of the given file
     *
     * @param $filename
     * @param $ext
     *
     * @return array|mixed
     * @throws Exception
     */
    public function getFileContents($filename, $ext)
    {
        if (!$file = fopen($filename, "r")) {
            throw new Exception("Unable to open file! Does the file exist or are you using \\ instead of / in the filename?");
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

    /**
     * Converts a CSV file to an array
     *
     * @param $filename
     *
     * @return array
     */
    public function getArrayFromCSV($filename)
    {
        $new_file = array_map('str_getcsv', file($filename));
        array_walk($new_file, function (&$a) use ($new_file) {
            $a = array_combine($new_file[0], $a);
        });
        array_shift($new_file);
        return $new_file;
    }

    /**
     * Converts the given file to the required format
     *
     * @param $original_file
     *
     * @param $to_file_type
     *
     * @return false|string
     */
    public function convertFile($original_file, $to_file_type)
    {
        switch (strtolower($to_file_type)) {
            case 'json':
                return json_encode($original_file);
            case 'yaml':
                return Yaml::dump($original_file);
            default:
                return $this->convertToCSV($original_file);
        }
    }

    /**
     * Converts the contents of the given file to CSV string
     *
     * @param $original_file
     *
     * @return string
     */
    public function convertToCSV($original_file)
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

    /**
     * Returns the contents of a given CSV file as a string
     *
     * @param $filename
     *
     * @return string
     */
    public function getContentCSV($filename)
    {
        $new_file = '';
        $file = fopen($filename, "r");

        while (!feof($file)) {
            $new_file .= fgets($file);
        }

        fclose($file);
        return $new_file;
    }
}