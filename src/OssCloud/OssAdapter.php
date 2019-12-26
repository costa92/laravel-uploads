<?php


namespace Costalong\LaravelUpload\OssCloud;


use Costalong\LaravelUpload\Adapters\FileAdapter;
use Costalong\LaravelUpload\Functions\FileFunction;
use OSS\OssClient;

class OssAdapter extends FileAdapter
{

	/**
	 * @var array|mixed
	 */
	protected $config;
	/**
	 * @var
	 */
	protected $bucket;

	/**
	 * OssAdapter constructor.
	 * @param $config
	 */
	public function __construct($config = [])
	{
		$this->config = $config ? $config : OssConfig::getConfig();
		$this->bucket = $this->config['bucket'];
	}

	/**
	 *
	 * @return OssClient
	 * @throws \OSS\Core\OssException
	 */
	protected function connOss()
	{
		$isCName = $this->config['endpoint'] ? true : false;
		return new OssClient(
			$this->config['access_id'],
			$this->config['access_key'],
			$this->config['endpoint'],
			$isCName
		);

	}

	/**
	 * @param $bucket
	 * @return $this
	 */
	public function setBucket($bucket)
	{
		$this->bucket = $bucket;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getBucket()
	{
		return $this->bucket;
	}

	/**
	 * @param $name
	 * @param $ossPath
	 * @param string $filePath
	 * @return array
	 * @throws \Exception
	 */
	public function file($name, $ossPath, $filePath = "uploads/default.jpg")
	{
		try {
			$filePath = trim($filePath, '/');  // 去掉前面的斜杆
			$rs = $this->connOss()->uploadFile($this->getBucket(), $filePath, $ossPath);
			// 删除本地文件
			unlink($ossPath);
			return [
				'name' => $name,
				'path' => $rs['oss-request-url']
			];
		} catch (\Exception $e) {
			throw new \Exception("oss upload file fail:" . $e->getMessage());
		}
	}

	/**
	 * @param $name
	 * @param $copyName
	 * @return |null
	 * @throws \OSS\Core\OssException
	 */
	public function copy($name, $copyName)
	{
		return $this->connOss()->copyObject($this->getBucket(), $name, $this->getBucket(), $copyName);
	}
}