<?php

namespace Costalong\LaravelUpload\Tests\OssCloud;

use Costalong\LaravelUpload\OssCloud\OssAdapter;
use PHPUnit\Framework\TestCase;

class UploadTest extends TestCase
{
	public function testIndex()
	{
		$config = [
			'access_id' => 'LTAIzrCMSwh4gE89',
			'access_key' => 'BYJABakSEdvTwus2SYiqCUb3TKq1Dt',
			'bucket' => 'costa-long',
			'endpoint' => 'file.longqiuhong.com',
		];
		$oss = new OssAdapter($config);
		$filePath = "/Users/costalong/Desktop/default.jpg";
		$rs = $oss->file('test', $filePath,'uploads/test.jpg');
	}
}