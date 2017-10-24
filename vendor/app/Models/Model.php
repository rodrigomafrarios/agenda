<?php

/**
 * Created by PhpStorm.
 * User: rodrigo.mafra
 * Date: 24/10/2017
 * Time: 16:49
 */

namespace app\Models;

class Model
{
    private $values = array();

    public function __call($name, $arguments)
    {
        $method     = substr($name,0,3);
        $fieldName  = substr($name,3,strlen($name));

        switch ($method)
        {
            case $method == 'get':
                return $this->values[$fieldName];
                break;
            case $method == 'set':
                $this->values[$fieldName] = $arguments[0];
                break;
        }
    }

    public function setData($data)
    {
        foreach ($data as $key => $value)
        {
            $this->{"set" . $key}($value);
        }
    }

    public function getValues()
    {
        $data = array();

        foreach ($this->values as $key => $value)
        {
            $data[$key] = $value;
        }

        return $data;
    }
}