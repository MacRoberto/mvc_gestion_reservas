<?php

include_once 'models/Hotel.php';
include_once 'models/Pago.php';
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
            case 'procesar-pago':
                $this->procesarPago();
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

    private function procesarPago()
    {
        try {
            $payload = $this->obtenerJsonRequest();
            $reservaID = isset($payload['reserva_id']) ? (int) $payload['reserva_id'] : 0;
            $metodoPago = isset($payload['metodo_pago']) ? trim((string) $payload['metodo_pago']) : '';
            $monto = isset($payload['monto']) ? (float) $payload['monto'] : 0;
            $moneda = isset($payload['moneda']) ? trim((string) $payload['moneda']) : 'MXN';
            $referencia = isset($payload['referencia']) ? trim((string) $payload['referencia']) : '';
            $estado = isset($payload['estado']) ? trim((string) $payload['estado']) : 'pendiente';
            $esSimulado = isset($payload['es_simulado']) ? (int) $payload['es_simulado'] : 0;
            $fechaPago = isset($payload['fecha_pago']) && trim((string) $payload['fecha_pago']) !== ''
                ? trim((string) $payload['fecha_pago'])
                : date('Y-m-d H:i:s');
            $respuestaPasarela = isset($payload['respuesta_pasarela']) ? $payload['respuesta_pasarela'] : '';

            if ($reservaID <= 0 || $metodoPago === '') {
                throw new RuntimeException('Los datos del pago son invalidos.');
            }

            if (is_array($respuestaPasarela)) {
                $respuestaPasarela = json_encode($respuestaPasarela, JSON_UNESCAPED_UNICODE);
            }

            $pago = new Pago();
            $guardado = $pago->guardar(
                $reservaID,
                $metodoPago,
                $monto,
                $moneda,
                $referencia,
                $estado,
                $esSimulado,
                $fechaPago,
                (string) $respuestaPasarela
            );

            if (!$guardado) {
                throw new RuntimeException('No se pudo guardar el historial de pago.');
            }

            echo json_encode(array(
                'ok' => true,
                'reserva_id' => $reservaID,
                'estado' => $estado
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
