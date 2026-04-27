<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require_once __DIR__ . '/../vendor/autoload.php';

class VoucherMailer
{
    private $config;

    public function __construct()
    {
        $this->config = require __DIR__ . '/../config/mail.php';
    }

    public function enviarVoucherReserva($reserva)
    {
        if (empty($reserva['email_cliente'])) {
            throw new RuntimeException('La reserva no tiene correo del cliente.');
        }

        $mailer = new PHPMailer(true);
        $logoSrc = 'assets/img/logo-may.png';

        try {
            if (($this->config['mailer'] ?? 'mail') === 'smtp') {
                if (empty($this->config['host'])) {
                    throw new RuntimeException('Configura MAIL_HOST para poder enviar vouchers por SMTP.');
                }

                $mailer->isSMTP();
                $mailer->Host = $this->config['host'];
                $mailer->Port = (int) $this->config['port'];
                $mailer->SMTPAuth = !empty($this->config['username']);
                $mailer->Username = $this->config['username'];
                $mailer->Password = $this->config['password'];
                $mailer->Timeout = 20;
                $mailer->SMTPAutoTLS = true;

                if (!empty($this->config['encryption'])) {
                    $mailer->SMTPSecure = $this->config['encryption'];
                }
            } else {
                $mailer->isMail();
            }

            $mailer->CharSet = 'UTF-8';
            $mailer->setFrom($this->config['from_email'], $this->config['from_name']);
            $mailer->addAddress(trim($reserva['email_cliente']), trim(($reserva['nombre_cliente'] ?? '') . ' ' . ($reserva['apellidos'] ?? '')));

            $logoPath = realpath(__DIR__ . '/../assets/img/logo-may.png');
            if ($logoPath && is_file($logoPath)) {
                $mailer->addEmbeddedImage($logoPath, 'logo_experiencias_may');
                $logoSrc = 'cid:logo_experiencias_may';
            }

            $mailer->isHTML(true);
            $mailer->Subject = 'Voucher de reserva ' . ($reserva['folio'] ?? '');
            $mailer->Body = $this->renderizarVoucherHtml($reserva, $logoSrc);
            $mailer->AltBody = $this->renderizarVoucherTexto($reserva);

            return $mailer->send();
        } catch (Exception $e) {
            throw new RuntimeException('No se pudo enviar el voucher: ' . $mailer->ErrorInfo);
        } catch (RuntimeException $e) {
            throw $e;
        }
    }

    private function renderizarVoucherHtml($reserva, $logoSrc = 'assets/img/logo-may.png')
    {
        ob_start();
        $reservaInfo = $reserva;
        $reservaInfo['logo_src'] = $logoSrc;
        include __DIR__ . '/../views/voucher/index.php';

        return ob_get_clean();
    }

    private function renderizarVoucherTexto($reserva)
    {
        $lineas = array(
            'Voucher de reserva',
            'Folio: ' . ($reserva['folio'] ?? ''),
            'Cliente: ' . trim(($reserva['nombre_cliente'] ?? '') . ' ' . ($reserva['apellidos'] ?? '')),
            'Hotel: ' . ($reserva['nombre_hotel'] ?? ''),
            'Habitacion: ' . ($reserva['tipo_habitacion'] ?? ''),
            'Entrada: ' . ($reserva['fecha_entrada'] ?? ''),
            'Salida: ' . ($reserva['fecha_salida'] ?? ''),
            'Noches: ' . ($reserva['noches'] ?? ''),
            'Total: ' . ($reserva['total'] ?? ''),
            'Estado: ' . ($reserva['estado_reserva'] ?? '')
        );

        return implode(PHP_EOL, $lineas);
    }
}
