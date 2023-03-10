# <liLinux学习

## firewall防火墙详解

````
 停止firewall
 systemctl stop firewalld.service
 
 禁止firewall开机启动
 systemctl disable firewalld.service
 
 重启防火墙
 firewall-cmd --reload
 
 永久添加端口 完成后记得重启防火墙
 firewall-cmd --zone=public --add-port=80/tcp --permanent
 
 查看开放的端口
 firewall-cmd --list-port
 
````

## apache options +followsymlinks

````html
Web服务器的Apache安装编译成功mod_rewrite编译成模块，但当我在网站根目录下放了一个.htaccess配置文件，却得到了一个500内部服务器出错。
我打开我的.htaccess配置文件，发现文件头有 Options +FollowSymlinks
上网查了一下"在 某些服务器配置中，mod_rewrite要求有followsymlinks，否则会显示500内部服务器错误。
[In some (or all?) server configurations, mod_rewrite requires followsymlinks to be enabled, or it will crater with a 500-Server Error.]
在任何情况下，只要您没有指定FollowSymLinks的选项（即Options FollowSymLinks），或者指定了SymLinksIfOwnerMatch选项，Apache将不得不调用额外的系统函数来检查符号链接。每次针对文件名的请求都将触发一次检查。
如果你没有使用followsymlinks规则而网站访问正常，说明你的服务器配置已经默认调用followsymlinks的重写规则，你无需再为你的htaccess文件定义了。但在有些服务器500 Server Error之后的错误日志中提示需要定义SymLinks使得rewrite重写规则起作用。
````

```
echo "# StudyNotes" >> README.md
git init
git add README.md
git commit -m "first commit"
git branch -M main
git remote add origin git@github.com:whutan/StudyNotes.git
git push -u origin main
```
## 安装httpd服务

````php+HTML
安装apache
yum -y install httpd


查看apache运行状态
systemctl status httpd

开启apache
systemctl start httpd

设置开机启动

````

## 安装mariadb

~~~~
安装mariadb
yum install mariadb-server

启动命令
systemctl start mariadb

重启命令
systemctl restart mariadb

关闭命令
systemctl stop mariadb

开机自启
systemctl enable mariadb

关闭自启
systemctl disable mariadb

初始化数据库
mysql_secure_installation
初始化数据库提示输入root用户密码，初次进入，密码为空，直接回车就可以了

实现远程访问的两个条件
1 执行命令
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY '你的root密码' WITH GRANT OPTION;
2  设置防火墙放开3306端口
~~~~

##  linux网卡配置

````
 /etc/sysconfig/network-scripts目录下
 最后一行等号后面把no改为yes
 
 2  重启网路服务  
 service network restart
````

## linux安装php相关

````
查看php扩展
php -m

````

![1661668970284](C:\Users\Administrator\AppData\Roaming\Typora\typora-user-images\1661668970284.png)

````
 1  安装必要
    yum -y install gcc gcc-c++
    
 2	要安装PHP 7，您必须使用以下命令在CentOS 7系统上安装和启用EPEL和Remi存储库
	yum install https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
	yum install http://rpms.remirepo.net/enterprise/remi-release-7.rpm
	
 3	安装yum-utils，这是一组用于管理yum存储库和包的有用程序。它有基本上扩展yum默认功能的工具。
 	yum -y install yum-utils

 4	yum-utils提供的程序之一是yum-config-manager，您可以使用它来启用Remi存储库作为安装不同PHP版本的默认存储库，如图所示。
#yum-config-manager --enable remi-php71 [ 安装PHP 7.1 ]
#yum-config-manager --enable remi-php72 [ 安装PHP 7.2 ]
#yum-config-manager --enable remi-php73 [ 安装PHP 7.3 ]

  5	使用以下命令安装PHP 7以及所有必需的模块。
  yum -y install php php-mcrypt php-devel php-cli php-gd php-pear php-curl php-fpm php-mysql php-ldap php-zip php-fileinfo 
````

## 安装laravel框架

````html
  1  安装composer
curl -k -sS https://getcomposer.org/installer | php

  2 移动composer.phar
  mv composer.phar /usr/local/bin/composer
  
  3 更改composer国内镜像
  composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/
  
  4 通过composer安装 #--prefer-dist 的作用是强制下载压缩包
  composer create-project --prefer-dist laravel/laravel 项目名称 "8.*"
  
  5  配置虚拟机 在/etc/httpd/conf.d目录下创建vhosts.conf文件，在文件中添加以下内容
	<VirtualHost 192.168.1.112:80>
        DocumentRoot "/var/www/html/blog/public"
        ServerName blog_laravel.com
        ErrorLog "/var/log/httpd/blog-error_log"
        <Directory "/var/www/html/blog/public/">
        DirectoryIndex index.html index.php
        Options FollowSymLinks
        AllowOverride All
        Require all granted
        </Directory>
     </VirtualHost>

 6	更改laravel项目目录的所有者
	chown -R apache.apache /var/www/laravel
	chmod -R 755 /var/www/laravel
	
````

## etc/issue文件

~~~~
 /etc/issue 是在 登录之前显示， /etc/motd 是在登录之后显示
 /etc/issue 可用的参数
/l  显示第几个终端机接口
/m  显示硬件的等级
/n  显示主机的网络名称
/o  显示 domain name
/r  显示操作系统的版本
/t  显示本地时间
/s  显示操作系统的名称
/v  显示操作系统的版本
~~~~

