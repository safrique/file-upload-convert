<?php

namespace Helpers\Interfaces;

interface FileHelpersInterface
{
    /**
     * Saves a file at the given location
     *
     * @param $location
     * @param $content
     *
     * @return false|int
     */
    public function saveFile($location, $content);

    /**
     * Returns the contents of the given file
     *
     * @param $filename
     * @param $ext
     *
     * @return array|mixed
     * @throws Exception
     */
    public function getFileContents($filename, $ext);

    /**
     * Converts a CSV file to an array
     *
     * @param $filename
     *
     * @return array
     */
    public function getArrayFromCSV($filename);

    /**
     * Converts the given file to the required format
     *
     * @param $original_file
     *
     * @param $to_file_type
     *
     * @return false|string
     */
    public function convertFile($original_file, $to_file_type);

    /**
     * Converts the contents of the given file to CSV string
     *
     * @param $original_file
     *
     * @return string
     */
    public function convertToCSV($original_file);

    /**
     * Returns the contents of a given CSV file as a string
     *
     * @param $filename
     *
     * @return string
     */
    public function getContentCSV($filename);
}