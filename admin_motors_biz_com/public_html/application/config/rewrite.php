<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['pattern']=array();
$config['replace']=array();

$config['pattern'][0]='/products\/index\/(.*)\/(\d+)\/(.*)/isU';
$config['replace'][0]='/category/$1/pid_$2_$3';

$config['pattern'][1]='/clist\/index\/(.*)/isU';
$config['replace'][1]='/category/$1';

//$config['pattern'][2]='/content\/index\/(\d+)\//isU';
$config['pattern'][2]='/content\/index\//isU';
//$config['replace'][2]='/product_$1/';
$config['replace'][2]='/item/';

$config['pattern'][9]='/search\/index\//isU';
$config['replace'][9]='/searcher/';

$config['pattern'][10]='/my_menu\/main\/index\//isU';
$config['replace'][10]='/admin/';