## umask计算方法

~~~~
先将将总的权限（目录777，文件666）和umask值都转换为2进制，然后对umask取反，再将两个2进制值做与运算，得到的二进制值再转换十进制，即为权限，
~~~~

## linux命令

### du命令

~~~~
du 查看当前目录、所有子目录大小（以KB为计数单位）
du -h 查看当前目录、所有子目录大小（以MB为计数单位）
du -sh 查看当前目录大小。只展示当前目录的大小，所包含的目录统计在内（以MB为计数单位）
du -sh * 查看当前目录大小。展示所包含的所有目录大小（以MB为单位）


~~~~

### wc命令

~~~~
Linux系统中的wc(Word Count)命令的功能为统计指定文件中的字节数、字数、行数，并将统计结果显示输出

~~~~

### grep

~~~~
全拼:Global search REgular expression and Print out the line.
作用:文本搜索工具，根据用户指定的“模式（过滤条件)”对目标文本逐行进行匹配检查，打印匹配到的行.
模式:由正则表达式的元字符及文本字符所编写出的过滤条件﹔
语法： grep [options] [pattern] file
		-i:ignorecase,忽略字符大小写
		-O:仅显示匹配到的字符串本身
		-v: --revert-match # 反转查找 输出除之外的所有行 -v 选项
		-E：支持使用扩展的正则表达式元字符
		-q:静默模式，不输出任何信息
~~~~

### ps命令

~~~~
ps(processstatus)进程状态
-a：显示所有终端机下执行的程序，除了阶段作业领导者之外。
a：显示现行终端机下的所有程序，包括其他用户的程序。
-A：显示所有程序。
-c：显示CLS和PRI栏位。
c：列出程序时，显示每个程序真正的指令名称，而不包含路径，选项或常驻服务的标示。
-C<指令名称>：指定执行指令的名称，并列出该指令的程序的状况。
-d：显示所有程序，但不包括阶段作业领导者的程序。
-e：此选项的效果和指定"A"选项相同。
e：列出程序时，显示每个程序所使用的环境变量。
-f：显示UID,PPIP,C与STIME栏位。
f：用ASCII字符显示树状结构，表达程序间的相互关系。
-g<群组名称>：此选项的效果和指定"-G"选项相同，当亦能使用阶段作业领导者的名称来指定。
g：显示现行终端机下的所有程序，包括群组领导者的程序。
-G<群组识别码>：列出属于该群组的程序的状况，也可使用群组名称来指定。
h：不显示标题列。
-H：显示树状结构，表示程序间的相互关系。
-j或j：采用工作控制的格式显示程序状况。
-l或l：采用详细的格式来显示程序状况。
L：列出栏位的相关信息。
-m或m：显示所有的执行绪。
n：以数字来表示USER和WCHAN栏位。
-N：显示所有的程序，除了执行ps指令终端机下的程序之外。
-p<程序识别码>：指定程序识别码，并列出该程序的状况。
p<程序识别码>：此选项的效果和指定"-p"选项相同，只在列表格式方面稍有差异。
r：只列出现行终端机正在执行中的程序。
-s<阶段作业>：指定阶段作业的程序识别码，并列出隶属该阶段作业的程序的状况。
s：采用程序信号的格式显示程序状况。
S：列出程序时，包括已中断的子程序资料。
-t<终端机编号>：指定终端机编号，并列出属于该终端机的程序的状况。
t<终端机编号>：此选项的效果和指定"-t"选项相同，只在列表格式方面稍有差异。
-T：显示现行终端机下的所有程序。
-u<用户识别码>：此选项的效果和指定"-U"选项相同。
u：以用户为主的格式来显示程序状况。
-U<用户识别码>：列出属于该用户的程序的状况，也可使用用户名称来指定。
U<用户名称>：列出属于该用户的程序的状况。
v：采用虚拟内存的格式显示程序状况。
-V或V：显示版本信息。
-w或w：采用宽阔的格式来显示程序状况。　
x：显示所有程序，不以终端机来区分。
X：采用旧式的Linux i386登陆格式显示程序状况。
-y：配合选项"-l"使用时，不显示F(flag)栏位，并以RSS栏位取代ADDR栏位　。
-<程序识别码>：此选项的效果和指定"p"选项相同。
--cols<每列字符数>：设置每列的最大字符数。
--columns<每列字符数>：此选项的效果和指定"--cols"选项相同。
--cumulative：此选项的效果和指定"S"选项相同。
--deselect：此选项的效果和指定"-N"选项相同。
--forest：此选项的效果和指定"f"选项相同。
--headers：重复显示标题列。
--help：在线帮助。
--info：显示排错信息。
--lines<显示列数>：设置显示画面的列数。
--no-headers：此选项的效果和指定"h"选项相同，只在列表格式方面稍有差异。
--group<群组名称>：此选项的效果和指定"-G"选项相同。
--Group<群组识别码>：此选项的效果和指定"-G"选项相同。
--pid<程序识别码>：此选项的效果和指定"-p"选项相同。
--rows<显示列数>：此选项的效果和指定"--lines"选项相同。
--sid<阶段作业>：此选项的效果和指定"-s"选项相同。
--tty<终端机编号>：此选项的效果和指定"-t"选项相同。
--user<用户名称>：此选项的效果和指定"-U"选项相同。
--User<用户识别码>：此选项的效果和指定"-U"选项相同。
--version：此选项的效果和指定"-V"选项相同。
--widty<每列字符数>：此选项的效果和指定"-cols"选项相同。

