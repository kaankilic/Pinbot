<?php

namespace Kaankilic\Pinbot\Helpers;

use Kaankilic\Pinbot\Exceptions\InvalidRequest;

class FileHelper
{
    /**
     * @param string $filePath
     * @return mixed
     * @throws InvalidRequest
     */
    public static function getMimeType($filePath)
    {
        if (!file_exists($filePath)) {
            throw new InvalidRequest("$filePath: failed to open file.");
        }
        
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $type = finfo_file($fileInfo, $filePath);
        finfo_close($fileInfo);

        return $type;
    }

    /**
     * @param string $source
     * @param string $destination
     */
    public static function saveTo($source, $destination)
    {
        file_put_contents($destination, file_get_contents($source));
    }
}