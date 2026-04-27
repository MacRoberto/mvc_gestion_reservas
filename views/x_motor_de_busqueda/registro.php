<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta - Agencias May</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .login-container {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            max-width: 1000px;
            width: 100%;
        }
        /* SECCIÓN IZQUIERDA - DISEÑO */
        .promo-side {
            background: linear-gradient(135deg, #6dd5ed, #2193b0);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            min-height: 600px;
        }
        .promo-side h2 { font-size: 3rem; font-weight: 800; }
        
        /* Avión y Estela */
        .plane-wrapper { margin: 40px 0; width: 100%; }
        .plane-svg { width: 180px; transform: rotate(-10deg); filter: drop-shadow(0 5px 15px rgba(0,0,0,0.1)); }

        /* Silueta de Ciudad */
        .skyline {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            opacity: 0.2;
            pointer-events: none;
        }

        /* SECCIÓN DERECHA - FORMULARIO */
        .login-side { padding: 50px; }
        .form-label { font-weight: bold; color: #666; font-size: 0.85rem; }
        .form-control { border-radius: 8px; padding: 10px; border: 1px solid #ddd; }
        
        .btn-register {
            background-color: #5bc0de;
            border: none;
            color: white;
            padding: 12px;
            font-weight: bold;
            border-radius: 8px;
            transition: 0.3s;
        }
        .btn-register:hover { background-color: #46b8da; transform: translateY(-2px); }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center">
    <div class="login-container row g-0">
        
        <div class="col-md-6 promo-side d-none d-md-flex">
            <div class="position-absolute top-0 start-0 p-4"><strong>AGENCIAS MAY</strong></div>
            
            <h2>¡ÚNETE!</h2>
            <p class="fs-4">Y comienza tu aventura</p>

            <div class="plane-wrapper">
                <svg viewBox="0 0 500 200" class="plane-svg">
                    <line x1="0" y1="100" x2="150" y2="100" stroke="white" stroke-width="4" stroke-dasharray="20,10" opacity="0.6" />
                    <line x1="20" y1="130" x2="120" y2="130" stroke="white" stroke-width="4" stroke-dasharray="15,15" opacity="0.4" />
                    <path d="M150,110 L350,80 C380,75 420,85 430,110 C420,135 380,145 350,140 L150,110 Z" fill="white" />
                    <path d="M280,92 L260,30 L310,87 Z" fill="white" /> 
                    <path d="M280,128 L260,180 L310,133 Z" fill="rgba(255,255,255,0.7)" />
                </svg>
            </div>

            <div class="mt-3 text-uppercase small" style="letter-spacing: 2px;">
                Explora el mundo con nosotros
            </div>

            <svg class="skyline" viewBox="0 0 1000 200">
                <path d="M0,200 L0,150 L50,150 L50,100 L80,100 L80,160 L120,160 L120,80 L160,80 L160,170 L200,170 L200,120 L250,120 L250,200 Z" fill="white" />
                <path d="M300,200 L300,140 L340,100 L380,140 L380,200 Z" fill="white" />
                <path d="M450,200 L450,70 L500,70 L500,200 Z" fill="white" />
                <path d="M600,200 L600,130 L650,130 L650,100 L700,100 L700,200 Z" fill="white" />
                <path d="M800,200 L800,120 L850,80 L900,120 L900,200 Z" fill="white" />
            </svg>
        </div>

        <div class="col-md-6 login-side">
            <h2 class="fw-bold mb-1">Crear Cuenta</h2>
            <p class="text-muted small mb-4">Regístrate para obtener beneficios exclusivos en tus viajes.</p>

            <form action="procesar_registro.php" method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Ej: Juan" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Apellido</label>
                        <input type="text" name="apellido" class="form-control" placeholder="Ej: Pérez" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" placeholder="correo@ejemplo.com" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Telefono</label>
                    <input type="number" name="telefono" class="form-control" placeholder="Telefono" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Confirmar Contraseña</label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-register text-uppercase">Registrarme Ahora</button>
                </div>

                <div class="mt-4 text-center small">
                    <span class="text-muted">¿Ya tienes cuenta?</span> 
                    <a href="login.php" class="text-info text-decoration-none fw-bold">Inicia Sesión</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>