#  Linux学习



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



# apache options +followsymlinks

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
    Schema::defaultStringLength(191);
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
 	compser require laravel-modules:版本号
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
  4 安装命令php artisan module:make Admin
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
````



# git 学习

## 只提交修改的文件

~~~~
 只提交修改的文件
 git add -u
~~~~

## 运算符知识

````
~波浪号运算符
~1.2（>=1.2,<2.0)  ~1.2.3(>=1.2.3,<1.3)
````

# javascript学习

## closest方法

````
用于向上遍历（查找）最近的祖先元素
````

