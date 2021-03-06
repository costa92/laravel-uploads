<?php

namespace Costalong\LaravelUpload;

use Costalong\LaravelUpload\OssCloud\OssFile;

class Upload
{
	/**
	 * @var
	 */
	public static $drive;

	/***
	 * Upload constructor.
	 */
	public function __construct()
	{

	}

	/**
	 * @param $drive
	 */
	public static function setDrive($drive)
	{
		self::$drive = $drive;
		return self::class;
	}

	/**
	 * @return string
	 */
	public static function getDrive()
	{
		return self::$drive ? self::$drive : 'local';
	}

	/**
	 * 上传图片
	 *
	 * @param        $name
	 * @param string $path
	 *
	 * @return array
	 */
	public static function image($name, $path = 'uploads')
	{
		$allowExtension = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
		if (self::getDrive() === 'local') {
			return LocalFile::file($name, $path, $allowExtension);
		} elseif (self::getDrive() === 'oss') {
			return (new OssFile())->file($name, $path, $allowExtension);
		}
	}

	/**
	 * @param $name
	 * @param $filePath
	 * @param $path
	 * @return array
	 * @throws \OSS\Core\OssException
	 */
	public static function uploadFile($name, $filePath, $path)
	{
		if (self::getDrive() === 'oss') {
			return (new OssFile())->uploadFile($name, $filePath, $path);
		}
	}

}