<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 27.03.2017
 * Time: 16:53
 */

namespace simpleframework\Cache\Driver;


use simpleframework\Cache\Driver;
use simpleframework\Exception\ServiceException;

/**
 * Class Redis
 * @package simpleframework\Cache\Driver
 */
class Redis extends Driver
{

    protected $_service;

    /**
     * @readwrite
     */
    protected $_host = '127.0.0.1';

    /**
     * @readwrite
     */
    protected $_port = '6379';

    /**
     * @readwrite
     */
    protected $_isConnected = false;

    /**
     * @readwrite
     */
    protected $_cache;


    /**
     *
     * @return boolean
     */
    protected function _isValidService()
    {
        $isEmpty = empty($this->_service);
        $isInstance = $this->_service instanceof \Redis;
        if($this->isConnected && $isInstance && !$isEmpty)
        {
            return true;
        }
        return false;
    }
    /**
     *
     * @throws ServiceException
     */
    public function connect()
    {
        try
        {
            $this->_service = new \Redis();
            $this->_service->connect($this->host, $this->port);
            $this->isConnected = true;
        }
        catch (\Exception $e)
        {
            throw new ServiceException("Unable to connect to service");
        }
        return $this;
    }

    /**
     * Disconnect
     * @return $this
     */
    public function disconnect()
    {
        if($this->_isValidService())
        {
            $this->_service->close();
            $this->isConnected=false;
        }
        return $this;
    }

    /**
     * @param $key
     * @param null $default
     * @return null
     * @throws ServiceException
     */
    public function get($key, $default=null)
    {
        if(!$this->_isValidService())
        {
            throw new ServiceException("Not connected to a valid service");
        }
        $value = $this->_service->get($key);
        if($value)
        {
            return $value;
        }
        return $default;
    }

    /**
     * @param $key
     * @param $value
     * @param int $duration
     * @return $this
     * @throws ServiceException
     */
    public function set($key, $value, $duration=120)
    {
        if(!$this->_isValidService())
        {
            throw new ServiceException("Not connected to a valid service");
        }
        $this->_service->setex($key, $duration,  $value);
        return $this;

    }

    /**
     * @param $key
     * @return $this
     * @throws ServiceException
     */
    public function erase($key)
    {
        if(!$this->isValideService())
        {
            throw new ServiceException("Not connected to a valide service");
        }
        $this->_service->delete($key);
        return $this;
    }

}