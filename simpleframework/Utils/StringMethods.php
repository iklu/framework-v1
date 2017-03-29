<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 27.03.2017
 * Time: 10:08
 */
namespace simpleframework\Utils;

/**
 * The match() and split() methods perform similarly to the preg_match_all() and preg_split() functions, but require less
 * formal structure to the regular expressions, and return a more predictable set of results.
 *
 * Class StringMethods
 * @package framework
 */
class StringMethods
{
    /**
     * @var string
     */
    private static $_delimiter = "#";

    /**
     * StringMethods constructor.
     */
    private function __construct()
    {
        //do nothing
    }

    /**
     * clone
     */
    private function __clone()
    {
        //do nothing
    }

    /**
     *
     * The $delimiter and _normalize() members are all for the normalization of regular expression strings, so
     * that the remaining methods can operate on them without first having to check or normalize them.
     *
     * @param $pattern
     * @return string
     */
    private static function _normalize($pattern) : string
    {
        return self::$_delimiter . trim($pattern, self::$_delimiter) . self::$_delimiter;
    }

    /**
     * @return string
     */
    public static function getDelimiter() : string
    {
        return self::$_delimiter;
    }

    /**
     * @param string $delimiter
     */
    public static function setDelimiter($delimiter)
    {
        self::$_delimiter = $delimiter;
    }

    /**
     * The match() method will
     * return the first captured substring, the entire substring match, or null.
     * @once @read
     * @param $string
     * @param $pattern
     * @return null
     */
    public static function match($string, $pattern)
    {
        preg_match_all(self::_normalize($pattern), $string, $matches, PREG_PATTERN_ORDER);
        if (!empty($matches[1])) {
            return $matches[1];
        }

        if (!empty($matches[0])) {
            return $matches[0];
        }

        return null;
    }

    /**
     * The split() method will return the results
     * of a call to the preg_split() function, after setting some flags and normalizing the regular expression.
     *
     * @param $string
     * @param $pattern
     * @param null $limit
     * @return mixed
     */
    public static function split($string, $pattern, $limit = null) : array
    {
        $flags = PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE;
        return preg_split(self::_normalize($pattern), $string, $limit, $flags);
    }

}