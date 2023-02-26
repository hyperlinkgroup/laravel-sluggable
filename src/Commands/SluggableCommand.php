<?php

namespace Hyperlink\Sluggable\Commands;

use Illuminate\Console\Command;

class SluggableCommand extends Command
{
    public $signature = 'laravel-sluggable';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
