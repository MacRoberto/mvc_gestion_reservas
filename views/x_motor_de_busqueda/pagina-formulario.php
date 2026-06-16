<?php
include 'views/layouts/header_motor.php';

$fechaBase = new DateTimeImmutable('today');
$checkin = isset($checkin) ? $checkin : $fechaBase->modify('+1 day')->format('Y-m-d');
$checkout = isset($checkout) ? $checkout : $fechaBase->modify('+2 day')->format('Y-m-d');
$huespedes = isset($huespedes) ? $huespedes : '1 adulto, 1 habitacion';
$noches = isset($noches) ? (int) $noches : 1;
$hotelSeleccionado = isset($hotelSeleccionado) && is_array($hotelSeleccionado) ? $hotelSeleccionado : null;
$habitacionSeleccionada = isset($habitacionSeleccionada) && is_array($habitacionSeleccionada) ? $habitacionSeleccionada : null;

$hotelNombre = $hotelSeleccionado && isset($hotelSeleccionado['nombre']) ? $hotelSeleccionado['nombre'] : 'Hotel seleccionado';
$hotelCiudad = $hotelSeleccionado && isset($hotelSeleccionado['ciudad']) ? $hotelSeleccionado['ciudad'] : '';
$horaCheckin = $hotelSeleccionado && !empty($hotelSeleccionado['hora_checkin']) ? substr((string) $hotelSeleccionado['hora_checkin'], 0, 5) : '15:00';
$horaCheckout = $hotelSeleccionado && !empty($hotelSeleccionado['hora_checkout']) ? substr((string) $hotelSeleccionado['hora_checkout'], 0, 5) : '12:00';
$tipoHabitacion = $habitacionSeleccionada && isset($habitacionSeleccionada['tipo_habitacion']) ? $habitacionSeleccionada['tipo_habitacion'] : 'Habitacion seleccionada';
$habitacionDescripcion = $habitacionSeleccionada && isset($habitacionSeleccionada['descripcion']) ? $habitacionSeleccionada['descripcion'] : '';
$monedaHabitacion = $habitacionSeleccionada && isset($habitacionSeleccionada['moneda']) ? $habitacionSeleccionada['moneda'] : 'MXN';
$precioNoche = $habitacionSeleccionada && isset($habitacionSeleccionada['precio_noche']) ? (float) $habitacionSeleccionada['precio_noche'] : 0;
$impuestosHabitacion = $habitacionSeleccionada && isset($habitacionSeleccionada['impuestos']) ? (float) $habitacionSeleccionada['impuestos'] : 0;
$totalHabitacion = $habitacionSeleccionada && isset($habitacionSeleccionada['total']) ? (float) $habitacionSeleccionada['total'] : 0;
$capacidadAdultos = $habitacionSeleccionada && isset($habitacionSeleccionada['capacidad_adultos']) ? (int) $habitacionSeleccionada['capacidad_adultos'] : 0;
$capacidadNinos = $habitacionSeleccionada && isset($habitacionSeleccionada['capacidad_ninos']) ? (int) $habitacionSeleccionada['capacidad_ninos'] : 0;
$cantidadCamas = $habitacionSeleccionada && isset($habitacionSeleccionada['cantidad_camas']) ? (int) $habitacionSeleccionada['cantidad_camas'] : 0;
$formatearFechaLargaEsp = function ($fecha, $fallback) {
    $timestamp = strtotime($fecha);
    if (!$timestamp) {
        return $fallback;
    }

    $dias = array(
        'Mon' => 'Lun',
        'Tue' => 'Mar',
        'Wed' => 'Mie',
        'Thu' => 'Jue',
        'Fri' => 'Vie',
        'Sat' => 'Sab',
        'Sun' => 'Dom'
    );
    $meses = array(
        'Jan' => 'ene',
        'Feb' => 'feb',
        'Mar' => 'mar',
        'Apr' => 'abr',
        'May' => 'may',
        'Jun' => 'jun',
        'Jul' => 'jul',
        'Aug' => 'ago',
        'Sep' => 'sep',
        'Oct' => 'oct',
        'Nov' => 'nov',
        'Dec' => 'dic'
    );

    return $dias[date('D', $timestamp)] . ' ' . date('d', $timestamp) . ' ' . $meses[date('M', $timestamp)] . ' ' . date('Y', $timestamp);
};
$fechaEntradaLabel = $formatearFechaLargaEsp($checkin, $checkin);
$fechaSalidaLabel = $formatearFechaLargaEsp($checkout, $checkout);
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
                <form action="motor_busqueda.php?accion=guardar" method="POST">
                <input type="hidden" name="hotel_id" value="<?php echo htmlspecialchars((string) ($hotelSeleccionado['id'] ?? 0), ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="habitacion_id" value="<?php echo htmlspecialchars((string) ($habitacionSeleccionada['id'] ?? 0), ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="checkin" value="<?php echo htmlspecialchars($checkin, ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="checkout" value="<?php echo htmlspecialchars($checkout, ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="huespedes" value="<?php echo htmlspecialchars($huespedes, ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="noches" value="<?php echo $noches; ?>">
                <input type="hidden" name="capacidad_adultos" value="<?php echo $capacidadAdultos; ?>">
                <input type="hidden" name="ninos" value="<?php echo $capacidadNinos; ?>">
                <input type="hidden" name="precio_noche" value="<?php echo $precioNoche; ?>">
                <input type="hidden" name="total" value="<?php echo $totalHabitacion; ?>">
                <input type="hidden" name="subtotal" value="<?php echo ($precioNoche * $noches); ?>">
                
                
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
                                <input type="text" id="telefono" name="telefono" class="form-control checkout-input border-start-0" placeholder="998 653 5632" required>
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
                            <span>1 habitacion, <?php echo $noches; ?> noche<?php echo $noches === 1 ? '' : 's'; ?></span>
                            <strong>$ <?php echo number_format($precioNoche * $noches, 0); ?> <?php echo htmlspecialchars($monedaHabitacion, ENT_QUOTES, 'UTF-8'); ?></strong>
                        </div>
                        <div class="checkout-summary-row">
                            <span>Impuestos</span>
                            <strong>$ <?php echo number_format($impuestosHabitacion, 0); ?> <?php echo htmlspecialchars($monedaHabitacion, ENT_QUOTES, 'UTF-8'); ?></strong>
                        </div>
                        <div class="checkout-summary-total">
                            <span>Total</span>
                            <strong>$ <?php echo number_format($totalHabitacion, 0); ?> <?php echo htmlspecialchars($monedaHabitacion, ENT_QUOTES, 'UTF-8'); ?></strong>
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
                                        <h3 class="checkout-hotel-name"><?php echo htmlspecialchars($hotelNombre, ENT_QUOTES, 'UTF-8'); ?></h3>
                                        <p class="checkout-location mb-2"><?php echo htmlspecialchars($hotelCiudad, ENT_QUOTES, 'UTF-8'); ?></p>
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
                                                <div class="checkout-detail-value"><?php echo htmlspecialchars($fechaEntradaLabel, ENT_QUOTES, 'UTF-8'); ?> <?php echo htmlspecialchars($horaCheckin, ENT_QUOTES, 'UTF-8'); ?></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="checkout-detail-label">Salida</div>
                                                <div class="checkout-detail-value"><?php echo htmlspecialchars($fechaSalidaLabel, ENT_QUOTES, 'UTF-8'); ?> <?php echo htmlspecialchars($horaCheckout, ENT_QUOTES, 'UTF-8'); ?></div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="checkout-detail-label">Duracion de la estancia</div>
                                            <div class="checkout-detail-value"><?php echo $noches; ?> noche<?php echo $noches === 1 ? '' : 's'; ?></div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="checkout-detail-label">Seleccionaste</div>
                                            <div class="checkout-detail-value"><?php echo htmlspecialchars($huespedes, ENT_QUOTES, 'UTF-8'); ?></div>
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
                                            <p class="mb-1"><strong>1x</strong> <?php echo htmlspecialchars($tipoHabitacion, ENT_QUOTES, 'UTF-8'); ?></p>
                                            <?php if ($habitacionDescripcion !== ''): ?>
                                            <p class="mb-1"><?php echo htmlspecialchars($habitacionDescripcion, ENT_QUOTES, 'UTF-8'); ?></p>
                                            <?php endif; ?>
                                            <p class="mb-1">Hasta <?php echo $capacidadAdultos; ?> adultos<?php echo $capacidadNinos > 0 ? ' y ' . $capacidadNinos . ' niños' : ''; ?></p>
                                            <p class="mb-0"><?php echo $cantidadCamas > 0 ? $cantidadCamas . ' cama' . ($cantidadCamas === 1 ? '' : 's') : 'Configuracion de camas disponible'; ?></p>
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
