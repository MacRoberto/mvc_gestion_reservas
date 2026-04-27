
<?php 
include 'views/layouts/header_motor.php';
?>
    <link rel="stylesheet" href="assets/css/reserva-consulta.css">
    
    <section>
    <div class="espacio"></div>
    </section>

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
<section>
    <div class="espacio"></div>
</section>
<?php
include 'views/layouts/footer_motor.php';
?>

