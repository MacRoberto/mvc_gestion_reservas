<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva Confirmada - Hotel Fiesta Americana Grand Coral Beach</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* General Reset & Base Styles */
        * { box-sizing: border-box; }
        .em-logo {
            height: 80px;
            }

        body { 
            background-color: #f4f7f6; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .voucher-container { 
            max-width: 900px; 
            margin: 30px auto; 
            background: white; 
            padding: 40px; 
            border-radius: 8px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.1); 
        }

        /* Header Layout */
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .hotel-info h1 { margin: 0; font-size: 1.75rem; color: #222; }
        .text-muted { color: #6c757d; font-size: 0.9rem; }
        
        .status-info { text-align: right; }
        .header-status { color: #198754; font-weight: bold; margin-bottom: 5px; }
        .small { font-size: 0.85rem; }

        hr { border: 0; border-top: 1px solid #eee; margin: 20px 0; }

        /* Grid for Check-in/out */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-box { 
            background-color: #f8f9fa; 
            border-left: 4px solid #0d6efd; 
            padding: 15px; 
        }

        .detail-label { 
            font-weight: 600; 
            color: #6c757d; 
            text-transform: uppercase; 
            font-size: 0.75rem; 
            margin-bottom: 5px;
        }

        .fw-bold { font-weight: bold; }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table th, table td {
            border: 1px solid #dee2e6;
            padding: 12px;
            text-align: left;
        }

        table thead { background-color: #f8f9fa; }

        /* Bottom Section Layout */
        .footer-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .price-breakdown { 
            background-color: #e9ecef; 
            padding: 20px; 
            border-radius: 5px; 
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .text-primary { color: #0d6efd; font-size: 1.5rem; }

        /* Warning Card */
        .important-info {
            border: 1px solid #ffc107;
            border-radius: 5px;
            padding: 20px;
        }

        .important-info h6 { 
            color: #856404; 
            margin: 0 0 10px 0; 
            font-size: 1rem; 
        }

        .important-info ul { padding-left: 20px; margin: 0; font-size: 0.85rem; }
        .important-info li { margin-bottom: 5px; }

        footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            text-align: center;
            color: #6c757d;
            font-size: 0.85rem;
        }

        /* Responsive & Print */
        @media (max-width: 768px) {
            .header-section, .info-grid, .footer-grid {
                grid-template-columns: 1fr;
                flex-direction: column;
            }
            .status-info { text-align: left; margin-top: 15px; }
        }

        @media print {
            body { background: white; padding: 0; }
            .voucher-container { box-shadow: none; margin: 0; width: 100%; max-width: none; }
        }
    </style>



</head>

<body>

<div class="voucher-container">
    <div class="header-section">
        <div class="hotel-info">
            <h1>Hotel Fiesta Americana Grand Coral beach</h1>
            <p class="text-muted">Cancún, México</p>
        </div>
        <div class="status-info">
            <img src="assets/img/logo-may.png" alt="ExperienciasMay" class="em-logo">
            <div class="header-status">
                <i class="fas fa-check-circle"></i> Reserva confirmada
            </div>
            <div class="small text-muted">
                Confirmacion:
                <?php
                echo $reservaInfo['folio'] ;
                ?>
                
            </div>
            <div class="small text-muted">PIN: xxxx</div>
        </div>
    </div>

    <hr>

    <div class="info-grid">
        <div class="info-box">
            <div class="detail-label">Check-in</div>
            <div class="fw-bold">
                <?php
                echo $reservaInfo['fecha_entrada_formateada'];
                ?>
                Sabado 18 de abril del 2026
            </div>
            <div class="small text-muted">
                <?php
                echo $reservaInfo['hora_checkin'];
                ?>
            </div>
        </div>
        <div class="info-box" style="border-left-color: #dc3545;">
            <div class="detail-label">Check-out</div>
            <div class="fw-bold">
                <?php
                echo $reservaInfo['fecha_salida_formateada'];
                ?>
            </div>
            <div class="small text-muted">
                <?php
                echo $reservaInfo['hora_checkout'];
                ?>
            </div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nombre del huesped</th>
                <th>Habitación</th>
                <th>Capacidad</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <?php
                    echo $reservaInfo['nombre_cliente'];
                    ?>
                </td>
                <td><!-- 2 Habitación estandar (2 doble cama) -->
                    <?php
                    echo $reservaInfo['habitaciones'].$reservaInfo['tipo_habitacion']." (".$reservaInfo['descripcion_habitacion'].$reservaInfo['cantidad_camas']."cama(s)".")"; 
                    ?>
                </td>
                <td><!--3 Adults, 1 Child (4 years)-->
                    <?php
                    echo $reservaInfo['capacidad_adultos']. " adultos,".$reservaInfo['capacidad_ninos']. " niño(s)"  ;
                    ?>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="footer-grid">
        <div class="contact-info">
            <h5 class="fw-bold" style="margin-top:0;">Ubicación & Contacto</h5>
            <p class="small text-muted" style="margin-bottom: 5px;">
                <i class="fas fa-map-marker-alt" style="color:#dc3545;"></i>
                <?php
                echo $reservaInfo['direccion'];
                ?> 
            </p>
            <p class="small text-muted">
                <i class="fas fa-phone"></i> 
                <?php
                echo $reservaInfo['telefono_hotel'];
                ?>
            </p>
        </div>
        <div class="price-breakdown">
            <div class="price-row">
                <span class="fw-bold">Precio Total:</span>
                <span class="text-primary fw-bold">
                    <?php
                    Echo number_format($reservaInfo['total']) .' '. $reservaInfo['moneda'] ;
                    ?> 
                </span>
            </div>
            <div class="small text-muted" style="margin-top: 10px;">
                <!-- * Desayuno: US$9 por persona/noche -->
            </div>
        </div>
    </div>

    <div class="important-info">
        <h6><i class="fas fa-exclamation-triangle"></i> Informacion Importante</h6>
        <ul>
            <li><strong>Cancelación:</strong> No-rembolsable. Los cambios o las ausencias sin previo aviso se cobrarán al precio total. (US$55.44).</li>
            <li><strong>Pago por adelantado:</strong> El importe total podrá cobrarse en cualquier momento.</li>
            <li><strong>Security:</strong> Trate su PIN confidencialmente para evitar cambios no autorizados.</li>
        </ul>
    </div>

    <footer>
        &copy; <?php echo date("Y"). " ".$reservaInfo['nombre_hotel']. " "; ?> | Administrado por ExperienciasMay.com
    </footer>
</div>

</body>
</html>