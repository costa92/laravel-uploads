<?php

namespace Costalong\LaravelUpload\Tests\OssCloud;

use Costalong\LaravelUpload\OssCloud\OssAdapter;
use PHPUnit\Framework\TestCase;

class UploadTest extends TestCase
{
	public function testIndex()
	{
		$config = [

		];
		$oss = new OssAdapter($config);
		$filePath = "/Users/costalong/Desktop/default.jpg";
		$rs = $oss->file('test', $filePath,'uploads/test.jpg');
	}
}