<?php


namespace Costalong\LaravelUpload\OssCloud;


class OssConfig
{
	public function __construct()
	{
	}

	/**
	 * 获取配置文件
	 * @return mixed
	 */
	public static function getConfig()
	{
		return config('filesystems.disks.oss');
	}
}