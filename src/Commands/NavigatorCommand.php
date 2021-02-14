<?php

namespace Binomedev\Navigator\Commands;

use Illuminate\Console\Command;

class NavigatorCommand extends Command
{
    public $signature = 'navigator';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
