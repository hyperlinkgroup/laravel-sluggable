<?php

namespace Hyperlink\Sluggable\Exceptions;

use Exception;

class SlugCreatedFromMissing extends Exception
{
    public function __construct($model)
    {
        parent::__construct("The model {$model} has no createSlugFrom attribute.");
    }
}
