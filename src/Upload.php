<?php

namespace LaravelUpload;

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
		}
	}

}