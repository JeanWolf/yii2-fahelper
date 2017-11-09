# yii2-fahelper
font-awesome html helper for yii2

including most usages from http://www.fontawesome.io/   Examples

## Usage

`composer require jext/yii2-fahelper`

add assets bundle in the view file

eg:
```
<?php
use jext\fahelper\FontAwesomeAsset;
use jext\fahelper\JFA;

FontAwesomeAsset::register($this);

$icon = JFA::icon('camera');
//or
$icon = JFA::i('camera')->size('2x')->rotate('90');

echo $icon;
//or
echo $icon->render();

//use stack
echo $icon->stackOn('ban');

//... some other codes

```

**无 composer 安装使用说明**

由于国内的composer包安装速度很让人着急，这边简单的介绍下怎么在没有composer的环境下使用本库。

其实说白了就是直接使用源码。

核心源码为 `JFA.php` 中的 JFA类，直接查看源码 复制到自己项目的某个新文件中， 然后针对自己的项目目录修改命名空间即可。

关于font-awesome的前端文件，很多地方都可以下载到也有文档说明，不明白的可以搜索下。

如发现问题，欢迎反馈 :)