~~~~

## 查看所有的用户和用户组

~~~~
 cat /etc/passwd   查看所有用户
 cat /etc/group    查看所有用户组
~~~~

## 文件权限设置为777 还报错

~~~~
设置 SELinux
~~~~



## rpm

~~~~
rpm全名(RedHat Pachkage Manager)，是以一种数据库记录的方式来将你所需要的软件安装到你的Linux系统的一套管理机制。

~~~~

## yum命令

~~~~
yum search 包名  //查询相关的包有哪些
~~~~

## traceroute 全部是*

~~~~
linux 下默认是用tcp，udp， 你把它强制用icmp 就可以。如：traceroute -I hostaddr,还不行，增加超时时间
~~~~

## netstat

~~~~
netstat -[antulpc] <==与网络接口有关的参数
-   r  :列出路由表(route table)，功能如同 route 这个指令；
-	n  ：不使用主机名与服务名称，使用 IP 与 port number ，如同 route -n
-	a  ：列出所有的联机状态，包括 tcp/udp/unix socket 等；
-	t  ：仅列出 TCP 封包的联机；
-	u  ：仅列出 UDP 封包的联机；
-	l  ：仅列出有在 Listen (监听) 的服务之网络状态；
-	p  ：列出 PID 与 Program 的檔名；
-	c  ：可以设定几秒钟后自动更新一次，例如 -c 5 每五秒更新一次网络状态的显示vi编辑器
~~~~

## vi编辑器

~~~~
Vim具有自己的复制，剪切和粘贴命令。复制称为y，剪切称为d，粘贴称为p
~~~~

## PHP源码安装

~~~~
需要gcc  autoconfig环境
yum install -y gcc-c++ gcc
yum install autoconf

1 解压
2 configure
3 make
4 make install
参数的含义：
--prefix=xxxxx   指定PHP安装目录
--with-config-file-path=XXXX   指定php.ini位置


cd php-7.1.10
 
./configure \
--prefix=/home/whutan/soft/php \
--with-apxs2=/usr/bin/apxs \
--with-mysql-sock=/usr/local/mysql/mysql.sock \
--with-mysqli \
--with-zlib \
--with-curl \
--with-gd \
--with-jpeg-dir \
--with-png-dir \
--with-freetype-dir \
--with-openssl \
--enable-xml \
--enable-session \
--enable-ftp \
--enable-pdo \
--enable-tokenizer \
--enable-zip
~~~~

## swoole源码安装

~~~~
编译的时候带上 --with-php-config选项
./configure --with-php-config=xxxxxx  php的安装目录
~~~~

## think-swoole扩展

~~~~
4.0开始协程风格服务端默认不支持静态文件访问，建议使用nginx来支持静态文件访问，也可使用路由输出文件内容，下面是示例，可参照修改

添加静态文件路由：
Route::get('static/:path', function (string $path) {
    $filename = public_path() . $path;
    return new \think\swoole\response\File($filename);
})->pattern(['path' => '.*\.\w+$']);
访问路由 http://localhost/static/文件路径
~~~~

## 源码安装Php不能解析PHP文件

~~~~
yum 安装 apache 后，必须安装依赖包 httpd-devel ，否则是不存在文件 apxs 的，而 编译 php 时需要 添加apxs依赖（apxs是一个为Apache HTTP服务器编译和安装扩展模块的工具,用于编译一个或多个源程序或目标代码文件为动态共享对象,使之可以用由mod_so提供的LoadModule指令在运行时加载到Apache服务器中。）

15
//首先安装Apache服务器
yum install httpd
yum install httpd-devel

//下载源码包
http://cn2.php.net/distributions/php-7.0.6.tar.gz

tar -zxvf php-7.0.6.tar.gz //解压

//然后执行./configure检测安装环境，过程中遇到依赖不满足，yum install依次解决即可
./configure --prefix=/etc/php7.0.6\ //安装位置
--with-apxs2=/usr/bin/apxs //添加依赖，使编译生成libphp7.so，后面用于Apache关联php

//编译+安装
make&&make install

第二种解决方案
我百度了一下午，根本原因是漏了一个php扩展：mod_php
安装完重启apache就好了。
yum install mod_php

第三种

添加 AddType application/x-httpd-php .php
~~~~

![1675927633696](C:\Users\Administrator\AppData\Roaming\Typora\typora-user-images\1675927633696.png)

## make时错误提示

~~~~
1  make clean
2 修改Makefile中的CFLAGS 添加-std=c99
~~~~



# 网络知识

## 三次握手

~~~~
SYN(synchronous 同步，同时发生)若为1，表示发送端希望双方建立同步处理，也就是要求建立联机。
ACK(acknowledge)若为1，表示这个数据包为响应包。
~~~~







# laravel学习

## 安装指定版本的laravel

````
安装指定版本的laravel
composer create-project --prefer-dist laravel/laravel blog "5.5.*"
````



## 数据库索引长度的问题

