<?php
include 'views/layouts/header_motor.php';

$fechaBase = new DateTimeImmutable('today');
$checkinDefault = $fechaBase->modify('+1 day')->format('Y-m-d');
$checkoutDefault = $fechaBase->modify('+2 day')->format('Y-m-d');
$rangoFechasDefault = $fechaBase->modify('+1 day')->format('d M Y')
    . ' - '
    . $fechaBase->modify('+2 day')->format('d M Y');

$destinoBusqueda = isset($destinoBusqueda) ? $destinoBusqueda : '';
$checkin = isset($checkin) ? $checkin : $checkinDefault;
$checkout = isset($checkout) ? $checkout : $checkoutDefault;
$huespedes = isset($huespedes) ? $huespedes : '1 adulto, 1 habitacion';
$rangoFechas = isset($rangoFechas) ? $rangoFechas : $rangoFechasDefault;
$noches = isset($noches) ? (int) $noches : 1;
$habitacionesResultados = isset($habitacionesResultados) && is_array($habitacionesResultados) ? $habitacionesResultados : array();
$totalResultados = count($habitacionesResultados);
?>

<main class="search-results-page room-results-page py-4 py-lg-4">
    <div class="container-fluid px-2 px-lg-3">
        <div class="row g-3 align-items-start">
            <div class="col-xl-3 col-lg-4">
                <aside class="search-filter-card room-results-sidebar">
                    <h1 class="room-results-sidebar-title">Modificar búsqueda</h1>

                    <form action="motor_busqueda.php" method="GET">
                        <input type="hidden" name="accion" value="paso2">

                        <div class="search-filter-field pt-0">
                            <label class="search-filter-label" for="hotel-search-input-results">Destino, hotel, punto de interés.</label>
                            <div class="search-filter-value-wrap hotel-search-field">
                                <i class="fa-solid fa-location-dot"></i>
                                <input
                                    required
                                    type="text"
                                    id="hotel-search-input-results"
                                    data-hotel-search-input
                                    name="destino"
                                    class="search-filter-input"
                                    placeholder="Destino, hotel, punto de interés."
                                    autocomplete="off"
                                    value="<?php echo htmlspecialchars($destinoBusqueda, ENT_QUOTES, 'UTF-8'); ?>">
                                <div data-hotel-search-results class="ajax-search-results d-none"></div>
                            </div>
                        </div>

                        <div class="search-filter-field">
                            <span class="search-filter-label">Fechas</span>
                            <div class="search-filter-value-wrap search-filter-date-wrap">
                                <i class="fa-solid fa-calendar-days"></i>
                                <div class="search-filter-date-picker" data-date-picker>
                                    <button type="button" class="search-filter-date-trigger" data-date-trigger aria-expanded="false">
                                        <span class="search-filter-date-display" data-date-display><?php echo htmlspecialchars($rangoFechas, ENT_QUOTES, 'UTF-8'); ?></span>
                                    </button>
                                    <input required type="hidden" name="checkin" value="<?php echo htmlspecialchars($checkin, ENT_QUOTES, 'UTF-8'); ?>" data-checkin-input>
                                    <input type="hidden" name="checkout" value="<?php echo htmlspecialchars($checkout, ENT_QUOTES, 'UTF-8'); ?>" data-checkout-input>
                                    <div class="search-filter-calendar-popover d-none" data-date-popover>
                                        <div class="search-filter-calendar-header">
                                            <button type="button" class="search-filter-calendar-nav" data-calendar-nav="prev" aria-label="Mes anterior">
                                                <i class="fa-solid fa-chevron-left"></i>
                                            </button>
                                            <button type="button" class="search-filter-calendar-nav" data-calendar-nav="next" aria-label="Mes siguiente">
                                                <i class="fa-solid fa-chevron-right"></i>
                                            </button>
                                        </div>
                                        <div class="search-filter-calendar-months" data-calendar-months></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="search-filter-field">
                            <span class="search-filter-label">Huéspedes</span>
                            <div class="search-filter-value-wrap">
                                <i class="fa-solid fa-user-group"></i>
                                <div class="search-guest-picker" data-guest-picker>
                                    <button type="button" class="search-guest-trigger" data-guest-trigger aria-expanded="false">
                                        <span class="search-guest-display" data-guest-display><?php echo htmlspecialchars($huespedes, ENT_QUOTES, 'UTF-8'); ?></span>
                                    </button>
                                    <input required type="hidden" name="huespedes" value="<?php echo htmlspecialchars($huespedes, ENT_QUOTES, 'UTF-8'); ?>" data-guest-input>
                                    <div class="search-guest-popover d-none" data-guest-popover>
                                        <div class="search-guest-row" data-guest-key="adultos">
                                            <div>
                                                <span class="search-guest-title">Adultos</span>
                                                <span class="search-guest-subtitle">Edad 18 o más</span>
                                            </div>
                                            <div class="search-guest-counter">
                                                <button type="button" class="search-guest-counter-btn" data-guest-action="minus" aria-label="Quitar adultos">-</button>
                                                <span class="search-guest-counter-value" data-guest-value>1</span>
                                                <button type="button" class="search-guest-counter-btn" data-guest-action="plus" aria-label="Agregar adultos">+</button>
                                            </div>
                                        </div>
                                        <div class="search-guest-row" data-guest-key="menores">
                                            <div>
                                                <span class="search-guest-title">Niños</span>
                                                <span class="search-guest-subtitle">Edad 0 a 17</span>
                                            </div>
                                            <div class="search-guest-counter">
                                                <button type="button" class="search-guest-counter-btn" data-guest-action="minus" aria-label="Quitar niños">-</button>
                                                <span class="search-guest-counter-value" data-guest-value>0</span>
                                                <button type="button" class="search-guest-counter-btn" data-guest-action="plus" aria-label="Agregar niños">+</button>
                                            </div>
                                        </div>
                                        <div class="search-guest-row" data-guest-key="habitaciones">
                                            <div>
                                                <span class="search-guest-title">Habitaciones</span>
                                                <span class="search-guest-subtitle">Selecciona cuántas necesitas</span>
                                            </div>
                                            <div class="search-guest-counter">
                                                <button type="button" class="search-guest-counter-btn" data-guest-action="minus" aria-label="Quitar habitaciones">-</button>
                                                <span class="search-guest-counter-value" data-guest-value>1</span>
                                                <button type="button" class="search-guest-counter-btn" data-guest-action="plus" aria-label="Agregar habitaciones">+</button>
                                            </div>
                                        </div>
                                        <div class="search-guest-actions">
                                            <button type="button" class="search-guest-cancel" data-guest-cancel>Cancelar</button>
                                            <button type="button" class="search-guest-apply" data-guest-apply>Aplicar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn room-results-search-btn w-100">Buscar</button>
                    </form>
                </aside>
            </div>

            <div class="col-xl-9 col-lg-8">
                <?php if (empty($habitacionesResultados)): ?>
                    <div class="alert alert-light border text-center mb-0">
                        No se encontraron habitaciones disponibles para la búsqueda actual.
                    </div>
                <?php else: ?>
                    <div class="room-results-list">
                        <?php foreach ($habitacionesResultados as $habitacion): ?>
                            <?php
                            $nombreHabitacion = isset($habitacion['tipo_habitacion']) ? $habitacion['tipo_habitacion'] : 'Habitación disponible';
                            $nombreHotel = isset($habitacion['hotel_nombre']) ? $habitacion['hotel_nombre'] : 'Hotel disponible';
                            $ciudadHotel = isset($habitacion['hotel_ciudad']) ? $habitacion['hotel_ciudad'] : '';
                            $imagenPrincipal = !empty($habitacion['imagen_principal']) ? $habitacion['imagen_principal'] : 'https://via.placeholder.com/540x340?text=Habitacion';
                            $descripcion = isset($habitacion['descripcion']) ? $habitacion['descripcion'] : '';
                            $capacidadAdultos = isset($habitacion['capacidad_adultos']) ? (int) $habitacion['capacidad_adultos'] : 0;
                            $capacidadNinos = isset($habitacion['capacidad_ninos']) ? (int) $habitacion['capacidad_ninos'] : 0;
                            $cantidadCamas = isset($habitacion['cantidad_camas']) ? (int) $habitacion['cantidad_camas'] : 0;
                            $precioNoche = isset($habitacion['precio_noche']) ? (float) $habitacion['precio_noche'] : 0;
                            $impuestos = isset($habitacion['impuestos']) ? (float) $habitacion['impuestos'] : 0;
                            $total = isset($habitacion['total']) ? (float) $habitacion['total'] : 0;
                            $moneda = isset($habitacion['moneda']) ? $habitacion['moneda'] : 'MXN';
                            ?>
                            <article class="room-result-card">
                                <div class="room-result-media">
                                    <img src="<?php echo htmlspecialchars($imagenPrincipal, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($nombreHabitacion, ENT_QUOTES, 'UTF-8'); ?>">
                                </div>

                                <div class="room-result-content">
                                    <div class="room-result-main">
                                        <h2 class="room-result-title"><?php echo htmlspecialchars($nombreHabitacion, ENT_QUOTES, 'UTF-8'); ?></h2>
                                        <p class="room-result-hotel mb-1"><?php echo htmlspecialchars($nombreHotel, ENT_QUOTES, 'UTF-8'); ?></p>
                                        <?php if ($ciudadHotel !== ''): ?>
                                            <p class="room-result-location"><?php echo htmlspecialchars($ciudadHotel, ENT_QUOTES, 'UTF-8'); ?></p>
                                        <?php endif; ?>

                                        <div class="room-result-stars">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>

                                        <ul class="room-result-features">
                                            <li>Hasta <?php echo $capacidadAdultos; ?> adultos<?php echo $capacidadNinos > 0 ? ' y ' . $capacidadNinos . ' niños' : ''; ?></li>
                                            <li><?php echo $cantidadCamas > 0 ? $cantidadCamas . ' cama' . ($cantidadCamas === 1 ? '' : 's') : 'Configuración de camas disponible'; ?></li>
                                            <li>Cancelación sujeta a políticas del hotel</li>
                                        </ul>

                                        <?php if ($descripcion !== ''): ?>
                                            <p class="room-result-description"><?php echo htmlspecialchars($descripcion, ENT_QUOTES, 'UTF-8'); ?></p>
                                        <?php endif; ?>

                                        <div class="room-result-score">
                                            <span class="room-result-score-badge">7/10</span>
                                            <span>Buena opción para tu viaje</span>
                                        </div>
                                    </div>

                                    <div class="room-result-price">
                                        <p class="room-result-price-label">Habitación por noche</p>
                                        <p class="room-result-price-value">
                                            $ <?php echo number_format($precioNoche, 0); ?>
                                            <span><?php echo htmlspecialchars($moneda, ENT_QUOTES, 'UTF-8'); ?></span>
                                        </p>
                                        <p class="room-result-tax">+ $ <?php echo number_format($impuestos, 0); ?> de impuestos</p>
                                        <p class="room-result-total">Total $ <?php echo number_format($total, 0); ?> <?php echo htmlspecialchars($moneda, ENT_QUOTES, 'UTF-8'); ?></p>
                                        <p class="room-result-total-note"><?php echo $noches; ?> noche<?php echo $noches === 1 ? '' : 's'; ?></p>

                                        <a
                                            href="motor_busqueda.php?accion=formulario&hotel_id=<?php echo urlencode((string) (isset($habitacion['hotel_id']) ? $habitacion['hotel_id'] : 0)); ?>&habitacion_id=<?php echo urlencode((string) (isset($habitacion['id']) ? $habitacion['id'] : 0)); ?>&destino=<?php echo urlencode($destinoBusqueda); ?>&checkin=<?php echo urlencode($checkin); ?>&checkout=<?php echo urlencode($checkout); ?>&huespedes=<?php echo urlencode($huespedes); ?>"
                                            class="btn room-result-cta">
                                            Ver habitación
                                        </a>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php
include 'views/layouts/footer_motor.php';
?>
