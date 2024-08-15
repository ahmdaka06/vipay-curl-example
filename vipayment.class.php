<?php

// VIPayment Class
class VIPayment {
    
    // Endpoint API
    public string $end_point = 'https://vip-reseller.co.id/api';

    // API ID
    protected string $api_id;
    // API Key
    protected string $api_key;
    // Signature
    protected string $signature;

    /**
     * Constructor
     * @param string $api_id
     * @param string $api_key
     */
    public function __construct(
        string $api_id, 
        string $api_key
    ) {
        $this->api_id = $api_id;
        $this->api_key = $api_key;
        $this->signature = md5($api_id . $api_key);
    }

    /**
     * Profile
     * 
     * @return array
     * 
     * @example profile()
     */
    public function profile(): array
    {
        $end_point = $this->end_point . '/profile';

        $params = [
            'key' => $this->api_key,
            'sign' => $this->signature
        ];

        $request = $this->connect($end_point, $params);

        $response = json_decode($request, true);

        if (isset($response['result']) && $response['result'] == false) {
            return [
                'status' => false,
                'message' => $response['message']
            ];
        }

        return [
            'status' => true,
            'data' => $response['data'],
            'message' => $response['message']
        ];
    }

    /**
     * Order Prepaid
     * @param string $service_code service code
     * @param string $data_no target number
     * 
     * @return array
     * 
     * @example order_prepaid('PLN5', '3335211111133')
     * @example order_prepaid('PULSA5', '081234567890')
     */
    public function order_prepaid(
        string $service_code,
        string $data_no
    ): array 
    {
        $end_point = $this->end_point . '/prepaid';

        $params = [
            'key' => $this->api_key,
            'sign' => $this->signature,
            'type' => 'order',
            'service' => $service_code,
            'data_no' => $data_no
        ];

        $request = $this->connect($end_point, $params);

        $response = json_decode($request, true);

        if (isset($response['result']) && $response['result'] == false) {
            return [
                'status' => false,
                'message' => $response['message']
            ];
        }

        return [
            'status' => true,
            'data' => $response['data'],
            'message' => $response['message']
        ];
    }

    /**
     * Status Order Prepaid
     * @param string $trxid transaction id
     * @param null|int $limit (optional)
     * 
     * @return array
     * 
     * @example status_order_prepaid('1234567890', 1)
     * @example status_order_prepaid('1234567890')
     */
    public function status_order_prepaid(
        string $trxid,
        ?int $limit = null
    ): array 
    {
        $end_point = $this->end_point . '/prepaid';

        $params = [
            'key' => $this->api_key,
            'sign' => $this->signature,
            'type' => 'status',
            'trxid' => $trxid,
            'limit'=> $limit
        ];

        $request = $this->connect($end_point, $params);

        $response = json_decode($request, true);

        if (isset($response['result']) && $response['result'] == false) {
            return [
                'status' => false,
                'message' => $response['message']
            ];
        }

        return [
            'status' => true,
            'data' => $response['data'],
            'message' => $response['message']
        ];
    }

    /**
     * Service Prepaid
     * @param string $filter_type (optional | type, brand)
     * @param null|string $filter_value (optional | pulsa-reguler, telkomsel)
     * 
     * @return array
     * 
     * @example service_prepaid('type', 'pulsa-reguler')
     * @example service_prepaid('brand', 'telkomsel')
     */
    public function service_prepaid(
        ?string $filter_type = null,
        ?string $filter_value = null
    ): array
    {
        $end_point = $this->end_point . '/prepaid';

        $params = [
            'key'=> $this->api_key,
            'sign'=> $this->signature,
            'type'=> 'services',
            'filter_type'=> $filter_type,
            'filter_value'=> $filter_value
        ];

        $request = $this->connect($end_point, $params);

        $response = json_decode($request, true);

        if (isset($response['result']) && $response['result'] == false) {
            return [
                'status'=> false,
                'message'=> $response['message']
            ];
        }

        return [
            'status'=> true,
            'data'=> $response['data'],
            'message'=> $response['message']
        ];
    }

    /**
     * Order Game & Streaming
     * @param string $service service code
     * @param string $data_no target number
     * @param null|string $data_zone (optional)
     * 
     * @return array
     * 
     * @example order_game('GARENA', '1234567890', 'ID')
     * @example order_game('STEAM', '1234567890')
     */
    public function order_game(
        string $service,
        string $data_no,
        ?string $data_zone = null
    ): array 
    {
        $end_point = $this->end_point . '/game-feature';

        $params = [
            'key'=> $this->api_key,
            'sign'=> $this->signature,
            'type'=> 'order',
            'service'=> $service,
            'data_no'=> $data_no,
            'data_zone'=> $data_zone
        ];

        $request = $this->connect($end_point, $params);

        $response = json_decode($request, true);

        if (isset($response['result']) && $response['result'] == false) {
            return [
                'status'=> false,
                'message'=> $response['message']
            ];
        }

        return [
            'status'=> true,
            'data'=> $response['data'],
            'message'=> $response['message']
        ];
    }

    /**
     * Status Order Game & Streaming
     * @param string $trxid
     * @param null|int $limit (optional)
     * 
     * @return array
     * 
     * @example status_order_game('1234567890', 1)
     * @example status_order_game('1234567890')
     */

    public function status_order_game(
        string $trxid,
        ?int $limit = null
    ): array
    {
        $end_point = $this->end_point . '/game-feature';

        $params = [
            'key'=> $this->api_key,
            'sign'=> $this->signature,
            'type'=> 'status',
            'trxid'=> $trxid,
            'limit'=> $limit
        ];

        $request = $this->connect($end_point, $params);

        $response = json_decode($request, true);

        if (isset($response['result']) && $response['result'] == false) {
            return [
                'status'=> false,
                'message'=> $response['message']
            ];
        }

        return [
            'status'=> true,
            'data'=> $response['data'],
            'message'=> $response['message']
        ];
    }

    /**
     * Service Game & Streaming
     * @param string $filter_type (optional | type, brand)
     * @param null|string $filter_value (optional | game, streaming)
     * @param null|string $filter_status (optional | available / empty)
     * 
     * @return array
     * 
     * @example service_game('type', 'game')
     * @example service_game('brand', 'streaming')
     * @example service_game('brand', 'streaming', 'available')
     */

    public function service_game(
        ?string $filter_type = null,
        ?string $filter_value = null,
        ?string $filter_status = null
    ): array
    {
        $end_point = $this->end_point . '/game-feature';

        $params = [
            'key'=> $this->api_key,
            'sign'=> $this->signature,
            'type'=> 'services',
            'filter_type'=> $filter_type,
            'filter_value'=> $filter_value,
            'filter_status'=> $filter_status
        ];

        $request = $this->connect($end_point, $params);

        $response = json_decode($request, true);

        if (isset($response['result']) && $response['result'] == false) {
            return [
                'status'=> false,
                'message'=> $response['message']
            ];
        }

        return [
            'status'=> true,
            'data'=> $response['data'],
            'message'=> $response['message']
        ];
    }

    /**
     * Connect
     * @param string $endpoint
     * @param array $params
     * 
     * @return string|bool
     */
    private function connect(
        string $endpoint, 
        array $params
    ): string | bool 
    {
        $_post = [];
        if (is_array($params)) {
            foreach ($params as $name => $value) {
                $_post[] = $name . '=' . urlencode($value);
            }
        }

        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        if (is_array($params)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, join('&', $_post));
        }
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        $response = curl_exec($ch);
        if (curl_errno($ch) != 0 && empty($response)) {
            $response = false;
        }
        curl_close($ch);
        return $response;
    }

}