````php+HTML
默认情况下，Laravel 使用 utf8mb4 编码。如果你是在版本低于 5.7.7 的 MySQL 或者版本低于 10.2.2 的 MariaDB 上创建索引，那你就需要手动配置数据库迁移的默认字符串长度。 也就是说，你可以通过在 App\Providers\AppServiceProvider 类的 boot 方法中调用 Schema::defaultStringLength 方法来配置默认字符串长度：

public function boot()
{
    Schema::defaultStringLength(191);//或者改为125
}
````

## 组件的使用方法

````
Blade组件标签以字符串x-开头，后跟组件类的名称。
````

## 配置语言包

````
 安装语言包
 composer require caouecs/laravel-lang
````

## laravel 模块化开发

````
README
通过使用模块来管理大型Laravel项目，模块就像一个laravel包非常方便的进行添加或移除。

这个包已经在 HDCMS 中使用。

模块是在 nwidart.com/laravel-modules 和 laravel-permission 组件基础上扩展了一些功能，所以需要先安装这两个组件。

laravel-modules 和 laravel-permission 组件的功能都可以正常使用
laravel-modules安装步骤
 1  根据系统安装相应的版本
 	composer require nwidart/laravel-modules:版本号
 	php artisan vendor:publish --provider="Nwidart\Modules\LaravelModulesServiceProvider"
 2  修改composer.json文件
        {
          "autoload": {
            "psr-4": {
              "App\\": "app/",
              "Modules\\": "Modules/"
            }
          }
        }
  3	运行composer dump-autoload
  4 安装命令php artisan module:make Admin//创建一个模块
  5 php artisan module:make-controller 控制器名称  模块名称  //创建一个控制器
安装组件
composer require houdunwang/laravel-module

php artisan vendor:publish --provider="Nwidart\Modules\LaravelModulesServiceProvider"

php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations"

php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="config"

php artisan vendor:publish --provider="Houdunwang\Module\LaravelServiceProvider"

php artisan migrate
配置 composer.json 设置自动加载目录

{
  "autoload": {
    "psr-4": {
      "App\\": "app/",
      "Modules\\": "Modules/"
    }
  }
}
创建模块
下面的命令是安装 Admin 模块

php artisan hd:module Admin
创建模块会同时执行以下操作：

生成 menus.php 配置文件
生成 permission.php 权限文件
模块配置
新建模块时系统会自动创建配置，一般情况下不需要执行以下命令生成配置文件（除组件添加新配置功能外）

php artisan hd:config Admin
文件说明

config——基础配置，用于配置模块中文描述等信息
permission.php——权限设置
menus.php——后台管理菜单
获取配置

下面是获取 Admin/config/config.php 文件中的name值，支持 . 从深度嵌套的数组中检索值。

\HDModule::config('admin.config.name')
保存配置

function saveConfig(array $data = [], $name = 'config')
$data——配置数据
$name——配置文件
后台菜单
系统会根据模块配置文件 menus.php 生成后台菜单项

当 menus.php 文件不存在时，执行 php artisan hd:config Admin 系统会为模块 Admin 创建菜单。

获取菜单

获取系统可使用的所有菜单，以集合形式返回数据。可用于后台显示菜单列表。

\HDModule::getMenus()
权限管理
首先需要安装 laravel-permission 组件，安装方式在上面已经介绍。

创建权限配置
系统根据 Admin 模块配置文件 permission.php 重新生成权限，执行以下命令会创建权限配置文件。

php artisan hd:permission Admin
不指定模块时生成所有模块的权限表

php artisan hd:permission
文件存在时不会覆盖

生成的配置文件结构如下：

<?php return [
    [
        'group' => '文章管理',
        'permissions' => [
            ['title' => '添加栏目', 'name' => 'Modules\Admin\Http\Controllers\CategoryController@create', 'guard' => 'admin'],
        ],
    ],
];
name 指用于验证时的 权限标识 ，可以使用任何字符定义。如果以 控制器@方法 形式定义的，在使用中间件验证时会比较容易。

获取权限配置
根据 guard 获取权限数据，可用于后台配置设置表单。

\HDModule::getPermissionByGuard('admin');
中间件
laravel-permission 组件提供了中间件功能，但处理不够灵活并对资源控制器支持不好。所以houdunwang/laravel-module 组件提供了中间件的功能扩展，你也可以使用 laravel-permission 中间件的所有功能。

以下都是对 houdunwang/laravel-module扩展中间件的说明，laravel-permission 中间件使用请查看组件手册。

使用中间件路由需要模块 permission.php 配置文件中的权限标识为 控制器@方法形式。

配置

在 app/Http/Kernel.php 文件的 $routeMiddleware 段添加中间件

protected $routeMiddleware = [
	...
	'permission'    => \Houdunwang\Module\Middlewares\PermissionMiddleware::class,
	...
];
站长特权
配置文件 config/hd_module.php 文件中定义站长使用的角色。

'webmaster' => 'webmaster'
在使用中间件验证时，如果不前用户所在角色为站长角色，系统不进行验证直接放行。

普通路由
系统根据控制器方法检查是否存在权限规则，然后自动进行验证。

所以必须正确设置路由配置文件，下面是对编辑文章的权限设置

<?php
#config/permisson.php
return [
    [
        'group'       => '文章管理',
        'permissions' => [
            ['title' => '编辑管理', 'name' => 'Modules\Admin\Http\Controllers\ArticleController@edit', 'guard' => 'admin'],
        ],
    ],
];
下面是编辑文章的路由定义，必须保存 Modules\Admin\Http\Controllers\ArticleController@edit 规则已经在权限配置文件中定义，否则系统不验证。

