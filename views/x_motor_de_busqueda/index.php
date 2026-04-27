<?php
include 'views/layouts/header_motor.php';
?>

<section class="hero-banner">
        <div class="container h-100 d-flex align-items-center">
            <div class="promo-content">
                <!-- 
                <div class="mb-2" style="max-width: 200px;">
                    <img src="logo de promocion" class="img-fluid" alt=" ">
                </div> 
                -->
                <p class="mb-0 h4">Hasta</p>
                <div class="discount-text">67%</div>
                <p class="h4">de descuento</p>
                <button class="btn btn-light rounded-pill px-4 mt-3 fw-bold text-primary">¡Reserva ahora!</button>
            </div>
        </div>
    </section>

    <div class="container search-container">
        <form class="search-card" action="motor_busqueda.php" method="GET">
            <input type="hidden" name="accion" value="paso2">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="search-input-group d-flex align-items-center">
                        <i class="fa-solid fa-location-dot me-3 text-secondary"></i>
                        <div class="w-100 hotel-search-field">
                            <span class="label-xs">Destino, hotel, punto de interés.</span>
                            <input required 
                                type="text"
                                id="hotel-search-input"
                                data-hotel-search-input
                                name="destino"
                                class="form-control border-0 p-0 shadow-none"
                                placeholder="Destino, hotel, punto de interés."
                                autocomplete="off">
                            <div id="hotel-search-results" data-hotel-search-results class="ajax-search-results d-none"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="search-input-group d-flex align-items-center">
                        <i class="fa-solid fa-calendar-days me-3 text-secondary"></i>
                        <div class="w-100 search-home-date-picker" data-date-picker-main>
                            <span class="label-xs">Fechas</span>
                            <button type="button" class="search-home-date-trigger" data-date-trigger aria-expanded="false">
                                <span class="search-home-date-display" data-date-display>15 abr 2026 - 19 abr 2026</span>
                            </button>
                            <input required type="hidden" name="checkin" value="2026-04-15" data-checkin-input>
                            <input type="hidden" name="checkout" value="2026-04-19" data-checkout-input>
                            <div class="search-filter-calendar-popover search-home-calendar-popover d-none" data-date-popover>
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
                <div class="col-md-3">
                    <div class="search-input-group d-flex align-items-center">
                        <i class="fa-solid fa-user-group me-3 text-secondary"></i>
                        <div class="w-100 search-guest-picker" data-guest-picker>
                            <span class="label-xs">Huéspedes</span>
                            <button type="button" class="search-guest-trigger" data-guest-trigger aria-expanded="false">
                                <span class="search-guest-display" data-guest-display>1 adulto, 1 habitación</span>
                            </button>
                            <input required type="hidden" name="huespedes" value="1 adulto, 1 habitación" data-guest-input>
                            <div class="search-guest-popover search-guest-popover-inline d-none" data-guest-popover>
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
                <div class="col-md-2">
                    <button type="submit" class="btn btn-search py-2">Buscar</button>
                </div>
            </div>
        </form>
    </div>

    <div class="value-props py-2 mt-4 border-top border-bottom">
        <div class="container">
            <div class="d-flex justify-content-center gap-5">
                <span><i class="fa-solid fa-rotate-left me-2 text-primary"></i> Reserva ahora y paga después</span>
                <span><i class="fa-solid fa-credit-card me-2 text-primary"></i> Meses sin intereses</span>
                <span><i class="fa-solid fa-circle-check me-2 text-primary"></i> Cancelación GRATIS en miles de hoteles</span>
            </div>
        </div>
    </div>


    <div class="container py-5">
    <section class="mb-5">
        <h2 class="fw-bold h4 mb-4">Tus búsquedas recientes</h2>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <a href="motor_busqueda.php?accion=paso2&destino=<?= htmlspecialchars('Cancún', ENT_QUOTES, 'UTF-8') ?>&checkin=<?= htmlspecialchars($checkinDefault, ENT_QUOTES, 'UTF-8') ?>&checkout=<?= htmlspecialchars($checkoutDefault, ENT_QUOTES, 'UTF-8') ?>&huespedes=1+adulto%2C+1+habitación" class="brand-card-link">   
                    <div class="recent-search-card d-flex align-items-center">
                        <img src="assets/img/recent-search-01.jpg" class="recent-img" alt="Cancún">
                        <div class="ps-3 pe-2 py-2">
                            <div class="d-flex justify-content-between align-items-start">
                                <h6 class="mb-0 fw-bold text-truncate" style="max-width: 180px;">Cancún, Quintana Roo, Méxi...</h6>
                                <span class="badge-hotel text-uppercase ml-2"><i class="fa-solid fa-bed"></i> Hotel</span>
                            </div>
                            <p class="mb-0 text-muted small">15 abr. - 19 abr.</p>
                            <p class="mb-0 text-muted small">1 adulto</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-4">
                <a href="motor_busqueda.php?accion=paso2&destino=<?= htmlspecialchars('Sydney', ENT_QUOTES, 'UTF-8') ?>&checkin=<?= htmlspecialchars($checkinDefault, ENT_QUOTES, 'UTF-8') ?>&checkout=<?= htmlspecialchars($checkoutDefault, ENT_QUOTES, 'UTF-8') ?>&huespedes=1+adulto%2C+1+habitación" class="brand-card-link">   
                    <div class="recent-search-card d-flex align-items-center">
                        <img src="assets/img/recent-search-02.jpg" class="recent-img" alt="Sedney">
                        <div class="ps-3 pe-2 py-2 w-100">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-0 fw-bold">Sedney, Australia</h6>
                                <span class="badge-hotel text-uppercase"><i class="fa-solid fa-bed"></i> Hotel</span>
                            </div>
                            <p class="mb-0 text-muted small">15 abr. - 19 abr.</p>
                            <p class="mb-0 text-muted small">1 adulto</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section>
        <h2 id="ofertas" class="fw-bold h4 mb-1">Aprovecha nuestras ofertas</h2>
        <p class="text-muted mb-4">Paga a meses sin intereses, reserva ya!</p>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="offer-card">
                    <img src="assets/img/offer-1.jpg" alt="Destinos de Europa">
                    <div class="offer-overlay">
                        <div class="fs-5">Destinos de Europa</div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="offer-card">
                    <img src="assets/img/offer-2.webp" alt="Cancún">
                    <div class="offer-overlay">
                        <div class="fs-5">Cancún</div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="offer-card">
                    <img src="assets/img/offer-3.png" alt="Cuenta Regresiva">
                    <div class="offer-overlay">
                        <div class="fs-5">Comienza la cuenta regresiva ⚽</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="container py-5">
    <header class="mb-4">
        <h2 class="fw-bold mb-1">Prepara las maletas</h2>
        <p class="text-muted">Contamos con cambios flexibles</p>
    </header>

    <div class="position-relative">
        <a href="#" class="btn-next-floating d-none d-md-flex">
            <i class="fa-solid fa-chevron-right"></i>
        </a>

        <div class="row g-3">
            <?php if (empty($hotels)): ?>
            <div class="col-12">
                <div class="alert alert-light border text-center mb-0">No hay hoteles registrados por el momento.</div>
            </div>
            <?php else: ?>
            <?php foreach ($hotels as $hotel): ?>
                <div class="col-6 col-md-3">
                    <a href="motor_busqueda.php?accion=paso2&destino=<?= htmlspecialchars($hotel['nombre'], ENT_QUOTES, 'UTF-8') ?>&checkin=<?= htmlspecialchars($checkinDefault, ENT_QUOTES, 'UTF-8') ?>&checkout=<?= htmlspecialchars($checkoutDefault, ENT_QUOTES, 'UTF-8') ?>&huespedes=1+adulto%2C+1+habitación" class="brand-card-link">
                    <div class="brand-card shadow-sm">
                        <img src="<?= htmlspecialchars($hotel['imagen_principal'], ENT_QUOTES, 'UTF-8') ?>" class="bg-brand" alt="<?= htmlspecialchars($hotel['nombre'], ENT_QUOTES, 'UTF-8') ?>">
                        <div class="brand-overlay">
                            <div class="brand-logo d-flex align-items-center justify-content-center text-center fw-bold fs-5">
                                <?= htmlspecialchars($hotel['ciudad'], ENT_QUOTES, 'UTF-8') ?>
                            </div>
                            
                            <p class="brand-title"><?= htmlspecialchars($hotel['nombre'], ENT_QUOTES, 'UTF-8') ?></p>
                        </div>
                    </div>
                    </a>
                </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>



