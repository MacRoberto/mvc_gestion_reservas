<?php

include_once 'models/Hotel.php';
include_once 'services/PayPalService.php';

class AjaxController
{
    public function procesar($accion)
    {
        header('Content-Type: application/json; charset=utf-8');

        switch ($accion) {
            case 'buscar-hoteles':
                $this->buscarHoteles();
                break;
            case 'paypal-create-order':
                $this->paypalCreateOrder();
                break;
            case 'paypal-capture-order':
                $this->paypalCaptureOrder();
                break;
            default:
                http_response_code(404);
                echo json_encode(array(
                    'ok' => false,
                    'mensaje' => 'Accion AJAX no valida.'
                ), JSON_UNESCAPED_UNICODE);
                break;
        }
    }

    private function buscarHoteles()
    {
        $termino = isset($_GET['termino']) ? trim($_GET['termino']) : '';
        $hotel = new Hotel();
        $hoteles = $hotel->buscarDisponiblesAjax($termino);

        echo json_encode(array(
            'ok' => true,
            'hoteles' => $hoteles
        ), JSON_UNESCAPED_UNICODE);
    }

    private function paypalCreateOrder()
    {
        try {
            $payload = $this->obtenerJsonRequest();
            $monto = isset($payload['amount']) ? $payload['amount'] : null;

            $payPal = new PayPalService();
            $orden = $payPal->crearOrden($monto);

            echo json_encode(array(
                'ok' => true,
                'id' => $orden['id'] ?? 678654,
                'order' => $orden
            ), JSON_UNESCAPED_UNICODE);
        } catch (RuntimeException $e) {
            http_response_code(422);
            echo json_encode(array(
                'ok' => false,
                'mensaje' => $e->getMessage()
            ), JSON_UNESCAPED_UNICODE);
        }
    }

    private function paypalCaptureOrder()
    {
        try {
            $payload = $this->obtenerJsonRequest();
            $orderId = isset($payload['orderID']) ? $payload['orderID'] : '';

            $payPal = new PayPalService();
            $captura = $payPal->capturarOrden($orderId);

            echo json_encode(array(
                'ok' => true,
                'capture' => $captura
            ), JSON_UNESCAPED_UNICODE);
        } catch (RuntimeException $e) {
            http_response_code(422);
            echo json_encode(array(
                'ok' => false,
                'mensaje' => $e->getMessage()
            ), JSON_UNESCAPED_UNICODE);
        }
    }

    private function obtenerJsonRequest()
    {
        $raw = file_get_contents('php://input');
        if (!$raw) {
            return array();
        }

        $data = json_decode($raw, true);

        return is_array($data) ? $data : array();
    }
}