Route::group([
    'middleware' => ['web', 'auth:admin'],'prefix'     => 'admin','namespace'  => 'Modules\Admin\Http\Controllers'], function () {
	Route::resource('edit_article', 'ArticleController@edit')->middleware("permission:admin");
});
上面的 permission 中间件的 admin 参数是权限 guard。

资源路由
资源路由新增资源由 create 与 store方法完成，更新资源由 edit 与 update 方法完成。权限规则只需要设置 create 与 edit 方法即可，在执行 store 动作时系统会自动使用 create 方法规则，update 动作会使用 create 方法规则，下面是用户管理的资源控制器规则设置:

<?php
#config/permisson.php
return [
    [
        'group'       => '会员管理',
        'permissions' => [
            ['title' => '会员管理', 'name' => 'Modules\Admin\Http\Controllers\UserController@index', 'guard' => 'admin'],
            ['title' => '添加会员', 'name' => 'Modules\Admin\Http\Controllers\UserController@create', 'guard' => 'admin'],
            ['title' => '编辑会员', 'name' => 'Modules\Admin\Http\Controllers\UserController@edit', 'guard' => 'admin'],
            ['title' => '删除会员', 'name' => 'Modules\Admin\Http\Controllers\UserController@destory', 'guard' => 'admin'],
            ['title' => '查看会员', 'name' => 'Modules\Admin\Http\Controllers\UserController@show', 'guard' => 'admin'],
        ],
    ],
];
资源路由中间件的使用

Route::resource('role', 'RoleController')->middleware("permission:admin,resource");
上面的 permission 中间件的 admin 参数是权限 guard，中间件 permission 的第二个参数 resource 表示这是一个资源路由验证。

模块方法
获取模块对象

#$module 模块标识
\HDModule::module($module = null)
获取当前请求使用的模块名

\HDModule::currentModule()
获取模块菜单，参数为模块标识，不传参数时获取当前模块菜单

\HDModule::getMenuByModule('Admin')
验证权限如果用户是站长直接放行

\HDModule::hadPermission()
获取模块列表，参数为不需要返回的模块，不传参数获取所有模块

\HDModule::getModulesLists(['Admin','Article'])
获取模块路径

#$module——模块标识
\HDModule::getModulePath($module = null);
自动化构建
大部分业务由 Controller控制器、Request请求难、Model模型、View视图、Handle处理器构成，很多时间这些工作都是重复的，系统支持通过一行命令生成业务需要的大部功能。

生成工作是根据模型和数据表完成的，所以必须先创建模型在数据库中创建模型表。

创建模型和迁移
执行以下命令系统会为 Article 模块创建 Category模型和对应的数据迁移文件。

php artisan hd:model Category Article
执行自动化构建
首先安装组件

composer require houdunwang/laravel-autocreate
下面是根据 Article 模块的 Category 模型生成业务框架，系统同时会创建模型表单处理器，请查看 https://github.com/houdunwang/laravel-autocreate 学习。

php artisan hd:autocreate Modules/Article/Entities/Category.php 文章
执行以下命令会创建下列文件

创建控制器 Http/Controllers/CategoryController
表单验证请求 Http/Request/CategoryRequest
添加路由规则 routes.php
生成模版视图
必须保存模型与数据表存在，某个文件存在时忽略这个文件继续向下执行



安装laravel-permission执行数据迁移如果报错
Syntax error or access violation: 1071 Specified key was too long; max key length is 1000 bytes")
修改 app->prividers->appserviceprovider.php Schema::defaultStringLength(125);
````

## session相关

````
$request->session()->regenerate();
重新生成Session ID经常用于阻止恶意用户对应用进行session fixation攻击
````

## 表单验证

````
unique:table,column,except,idColumn
````

## 用户认证

````
composer require laravel/jetstream   //安装命令
php artisan jetstream:install livewire
npm install
npm run build
php artisan migrate
````

## laravel中使用array_get()

````
laravel5.7以上启用了array_get(),改用Arr::get
````

## 在blade模板中调用控制器方法

~~~~
app()->make(Modules\Admin\Http\Controllers\AdminController::class)->getMenus()
~~~~

## 给用户分配角色时，需要扩展模型

~~~~
use Spatie\Permission\Traits\HasRoles;
~~~~

## 路由的引入

~~~~
在web.php中 加入
include base_path('routes/admin/route.php');
~~~~

## 无限级分类

~~~~php+html
 public function tree($datas, $pid = 0, $level = 0)
    {
        $newArr = array();
        foreach ($datas as $data) {
            if ($data['pid'] == $pid) {
                $data['level']=$level;
                $child = $this->tree($datas, $data['id'],$level+1);
                if(!empty($child)){
                    $data['children']=$child;
                }
                $newArr[] = $data;
            }
        }
        return $newArr;
    }

~~~~

## laravel中使用vue

~~~~
 1 composer require laravel/ui
 2 php artisan ui vue --auth
 3 npm install
 4 npm run watch
~~~~

## 数据迁移 列的类型

~~~~
increments:创建一个自动递增相当于 UNSIGNED INTEGER的列作为主键
~~~~

## xhr请求携带csrf-token

~~~~
let token = document.head.querySelector('meta[name="csrf-token"]');
        if (token) {
          this.headers['X-CSRF-TOKEN'] = token.content;
        }
