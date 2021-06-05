<?php

use Dotenv\Dotenv;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Env
{
    public function __construct()
    {
        $dotenv =  Dotenv::createImmutable(FCPATH);
        $dotenv->safeLoad();
    }
}
