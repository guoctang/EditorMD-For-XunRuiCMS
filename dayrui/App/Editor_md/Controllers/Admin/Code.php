<?php namespace Phpcmf\Controllers\Admin;

class Code extends \Phpcmf\Common
{

	public function index() {

	    $name = 'hello word';

        // 将变量传入模板
        \Phpcmf\Service::V()->assign([
            'testname' => $name,
        ]);
        // 选择输出模板 后台位于 ./Views/code.html 此文件需要手动创建
        \Phpcmf\Service::V()->display('code.html');
    }

}
