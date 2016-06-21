<?php

namespace RedPacket;

use RedPacket\Core\RPException;
use RedPacket\Http\RequestCore;
use RedPacket\Http\ResponseCore;
use RedPacket\Result\ApiResult;

class RPClient
{
    const SERVICE = "redpacket-sdk-php";
    const RP_VERSION = "1.0";
    const BASE_URL = "http://121.42.52.69:3005";

    /* 
TODO(Zhijie Deng): 调用相关 REST API
1. 获得红包 ID：http.post('/api/hongbao/generate-id')
2. 获得红包配置：http.get('/api/hongbao/settings')
3. 用户填写红包金额、祝福语、收件人，选择支付方式
4. 若用户使用零钱支付，填写支付密码
5. 若用户使用京东支付，调用京东支付相关 API，获得成功的流水号
6. 获得红包 ID：http.post('/api/hongbao/generate-id')
7. 将红包ID、金额、祝福语、收件人、支付相关参数 提交：http.post('/api/hongbao/send', data)
8. 提交后，会获得红包 ID，将红包 ID 通过 IM 等方式发给收件人
     */

    function __construct($uid, $gid)
    {
        $uid = trim($uid);
        $gid = trim($gid);

        if (empty($uid)) {
            throw new RPException("uid is empty");
        }
        if (empty($gid)) {
            throw new RPException("gid is empty");
        }
        $this->uid = $uid;
        $this->gid = $gid;
    }

    public function getRedPacketId()
    {
        $options['method'] = 'GET';
        $options['object'] = '/api/hongbao/generate-id';
        $options['data'] = '/';
        $response = $this->auth($options);
        return new ApiResult($response);
    }

    private function auth($options)
    {
        $requestUrl = self::BASE_URL . $options['object'];
        $request = new RequestCore($requestUrl);
        $request->timeout = 0;
        $request->connect_timeout = 0;
        $request->set_useragent($this->generateUserAgent());
        $request->set_method($options['method']);
        $request->add_header('Content-Type', 'application/x-www-form-urlencoded');
        try {
            $request->send_request();
        } catch (RequestCore_Exception $e) {
            throw(new RPException('RequestCoreException: ' . $e->getMessage()));
        }
        $response_header = $request->get_response_header();
        $response_header['request-url'] = $requestUrl;
        $response_header['request-headers'] = $request->request_headers;
        $data = new ResponseCore($response_header, $request->get_response_body(), $request->get_response_code());
        return $data;
    }

    function hello()
    {
        return 'hello';
    }

    /**
     * 用来检查sdk所以来的扩展是否打开
     *
     * @throws RPException
     */
    public static function checkEnv()
    {
        if (function_exists('get_loaded_extensions')) {
            //检测curl扩展
            $enabled_extension = array("curl");
            $extensions = get_loaded_extensions();
            if ($extensions) {
                foreach ($enabled_extension as $item) {
                    if (!in_array($item, $extensions)) {
                        throw new RPException("Extension {" . $item . "} is not installed or not enabled, please check your php env.");
                    }
                }
            } else {
                throw new RPException("function get_loaded_extensions not found.");
            }
        } else {
            throw new RPException('Function get_loaded_extensions has been disabled, please check php config.');
        }
    }

    /**
     * 生成请求用的 UserAgent
     *
     * @return string
     */
    private function generateUserAgent()
    {
        return self::SERVICE . "/" . self::RP_VERSION . " (" . php_uname('s') . "/" . php_uname('r') . "/" . php_uname('m') . ";" . PHP_VERSION . ")";
    }


}
