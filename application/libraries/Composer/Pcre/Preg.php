<?php

namespace Composer\Pcre;

class Preg
{
    public static function isMatch($pattern, $subject, &$matches = null, $flags = 0, $offset = 0)
    {
        return preg_match($pattern, $subject, $matches, $flags, $offset);
    }

    public static function replace($pattern, $replacement, $subject, $limit = -1, &$count = null)
    {
        return preg_replace($pattern, $replacement, $subject, $limit, $count);
    }

    public static function split($pattern, $subject, $limit = -1, $flags = 0)
    {
        return preg_split($pattern, $subject, $limit, $flags);
    }
}
