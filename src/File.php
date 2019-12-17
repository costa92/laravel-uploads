<?php


namespace LaravelUpload;

class File
{
	/**
	 * @param $path
	 * @param bool $childPath
	 * @return mixed|string
	 */
	public static function getPath($path, $childPath = true)
	{
		// 过滤所有的.符号
		$path = str_replace('.', '', $path);
		// 先去除两边空格
		$path = trim($path, '/');
		// 判断是否需要生成日期子目录
		$path = $childPath ? $path . '/' . date('Ymd') : $path;

		return $path;
	}

	/**
	 * 先创建目录
	 * @param $publicPath
	 */
	public function mkdirPath($publicPath)
	{
		// 如果目录不存在；先创建目录
		is_dir($publicPath) || mkdir($publicPath, 0755, true);
	}
}