<section class="bg-light">

<div class="container py-4">
    
    <div class="info-card bg-white d-flex align-items-center mb-4">
        <div style="min-width: 250px;">
            <h5 class="fw-bold mb-1">Hasta 18 meses sin intereses</h5>
            <a href="#" class="link-pt">Más formas de pago <i class="fas fa-chevron-right ms-1"></i></a>
        </div>
        
        <div class="bank-divider d-none d-md-block"></div>
        
        <div class="d-flex flex-wrap align-items-center gap-4 flex-grow-1 justify-content-center">
            <img src="assets/img/bbva.png" class="bank-logo" alt="BBVA">
            <img src="assets/img//mercado-pago.png" class="bank-logo" alt="Mercado Pago">
            <img src="assets/img/nu.png" class="bank-logo" alt="Nu">
            <img src="assets/img/santander.png" class="bank-logo" alt="Santander">
            <img src="assets/img/banamex.svg" class="bank-logo" alt="Banamex">
            <img src="assets/img/scotiabank.png" class="bank-logo" alt="Scotiabank">
            <img src="assets/img/amex.png" class="bank-logo" alt="Amex">
            <img src="assets/img/paypal.png" class="bank-logo" alt="PayPal">
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="info-card bg-white d-flex align-items-start gap-3">
                <img src="bag-icon.png" width="40" alt="Reserva">
                <div>
                    <h5 class="fw-bold">Reserva ahora y paga después</h5>
                    <p class="text-muted small mb-1">Te damos más tiempo para pagar tu hospedaje</p>
                    <a href="#" class="link-pt">Cómo funciona <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="info-card bg-white d-flex align-items-start gap-3">
                <img src="expert-icon.png" width="40" alt="Expertos">
                <div>
                    <h5 class="fw-bold">Nuestros expertos a tu servicio</h5>
                    <p class="text-muted small mb-1">Atención 24 horas, 365 días del año</p>
                    <a href="#" class="link-pt">Contáctanos <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="cta-banner">
        <div class="row">
            <div class="col-md-6">
                <h2 class="fw-bold mb-3">Obtén descuentos al instante</h2>
                <p class="mb-4"><strong>Ahorra hasta 10%</strong> en tu próximo viaje comprando con tu cuenta en ExperienciasMay</p>
                <div class="d-flex gap-3">
                    <button class="btn-pt-primary" onclick="location.href='motor_busqueda.php?accion=login'">Iniciar sesión</button>
                    <button class="btn-pt-outline" onclick="location.href='motor_busqueda.php?accion=registro'">Crear cuenta</button>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<?php
include 'views/layouts/footer_motor.php';
?>
