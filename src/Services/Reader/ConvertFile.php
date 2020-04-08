<?php

namespace FileReader;

use Exception;
use Helpers\Interfaces\FileHelpersInterface;

class ConvertFile
{
    protected
        $accepted_ext = ["csv", "json", "yaml"],
        $ext,
        $filename,
        $save,
        $save_location,
        $to_file_type;

    /** @var FileHelpersInterface */
    protected $file_helper;

    /**
     * ConvertFile constructor.
     *
     * @param                      $filename
     * @param                      $to_file_type
     * @param FileHelpersInterface $file_helper
     * @param bool                 $save
     * @param null                 $save_location
     *
     * @throws Exception
     */
    public function __construct(
        $filename,
        $to_file_type,
        FileHelpersInterface $file_helper,
        $save = false,
        $save_location = null
    ) {
        $this->checkExtensions([
            'original file extension' => ($ext = pathinfo($filename, PATHINFO_EXTENSION)),
            'target file extension'   => $to_file_type
        ]);

        $this->setDefaults([
            'filename'      => $filename,
            'to_file_type'  => $to_file_type,
            'save'          => $save,
            'save_location' => $save_location,
            'ext'           => $ext,
            'file_helper'   => $file_helper,
        ]);
    }

    /**
     * Checks if the input and output file extensions are acceptable
     *
     * @param array $extensions
     *
     * @throws Exception
     */
    private function checkExtensions(array $extensions)
    {
        foreach ($extensions as $type => $ext) {
            if (!in_array($ext, $this->accepted_ext)) {
                throw new Exception("The $type $ext is not valid");
            }
        }
    }

    /**
     * Sets the default parameters
     *
     * @param array $defaults
     */
    private function setDefaults(array $defaults)
    {
        foreach ($defaults as $key => $item) {
            if (property_exists($this, $key)) {
                $this->$key = $item;
            }
        }
    }

    /**
     * Executes the file conversion
     *
     * @return false|string
     * @throws Exception
     */
    public function execute()
    {
        $contents = $this->file_helper->getFileContents($this->filename, $this->ext);
        $new_file = $this->file_helper->convertFile($contents, $this->to_file_type);

        if ($this->save) {
            if (!$this->save_location) {
                throw new Exception("A location has to be specified to save the file!!");
            }

            $this->file_helper->saveFile($this->save_location, $new_file);
        }

        if (!$this->save) {
            print_r($new_file);
        }

        print_r("\n\nRESULT:\nThe original file $this->filename with extension $this->ext was converted to $this->to_file_type and "
                . ($this->save ? 'saved' : 'displayed') . ($this->save && $this->save_location ? " at $this->save_location" : '') . "\n\n");
        return $new_file;
    }
}