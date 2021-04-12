<?php

class ChecksumUtil
{
    public static function checksumGenerator($filePath)
    {
        return hash_file('md5', $filePath);
    }

    public static function checker($file, $checksum)
    {
        return $file == $checksum;
    }
}
