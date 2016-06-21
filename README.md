# RedPacket SDK for PHP

[![Latest Stable Version](https://poser.pugx.org/yunzhanghu/redpacket-sdk-php/v/stable)](https://packagist.org/packages/yunzhanghu/redpacket-sdk-php)

## 概述

RedPacket SDK for PHP 专门应用于服务端发送红包, 是云账户对外提供的红包工具。开发者可以通过调用 API, 在任何时间、地点进行红包的发送, 也可以进行其他的数据操作。

## 运行环境

- PHP 5.3+
- cURL extension

提示： Ubuntu 下可以使用 apt-get 包管理器安装 PHP 的 cURL 扩展 `sudo apt-get install php5-curl`

## 安装方法

### 1. Composer 

如果您通过 composer 管理您的项目依赖，可以在你的项目根目录运行：

```json
$ composer require yunzhanghu/redpacket-sdk-php

或者在你的 composer.json 中声明对 RedPacket SDK for PHP 的依赖：

"require": {
    "yunzhanghu/redpacket-sdk-php": "~2.0"
}

然后通过 composer install 安装依赖。composer 安装完成后，在您的PHP代码中引入依赖即可：

require_once __DIR__ . '/vendor/autoload.php';
```

### 2. 下载SDK源码 (或者)

下载 SDK 源码，在您的代码中引入 SDK 目录下的 `autoload.php` 文件：

```json
require_once '/path/to/redpacket-sdk-php/autoload.php';
```

## 快速使用

### 常用类

| 类名 | 解释 |
|:------------------|:------------------------------------|
|RedPacket\RPClient| 红包客户端类，用户通过 RPClient 的实例调用接口 |
|RedPacket\Core\RPException | RedPacket 异常类，用户在使用的过程中，只需要注意这个异常|

### RPClient 初始化

SDK 的 RedPacket 操作通过 RPClient 类完成的，下面代码创建一个 RPClient 对象:

```php
<?php
$duid = "<用户ID>"; ;
$groupId = "<用户所在组>";
try {
    $rplient = new RPClient($duid, groupId);
} catch (RPException $e) {
    print $e->getMessage();
}

```

### Sample

1. 修改 `samples/Config.php`， 补充配置信息
2. 执行 `cd samples/ && php run.php`

### 单元测试

1. 执行 `composer install` 下载依赖的库
2. 执行 `php vendor/bin/phpunit`

## 联系我们

开发者邮箱：zhijie.deng@yunzhanghu.com

[releases-page]: https://github.com/PhilipTang/redpacket-server-side-sdk-php/releases
