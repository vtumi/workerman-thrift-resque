workerman-thrift-resque
=========

配置运行环境
----------

[配置教程](http://www.workerman.net/install)

安装Redis
----------

创建项目
----------

Composer
```sh
composer create-project --prefer-dist tumi/workerman-thrift-resque:dev-master
```

安装使用Thrift
----------

[在线文档](http://thrift.apache.org/docs/)

添加作业到队列
----------

直接添加
```php
require_once __DIR__ . '/vendor/autoload.php';
  
use Resque;
  
Resque::setBackend('127.0.0.1:6379');
  
$args = ['str' => 'This is a test!'];
Resque::enqueue('default', 'Demo', $args);
```

使用Thrift添加（参考client.php）

定义作业处理类
----------

启动停止
----------

启动
```sh
php start.php start -d
```

重启
```sh
php start.php restart
```

平滑重启  
```sh
php start.php reload
```

查看状态
```sh
php start.php status
```

停止
```sh
php start.php stop
```
