<?php

namespace Hyperlink\Sluggable\Exceptions;

use Exception;

class ConfigModelMissing extends Exception
{
    public function __construct()
    {
        parent::__construct('The model in the sluggable.php config file is null.');
    }
}
