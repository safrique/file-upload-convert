<?php

namespace App\Services\Helpers;

use Helpers\FileHelpers;
use Helpers\Interfaces\FileHelpersInterface;
use PHPUnit\Framework\TestCase;

class FileHelpersTest extends TestCase
{
    /** @var FileHelpersInterface */
    protected $file_helper;

    /**
     * FileHelpersTest constructor.
     *
     * @param string|void $name
     * @param array       $data
     * @param string      $dataName
     */
    public function __construct(string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->file_helper = new FileHelpers();
    }

    public function testItSavesFileToExistingPath()
    {
        $filename = RESOURCES_DIRECTORY . "/sample-files/test.txt";
        $this->assertGreaterThan(0, $this->file_helper->saveFile($filename, 'Some test text'));
        unlink($filename);
    }

    public function testItSavesFileToNonExistingPath()
    {
        $filename = RESOURCES_DIRECTORY . "/non-existent-directory/test.txt";
        $this->assertGreaterThan(0, $this->file_helper->saveFile($filename, 'Some test text'));
        unlink($filename);
        rmdir(dirname($filename));
    }

    public function testItReturnsFileContentAsArray()
    {
        $filename = RESOURCES_DIRECTORY . "/sample-files/customers.csv";
        $this->assertIsArray($this->file_helper->getFileContents($filename, 'csv'));
    }
}