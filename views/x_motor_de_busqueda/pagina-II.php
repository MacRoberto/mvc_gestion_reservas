<?php
include 'views/layouts/header_motor.php';

?>




<?php

// Mock data representing the hotels in the image
$hotels = [
    [
        "name" => "Hacienda San Miguel",
        "location" => "Valladolid",
        "stars" => 4,
        "rating" => 8.2,
        "reviews" => 34,
        "amenities" => ["Mascotas aceptadas", "Cancelación GRATIS"],
        "price_night" => 3619,
        "taxes" => 1104,
        "image" => "https://via.placeholder.com/300x200?text=Hacienda+San+Miguel"
    ],
    [
        "name" => "Hotel Chichen Itzá",
        "location" => "Pisté",
        "stars" => 4,
        "rating" => 8.6,
        "reviews" => 727,
        "amenities" => ["Estacionamiento", "Wi-Fi", "Desayuno"],
        "price_night" => 1930,
        "taxes" => 396,
        "image" => "https://via.placeholder.com/300x200?text=Hotel+Chichen+Itza"
    ]
];
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <div class="card p-3 shadow-sm">
                <h5>Modificar búsqueda</h5>
                <small class="text-muted">Valladolid, Yucatán, México</small>
                <hr>
                <button class="btn btn-danger w-100">Buscar</button>
            </div>
        </div>

        <div class="col-md-9">
            <?php foreach ($hotels as $hotel): ?>
                <div class="card mb-3 shadow-sm">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?php echo $hotel['image']; ?>" class="img-fluid rounded-start h-100" style="object-fit: cover;" alt="Hotel">
                        </div>
                        
                        <div class="col-md-5 p-3">
                            <h5 class="card-title mb-1"><?php echo $hotel['name']; ?></h5>
                            <p class="text-muted small mb-1"><?php echo $hotel['location']; ?></p>
                            
                            <div class="text-warning mb-2">
                                <?php for($i=0; $i<$hotel['stars']; $i++) echo "★"; ?>
                            </div>

                            <ul class="list-unstyled small">
                                <?php foreach ($hotel['amenities'] as $amenity): ?>
                                    <li class="text-success"><i class="bi bi-check"></i> <?php echo $amenity; ?></li>
                                <?php endforeach; ?>
                            </ul>

                            <span class="badge bg-primary"><?php echo $hotel['rating']; ?>/10</span>
                            <small class="text-muted">Muy Bueno (<?php echo $hotel['reviews']; ?> Opiniones)</small>
                        </div>

                        <div class="col-md-3 p-3 border-start text-end bg-light">
                            <small class="text-muted">Habitación por noche</small>
                            <h4 class="fw-bold mb-0">$ <?php echo number_format($hotel['price_night']); ?> MXN</h4>
                            <small class="text-muted">+ $ <?php echo number_format($hotel['taxes']); ?> de impuestos</small>
                            <div class="mt-2">
                                <strong class="text-dark">Total $ <?php echo number_format($hotel['price_night'] + $hotel['taxes']); ?> MXN</strong>
                            </div>
                            <div class="text-success small mt-2">
                                <i class="bi bi-tag-fill"></i> -$116 al iniciar sesión
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>