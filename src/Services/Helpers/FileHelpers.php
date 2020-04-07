<?php

namespace Helpers;

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
        return file_put_contents($location, $content);
    }
}