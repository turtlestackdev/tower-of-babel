<?php


namespace TowerOfBabel\Utilities;


class Path {
    /**
     * Take a list of strings and join them together as a path.
     * Assumes either a URL or posix path setup, i.e., works with / as the path separator, but not \.
     * The returned string always has the trailing slash removed, unless the path is the root path.
     */
    public static function join(string ...$paths): string {
        $joined = '';
        foreach ($paths as $path) {
            // strip all duplicate path separators except for a url declaration.
            $path = preg_replace('/^(\w+:\/\/)?(*SKIP)(*F)|\/+/', '/', $path);
            if ($joined === '') {
                $joined = $path;
            } else {
                $joined = rtrim(rtrim($joined, '/').'/'.ltrim($path, '/'), '/');
            }
        }

        return $joined;
    }

}