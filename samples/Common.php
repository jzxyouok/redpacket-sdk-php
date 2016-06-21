<?php

if (is_file(__DIR__ . '/../autoload.php')) {
    require_once __DIR__ . '/../autoload.php';
}

if (is_file(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
}

require_once __DIR__ . '/Config.php';

use RedPacket\RPClient;
use RedPacket\Core\RPException;

/**
 * Class Common
 *
 * 示例程序【Samples/*.php】 的Common类，用于获取 RPClient 实例和其他公用方法
 */
class Common
{

    /**
     * 根据 Config 配置，得到一个 RPClient 实例
     *
     * @return RPClient 一个 RPClient 实例
     */
    public static function getRPClient()
    {
        try {
            $RPClient = new RPClient(Config::PARTNER, Config::KEY);
        } catch (RPException $e) {
            printf(__FUNCTION__ . "creating RPClient instance: FAILED\n");
            printf($e->getMessage() . "\n");
            return null;
        }
        return $RPClient;
    }

}
