<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 31.03.2017
 * Time: 10:08
 */

namespace simpleframework\Configuration\Driver;


use simpleframework\Configuration\Driver;
use simpleframework\Exception\ArgumentException;
use simpleframework\Exception\SyntaxException;
use simpleframework\Utils\ArrayMethods;

class Ini extends Driver
{
    /**
     * The only public method in our INI configuration parser class is a method called parse(). It first checks to
     * see that the $path argument is not empty, throwing a ConfigurationExceptionArgument exception if it is. Next, it
     * checks to see if the requested configuration file has not already been parsed, and if it has it jumps right to where it
     * returns the configuration.
     *
     * If it has not parsed the required configuration file, it uses output buffering to capture the contents of a call
     * to include() the configuration file’s contents. Using the include() method allows the configuration to be sitting
     * anywhere relative to the paths in PHP’s include path, though we will usually be loading them from a standard
     * configuration folder.
     *
     * @param $path
     * @return mixed
     * @throws ArgumentException
     * @throws SyntaxException
     */
    public function parse($path)
    {
        if (empty($path)) {
            throw new ArgumentException("{$path} is not valid");
        }
        if (!isset($this->_parsed[$path])) {
            $config = [];

            ob_start();
            include("{$path}.ini");
            $string = ob_get_contents();
            ob_end_clean();

            $pairs = parse_ini_string($string);

            if ($pairs == false) {
                throw new SyntaxException("Could not parse the configuration file");
            }

            foreach ($pairs as $key => $value) {
                $config = $this->_pair($config, $key, $value);
            }
            $this->_parsed[$path] = ArrayMethods::toObject($config);
        }
        return $this->_parsed[$path];
    }

    /**
     * The _pair() method deconstructs the dot notation, used in the configuration file’s keys, into an associative
     * array hierarchy. If the $key variable contains a dot character (.), the first part will be sliced off, used to create a
     * new array, and assigned the value of another call to _pair()
     *
     * @param $config
     * @param $key
     * @param $value
     * @return mixed
     */
    protected function _pair($config, $key, $value)
    {
        if (strstr($key, ".")) {
            $parts = explode(".", $key, 2);

            if (empty($config[$parts[0]])) {
                $config[$parts[0]] = [];
            }

            $config[$parts[0]] = $this->_pair($config[$parts[0]], $parts[1], $value);
        } else {
            $config[$key] = $value;
        }
        return $config;
    }
}