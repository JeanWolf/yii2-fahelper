# yii2-fahelper
font-awesome html helper for yii2

including most usages from http://www.fontawesome.io/  Examples

## Usage

composer require jext/yii2-fahelper

add assets bundle in the view file

eg:
```
<?php
use jext\fahelper\FontAwesomeAsset;
use jext\fahelper\JFA;

FontAwesomeAsset::register($this);

$icon = JFA::icon('camera')
//or
$icon = JFA::i('camera')->size('2x')->rotate('90');

echo $icon;
//or
echo $icon->render();

//use stack
echo $icon->stackOn('ban');

//... some other codes

```

**免 composer 使用说明**

由于国内的composer包安装速度很让人着急，这边简单的介绍下怎么在没有composer的环境下使用本库。说简单些就是直接使用源码。

核心源码为 `JFA.php` 中的 JFA类，直接查看源码 复制到自己项目的某个新文件中， 在针对自己的项目目录修改命名空间即可。

发现问题欢迎反馈 :)
