<?php

namespace Aliyun\Core\Test\Regions;

use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\Regions\service\LocationService;
use Aliyun\Core\Test\BaseTest;

class EndPointByLocationTest extends BaseTest
{
    /** @var LocationService */
    private $locationService;

    private $clientProfile;

    private function initClient()
    {
        # 创建 DefaultAcsClient 实例并初始化
        $this->clientProfile = DefaultProfile::getProfile(
            "cn-shanghai",                   # 您的 Region ID
            getenv('id'),               # 您的 Access Key ID
            getenv("secret")            # 您的 Access Key Secret
        );

        $this->locationService = new LocationService($this->clientProfile);
    }

    public function testFindProductDomain()
    {
        $this->initClient();
        $domain = $this->locationService->findProductDomain("cn-shanghai", "apigateway", "openAPI", "CloudAPI");
        $this->assertEquals("apigateway.cn-shanghai.aliyuncs.com", $domain);
    }

    public function testFindProductDomainWithAddEndPoint()
    {
        DefaultProfile::addEndpoint("cn-shanghai", "cn-shanghai", "CloudAPI", "apigateway.cn-shanghai123.aliyuncs.com");
        $this->initClient();
        $domain = $this->locationService->findProductDomain("cn-shanghai", "apigateway", "openAPI", "CloudAPI");
        $this->assertEquals("apigateway.cn-shanghai123.aliyuncs.com", $domain);
    }
}
