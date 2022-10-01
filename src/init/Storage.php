<?php

namespace liansu\storage\init;

use liansu\core\App;
use liansu\core\Config;
use liansu\core\interface_\RunInterface;
use liansu\storage\Cache;
use liansu\storage\Session;

class Storage implements RunInterface
{
    public function run()
    {
        Cache::initialize(App::instance()->runtimeDirectory . DIRECTORY_SEPARATOR . '/cache', Config::get('default_expire_seconds'));

        Session::initialize(md5(App::instance()->rootDirectory));
    }
}
