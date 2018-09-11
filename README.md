此版本在原作者的基础上，再度加入部分功能。

**二次开发文档**

[http://www.w3cschool.cn/apiadmin_v2/](http://www.w3cschool.cn/apiadmin_v2/)

**源码地址**

原作者GitHub：[https://github.com/Zhao-github/ApiAdmin](https://github.com/Zhao-github/ApiAdmin)



**项目构成**

- ThinkPHP v3.2.3
- LayUI
- semanticUI
- ...

**功能简介**

 1. 接口文档自动生成
 2. 接口输入参数自动检查
 3. 接口输出参数数据类型自动规整
 4. 灵活的参数规则设定
 5. 支持三方Api无缝融合
 6. 本地二次开发友好
 7. 使用Datatables完成数据JS加载
 8. ....
 
 
 **新增功能**
 1、引入composer安装三方类库
 2、添加上传封装类
 3、修复接口部分问题
 4、......
 
 ```
 ApiAdmin（PHP部分）
 ├─ 系统维护
 |  ├─ 菜单管理 - 编辑访客权限，处理菜单父子关系，被权限系统依赖（极为重要）
 |  ├─ 用户管理 - 添加新用户，封号，删号以及给账号分配权限组
 |  ├─ 权限管理 - 权限组管理，给权限组添加权限，将用户提出权限组
 |  └─ 操作日志 - 记录管理员的操作，用于追责，回溯和备案
 |  ...
 ```

