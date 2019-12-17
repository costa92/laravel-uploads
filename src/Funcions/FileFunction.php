<?php


namespace Costalong\LaravelUpload\Functions;

class FileFunction
{
	public static function hasFile($name)
	{
		// 判断请求中是否包含name=file的上传文件
		if (!request()->hasFile($name)) {
			$data = [
				'status_code' => 401,
				'message' => '上传文件为空'
			];
			return $data;
		}
	}

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
	public static function mkdirPath($publicPath)
	{
		// 如果目录不存在；先创建目录
		is_dir($publicPath) || mkdir($publicPath, 0755, true);
	}

	/**
	 * 获得一个临时文件
	 *
	 * @return string
	 */
	public static function getTmpFile()
	{
		$tmpfname       = tempnam("/tmp", "dir");
		chmod($tmpfname, 0777);
		return $tmpfname;
	}

	/**
	 * 删除一个临时文件
	 * @param $file_name
	 * @return bool
	 */
	public static function deleteTmpFile($filename)
	{
		return unlink($filename);
	}
}