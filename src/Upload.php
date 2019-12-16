<?php

namespace Costalong\LaravelUpload;

class Upload
{
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
		return LocalFile::file($name, $path, $allowExtension);
	}

}