~~~~

## 图片缩略图

~~~~
composer require intervention/image
use Intervention\Image\Facades\Image;
 $image = Image::make($dir.'/'.$filename)->resize(178, 178);
 $image->save('uploads/thumb/'.$filename);
~~~~

## 数据库设置外键约束

~~~~
外键要存在，首先必须保证表的引擎是 InnoDB（默认的存储引擎），如果不是 InnoDB 存储引擎，那么外键可以创建成功，但没有约束作用；
外键字段的字段类型（列类型），必须与父表的主键类型完全一致；
每张表中的外键名称不能重复；
增加外键的字段，如果数据已经存在，那么要保证数据与父表中的主键对应。
如果外键约束模式选择SET NULL ，那么字段必须允许为NULL，否则出现Cannot add foreign key constraint。

~~~~

## 获取路由里面参数

~~~~
   $controller=Route::getCurrentRoute()->getAction()['controller'];
   preg_match('%\\\(.*?)\\\%i', $controller, $match);//正则匹配
~~~~

## glob函数

~~~~
Find pathnames matching a pattern
glob(string $pattern, int $flags = 0): array|false
~~~~

## 设置默认模板

~~~~
 在控制器构造函数中添加
 $paths=[public_path('templates/default)];这里是存放模板的路径
 View::setFinder(new FileViewFinder(App::make('files'),$paths));
 这样设置后此控制器就会在以下路径中选择视图文件
 
 
 另外一种方式
 
 $finder=app('view')->getFinder();
 $finder->prependLocation('模板的路径')；
~~~~

## 三元运算符

~~~~
$x?$y:$z  表示“如果$x是true,那么采用$y,否则采用$z”
$x?:$z  这是简写方式：表示 如果$x是true,就采用$x,否则$z
~~~~

## 事件

~~~~
在系统的服务提供者 App\Providers\EventServiceProvider 中提供了一个简单的方式来注册你所有的事件监听者。属性 listen 包含所有的事件 (作为键) 和对应的监听器 (值). 你可以添加任意多系统需要的监听器在这个数组中

可以用 Artisan 命令行 event:list 来显示系统注册的事件和监听器的列表。
~~~~

## 返回验证信息给vue前端

~~~~
在request.php中添加
 public function failedValidation(Validator $validator){
    throw (new HttpResponseException(response()->json([
        'code'=>442,
        'message'=>'已存在',
        'data'=>$validator->errors()->first()
    ],200)));
   }
~~~~



# git 学习

## 只提交修改的文件

~~~~
 只提交修改的文件  git add -u
 添加远程仓库  git remote add 远程仓库名（origin) 远程仓库地址
 删除本地分支  git branch -d 本地分支名
~~~~

## 运算符知识

````
~波浪号运算符
~1.2（>=1.2,<2.0)  ~1.2.3(>=1.2.3,<1.3)
^号（caret）+指定版本：比如ˆ1.2.2，表示安装1.x.x的最新版本（不低于1.2.2），但是不安装2.x.x，也就是说安装时不改变大版本号。
````

# javascript学习

## closest方法

````
用于向上遍历（查找）最近的祖先元素
````

## 立即执行函数

~~~~
(function sum(a,b) {
				console.log(a + b);
			}(2,3));
~~~~

undefinedundefinedundefined<script src="js/require.js" defer async="true" ></script>

# 卡巴斯基杀

````
3SXCM-M9RJM-6985N-PWKP7 输入这个激活码就可以切换到免费版
````

# phostoshop插件

````
磨皮插件 skinfinder
ctrl+alt+2  选择绿色通道中的高光区域
磨皮：
1 复制图层，杂色->蒙尘与划痕
2 选择背景层，复制一层，选中此复制图层，并放置到所有图层的最上方，执行滤镜->其它->高反差保留，注意半径不要太大。图层混合模式改为线性光
3 选择上面的2个图层，ctrl+g编组，添加蒙板，执行图像->应用图像，混合模式选正片叠底
4 选中蒙版，用白色画笔进行涂抹。

````

# tailwindcss

````php+HTML
1 如何在laravel中使用tailwindcss
  在webpack.mix.js中加入 let tailwindcss = require('tailwindcss');
  
  mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
        tailwindcss('./tailwind.config.js')//加入这一行命令
    ]);

````

# 字体

````
{font-family:"Microsoft YaHei",微软雅黑,"Microsoft JhengHei",华文细黑,STHeiti,MingLiu}
````



# log函数

````html
对数函数（logrithmic function ）是以幂为自变量，指数为因变量，底数为常量的函数。

````

$$
a^x=N(a>0,且a!=1),那么数x叫做以a为底N的对数，记作x=log_aN,读作以a为底N的对数，其中a叫做对数的底数，N叫做真数。
$log_aM
∞
$$

# php学习

~~~~
?? 运算符 相当于判断一个变量是否存在，如果存在就赋值前面的，不存在就赋值后面的
$a=$a??1;//结果是1
~~~~

## 函数学习

### ini_get_all

~~~~

~~~~

### trait

~~~~
自PHP5.4.0起，PHP实现了一种代码复用的方法，称为Trait.
~~~~

### parent::__construct

