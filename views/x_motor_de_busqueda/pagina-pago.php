<?php
include 'views/layouts/header_motor.php';
$payPalConfig = require 'config/paypal.php';
$payPalClientId = isset($payPalConfig['client_id']) ? $payPalConfig['client_id'] : '';
$payPalCurrency = isset($payPalConfig['currency']) ? $payPalConfig['currency'] : 'MXN';
$payPalAmount = '16728.00';
print_r ($reservaInfo);
?>

<main class="checkout-form-page checkout-payment-page py-4 py-lg-5">
    <div class="container-fluid px-3 px-lg-4">
        <div class="checkout-steps mb-4">
            <div class="checkout-step-item active">
                <span class="checkout-step-dot">
                    <i class="fa-solid fa-check"></i>
                </span>
                <span class="checkout-step-label">Informacion del viajero</span>
            </div>
            <div class="checkout-step-line checkout-step-line-complete"></div>
            <div class="checkout-step-item active">
                <span class="checkout-step-dot">2</span>
                <span class="checkout-step-label">Metodo de pago</span>
            </div>
        </div>

        <div class="row g-4 align-items-start">
            <div class="col-xl-8 order-2 order-xl-1">
                <section class="checkout-payment-panel">
                    <header class="mb-4">
                        <h1 class="checkout-title mb-2">Elige tu metodo de pago</h1>
                        <p class="checkout-payment-safe mb-0">
                            <i class="fa-solid fa-shield-heart"></i>
                            <span><strong>Compra 100% segura.</strong> Utilizamos conexiones seguras para proteger tu informacion.</span>
                        </p>
                    </header>

                    <div class="mb-4">
                        <div class="checkout-payment-list">
                            <button type="button" class="checkout-payment-method" data-payment-method="card">
                                <span class="checkout-payment-method-main">
                                    <span class="checkout-payment-method-icon">
                                        <i class="fa-regular fa-credit-card"></i>
                                    </span>
                                    <span>Tarjeta de Credito / Debito</span>
                                </span>
                                <span class="checkout-payment-check">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                            </button>

                            <div class="collapse" id="checkoutCardPaymentForm">
                                <div class="checkout-payment-form">
                                    <div class="checkout-card-brands checkout-card-brands-start mb-4">
                                        <span class="checkout-brand-pill">MC</span>
                                        <span class="checkout-brand-pill">VISA</span>
                                        <span class="checkout-brand-pill">AMEX</span>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="card-number" class="form-label checkout-label">Numero de tarjeta</label>
                                            <input type="text" id="card-number" class="form-control checkout-input" placeholder="15 a 16 digitos">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="card-expiry" class="form-label checkout-label">Vencimiento</label>
                                            <input type="text" id="card-expiry" class="form-control checkout-input" placeholder="MM/AA">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="card-cvv" class="form-label checkout-label">Codigo de Seguridad</label>
                                            <div class="input-group">
                                                <input type="text" id="card-cvv" class="form-control checkout-input border-end-0" placeholder="CVV">
                                                <span class="input-group-text checkout-payment-info">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="card-holder" class="form-label checkout-label">Nombre del titular de la tarjeta</label>
                                            <input type="text" id="card-holder" class="form-control checkout-input">
                                            <div class="checkout-payment-help">Escribelo exactamente como aparece en tu tarjeta</div>
                                        </div>

                                        <div class="col-md-7">
                                            <label for="card-country" class="form-label checkout-label">Pais</label>
                                            <div class="position-relative">
                                                <select id="card-country" class="form-select checkout-input checkout-select">
                                                    <option selected>Mexico</option>
                                                </select>
                                                <span class="checkout-select-check">
                                                    <i class="fa-solid fa-circle-check"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <label for="card-postal" class="form-label checkout-label">Codigo postal</label>
                                            <input type="text" id="card-postal" class="form-control checkout-input" placeholder="C.P.">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="checkout-payment-method" data-payment-method="paypal">
                                <span class="checkout-payment-method-main">
                                    <span class="checkout-payment-method-icon checkout-payment-brand">P</span>
                                    <span>PayPal</span>
                                </span>
                                <span class="checkout-payment-check">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                            </button>

                            <div class="collapse" id="checkoutPaypalPaymentBox">
                                <div class="checkout-payment-form">
                                    <?php if ($payPalClientId === '') { ?>
                                        <div class="alert alert-warning mb-0">
                                            Configura <code>PAYPAL_CLIENT_ID</code> y <code>PAYPAL_CLIENT_SECRET</code> para probar PayPal Sandbox.
                                        </div>
                                    <?php } else { ?>
                                        <p class="checkout-payment-help mb-3">Usa tu cuenta Sandbox de PayPal para completar la prueba.</p>
                                        <div id="paypal-button-container"></div>
                                        <div id="paypal-status-message" class="checkout-payment-status mt-3 d-none"></div>
                                    <?php } ?>
                                </div>
                            </div>

                            <button type="button" class="checkout-payment-method active" data-payment-method="destination">
                                <span class="checkout-payment-method-main">
                                    <span class="checkout-payment-method-icon">
                                        <i class="fa-solid fa-hotel"></i>
                                    </span>
                                    <span>Pago en destino</span>
                                </span>
                                <span class="checkout-payment-check">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                            </button>
                        </div>
                    </div>

                    <section class="checkout-card checkout-payment-continue d-none p-4 p-lg-4" id="checkoutPaymentContinueBox">
                        <p class="checkout-continue-copy mb-3">
                            Al hacer clic en el boton "Continuar", acepto las
                            <a href="#">politicas de reservacion</a> y nuestro
                            <a href="#">aviso de privacidad</a>.
                        </p>

                        <button type="button" class="btn checkout-continue-btn w-100">
                            <span>Continuar</span>
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </section>
                </section>
            </div>

            <div class="col-xl-4 order-1 order-xl-2">
                <aside class="checkout-sidebar">
                    <section class="checkout-card checkout-summary-card p-4 mb-3">
                        <h2 class="checkout-side-title mb-3">Resumen de Pago</h2>
                        <div class="checkout-summary-row">
                            <span>1 Habitacion, 2 Noches</span>
                            <strong>
                                <?php
                                echo number_format($reservaInfo['precio_noche']) .' '. $reservaInfo['moneda'] ;
                                ?>
                            </strong>
                        </div>
                        <div class="checkout-summary-row">
                            <span>Impuestos</span>
                            <strong>
                                <?php
                                echo number_format($reservaInfo['total'] - $reservaInfo['subtotal']) .' '. $reservaInfo['moneda'] ;
                                ?>
                            </strong>
                        </div>
                     
                        <div class="checkout-summary-total">
                            <span>Total</span>
                            <strong>
                                <?php
                                Echo number_format($reservaInfo['total']) .' '. $reservaInfo['moneda'] ;
                                ?>  
                            </strong>
                        </div>
                    </section>

                    <section class="checkout-card p-4">
                        <h2 class="checkout-side-title mb-2">Detalles de la reserva</h2>
                        <p class="checkout-payment-reservation-id mb-4">
                            <strong>
                                <?php
                                    echo "No. de reservacion:<br>" .' ' . $reservaInfo['folio'] ; 
                                ?>
                            </strong>
                             Este numero es para cualquier asunto relacionado con tu reservacion.
                        </p>

                        <div class="accordion checkout-accordion" id="checkoutPaymentReservationAccordion">
                            <div class="accordion-item checkout-accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button checkout-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#paymentHotelReservationCollapse" aria-expanded="true" aria-controls="paymentHotelReservationCollapse">
                                        <span class="d-flex align-items-center gap-2">
                                            <i class="fa-solid fa-building"></i>
                                            <span>Hotel</span>
                                        </span>
                                    </button>
                                </h2>
                                <div id="paymentHotelReservationCollapse" class="accordion-collapse collapse show" data-bs-parent="#checkoutPaymentReservationAccordion">
                                    <div class="accordion-body pt-2">
                                        <h3 class="checkout-hotel-name">
                                            <?php
                                                echo $reservaInfo['nombre_hotel'] ;
                                            ?>
                                        </h3>
                                        <p class="checkout-location mb-2">
                                            <?php
                                                echo $reservaInfo['ciudad'] ;
                                            ?>
                                        </p>
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
                                                <div class="checkout-detail-value">
                                                    <?php
                                                    echo $reservaInfo['fecha_entrada_formateada'] ;
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="checkout-detail-label">Salida</div>
                                                <div class="checkout-detail-value">
                                                    <?php
                                                        echo $reservaInfo['fecha_salida_formateada'] ; 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="checkout-detail-label">Duracion de la estancia</div>
                                            <div class="checkout-detail-value">
                                                
                                                <?php
                                                    echo $reservaInfo['noches'] ;
                                                ?>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="checkout-detail-label">Elegiste</div>
                                            <div class="checkout-detail-value">
                                                <?php
                                                 echo $reservaInfo['habitaciones']."habitaciones".' '. $reservaInfo['capacidad_adultos'].' '." Adultos";
                                                ?>
                                               
                                            </div>
                                        </div>

                                        <button
                                            type="button"
                                            class="checkout-room-toggle d-inline-flex align-items-center gap-2"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#paymentRoomDetails"
                                            aria-expanded="false"
                                            aria-controls="paymentRoomDetails">
                                            <span>Mostrar detalles de habitacion</span>
                                            <i class="fa-solid fa-chevron-up"></i>
                                        </button>

                                        <div class="collapse" id="paymentRoomDetails">
                                            <div class="checkout-room-box mt-4">
                                                <p class="mb-1">
                                                <strong>
                                                    <?php
                                                    echo $reservaInfo['habitaciones']
                                                    ?>
                                                </strong> 
                                                <?php
                                                    echo $reservaInfo['tipo_habitacion'];                                                    
                                                ?>
                                                </p>
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
    </div>
