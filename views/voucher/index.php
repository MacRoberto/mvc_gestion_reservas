<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva Confirmada - Hotel Fiesta Americana Grand Coral Beach</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
<style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .voucher-container { max-width: 900px; margin: 30px auto; background: white; padding: 40px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .header-status { color: #198754; font-weight: bold; }
        .detail-label { font-weight: 600; color: #6c757d; text-transform: uppercase; font-size: 0.85rem; }
        .info-box { background-color: #f8f9fa; border-left: 4px solid #0d6efd; padding: 15px; margin-bottom: 20px; }
        .price-breakdown { background-color: #e9ecef; padding: 20px; border-radius: 5px; }
        @media print { .no-print { display: none; } body { background: white; } .voucher-container { box-shadow: none; margin: 0; width: 100%; } }
</style>
</head>

<body>

<div class="container no-print mt-3 text-end">
    <button onclick="window.print()" class="btn btn-primary"><i class="fas fa-print"></i> Imprimir Voucher</button>
</div>

<div class="voucher-container">
    <div class="row align-items-center mb-4">
        <div class="col-md-7">
            <h1 class="h3 mb-1">Hotel Fiesta Americana Grand Coral beach</h1>
            <p class="text-muted mb-0">Cancún, México</p>
        </div>
        <div class="col-md-5 text-md-end">
            <div class="header-status">
                <i class="fas fa-check-circle"></i> Reserva confirmada
            </div>
            <div class="small text-muted">Confirmacion: xxxxxxxxxxx</div>
            <div class="small text-muted">PIN: xxxx</div>
        </div>
    </div>

    <hr>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="info-box">
                <div class="detail-label">Check-in</div>
                <div class="fw-bold">Sabado 18 de abril del 2026</div>
                <div class="small text-muted">15:00 - 20:00</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="info-box" style="border-left-color: #dc3545;">
                <div class="detail-label">Check-out</div>
                <div class="fw-bold">20 de Abril del 2026</div>
                <div class="small text-muted">11:30 - 12:00</div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Nombre del huesped</th>
                        <th>Habitación</th>
                        <th>Capacidad</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Fidel Santiago Rubio</td>
                        <td>2 Habitación estandar (2 doble cama)</td>
                        <td>3 Adults, 1 Child (4 years)</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-7">
            <h5 class="h6 fw-bold">Ubicación & Contacto</h5>
            <p class="mb-1 text-muted">
                <i class="fas fa-map-marker-alt text-danger"></i> 
                25 Avenida Nte. entre 4 y 6 centro, Cancún Quintana Roo, 77520, México
            </p>
            <p class="mb-0 text-muted">
                <i class="fas fa-phone"></i> +52 998 789 1234
            </p>
        </div>
        <div class="col-md-5">
            <div class="price-breakdown">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold">Precio Total:</span>
                    <span class="h4 mb-0 text-primary">US$47.79</span>
                </div>
                <div class="small text-muted mt-2">
                    * Desayuno: US$9 por persona/noche
                </div>
            </div>
        </div>
    </div>

    <div class="card border-warning">
        <div class="card-body">
            <h6 class="card-title fw-bold text-warning-emphasis"><i class="fas fa-exclamation-triangle"></i> Informacion Importante</h6>
            <ul class="small mb-0">
                <li><strong>Cancelación:</strong> No-rembolsable. Los cambios o las ausencias sin previo aviso se cobrarán al precio total. (US$55.44).</li>
                <li><strong>Pago por adelantado:</strong> El importe total podrá cobrarse en cualquier momento.</li>
                <li><strong>Seguridad:</strong>Trate su PIN confidencialmente para evitar cambios no autorizados.</li>
            </ul>
        </div>
    </div>

    <footer class="mt-5 pt-3 border-top text-center text-muted small">
        &copy; <?php echo date("Y"); ?> Hotel Fiesta Americana Grand Coral Beach | Administrado por ExperienciasMay.com
    </footer>
</div>

</body>
</html>