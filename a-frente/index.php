<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PriceTravel Header Clone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --pt-pink: #c5006d;
            --pt-text: #4a4a4a;
        }
        body { font-family: 'Arial', sans-serif; color: var(--pt-text); }
        
        .top-header { font-size: 13px; }
        .nav-category {
            font-weight: 600;
            color: var(--pt-text);
            text-decoration: none;
            padding-bottom: 8px;
            border-bottom: 3px solid transparent;
            font-size: 14px;
        }
        .nav-category:hover, .nav-category.active {
            color: #000;
            border-bottom: 3px solid var(--pt-pink);
        }
        .login-btn {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 5px 15px;
            background: white;
            font-size: 14px;
        }
        .pt-logo { height: 40px; }

        /*Hero*/

        <>
        .hero-banner {
            background: url('your-beach-image.jpg') center/cover no-repeat;
            height: 450px;
            position: relative;
            display: flex;
            align-items: center;
        }

        /* Floating Search Bar */
        .search-container {
            margin-top: -50px; /* Pulls it up over the hero */
            position: relative;
            z-index: 10;
        }

        .search-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.15);
            padding: 20px;
        }

        .search-input-group {
            border: 1px solid #ced4da;
            border-radius: 8px;
            padding: 8px 12px;
        }

        .label-xs {
            font-size: 11px;
            font-weight: 700;
            color: #6c757d;
            display: block;
            margin-bottom: 2px;
        }

        .btn-search {
            background-color: #c5006d;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            height: 100%;
            width: 100%;
        }

        .btn-search:hover {
            background-color: #a00058;
            color: white;
        }

        /* Promo Text Overlay */
        .promo-content {
            color: white;
            text-shadow: 1px 1px 4px rgba(0,0,0,0.3);
        }

        .discount-text {
            font-size: 80px;
            font-weight: 900;
            line-height: 1;
        }

        /* Value Props Bar */
        .value-props {
            background-color: #f8f9fa;
            font-size: 13px;
            color: #2d3e50;
        }

        /*Body*/
        /*Body*/

        body { background-color: #ffffff; color: #1a2b49; }
        
        /* Recent Search Card Styles */
        .recent-search-card {
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e0e0e0;
            transition: box-shadow 0.3s ease;
            cursor: pointer;
            height: 100px;
        }
        .recent-search-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .recent-img {
            width: 120px;
            height: 100%;
            object-fit: cover;
        }
        .badge-hotel {
            background-color: #f3e5f5;
            color: #7b1fa2;
            font-size: 10px;
            font-weight: bold;
            padding: 2px 8px;
            border-radius: 4px;
        }

        /* Offers Styles */
        .offer-card {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            height: 280px;
            cursor: pointer;
        }
        .offer-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .offer-card:hover img {
            transform: scale(1.05);
        }
        .offer-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
            background: linear-gradient(transparent, rgba(0,0,0,0.7));
            color: white;
            font-weight: bold;
        }

        .brand-card {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            height: 400px; /* Tall vertical cards as seen in image */
            border: none;
            cursor: pointer;
        }

        .brand-card img.bg-brand {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .brand-card:hover img.bg-brand {
            transform: scale(1.1);
        }

        .brand-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0.2) 0%, transparent 40%, rgba(0,0,0,0.8) 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px;
            color: white;
        }

        .brand-logo {
            max-width: 120px;
            align-self: center;
            filter: brightness(0) invert(1); /* Makes logos white */
        }

        .brand-title {
            font-size: 1.2rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 0;
        }

        /* Carousel Next Button Overlay */
        .btn-next-floating {
            position: absolute;
            right: -20px;
            top: 50%;
            transform: translateY(-50%);
            background: #4a4a4a;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 5;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            border: 2px solid white;
        }

        /* Bank secction */

        .info-card {
            border-radius: 12px;
            border: 1px solid #e0e0e0;
            padding: 24px;
            height: 100%;
        }
        .bank-divider {
            border-left: 1px solid #e0e0e0;
            height: 50px;
            margin: 0 20px;
        }
        .bank-logo {
            max-height: 25px;
            filter: grayscale(100%);
            opacity: 0.7;
            transition: 0.3s;
        }
        .bank-logo:hover {
            filter: grayscale(0%);
            opacity: 1;
        }
        .link-pt {
            color: #c5006d;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
        }
        .cta-banner {
            background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('mountain-landscape.jpg') center/cover;
            border-radius: 12px;
            padding: 60px 40px;
            color: white;
        }
        .btn-pt-primary {
            background-color: #c5006d;
            border: none;
            color: white;
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 8px;
        }
        .btn-pt-outline {
            background-color: transparent;
            border: 2px solid white;
            color: white;
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 8px;
        }

        /*Footer*/

        .pre-footer { background-color: #f1f1f1; padding: 30px 0; }
        .contact-btn {
            background: white;
            border-radius: 8px;
            padding: 10px 20px;
            text-decoration: none;
            color: #333;
            font-weight: 500;
            border: 1px solid #ddd;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }
        /* Multi-colored border line */
        .color-bar {
            height: 4px;
            width: 100%;
            display: flex;
        }
        .color-segment { flex: 1; }

        .footer-main { background-color: #ffffff; padding: 40px 0; font-size: 14px; }
        .footer-main h6 { font-weight: 700; margin-bottom: 20px; color: #333; }
        .footer-link { 
            display: block; 
            color: #007bff; 
            text-decoration: none; 
            margin-bottom: 8px; 
        }
        .footer-link:hover { text-decoration: underline; }
        
        .contact-info p { margin-bottom: 5px; font-size: 13px; }
        .contact-info strong { color: #333; }

        .brand-footer { border-top: 1px solid #eee; padding: 30px 0; }
        .brand-logo-footer { height: 25px; opacity: 0.8; }
        .copyright-text { font-size: 11px; color: #666; }

    </style>
</head>
<body>

<header class="bg-white pt-2 shadow-sm">
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            
            <a href="index.php">
                <img src="path_to_your_logo.png" alt="PriceTravel" class="pt-logo">
            </a>

            <div class="d-flex align-items-center gap-4 top-header">
                <div class="d-flex align-items-center">
                    <img src="https://flagcdn.com/w20/mx.png" class="me-2" alt="MX">
                    <span>Español - MXN</span>
                </div>
                <a href="#" class="text-decoration-none text-dark">Ayuda</a>
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-phone me-2"></i>
                    <span>Para reservar <strong>+52 55 8663 8825</strong></span>
                </div>
                <button class="login-btn d-flex align-items-center gap-2">
                    Iniciar sesión <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>

        <nav class="d-flex gap-4 pb-2">
            <a href="#" class="nav-category">
                <i class="fa-solid fa-bed me-2 text-primary"></i> Alojamientos
            </a>
            <a href="#" class="nav-category">
                <i class="fa-solid fa-plane me-2"></i> Vuelos
            </a>
            <a href="#" class="nav-category">
                <i class="fa-solid fa-suitcase me-2"></i> Hotel + Vuelo
            </a>
            <a href="#" class="nav-category">
                <i class="fa-solid fa-face-smile me-2"></i> Disney
            </a>
            <a href="#" class="nav-category">
                <i class="fa-solid fa-fire me-2"></i> Ofertas
            </a>
        </nav>
    </div>
</header>



<section class="hero-banner">
        <div class="container h-100 d-flex align-items-center">
            <div class="promo-content">
                <div class="mb-2" style="max-width: 200px;">
                    <img src="semana-santa-badge.png" class="img-fluid" alt="Semana Santa">
                </div>
                <p class="mb-0 h4">Hasta</p>
                <div class="discount-text">67%</div>
                <p class="h4">de descuento</p>
                <button class="btn btn-light rounded-pill px-4 mt-3 fw-bold text-primary">¡Reserva ahora!</button>
            </div>
        </div>
    </section>

    <div class="container search-container">
        <div class="search-card">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="search-input-group d-flex align-items-center">
                        <i class="fa-solid fa-location-dot me-3 text-secondary"></i>
                        <div class="w-100">
                            <span class="label-xs">Destino, hotel, punto de interés.</span>
                            <input type="text" class="form-control border-0 p-0 shadow-none" placeholder="Destino, hotel, punto de interés.">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="search-input-group d-flex align-items-center">
                        <i class="fa-solid fa-calendar-days me-3 text-secondary"></i>
                        <div class="w-100">
                            <span class="label-xs">Fechas</span>
                            <input type="text" class="form-control border-0 p-0 shadow-none" value="15 abr 2026 - 19 abr 2026">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="search-input-group d-flex align-items-center">
                        <i class="fa-solid fa-user-group me-3 text-secondary"></i>
                        <div class="w-100">
                            <span class="label-xs">Huéspedes</span>
                            <input type="text" class="form-control border-0 p-0 shadow-none" value="1 adulto, 1 habitación">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-search py-2">Buscar</button>
                </div>
            </div>
        </div>
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
                    <img src="cancun_thumb.jpg" class="recent-img" alt="Cancún">
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
                    <img src="valladolid_thumb.jpg" class="recent-img" alt="Valladolid">
                    <div class="ps-3 pe-2 py-2 w-100">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-0 fw-bold">Valladolid, Yucatán, México</h6>
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
                    <img src="playa_promo.jpg" alt="Destinos de Playa">
                    <div class="offer-overlay">
                        <div class="fs-5">Destinos de Playa</div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="offer-card">
                    <img src="cancun_promo.jpg" alt="Cancún">
                    <div class="offer-overlay">
                        <div class="fs-5">Cancún</div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="offer-card">
                    <img src="countdown_promo.jpg" alt="Cuenta Regresiva">
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
            <?php
            $hotels = [
                ['name' => 'Palace Resorts 5ta noche gratis', 'logo' => 'palace-logo.png', 'img' => 'resort1.jpg'],
                ['name' => 'RIU Hotels & Resorts', 'logo' => 'riu-logo.png', 'img' => 'resort2.jpg'],
                ['name' => 'Barceló Hotels & Resorts', 'logo' => 'barcelo-logo.png', 'img' => 'resort3.jpg'],
                ['name' => 'Hilton Hotels & Resorts', 'logo' => 'hilton-logo.png', 'img' => 'resort4.jpg']
            ];

            foreach ($hotels as $hotel):
            ?>
            <div class="col-6 col-md-3">
                <div class="brand-card shadow-sm">
                    <img src="<?= $hotel['img'] ?>" class="bg-brand" alt="<?= $hotel['name'] ?>">
                    <div class="brand-overlay">
                        <img src="<?= $hotel['logo'] ?>" class="brand-logo" alt="logo">
                        
                        <p class="brand-title"><?= $hotel['name'] ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
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
            <img src="bbva.png" class="bank-logo" alt="BBVA">
            <img src="mercado-pago.png" class="bank-logo" alt="Mercado Pago">
            <img src="nu.png" class="bank-logo" alt="Nu">
            <img src="santander.png" class="bank-logo" alt="Santander">
            <img src="banamex.png" class="bank-logo" alt="Banamex">
            <img src="scotiabank.png" class="bank-logo" alt="Scotiabank">
            <img src="amex.png" class="bank-logo" alt="Amex">
            <img src="paypal.png" class="bank-logo" alt="PayPal">
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
                <p class="mb-4"><strong>Ahorra hasta 10%</strong> en tu próximo viaje comprando con tu cuenta en PriceTravel</p>
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
                        <div class="contact-btn"><i class="fa fa-phone"></i> Para reservar <strong>+52 55 8663 8825</strong></div>
                    </div>
                </div>
                <div class="col-lg-5 mt-4 mt-lg-0 text-center">
                    <h6 class="fw-bold mb-3">Descarga la app de PriceTravel</h6>
                    <div class="d-flex gap-2 justify-content-center">
                        <img src="app-store.png" height="40" alt="App Store">
                        <img src="google-play.png" height="40" alt="Google Play">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="color-bar">
        <div class="color-segment" style="background-color: #00c4f4;"></div>
        <div class="color-segment" style="background-color: #007bff;"></div>
        <div class="color-segment" style="background-color: #ffb400;"></div>
        <div class="color-segment" style="background-color: #e6007e;"></div>
        <div class="color-segment" style="background-color: #4b2c82;"></div>
    </div>

    <div class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h6>Servicio al cliente</h6>
                    <a href="#" class="footer-link">Ayuda</a>
                    <a href="#" class="footer-link">Puntos de venta PriceTravel</a>
                    <a href="#" class="footer-link">Facturación electrónica</a>
                    <a href="#" class="footer-link">Consultar reservación</a>
                    <a href="#" class="footer-link">Modificar reservación</a>
                    <a href="#" class="footer-link">Cancelar reservación</a>
                </div>
                <div class="col-md-3">
                    <h6>Acerca de nosotros</h6>
                    <a href="#" class="footer-link">Nuestra historia</a>
                    <a href="#" class="footer-link">Sala de prensa</a>
                    <a href="#" class="footer-link">Revista PriceTravel</a>
                    <a href="#" class="footer-link">Destinos</a>
                </div>
                <div class="col-md-2">
                    <h6>Proveedores</h6>
                    <a href="#" class="footer-link">Registrar hotel</a>
                </div>
                <div class="col-md-4 contact-info">
                    <h6>Contáctanos</h6>
                    <p><strong>México</strong> <span class="text-primary">+52 55 8663 8825</span></p>
                    <p><strong>Colombia</strong> <span class="text-primary">+57 601 744 2024</span></p>
                    <p><strong>Estados Unidos/Canadá</strong> <span class="text-primary">+1 855 437 8999</span></p>
                    <p><strong>Otros países</strong> <span class="text-primary">+52 55 8663 8825</span></p>
                    <p><strong>Correo electrónico</strong> <span class="text-primary">contact@pricetravel.com.mx</span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="brand-footer">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="d-flex gap-4 align-items-center flex-wrap">
                    <h5 class="fw-bold mb-0">Nuestras marcas</h5>
                    <img src="pricetravel-logo.png" class="brand-logo-footer" alt="PriceTravel">
                    <img src="tiquetes-logo.png" class="brand-logo-footer" alt="Tiquetes Baratos">
                    <img src="priceagencies-logo.png" class="brand-logo-footer" alt="PriceAgencies">
                    <img src="priceaffiliates-logo.png" class="brand-logo-footer" alt="PriceAffiliates">
                    <img src="connect-logo.png" class="brand-logo-footer" alt="Connect">
                </div>
                <div class="text-lg-end mt-4 mt-lg-0">
                    <div class="mb-2">
                        <a href="#" class="text-primary text-decoration-none small me-3">Términos y condiciones</a>
                        <a href="#" class="text-primary text-decoration-none small">Política de privacidad</a>
                    </div>
                    <p class="copyright-text mb-0">© Price Res, SAPI de CV. 2026. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>