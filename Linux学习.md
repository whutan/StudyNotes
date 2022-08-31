#  Linux学习修改



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

## 修改centos7 yum源为阿里源

````
1  备份原理的yum源
cp /etc/yum.repos.d/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo.bak

2 下载阿里云的 yum 源文件并替换本地 yum 源文件
wget -O /etc/yum.repos.d/CentOS-Base.repo http://mirrors.aliyun.com/repo/Centos-7.repo
3 清理缓存
yum clean all
````

## php各版本下载地址

````
通过本镜像使用wget命令下载 http://175.6.32.4:88/php/php-版本号.tar.bz2 源码文件到lnmp安装包 src 目录下，然后直接进行升级。
````