~~~~
在子类里父类的构造函数会不会执行，分两种情况：
1、如子类不定义构造函数 __construct()，则父类的构造函数默认会被继承下来，且会自动执行。
2、如子类定义了构造函数 __construct()，因为构造函数名也是__construct()，所以子类的构造函数实际上是覆盖(override)了父类的构造函数。这时执行的是该子类的构造函数。
这时如果要在子类里执行父类的构造函数，必须执行类似以下语句 parent::__construct()
~~~~

### call_user_func_array

~~~~
call_user_func_array — Call a callback with an array of parameters
~~~~

### php回调函数的几种写法

~~~~
可以用数组
~~~~



# composer学习

~~~~
composer info  //查看已安装的包信息
~~~~

# MYSQL学习

# pjax相关

~~~~
在resources/plugin/pjax目录下创建pajx.js pjax.css
pjax.js

//定义加载区域
$(document).pjax('a','#pjax-container');
//定义pjax有效时间，超过这个时间会整页刷新
$.pjax.defaults.timeout=1200;
//显示加载动画
$(document).on('pjax:click',function(){
    $('#loading').show();
});
//隐藏加载动画
$(document).on('pjax:end',function(){
   $('#loading').hide(); 
});


pjax.css
#loading{
    background-color:rgba(238,238,238,0.6);
    display:none;
    position:absolute;
    left:0;
    top:0;
    right:0;
    z-index:2000;
    bottom:0;
    padding-top:10%;
}
#loading .spinner{
    margin:100px auto;
    width:50px;
    height:60px;
    text-align:center;
    font-size:10px;
}
#loading .spinner>div{
    background-color:rgba(0,0,0,0.2);
    height:100%;
    width:6px;
    display:inline-block;
    -webkit-animation:stretchdelay 1.2s infinite ease-in-out;
    animation:stetchdelay 1.2s infinite ease-in-out;
}
#loading .spinner .rect2{
    -webkit-animation-delay:-1.1s;
    animation-delay:-1.1s;
}
#loading .spinner .rect3{
    -webkit-animation-delay:-1s;
    animation-delay:-1s;
}
#loading .spinner .rect4{
    -webkit-animation-delay:-0.9s;
    animation-delay:-0.9s;
}
#loading .spinner .rect5{
    -webkit-animation-delay:-0.8s;
    animation-delay:-0.8s;
}
@-webkit-keyframes stretchdelay{
    0%,
    40%,
    100%{
        -webkit-transform:scaleY(0.4);
    }
    20%{
        -webkit-transform:scaleY(1);
    }
}


使用方法
主模板引入
<script src="https//cdn.bootcss.com/jquery.pjax/2.0.1/jquery.pjax.min.js">
</script>
<script src="{{asset('plugin/pjax/pjax.js)}}"></script>
<link rel="stylesheet" href="{{asset('plugin/pjax/pjax.css)}}">

定义pjax加载区域
<div class="main-content container-fluid" id="pjax-container">
<div id="loading">
<div class="spinner">
<div class="rect1"></div>
<div class="rect2"></div>
<div class="rect3"></div>
<div class="rect4"></div>
<div class="rect5"></div>
</div>
</div>
<div id="app">
@yield('content')
</div>
</div>

最后安装composer require spatie/laravel-pjax
配置中间件
// app/Http/Kernel.php

...
protected $middleware = [
    ...
    \Spatie\Pjax\Middleware\FilterIfPjax::class,
];
~~~~

# simditor富文本编辑器修改上传图片的地址

~~~~
simditor.js  与 upload.js  是有关联的，当图片上传成功后会把结果传给 simditor.js ，我们只需要把 JSON  对象修改成simditor.js 想要的就可以，主要是修改file_path 参数值

修改upload.js
 success: (function(_this) {
        return function(result) {
           var newResult=JSON.parse("{\"file_path\":\""+result+"\"}");//修改这里
         
          
          _this.trigger('uploadprogress', [file, file.size, file.size]);
          _this.trigger('uploadsuccess', [file, newResult]);
          return $(document).trigger('uploadsuccess', [file, newResult, _this]);
        };
      })(this),
~~~~

# requireJs

## 引入css

~~~~
define([css!xxx/xx.css],function(){
    .....
})
~~~~

# HDJS使用

~~~~
<link>  引入bootstrap.css
<script>
window.hdjs={}
//组件目录必须绝对路径
window.hdjs.base='hdjs'
//上传文件后台地址
window.hdjs.uploader='/uploader.php?
window.hdjs.filesLists='/filesLists.php?'
</script>
<script src="hdjs/require.js"></script>
<script src="hdjs/config.js"></script>
~~~~

## 百度编辑器的使用

~~~~
<textarea id="container" style="height:300px;width:100%;"></textarea>
<script>
require(['hdjs'],functiong(hdjs){
    hdjs.ueditor('container',{has:2,data:'hd'},function(editor){
        console.log('编辑器执行后的回调方法')
    })
})
</script>
~~~~

# VUE3.0 使用elementUI

~~~~
npm install element-plus --save


import { createApp } from 'vue'
import ElementPlus from 'element-plus';//1.引入组件
import 'element-plus/dist/index.css';//2.引入CSS
import App from './App.vue'

createApp(App).use(ElementPlus).mount('#app')
~~~~

## vue  axiso跨域请求

~~~~
//vue.config.js


const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  transpileDependencies: true,
  devServer: {
    host:'localhost',
    port:8083,
    open:true,
    proxy:{
      '/api':{
        target:'http://58.57.152.228:9000',
        changeOrigin:true,
        secure:true,
        pathRewrite:{
          '^/api':''
        }
      },
      
    }
  },
})

