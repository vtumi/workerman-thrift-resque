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
`composer create-project --prefer-dist tumi/workerman-thrift-resque:dev-master`

安装使用Thrift
----------

添加作业到队列
----------

定义作业处理类
----------

启动停止
----------

启动  
`php start.php start -d`

重启  
`php start.php restart`

平滑重启  
`php start.php reload`

查看状态  
`php start.php status`

停止  
`php start.php stop`
