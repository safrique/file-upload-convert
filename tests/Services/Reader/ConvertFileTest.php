<?php

namespace FileReader;

use Helpers\FileHelpers;
use PHPUnit\Framework\TestCase;

class ConvertFileTest extends TestCase
{
    protected $new_file = "C:/Users/jvniekerk/Desktop/repos/file-upload-convert/resources/sample-files/customers.json";
    protected $filename = "http://localhost/file-upload-convert/resources/sample-files/customers.csv";

    public function testConvertFile()
    {
        $this->assertClassHasAttribute('filename', ConvertFile::class);
        $converter = new ConvertFile($this->filename, 'yaml', new FileHelpers());
        $this->assertIsObject($converter);
    }
}