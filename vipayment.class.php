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
     * @param string $service service code
     * @param string $data_no target number
     * 
     * @return array
     * 
     * @example order_prepaid('PLN5', '3335211111133')
     * @example order_prepaid('PULSA5', '081234567890')
     */
    public function order_prepaid(
        string $service,
        string $data_no
    ): array 
    {
        $end_point = $this->end_point . '/prepaid';

        $params = [
            'key' => $this->api_key,
            'sign' => $this->signature,
            'type' => 'order',
            'service' => $service,
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
     * Status Prepaid
     * @param string $trxid
     * @param int $limit (optional)
     * 
     * @return array
     * 
     * @example status_prepaid('1234567890', 1)
     * @example status_prepaid('1234567890')
     */
    public function status_prepaid(
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
     * @param string $filter_value (optional | pulsa-reguler, telkomsel)
     * 
     * @return array
     * 
     * @example service_prepaid('type', 'pulsa-reguler')
     * @example service_prepaid('brand', 'telkomsel')
     */
    public function service_prepaid(
        ?string $filter_type,
        ?string $filter_value
    ): array
    {
        $end_point = $this->end_point . '/prepaid';

        $params = [
            'key'=> $this->api_key,
            'type'=> 'services'
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