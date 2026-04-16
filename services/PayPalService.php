<?php

class PayPalService
{
    private $config;
    private $baseUrl;

    public function __construct()
    {
        $this->config = require __DIR__ . '/../config/paypal.php';
        $this->baseUrl = 'https://api-m.sandbox.paypal.com';
    }

    public function obtenerClientId()
    {
        return $this->config['client_id'] ?? '';
    }

    public function obtenerMoneda()
    {
        return $this->config['currency'] ?? 'MXN';
    }

    public function estaConfigurado()
    {
        return !empty($this->config['client_id']) && !empty($this->config['client_secret']);
    }

    public function crearOrden($monto)
    {
        $this->validarConfiguracion();

        $monto = $this->normalizarMonto($monto);
        $payload = array(
            'intent' => 'CAPTURE',
            'purchase_units' => array(
                array(
                    'amount' => array(
                        'currency_code' => $this->obtenerMoneda(),
                        'value' => $monto
                    )
                )
            )
        );

        return $this->request('POST', '/v2/checkout/orders', $payload);
    }

    public function capturarOrden($orderId)
    {
        $this->validarConfiguracion();

        if (trim((string) $orderId) === '') {
            throw new RuntimeException('No se recibio el identificador de la orden PayPal.');
        }

        return $this->request('POST', '/v2/checkout/orders/' . rawurlencode($orderId) . '/capture');
    }

    private function validarConfiguracion()
    {
        if (!$this->estaConfigurado()) {
            throw new RuntimeException('Configura PAYPAL_CLIENT_ID y PAYPAL_CLIENT_SECRET para usar PayPal Sandbox.');
        }
    }

    private function obtenerAccessToken()
    {
        $ch = curl_init($this->baseUrl . '/v1/oauth2/token');

        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => $this->config['client_id'] . ':' . $this->config['client_secret'],
            CURLOPT_SSL_VERIFYPEER => $this->debeVerificarSsl(),
            CURLOPT_SSL_VERIFYHOST => $this->debeVerificarSsl() ? 2 : 0,
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Accept-Language: es_MX'
            )
        ));

        $response = curl_exec($ch);
        $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($response === false || $error) {
            throw new RuntimeException('No se pudo conectar con PayPal: ' . $error);
        }

        $data = json_decode($response, true);
        if ($status < 200 || $status >= 300 || empty($data['access_token'])) {
            throw new RuntimeException('PayPal no devolvio un token valido.');
        }

        return $data['access_token'];
    }

    private function request($method, $path, $payload = null)
    {
        $accessToken = $this->obtenerAccessToken();
        $ch = curl_init($this->baseUrl . $path);

        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $accessToken
        );

        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_SSL_VERIFYPEER => $this->debeVerificarSsl(),
            CURLOPT_SSL_VERIFYHOST => $this->debeVerificarSsl() ? 2 : 0
        );

        if ($payload !== null) {
            $options[CURLOPT_POSTFIELDS] = json_encode($payload, JSON_UNESCAPED_UNICODE);
        }

        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);
        $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($response === false || $error) {
            throw new RuntimeException('No se pudo completar la solicitud a PayPal: ' . $error);
        }

        $data = json_decode($response, true);
        if ($status < 200 || $status >= 300) {
            $mensaje = isset($data['message']) ? $data['message'] : 'Respuesta no valida de PayPal.';
            throw new RuntimeException('PayPal devolvio un error: ' . $mensaje);
        }

        return is_array($data) ? $data : array();
    }

    private function normalizarMonto($monto)
    {
        $monto = is_numeric($monto) ? (float) $monto : 1;

        if ($monto <= 0) {
            $monto = 1;
        }

        return number_format($monto, 2, '.', '');
    }

    private function debeVerificarSsl()
    {
        return isset($this->config['verify_ssl']) ? (bool) $this->config['verify_ssl'] : true;
    }
}