方法二：
响应头添加Header允许访问
跨域资源共享（CORS）Cross-Origin Resource Sharing

这个跨域访问的解决方案的安全基础是基于"JavaScript无法控制该HTTP头"

它需要通过目标域返回的HTTP头来授权是否允许跨域访问。

在Controllers文件下新建header.php,在SalesController.php引用就好了 require_once "header.php";

<?php
    // header("Content-type:application/json;charset=utf-8");
    header('Access-Control-Allow-Origin:*');
    header('Access-Control-Allow-Methods:GET,POST,OPTIONS');//跨域访问
 
?>
~~~~

## 新建vue项目  main.js

~~~~
import Vue from 'vue'
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import App from './App.vue'
import axios from 'axios'
// import { use } from 'echarts/core'
// import { CanvasRenderer } from 'echarts/renderers'
// import { PieChart } from 'echarts/charts'
// import {
//   TitleComponent,
//   TooltipComponent,
//   LegendComponent
// } from 'echarts/components'
import VCharts from 'v-charts'
Vue.use(VCharts)
axios.defaults.baseURL='/api';
Vue.prototype.$axios = axios
Vue.config.productionTip = false

Vue.use(ElementUI);

new Vue({
  render: h => h(App),
}).$mount('#app')


//vue3

import { createApp } from 'vue'
import App from './App.vue'
import ElementPlus from 'element-plus';
import 'element-plus/dist/index.css';


import axios from 'axios'

const app=createApp(App);
app.use(ElementPlus).mount('#app');
app.config.globalProperties.$axios=axios;
~~~~



# CSS动画

~~~~
/*  简写   名字   时间   曲线    开始时间   次数    逆向还原    结束状态是否回去*/
animation: move   2s   linear      2s      999   alternate     forwards ;

~~~~



# npm 相关

## npm常见命令及参数

~~~~
npm init [-y]  用来初始化项目，并生产一个package.json文件，该文件用来记录一些基本配置信息。参数Y,其含义是在项目初始化时，采用系统默认的基本配置。如果没有此参数，在npm init命令执行过程中，会有一系列参数让用户即时输入。

npm install 用于安装当前项目的所有依赖。

npm install packagename --save或-S  安装到生产环境依赖中
npm install packagename --save-dev 或-D 安装到开发环境依赖中

npm install packagename --global或-g 全局安装

npm -v  查看此电脑安装的npm版本

npm view packagename version 查看远程仓库正式版本号，不显示历史版本

npm view packagename versions 查看所有版本号

npm list -g --depth 0  查看全局安装过的依赖模块

npm list --depth 0 查看此项目安装的依赖模块

~~~~

# win7 安装nodejs16

~~~~
1、下载Windows 7可用的最后一个版本
Windows 7只支持v12或以下的版本，从 https://nodejs.org/dist/latest-v12.x/ 下载最新的版本的.msi文件，然后安装。

2、下载16版本的.zip文件，注意：必须是zip
从 https://nodejs.org/dist/latest-v16.x/ 下载。

3、解压文件，覆盖到安装目录。
默认的安装目录一般是： C:\Program Files\nodejs\

4、打开命令行，执行：
执行set NODE_SKIP_PLATFORM_CHECK=1，作用是忽略平台审查。

5、查看Node.js版本
node -v
~~~~

# excel VBA拆分表格

~~~~
Sub 将数据拆分多个工作簿()
Dim sht1 As Worksheet '用来存储待拆分的工作表（总表）
Dim sht0 As Worksheet '用来存储新建工作簿的工作表
Dim file$
Dim k%, m%, n%, v% 
Set sht1 = Worksheets(1)
k = WorksheetFunction.CountA(sht1.[a:a]) '待拆分表的已用行数
    For m = 2 To k Step 1: '逐行循环
        file = Dir(ThisWorkbook.Path & "\*.xlsx") '准备遍历文件夹文件
        Do While file <> ""
            If Replace(file, ".xlsx", "") = Cells(m, 1).Value Then '如果xlsx名称与表内的值相同
                v = v + 1 '计算以某个cell值命名的表在当前文件夹的数量
            End If
            file = Dir
        Loop
        If v = 0 Then
            Workbooks.Add.SaveAs ThisWorkbook.Path & "\" & Cells(m, 1).Value & ".xlsx" '如果当前无相关xlsx文件，则新建一个
            Set sht0 = ActiveSheet '新建后的表用sht0
            sht1.Range("a1:e1").Copy sht0.Range("a1:e1") '复制第一行
        Else:
            Workbooks.Open ThisWorkbook.Path & "\" & Cells(m, 1).Value & ".xlsx" '如果已有相关的xlsx文件，则打开
            Set sht0 = ActiveSheet
        End If
        n = WorksheetFunction.CountA(sht0.[a:a]) 'xlsx已使用的行数
        sht1.Range(Cells(m, 1), Cells(m, 1)(1, 5)).Copy sht0.Cells(n + 1, 1) '将原表的行粘贴到新的表
        ActiveWorkbook.Close 1 '保存并关闭新表
        v = 0 '将文件数量设置为0，用于下次循环
    Next m
End Sub

~~~~

# phpstorm

~~~~
全局搜索 ctrl+alt+n
~~~~





