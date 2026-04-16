<?php
include 'views/layouts/header_motor.php';
?>

<main class="checkout-form-page py-4 py-lg-5">
    <div class="container-fluid px-3 px-lg-4">
        <div class="checkout-steps mb-4">
            <div class="checkout-step-item active">
                <span class="checkout-step-dot">1</span>
                <span class="checkout-step-label">Informacion del viajero</span>
            </div>
            <div class="checkout-step-line"></div>
            <div class="checkout-step-item">
                <span class="checkout-step-dot muted">2</span>
                <span class="checkout-step-label text-muted">Metodo de pago</span>
            </div>
        </div>

        <div class="row g-4 align-items-start">
            <div class="col-xl-8 order-2 order-xl-1">
                <form action="motor_busqueda.php?accion=pago" method="POST">
                <section class="checkout-card p-4 p-lg-5">
                    <div class="checkout-login-banner mb-4">
                        <div class="checkout-login-icon">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <p class="mb-0">
                            <a href="#" class="checkout-login-link">Inicia sesion</a>
                            <span> o crea una cuenta para agilizar tu reserva y gestionar tus viajes.</span>
                        </p>
                    </div>

                    <div class="mb-4">
                        <h1 class="checkout-title mb-2">Quien hara el check-in?</h1>
                        <p class="checkout-subtitle mb-0">Debera presentar una identificacion oficial al llegar al alojamiento.</p>
                    </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nombres" class="form-label checkout-label">Nombres</label>
                                <input type="text" id="nombres" name="nombres" class="form-control checkout-input" required>
                            </div>
                            <div class="col-md-6">
                                <label for="apellidos" class="form-label checkout-label">Apellidos</label>
                                <input type="text" id="apellidos" name="apellidos" class="form-control checkout-input" required>
                            </div>
                            <div class="col-md-6">
                                <label for="correo" class="form-label checkout-label">Correo electronico</label>
                                <input type="email" id="correo" name="correo" class="form-control checkout-input" placeholder="tucorreo@ejemplo.com" required>
                            </div>
                            <div class="col-md-6">
                                <label for="telefono" class="form-label checkout-label">Telefono</label>
                                <div class="input-group checkout-phone-group">
                                    <span class="input-group-text checkout-phone-prefix">
                                        <span class="checkout-country-chip me-2">MX</span>
                                        <span>+ 55</span>
                                    </span>
                                    <input type="text" id="telefono" name="telefono" class="form-control checkout-input border-start-0" placeholder="6530 5632" required>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-2">
                            <button class="checkout-section-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#specialRequests" aria-expanded="true" aria-controls="specialRequests">
                                <span>Solicitudes especiales (opcional)</span>
                                <i class="fa-solid fa-chevron-up"></i>
                            </button>
                            <p class="checkout-subtitle mt-2 mb-3">Enviaremos tus solicitudes al hotel; sin embargo, estan sujetas a disponibilidad y posibles cargos adicionales.</p>

                            <div class="collapse show" id="specialRequests">
                                <textarea name="solicitudes_especiales" class="form-control checkout-textarea" rows="5" placeholder="Escribe si necesitas algo en especial para tu estancia (ej. cunas, camas extra, etc)"></textarea>
                                <div class="checkout-counter text-end mt-1">0 / 200</div>
                            </div>
                        </div>
                </section>

                <section class="checkout-card checkout-continue-card p-4 p-lg-4 mt-4">
                    <p class="checkout-continue-copy mb-3">
                        Al hacer clic en el boton "Continuar", acepto las
                        <a href="#">politicas de reservacion</a> y nuestro
                        <a href="#">aviso de privacidad</a>.
                    </p>

                    <button type="submit" class="btn checkout-continue-btn w-100">
                        <span>Continuar</span>
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>

                    <div class="checkout-payment-note">
                        <i class="fa-solid fa-credit-card"></i>
                        <span>hasta 18 meses sin intereses</span>
                    </div>
                </section>
                </form>
            </div>

            <div class="col-xl-4 order-1 order-xl-2">
                <aside class="checkout-sidebar">
                    <section class="checkout-card checkout-summary-card p-4 mb-4">
                        <h2 class="checkout-side-title mb-3">Resumen de pago</h2>
                        <div class="checkout-summary-row">
                            <span>1 habitacion, 2 noches</span>
                            <strong>$ 13,825 MXN</strong>
                        </div>
                        <div class="checkout-summary-row">
                            <span>Impuestos</span>
                            <strong>$ 2,903 MXN</strong>
                        </div>
                        <div class="checkout-summary-total">
                            <span>Total</span>
                            <strong>$ 16,728 MXN</strong>
                        </div>
                    </section>

                    <section class="checkout-card p-4">
                        <h2 class="checkout-side-title mb-4">Detalles de la reservacion</h2>

                        <div class="accordion checkout-accordion" id="checkoutReservationAccordion">
                            <div class="accordion-item checkout-accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button checkout-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#hotelReservationCollapse" aria-expanded="true" aria-controls="hotelReservationCollapse">
                                        <span class="d-flex align-items-center gap-2">
                                            <i class="fa-solid fa-building"></i>
                                            <span>Hotel</span>
                                        </span>
                                    </button>
                                </h2>
                                <div id="hotelReservationCollapse" class="accordion-collapse collapse show" data-bs-parent="#checkoutReservationAccordion">
                                    <div class="accordion-body pt-2">
                                        <h3 class="checkout-hotel-name">Moon Palace Cancun</h3>
                                        <p class="checkout-location mb-2">Cancun, Mexico</p>
                                        <div class="checkout-stars mb-4">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>

                                        <div class="row g-3 mb-3">
                                            <div class="col-sm-6">
                                                <div class="checkout-detail-label">Llegada</div>
                                                <div class="checkout-detail-value">Mie 13 May. 2026 15:00</div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="checkout-detail-label">Salida</div>
                                                <div class="checkout-detail-value">Vie 15 May. 2026 12:00 (medio dia)</div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="checkout-detail-label">Duracion de la estancia</div>
                                            <div class="checkout-detail-value">2 noches</div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="checkout-detail-label">Seleccionaste</div>
                                            <div class="checkout-detail-value">1 habitacion, 2 adultos</div>
                                        </div>

                                        <button
                                            type="button"
                                            class="checkout-room-toggle d-inline-flex align-items-center gap-2"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#checkoutRoomDetails"
                                            aria-expanded="true"
                                            aria-controls="checkoutRoomDetails">
                                            <span>Ocultar detalles de habitacion</span>
                                            <i class="fa-solid fa-chevron-up"></i>
                                        </button>

                                        <div class="collapse show" id="checkoutRoomDetails">
                                            <div class="checkout-room-box mt-4">
                                            <p class="mb-1"><strong>1x</strong> Superior de Lujo Vista al Jardin - No Reembolsable</p>
                                            <p class="mb-1">Todo incluido</p>
                                            <p class="mb-0">No Reembolsable</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </aside>
            </div>
        </div>

        <section class="checkout-page-footer mt-4 mt-lg-5">
            <div class="checkout-page-footer-line"></div>

            <div class="checkout-page-footer-grid">
                <div class="checkout-page-footer-item">
                    <p class="mb-3">Aceptamos todas las tarjetas.</p>
                    <div class="checkout-card-brands">
                        <span class="checkout-brand-pill">MC</span>
                        <span class="checkout-brand-pill">VISA</span>
                        <span class="checkout-brand-pill">AMEX</span>
                    </div>
                </div>

                <div class="checkout-page-footer-item">
                    <p class="mb-3">Compra 100% segura.</p>
                    <div class="checkout-security-badge">PCI</div>
                </div>

                <div class="checkout-page-footer-item">
                    <p class="mb-3">Mejor precio garantizado!</p>
                    <div class="checkout-security-icon">
                        <i class="fa-regular fa-circle-check"></i>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var roomToggle = document.querySelector('.checkout-room-toggle');
    var roomDetails = document.getElementById('checkoutRoomDetails');

    if (!roomToggle || !roomDetails) {
        return;
    }

    var roomToggleText = roomToggle.querySelector('span');

    function updateRoomToggleLabel() {
        var expanded = roomDetails.classList.contains('show');
        roomToggleText.textContent = expanded ? 'Ocultar detalles de habitacion' : 'Mostrar detalles de habitacion';
    }

    roomDetails.addEventListener('shown.bs.collapse', updateRoomToggleLabel);
    roomDetails.addEventListener('hidden.bs.collapse', updateRoomToggleLabel);
    updateRoomToggleLabel();
});
</script>

<?php
include 'views/layouts/footer_motor.php';
?>
