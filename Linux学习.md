#  Linux学习修改



## firewall防火墙详解

````
 停止firewall
 systemctl stop firewalld.service
 
 禁止firewall开机启动
 systemctl disable firewalld.service
 
 重启防火墙
 firewall-cmd --reload
 
 永久添加端口
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