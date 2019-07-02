<?php

namespace Elite\Plugins\Devtool;

use ESD\Core\Plugins\Config\BaseConfig;

class DevtoolConfig extends BaseConfig
{
    const key = 'devtool';

    public function __construct()
    {
        parent::__construct(self::key);
    }

}