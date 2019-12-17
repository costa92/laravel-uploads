<?php


namespace LaravelUpload;


class VerifyFile
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
}