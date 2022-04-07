<?php

namespace App\Models;

class Product
{
    private $code;
    private $description;
    private $options;

    public function __construct($code, $description, $options)
    {
        $this->code = $code;
        $this->description = $description;
        $this->options = $options;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getOptions()
    {
        return $this->options;
    }
}