<?php

namespace Hyperlink\Sluggable\Exceptions;

use Exception;

class ConfigModelWrong extends Exception
{
    public function __construct($model)
    {
        parent::__construct("The model {$model} is not a valid model.");
    }
}
