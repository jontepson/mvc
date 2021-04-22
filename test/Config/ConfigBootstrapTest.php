<?php

declare(strict_types=1);

namespace jope\Config;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the configuration file bootstrap.php.
 */
class ConfigBootstrapTest extends TestCase
{
    private $configFile = INSTALL_PATH . "/config/bootstrap.php";

    /**
     * Require the config file.
     */
    public function testRequireConfigFile()
    {
        $exp = 1;
        $res = require $this->configFile;
        $this->assertEquals($exp, $res);
    }
}
