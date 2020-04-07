<?php

namespace Helpers;

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
}