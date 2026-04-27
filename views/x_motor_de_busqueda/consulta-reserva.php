<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CR Book System - Consulta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar { background-color: #007bff; }
        .card-shadow { box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark mb-5">
        <div class="container">
            <span class="navbar-brand mb-0 h1">CR Book System</span>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 card-shadow border-0">
                    <h5 class="mb-4 text-muted">Mi Reserva</h5>
                    
                    <form action="ver_reserva.php" method="POST">
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text">✔</span>
                                <input type="text" name="reserva_id" class="form-control" placeholder="Número de Reservación: XXX-000" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text">✉</span>
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">VER MI RESERVA</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>