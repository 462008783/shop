<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>

Yii 2 Advanced Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-advanced.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-advanced)

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
---项目日志---
# 1.项目介绍
## 1.1.项目描述简介
    类似京东商城的B2C商城 (C2C B2B O2O P2P ERP进销存 CRM客户关系管理)，采用git方式
## 1.2.主要功能模块
系统包括：

    后台：
    品牌管理、商品分类管理、商品管理、订单管理、系统管理和会员管理六个功能模块。

    前台：
    首页、商品展示、商品购买、订单管理、在线支付等。
## 1.3.开发环境和技术

开发环境 | Window
---|---
开发工具 | Phpstorm+PHP7.0+GIT+Apache
相关技术 | Yii2.0+CDN+jQuery+sphinx


## 1.4.项目人员组成周期成本
### 1.4.1.人员组成

职位 | 人数
---|---
项目经理和组长 | 1
后台开发人员 | 2-3
UI设计人员 |	0
前端开发人员 |	1
测试人员 |	1	
### 1.4.2.项目周期成本

人数 | 周期| 备注
---|---|---
1 | 两周需求及设计 |	项目经理 
1 | 两周 | UI设计	UI/UE
4（1测试  2后端  1前端）| 3个月 第1周需求设计 4-8周时间完成编码 1-2周时间进行测试和修复 | 开发人员、测试人员
# 2.系统功能模块
## 2.1.需求
品牌管理：

商品分类管理：

商品管理：

账号管理：

权限管理：

菜单管理：

订单管理：

## 2.2.流程
自动登录流程

购物车流程

订单流程

## 2.3.设计要点（数据库和页面交互）
    系统前后台设计：前台www.yiishop.com后台admin.yiishop.com 对url地址美化
    
    商品无限级分类设计：
    
    购物车设计

## 2.4.要点难点及解决方案
    难点在于需要掌握实际工作中，如何分析思考业务功能，如何在已有知识积累的前提下搜索并解决实际问题，抓大放小，融会贯通，尤其要排除畏难情绪。
# Day_01
#  --------------------
# 3.品牌功能模块
## 3.1.需求
    品牌管理功能涉及品牌：
        1.列表展示
        2.品牌添加
        3.品牌修改
        4.品牌删除。
    品牌删除使用逻辑删除。 
    
## 3.2.设计要点（数据库和页面交互）
    品牌管理列表显示使用分页
    列表显示上线优先
    图片采用网络存储，使用七牛云空间

## 3.3.要点难点及解决方案
    1.删除使用逻辑删除
        解决：只改变status属性,不删除记录
    2.图片上传体验效果差
        解决：使用webuploader插件,提升用户体验
    3.使用composer下载和安装webuploader
    4.composer安装插件报错
        解决:composer global require "fxp/composer-asset-plugin:^1.2.0"
    5.使用七牛云存储空间，将文件保存及访问地址更改

# Day_02
#  --------------------
# 4.文章管理模块
## 4.1.需求
    文章的增删改查
    文章分类的增删改查
## 4.2.设计要点

    文章和文章分类使用分页
    文章详情使用富文本
    文章表和文章详情表分离通过模型建立1对1关联

## 要点难点及解决方案
    文本框采用富文本， 
        解决：composer安装插件
    文章名以及文章不能重复，
        解决：添加规则unique
    文章采取垂直分表，
        解决：分为文章模型和文字详情

# Day_03
#  --------------------
        
# 5.分类模块
## 5.1需求
    分类的增删改查；
    界面列表显示要求分类层次
    添加可显示树形结构
## 5.2设计要点
     界面列表使用yii2无限极分类
     添加使用ztree
## 5.3 要点难点及解决方案
    分类添加采用树形结构，
        解决：packagist.org网站下载插件 
        composer require liyuze/yii2-ztree
        
    分类列表显示使用无限极分类，
        解决: packagist.org网站下载插件 
        composer require leandrogehlen/yii2-treegrid
    使用插件一级分类删除问题：
        暂未解决！
# Day_04
#  --------------------
# 6.商品模块
## 6.1需求
    商品列表与品牌，分类建立一对一关系
    商品模块建立多表：商品表，商品详情表，商品图片表
## 6.2设计要点
    列表可进行搜索
    货号可自动生成根据日期和当日第几个商品
    分页功能
## 6.3要点难点及解决方案
    ········
# Day_05
#  --------------------
# 7.管理员模块
# 7.1需求
    管理员登录
    管理员注销
    管理员自动登录
# 7.2设计要点
    管理员登录保存最后时间
    管理员登录保存数字ip

# 7.3要点难点及解决方案
    管理员获取时间和ip
        解决：
        main->
        user->
         'on beforeLogin' => function($event) {
                $user = $event->identity; //这里的就是User Model的实例
                $user->last_login_at = time();
                $user->last_login_ip = Yii::$app->request->userIP;
                $user->save();

            },
    
    
# Day_06
#  --------------------    
# 8.管理员模块完善
## 8.1需求
    管理员自动登录
    管理员登录记住密码
    编辑不修改密码使用原密码
## 8.2设计要点
    编辑完善
    数字化IP地址
## 8.3要点难点及解决方案
    场景使用
        解决：
        模型创建添加场景和编辑场景
        控制器引用场景
    
# Day_07
#  --------------------    
# 9.RBAC
## 9.1需求
    给操作权限
    菜单自动添加
## 9.2设计要点
    权限的添加
    角色添加
    角色给与权限
    用户指定角色
## 9.3要点难点及解决方案
    权限的编辑显示
    用户指定角色时拿不到角色
        解决：
            逻辑解决   
    