<?php

namespace LaravelUpload\Tests\OssCloud;

use LaravelUpload\OssCloud\OssFile;
use PHPUnit\Framework\TestCase;

class UploadTest extends TestCase
{
	public function testIndex()
	{
		$oss = new OssFile(
			'LTAIzrCMSwh4gE89',
			'BYJABakSEdvTwus2SYiqCUb3TKq1Dt',
			'file.longqiuhong.com',
			true
		);

		$oss->setBucket("costa-long");
		$oss->file("test.jpg");
	}
}