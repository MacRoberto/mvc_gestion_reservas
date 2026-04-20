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
                        <div class="w-100">
                            <span class="label-xs">Destino, hotel, punto de interés.</span>
                            <input required 
                                type="text"
                                id="hotel-search-input"
                                name="destino"
                                class="form-control border-0 p-0 shadow-none"
                                placeholder="Destino, hotel, punto de interés."
                                autocomplete="off"
                                onchange="buscarHotelesDisponiblesAjax(this.value)">
                            <div id="hotel-search-results" class="ajax-search-results d-none"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="search-input-group d-flex align-items-center">
                        <i class="fa-solid fa-calendar-days me-3 text-secondary"></i>
                        <div class="w-100">
                            <span class="label-xs">Fechas</span>
                            <input required name="checkin" type="text" class="form-control border-0 p-0 shadow-none" value="15 abr 2026 - 19 abr 2026">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="search-input-group d-flex align-items-center">
                        <i class="fa-solid fa-user-group me-3 text-secondary"></i>
                        <div class="w-100">
                            <span class="label-xs">Huéspedes</span>
                            <input required name="huespedes" type="text" class="form-control border-0 p-0 shadow-none" value="1 adulto, 1 habitación">
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
            </div>

            <div class="col-md-6 col-lg-4">
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
            </div>
        </div>
    </section>

    <section>
        <h2 class="fw-bold h4 mb-1">Aprovecha nuestras ofertas</h2>
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
                <div class="brand-card shadow-sm">
                    <img src="<?= htmlspecialchars($hotel['imagen_principal'], ENT_QUOTES, 'UTF-8') ?>" class="bg-brand" alt="<?= htmlspecialchars($hotel['nombre'], ENT_QUOTES, 'UTF-8') ?>">
                    <div class="brand-overlay">
                        <div class="brand-logo d-flex align-items-center justify-content-center text-center fw-bold fs-5">
                            <?= htmlspecialchars($hotel['ciudad'], ENT_QUOTES, 'UTF-8') ?>
                        </div>
                        
                        <p class="brand-title"><?= htmlspecialchars($hotel['nombre'], ENT_QUOTES, 'UTF-8') ?></p>
                    </div>
                </div>
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
                    <button class="btn-pt-primary">Iniciar sesión</button>
                    <button class="btn-pt-outline">Crear cuenta</button>
                </div>
            </div>
        </div>
    </div>
</div>
</section>


<footer>
    <div class="pre-footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 border-end-md">
                    <h6 class="fw-bold text-center text-lg-start mb-3">¿Necesitas ayuda? Comunícate con nosotros</h6>
                    <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
                        <a href="#" class="contact-btn"><i class="fab fa-whatsapp text-success"></i> Por WhatsApp</a>
                        <a href="#" class="contact-btn"><i class="fab fa-facebook-messenger text-primary"></i> Por Messenger</a>
                        <div class="contact-btn"><i class="fa fa-phone"></i> Para reservar <strong>+52 998145368</strong></div>
                    </div>
                </div>
                <div class="col-lg-5 mt-4 mt-lg-0 text-center">
                    <h6 class="fw-bold mb-3">Descarga la app de Experiencias May</h6>
                    <div class="d-flex gap-2 justify-content-center">
                        <img src="assets/img/app-store.png" height="40" alt="App Store">
                        <img src="assets/img/google-play.png" height="40" alt="Google Play">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="color-bar">
        <div class="color-segment" style="background-color: #f4c300;"></div>
        <div class="color-segment" style="background-color: #eaff00;"></div>
        <div class="color-segment" style="background-color: #59ff00;"></div>
        <div class="color-segment" style="background-color: #00e2e6;"></div>
        <div class="color-segment" style="background-color: #211dfb;"></div>
    </div>

    <div class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h6>Servicio al cliente</h6>
                    <a href="#" class="footer-link">Ayuda</a>
                    <a href="#" class="footer-link">Puntos de venta ExperienciasMay</a>
                    <a href="#" class="footer-link">Facturación electrónica</a>
                    <a href="#" class="footer-link">Consultar reservación</a>
                    <a href="#" class="footer-link">Modificar reservación</a>
                    <a href="#" class="footer-link">Cancelar reservación</a>
                </div>
                <div class="col-md-3">
                    <h6>Acerca de nosotros</h6>
                    <a href="#" class="footer-link">Nuestra historia</a>
                    <a href="#" class="footer-link">Revista Experiencias May</a>
                    <a href="#" class="footer-link">Destinos</a>
                </div>
                <div class="col-md-2">
                    <h6>Proveedores</h6>
                    <a href="#" class="footer-link">Registrar tu hotel</a>
                </div>
                <div class="col-md-4 contact-info">
                    <h6>Contáctanos</h6>
                    <p><strong>México</strong> <span class="text-primary">+52 998 145 5368</span></p>
                    <p><strong>Colombia</strong> <span class="text-primary">+57 998 145 5368</span></p>
                    <p><strong>Estados Unidos/Canadá</strong> <span class="text-primary">+1 998 145 5368</span></p>
                    <p><strong>Otros países</strong> <span class="text-primary">+52 998 145 5368</span></p>
                    <p><strong>Correo electrónico</strong> <span class="text-primary">contact@experienciasmay.com.mx</span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="brand-footer">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="d-flex gap-4 align-items-center flex-wrap">
                    <h5 class="fw-bold mb-0">Nuestras marcas</h5>
                    <img src="assets/img/logo-may01.jpg" class="brand-logo-footer" alt="Experiencias May">
                    <img src="assets/img/agencias-may.png" class="brand-logo-footer" alt="Agencias May">
                    <img src="assets/img/socios-may.jpg" class="brand-logo-footer" alt="Socios May">

                </div>
                <div class="text-lg-end mt-4 mt-lg-0">
                    <div class="mb-2">
                        <a href="#" class="text-primary text-decoration-none small me-3">Términos y condiciones</a>
                        <a href="#" class="text-primary text-decoration-none small">Política de privacidad</a>
                    </div>
                    <p class="copyright-text mb-0">© Experiencias May Res, SAPI de CV. 2026. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<script>
