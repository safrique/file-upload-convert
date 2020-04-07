<?php

namespace Helpers;

class FileHelpers extends Helpers implements FileHelpersInterface
{
    public function saveFile($location, $content)
    {
        file_put_contents($location, $content);
    }
}