<?php


namespace Costalong\LaravelUpload\OssCloud;

use Costalong\LaravelUpload\Functions\FileFunction;
use OSS\OssClient;

class OssFile
{

	/**
	 * @var
	 */
	protected static $ossClient;

	/**
	 * @var
	 */
	protected static $accessKeyId;

	/**
	 * @var
	 */
	protected static $accessKeySecret;
	/**
	 * @var
	 */
	protected static $endpoint;
	/**
	 * @var
	 */
	protected static $isCName;

	/**
	 * @var
	 */
	protected static $bucket;


	/**
	 * OssFile constructor.
	 */
	public function __construct($accessKeyId = '', $accessKeySecret = '', $endpoint = '', $isCName = '')
	{
		$config = $this->getConfig();
		self::$accessKeyId = $accessKeyId ? $accessKeyId : $config['access_id'];
		self::$accessKeySecret = $accessKeySecret ? $accessKeySecret : $config['access_key'];
		self::$endpoint = $accessKeySecret ? $accessKeySecret : $config['endpoint'];
		self::$isCName = $config['endpoint'] ? true : false;
		self::$bucket = $config['bucket'];
	}

	/**
	 * @return \Illuminate\Config\Repository|mixed
	 */
	protected function getConfig()
	{
		return config('filesystems.disks.oss');
	}

	/**
	 * @param $bucket
	 */
	public function setBucket($bucket)
	{
		self::$bucket = $bucket;
	}

	/**
	 * @return \Illuminate\Config\Repository|mixed
	 */
	public function getBucket()
	{
		return self::$bucket ? self::$bucket : config('filesystems.oss.bucket');
	}

	/**
	 * @throws \OSS\Core\OssException
	 */
	public function connOss()
	{
		return self::$ossClient = new OssClient(self::$accessKeyId, self::$accessKeySecret, self::$endpoint, self::$isCName);
	}


	/**
	 * 上传文件
	 *
	 * @param        $name            form 表单中的 name
	 * @param string $path 文件保存的目录 相对于 /public 目录
	 * @param array $allowExtension 允许上传的文件后缀
	 * @param bool $childPath 是否按日期创建目录
	 *
	 * @return array
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

		$ossClient = $this->connOss();
		$file = '/Users/costalong/Desktop/test.jpg';
		$ossClient->uploadFile(self::getBucket(), $name, $file);
	}
}