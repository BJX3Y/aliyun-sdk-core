<?php
/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */

namespace Aliyun\Core\Test;

use Aliyun\Core\Test\Ecs\Request as Ecs;
use Aliyun\Core\Test\BatchCompute\Request as BC;

class DefaultAcsClientTest extends BaseTest
{
    public function testDoActionRPC()
    {
        $request = new Ecs\DescribeRegionsRequest();
        $response = $this->client->doAction($request);
        
        $this->assertNotNull($response->RequestId);
        $this->assertNotNull($response->Regions->Region[0]->LocalName);
        $this->assertNotNull($response->Regions->Region[0]->RegionId);
    }
    
    public function testDoActionROA()
    {
        $request = new BC\ListImagesRequest();
        $response = $this->client->doAction($request);
        $this->assertNotNull($response);
    }
}
