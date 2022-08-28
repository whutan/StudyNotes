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