</main>

<?php if ($payPalClientId !== '') { ?>
<script src="https://www.paypal.com/sdk/js?client-id=<?php echo htmlspecialchars($payPalClientId, ENT_QUOTES, 'UTF-8'); ?>&currency=<?php echo htmlspecialchars($payPalCurrency, ENT_QUOTES, 'UTF-8'); ?>&intent=capture&disable-funding=card"></script>
<?php } ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var roomToggle = document.querySelector('#paymentHotelReservationCollapse .checkout-room-toggle');
    var roomDetails = document.getElementById('paymentRoomDetails');
    var paymentMethods = document.querySelectorAll('.checkout-payment-method[data-payment-method]');
    var cardForm = document.getElementById('checkoutCardPaymentForm');
    var paypalBox = document.getElementById('checkoutPaypalPaymentBox');
    var continueBox = document.getElementById('checkoutPaymentContinueBox');
    var paypalButtonsRendered = false;
    var paypalStatusMessage = document.getElementById('paypal-status-message');
    var reservaId = <?php echo json_encode($reservaId); ?>;
    var paypalAmount = <?php echo json_encode($payPalAmount); ?>;
    var paypalCurrency = <?php echo json_encode($payPalCurrency); ?>;

    if (roomToggle && roomDetails) {
        var roomToggleText = roomToggle.querySelector('span');

        function updateRoomToggleLabel() {
            var expanded = roomDetails.classList.contains('show');
            roomToggleText.textContent = expanded ? 'Ocultar detalles de habitacion' : 'Mostrar detalles de habitacion';
        }

        roomDetails.addEventListener('shown.bs.collapse', updateRoomToggleLabel);
        roomDetails.addEventListener('hidden.bs.collapse', updateRoomToggleLabel);
        updateRoomToggleLabel();
    }

    function renderPaypalButtons() {
        if (paypalButtonsRendered || !paypalBox || typeof paypal === 'undefined') {
            return;
        }

        var paypalContainer = document.getElementById('paypal-button-container');
        if (!paypalContainer) {
            return;
        }

        paypal.Buttons({
            style: {
                layout: 'vertical',
                color: 'blue',
                shape: 'rect',
                label: 'paypal'
            },
            createOrder: function () {
                return fetch('ajax.php?accion=paypal-create-order', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        amount: paypalAmount
                    })
                })
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    if (!data.ok || !data.id) {
                        throw new Error(data.mensaje || 'No se pudo crear la orden PayPal.');
                    }

                    return data.id;
                });
            },
            onApprove: function (data) {
                return fetch('ajax.php?accion=paypal-capture-order', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        orderID: data.orderID
                    })
                })
                .then(function (response) {
                    return response.json();
                })
                .then(function (captureResponse) {
                    if (!captureResponse.ok) {
                        throw new Error(captureResponse.mensaje || 'No se pudo capturar el pago PayPal.');
                    }

                    var paypalCapture = (((captureResponse || {}).capture || {}).purchase_units || [])
                        .map(function (unit) {
                            return unit && unit.payments && Array.isArray(unit.payments.captures)
                                ? unit.payments.captures[0]
                                : null;
                        })
                        .filter(function (capture) {
                            return capture !== null;
                        })[0] || null;

                    var respuestaPasarela = paypalCapture ? {
                        payments: {
                            captures: [
                                {
                                    id: paypalCapture.id || '',
                                    status: paypalCapture.status || '',
                                    amount: paypalCapture.amount || {
                                        currency_code: paypalCurrency,
                                        value: paypalAmount
                                    }
                                }
                            ]
                        }
                    } : {
                        payments: {
                            captures: []
                        }
                    };

                    return fetch('ajax.php?accion=procesar-pago', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            reserva_id: reservaId,
                            metodo_pago: 'paypal',
                            monto: paypalAmount,
                            moneda: paypalCurrency,
                            referencia: data.orderID,
                            estado: 'aprobado',
                            es_simulado: 1,
                            fecha_pago: new Date().toISOString().slice(0, 19).replace('T', ' '),
                            respuesta_pasarela: respuestaPasarela
                        })
                    })
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (paymentResponse) {
                        if (!paymentResponse.ok) {
                            throw new Error(paymentResponse.mensaje || 'No se pudo guardar el pago aprobado.');
                        }

                        if (paypalStatusMessage) {
                            paypalStatusMessage.className = 'checkout-payment-status checkout-payment-status-success mt-3';
                            paypalStatusMessage.textContent = 'Pago aprobado correctamente.';
                        }

                        window.setTimeout(function () {
                            window.location.reload();
                        }, 1500);
                    });
                });
            },
            onError: function (error) {
                //TODO: Si PayPal devuelve error o la captura falla, aqui mandar a llamar al backend que use Pago->guardar(...)
                // con estado = 'rechazado' para dejar historial del intento de pago fallido.
                if (paypalStatusMessage) {
                    paypalStatusMessage.className = 'checkout-payment-status checkout-payment-status-error mt-3';
                    paypalStatusMessage.textContent = error.message || 'Ocurrio un error al procesar PayPal.';
                }
            }
        }).render('#paypal-button-container');

        paypalButtonsRendered = true;
    }

    if (paymentMethods.length && cardForm) {
        var cardFormCollapse = bootstrap.Collapse.getOrCreateInstance(cardForm, {
            toggle: false
        });
        var paypalBoxCollapse = paypalBox ? bootstrap.Collapse.getOrCreateInstance(paypalBox, {
            toggle: false
        }) : null;

        function setActivePayment(method) {
            paymentMethods.forEach(function (button) {
                var isActive = button.getAttribute('data-payment-method') === method;
                button.classList.toggle('active', isActive);
            });

            if (method === 'card') {
                cardFormCollapse.show();
            } else {
                cardFormCollapse.hide();
            }

            if (paypalBoxCollapse) {
                if (method === 'paypal') {
                    paypalBoxCollapse.show();
                    renderPaypalButtons();
                } else {
                    paypalBoxCollapse.hide();
                }
            }

            if (continueBox) {
                var showContinue = method === 'card';
                continueBox.classList.toggle('d-none', !showContinue);
            }
        }

        paymentMethods.forEach(function (button) {
            button.addEventListener('click', function () {
                setActivePayment(this.getAttribute('data-payment-method'));
            });
        });

        setActivePayment('destination');
    }
});
</script>

<?php
include 'views/layouts/footer_motor.php';
?>
