<?php

namespace core\base;

use core\DB;

class Model
{
    public $attributes = [];
    public $errors = [];
    public $rules = [];

    public function __construct() {
        new DB();
    }
}