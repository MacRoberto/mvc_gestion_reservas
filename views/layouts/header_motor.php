<?php
@session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Experiencias MAY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style_motor.css">

</head>
<body>
    <header class="bg-white pt-2 shadow-sm">
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            
            <a href="motor_busqueda.php">
                <img src="assets/img/logo-may.png" alt="ExperienciasMay" class="pt-logo">
            </a>

            <div class="d-flex align-items-center gap-4 top-header">
                <div class="d-flex align-items-center">
                    <img src="https://flagcdn.com/w20/mx.png" class="me-2" alt="MX">
                    <span>Español - MXN</span>
                </div>
                <a href="#" class="text-decoration-none text-dark">Ayuda</a>
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-phone me-2"></i>
                    <span>Para reservar <strong>+52 998145368</strong></span>
                </div>
                <?php if(isset($_SESSION['nombre'])): ?>
                    <div class="dropdown">
                        <button class="login-btn d-flex align-items-center gap-2" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user"></i> <?= $_SESSION['nombre'] ?>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="motor_busqueda.php?accion=logout">Cerrar sesión</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <button class="login-btn d-flex align-items-center gap-2" onclick="location.href='motor_busqueda.php?accion=login'">
                        Iniciar sesión <i class="fa-solid fa-bars"></i>
                    </button>
                <?php endif; ?>
            </div>
        </div>

        <nav class="d-flex gap-4 pb-2">
            <a href="motor_busqueda.php" class="nav-category">
                <i class="fa-solid fa-bed me-2 text-primary"></i> Alojamientos
            </a>
            <a href="https://www.skyscanner.com.mx/?gclsrc=aw.ds&&utm_source=google&utm_medium=cpc&utm_campaign=MX-Flights-Search-ES-Generics-New&utm_term=vuelos&associateID=SEM_FLI_19465_00000&campaign_id=19652262208&adgroupid=154370717508&keyword_id=kwd-10382701&gad_source=1&gad_campaignid=19652262208&gbraid=0AAAAAD3oWFgcfG8uUjkBN_CjmjdiFrbgL&gclid=Cj0KCQjwkrzPBhCqARIsAJN460nnMpa61f4FB6B1MxOZm5hVQkhgnb0OZ_fVYruVR5r96nDtRCzXFqMaAk2REALw_wcB" class="nav-category">
                <i class="fa-solid fa-plane me-2"></i> Vuelos
            </a>
            <a href="#" class="nav-category">
                <i class="fa-solid fa-suitcase me-2"></i> Hotel + Vuelo
            </a>
            <a href="https://disneyworld.disney.go.com/es-mx/?ef_id=Cj0KCQjwkrzPBhCqARIsAJN460n0ZNtZJo5LrUaleD36v3MoY2q94YSr5TVnpcQWb7HmV2CqNzKV0W8aAgKGEALw_wcB:G:s&s_kwcid=AL!5071!3!787404213549!e!!g!!disney%20world!639371519!188583498223&CMP=KNC-FY26_WDW_TRA_MEX_WB2LA_RES_RSG_WDWBrand|G|5251851.CL.AM.01.01|M2SJ8KJ|BR|787404213549&keyword_id=kwd-12193621|dc|disney%20world|787404213549|e|5071:3|&gad_source=1&gad_campaignid=639371519&gbraid=0AAAAAD_M-kbiceUIi2TK6gAKx2KbBeXmI&gclid=Cj0KCQjwkrzPBhCqARIsAJN460n0ZNtZJo5LrUaleD36v3MoY2q94YSr5TVnpcQWb7HmV2CqNzKV0W8aAgKGEALw_wcB" class="nav-category">
                <i class="fa-solid fa-face-smile me-2"></i> Disney
            </a>
            <a href="#ofertas" class="nav-category">
                <i class="fa-solid fa-fire me-2"></i> Ofertas
            </a>
        </nav>
    </div>
</header>
