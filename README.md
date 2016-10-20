workerman-thrift-resque
=========

配置运行环境
----------

[配置教程](http://www.workerman.net/install)

安装Redis
----------

[安装教程](http://redis.cn/download.html)

创建项目
----------

Composer
```sh
composer create-project --prefer-dist tumi/workerman-thrift-resque:dev-master
```

安装使用Thrift
----------

[在线文档](http://thrift.apache.org/docs/)

添加作业到队列（PHP）
----------

直接添加
```php
require_once __DIR__ . '/vendor/autoload.php';

use Resque;

Resque::setBackend('127.0.0.1:6379');

$args = ['str' => 'This is a test!'];
Resque::enqueue('default', 'Demo', $args);
```

通过Thrift RPC添加（参考client.php）

定义作业处理类
----------

普通作业
```php
namespace App\Resque\Job;

class Demo
{
    public function perform()
    {
        \Workerman\Worker::log($this->args['str']);
    }
}
```

延时作业
```php
namespace App\Resque\Job;

class Demo
{
    public function perform()
    {
        sleep(300);
        \Workerman\Worker::log($this->args['str']);
    }
}
```

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