var ajaxHotelSearchTimeout = null;
var ajaxHotelSearchController = null;

function escaparHtmlAjaxHotel(valor) {
    return String(valor || '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

function obtenerImagenHotelAjax(urlImagen, nombreHotel) {
    if (urlImagen) {
        return urlImagen;
    }

    return 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(
        '<svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 120 120">'
        + '<rect width="120" height="120" fill="#dfe7ef"/>'
        + '<rect x="12" y="16" width="96" height="88" rx="12" fill="#9fb3c8"/>'
        + '<path d="M20 82L45 55L63 72L78 60L100 82V98H20Z" fill="#6f8aa6"/>'
        + '<circle cx="82" cy="38" r="10" fill="#ffd166"/>'
        + '<text x="60" y="111" text-anchor="middle" font-family="Arial, sans-serif" font-size="10" fill="#355070">'
        + escaparHtmlAjaxHotel(nombreHotel || 'Hotel')
        + '</text></svg>'
    );
}

function ocultarResultadosHotelesAjax() {
    var resultados = document.getElementById('hotel-search-results');
    if (!resultados) {
        return;
    }

    resultados.classList.add('d-none');
    resultados.innerHTML = '';
}

function pintarResultadosHotelesAjax(hoteles) {
    var resultados = document.getElementById('hotel-search-results');
    var input = document.getElementById('hotel-search-input');

    if (!resultados || !input) {
        return;
    }

    if (!hoteles || hoteles.length === 0) {
        resultados.innerHTML = '<div class="ajax-search-empty">No se encontraron hoteles disponibles.</div>';
        resultados.classList.remove('d-none');
        return;
    }

    resultados.innerHTML = hoteles.map(function (hotel) {
        var ubicacion = [hotel.ciudad, hotel.pais].filter(Boolean).join(', ');

        return ''
            + '<button type="button" class="ajax-search-item" data-hotel-id="' + escaparHtmlAjaxHotel(hotel.id) + '" data-hotel-name="' + escaparHtmlAjaxHotel(hotel.nombre) + '">'
            + '<img src="' + escaparHtmlAjaxHotel(obtenerImagenHotelAjax(hotel.imagen_principal, hotel.nombre)) + '" alt="' + escaparHtmlAjaxHotel(hotel.nombre) + '">'
            + '<div class="ajax-search-item-body">'
            + '<strong>' + escaparHtmlAjaxHotel(hotel.nombre) + '</strong>'
            + '<span>' + escaparHtmlAjaxHotel(ubicacion || hotel.direccion || 'Disponible') + '</span>'
            + '</div>'
            + '</button>';
    }).join('');

    resultados.classList.remove('d-none');

    resultados.querySelectorAll('.ajax-search-item').forEach(function (item) {
        item.addEventListener('click', function () {
            input.value = this.getAttribute('data-hotel-name') || '';
            ocultarResultadosHotelesAjax();
        });
    });
}

async function ejecutarBusquedaHotelesAjax(valor) {
    var termino = (valor || '').trim();

    if (termino.length < 2) {
        ocultarResultadosHotelesAjax();
        return;
    }

    if (ajaxHotelSearchController) {
        ajaxHotelSearchController.abort();
    }

    ajaxHotelSearchController = new AbortController();

    try {
        var respuesta = await fetch('ajax.php?accion=buscar-hoteles&termino=' + encodeURIComponent(termino), {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            signal: ajaxHotelSearchController.signal
        });

        if (!respuesta.ok) {
            throw new Error('No se pudo consultar la disponibilidad.');
        }

        var data = await respuesta.json();
        pintarResultadosHotelesAjax(data.hoteles || []);
    } catch (error) {
        if (error.name === 'AbortError') {
            return;
        }

        var resultados = document.getElementById('hotel-search-results');
        if (resultados) {
            resultados.innerHTML = '<div class="ajax-search-empty">Ocurrio un error al consultar hoteles.</div>';
            resultados.classList.remove('d-none');
        }
    }
}

function buscarHotelesDisponiblesAjax(valor) {
    clearTimeout(ajaxHotelSearchTimeout);
    ajaxHotelSearchTimeout = setTimeout(function () {
        ejecutarBusquedaHotelesAjax(valor);
    }, 250);
}

document.addEventListener('DOMContentLoaded', function () {
    var input = document.getElementById('hotel-search-input');
    var resultados = document.getElementById('hotel-search-results');

    if (!input || !resultados) {
        return;
    }

    input.addEventListener('input', function () {
        buscarHotelesDisponiblesAjax(this.value);
    });

    input.addEventListener('focus', function () {
        if (this.value.trim().length >= 2) {
            buscarHotelesDisponiblesAjax(this.value);
        }
    });

    document.addEventListener('click', function (evento) {
        if (!resultados.contains(evento.target) && evento.target !== input) {
            ocultarResultadosHotelesAjax();
        }
    });
});
</script>
<?php
include 'views/layouts/footer_motor.php';
?>
