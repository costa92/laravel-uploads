<?php


namespace Costalong\LaravelUpload\OssCloud;

use Costalong\LaravelUpload\Functions\FileFunction;
use OSS\OssClient;

class OssFile
{

	/**
	 * @param $name
	 * @param string $path
	 * @param array $allowExtension
	 * @param bool $childPath
	 * @return array|string
	 */
	public function file($name, $path = 'uploads', $allowExtension = [], $childPath = true)
	{
		$verify = FileFunction::hasFile($name);
		if ($verify) {
			return $verify;
		}
		$file = request()->file($name);
		// 判断是否多文件上传
		if (!is_array($file)) {
			$file = [$file];
		}
		$path = FileFunction::getPath($path, $childPath);

		$oss = new OssAdapter();
		// 上传成功的文件
		$success = [];
		// 循环上传
		foreach ($file as $k => $v) {
			$isValid = FileFunction::isValid($v);
			if ($isValid) {
				return $isValid;
			}
			// 获取上传的文件名
			$oldName = $v->getClientOriginalName();
			// 获取文件后缀
			$extension = strtolower($v->getClientOriginalExtension());
			$isAllowExtension = FileFunction::isUploadExtension($extension, $allowExtension, $oldName);
			if ($isAllowExtension) {
				return $extension;
			}
			// 临时目录
			$tmpPath = '/tmp/upload';
			FileFunction::mkdirPath($tmpPath);
			// 组合新的文件名
			$newName = uniqid() . '.' . $extension;
			$v->move($tmpPath, $newName);
			$filePatch = $tmpPath . '/' . $newName;
			$ossFilePath = $path . '/' . $newName;
			$success[] = $oss->file($oldName, $filePatch, $ossFilePath);
		}

		$data = [
			'status_code' => 200,
			'message' => '上传成功',
			'data' => $success
		];
		return $data;
	}
}