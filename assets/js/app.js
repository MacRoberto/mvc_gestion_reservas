console.log('Proyecto MVC escolar cargado');

document.addEventListener('DOMContentLoaded', function () {
    var pwd1 = document.getElementById('pwd1');
    var pwd2 = document.getElementById('pwd2');
    var mensaje = document.getElementById('mensaje-password');
    var boton = document.getElementById('btn-check-pwd');
    var toggle = document.getElementById('toggle-change-password');
    var currentPwd = document.getElementById('current-pwd');
    var mensajeActualizacion = document.getElementById('mensaje-actualizacion');

    if (!pwd1 || !pwd2 || !mensaje || !boton) {
        return;
    }

    function validarPasswords() {
        var valor1 = pwd1.value;
        var valor2 = pwd2.value;
        var limpio1 = valor1.trim();
        var limpio2 = valor2.trim();
        var esEdicion = !!toggle;

        if (esEdicion && !toggle.checked) {
            mensaje.textContent = '';
            boton.disabled = false;
            return;
        }

        if (mensajeActualizacion) {
            mensajeActualizacion.textContent = '';
        }
        
        if (limpio1.length < 3 || limpio2.length < 3) {
            mensaje.textContent = 'La contraseña debe tener minimo 3 digitos y no debe estar vacia.';
            boton.disabled = true;
            return;
        }

        if (valor1 !== valor2) {
            mensaje.textContent = 'Las contraseñas no coinciden.';
            boton.disabled = true;
            return;
        }

        if (esEdicion && currentPwd && currentPwd.value.trim() === '') {
            mensaje.textContent = 'Debes escribir la contraseña actual.';
            boton.disabled = true;
            return;
        }

        mensaje.textContent = '';
        boton.disabled = false;
    }

    function actualizarEstadoCambioPassword() {
        if (!toggle) {
            validarPasswords();
            return;
        }

        var habilitar = toggle.checked;

        if (currentPwd) {
            currentPwd.disabled = !habilitar;
        }

        pwd1.disabled = !habilitar;
        pwd2.disabled = !habilitar;

        if (!habilitar) {
            if (currentPwd) {
                currentPwd.value = '';
            }
            pwd1.value = '';
            pwd2.value = '';
        }

        validarPasswords();
    }

    pwd1.addEventListener('input', validarPasswords);
    pwd2.addEventListener('input', validarPasswords);

    if (currentPwd) {
        currentPwd.addEventListener('input', validarPasswords);
    }

    if (toggle) {
        toggle.addEventListener('change', actualizarEstadoCambioPassword);
        actualizarEstadoCambioPassword();
        return;
    }

    validarPasswords();
});

document.addEventListener('DOMContentLoaded', function () {
    function initGuestPicker(picker) {
        var trigger = picker.querySelector('[data-guest-trigger]');
        var display = picker.querySelector('[data-guest-display]');
        var input = picker.querySelector('[data-guest-input]');
        var popover = picker.querySelector('[data-guest-popover]');
        var cancelButton = picker.querySelector('[data-guest-cancel]');
        var applyButton = picker.querySelector('[data-guest-apply]');

        if (!trigger || !display || !input || !popover || !cancelButton || !applyButton) {
            return;
        }

        function parseState(texto) {
            var valor = String(texto || '').toLowerCase();
            var adults = (valor.match(/(\d+)\s*adult/) || [null, 1])[1];
            var minors = (valor.match(/(\d+)\s*(?:menor|nino|niño|niño)/) || [null, 0])[1];
            var rooms = (valor.match(/(\d+)\s*habit/) || [null, 1])[1];

            return {
                adultos: parseInt(adults, 10) || 1,
                menores: parseInt(minors, 10) || 0,
                habitaciones: parseInt(rooms, 10) || 1
            };
        }

        function formatLabel(state) {
            var partes = [];
            partes.push(state.adultos + ' ' + (state.adultos === 1 ? 'adulto' : 'adultos'));
            if (state.menores > 0) {
                partes.push(state.menores + ' ' + (state.menores === 1 ? 'niño' : 'niños'));
            }
            partes.push(state.habitaciones + ' ' + (state.habitaciones === 1 ? 'habitación' : 'habitaciones'));
            return partes.join(', ');
        }

        var committed = parseState(input.value);
        var draft = Object.assign({}, committed);

        function syncUi() {
            picker.querySelectorAll('[data-guest-key]').forEach(function (row) {
                var key = row.getAttribute('data-guest-key');
                var value = draft[key];
                var valueNode = row.querySelector('[data-guest-value]');
                var buttons = row.querySelectorAll('[data-guest-action]');
                var max = 5;
                if (valueNode) {
                    valueNode.textContent = value;
                }
                buttons.forEach(function (button) {
                    var isMinus = button.getAttribute('data-guest-action') === 'minus';
                    var isPlus = button.getAttribute('data-guest-action') === 'plus';
                    var min = key === 'menores' ? 0 : 1;
                    button.disabled = isMinus && value <= min;
                    button.classList.toggle('is-disabled', isMinus && value <= min);
                    if (isPlus && value >= max) {
                        button.disabled = true;
                        button.classList.add('is-disabled');
                    }
                });
            });
        }

        function commit() {
            committed = Object.assign({}, draft);
            var texto = formatLabel(committed);
            input.value = texto;
            display.textContent = texto;
        }

        function openPopover() {
            draft = Object.assign({}, committed);
            syncUi();
            popover.classList.remove('d-none');
            trigger.setAttribute('aria-expanded', 'true');
        }

        function closePopover() {
            popover.classList.add('d-none');
            trigger.setAttribute('aria-expanded', 'false');
        }

        trigger.addEventListener('click', function () {
            if (popover.classList.contains('d-none')) {
                openPopover();
            } else {
                closePopover();
            }
        });

        popover.addEventListener('click', function (event) {
            event.stopPropagation();
        });

        picker.querySelectorAll('[data-guest-key]').forEach(function (row) {
            row.querySelectorAll('[data-guest-action]').forEach(function (button) {
                button.addEventListener('click', function () {
                    var key = row.getAttribute('data-guest-key');
                    var action = this.getAttribute('data-guest-action');
                    var min = key === 'menores' ? 0 : 1;
                    var max = 5;
                    draft[key] = draft[key] || min;
                    if (action === 'plus' && draft[key] < max) {
                        draft[key] += 1;
                    } else if (draft[key] > min) {
                        draft[key] -= 1;
                    }
                    syncUi();
                });
            });
        });

        cancelButton.addEventListener('click', function () {
            draft = Object.assign({}, committed);
            syncUi();
            closePopover();
        });

        applyButton.addEventListener('click', function () {
            commit();
            closePopover();
        });

        document.addEventListener('click', function (event) {
            if (!picker.contains(event.target)) {
                closePopover();
            }
        });

        commit();
        syncUi();
    }

    function initDateRangePicker(picker) {
        var trigger = picker.querySelector('[data-date-trigger]');
        var display = picker.querySelector('[data-date-display]');
        var popover = picker.querySelector('[data-date-popover]');
        var monthsContainer = picker.querySelector('[data-calendar-months]');
        var checkinInput = picker.querySelector('[data-checkin-input]');
        var checkoutInput = picker.querySelector('[data-checkout-input]');
        var prevButton = picker.querySelector('[data-calendar-nav="prev"]');
        var nextButton = picker.querySelector('[data-calendar-nav="next"]');

        if (!trigger || !display || !popover || !monthsContainer || !checkinInput || !checkoutInput || !prevButton || !nextButton) {
            return;
        }

        var monthNames = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        var weekNames = ['lun', 'mar', 'mie', 'jue', 'vie', 'sab', 'dom'];

        function parseDate(value) {
            if (!value) {
                return null;
            }

            value = String(value).trim();
            var parts = value.split('-');
            if (parts.length === 3) {
                return new Date(Number(parts[0]), Number(parts[1]) - 1, Number(parts[2]));
            }

            var parsed = new Date(value);
            if (isNaN(parsed.getTime())) {
                return null;
            }

            return new Date(parsed.getFullYear(), parsed.getMonth(), parsed.getDate());
        }

        function formatInputValue(date) {
            var year = date.getFullYear();
            var month = String(date.getMonth() + 1).padStart(2, '0');
            var day = String(date.getDate()).padStart(2, '0');
            return year + '-' + month + '-' + day;
        }

        function formatDisplayValue(date) {
            var day = String(date.getDate()).padStart(2, '0');
            var month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'][date.getMonth()];
            return day + ' ' + month + ' ' + date.getFullYear();
        }

        function monthStart(date) {
            return new Date(date.getFullYear(), date.getMonth(), 1);
        }

        function addMonths(date, amount) {
            return new Date(date.getFullYear(), date.getMonth() + amount, 1);
        }

        function startOfWeek(date) {
            var result = new Date(date);
            var day = result.getDay();
            var diff = day === 0 ? -6 : 1 - day;
            result.setDate(result.getDate() + diff);
            return result;
        }

        function sameDate(a, b) {
            return a && b
                && a.getFullYear() === b.getFullYear()
                && a.getMonth() === b.getMonth()
                && a.getDate() === b.getDate();
        }

        function betweenDates(date, start, end) {
            if (!start || !end) {
                return false;
            }

            return date > start && date < end;
        }

        var defaultCheckin = parseDate(checkinInput.value) || new Date(2026, 3, 15);
        var defaultCheckout = parseDate(checkoutInput.value) || new Date(defaultCheckin.getFullYear(), defaultCheckin.getMonth(), defaultCheckin.getDate() + 4);
        var state = {
            checkin: defaultCheckin,
            checkout: defaultCheckout,
            visibleMonth: monthStart(defaultCheckin),
            selecting: 'checkin',
            draftCheckin: null
        };

        function syncInputs() {
            var displayCheckin = state.draftCheckin || state.checkin;
            var displayCheckout = state.draftCheckin ? null : state.checkout;

            checkinInput.value = formatInputValue(displayCheckin);
            checkoutInput.value = displayCheckout ? formatInputValue(displayCheckout) : '';
            display.textContent = formatDisplayValue(displayCheckin) + ' - ' + (displayCheckout ? formatDisplayValue(displayCheckout) : 'Selecciona salida');
        }

        function renderMonth(baseDate) {
            var monthDate = monthStart(baseDate);
            var gridStart = startOfWeek(monthDate);
            var html = ''
                + '<div class="search-filter-calendar-month">'
                + '<div class="search-filter-calendar-title">' + monthNames[monthDate.getMonth()] + ' <span>' + monthDate.getFullYear() + '</span></div>'
                + '<div class="search-filter-calendar-weekdays">';

            weekNames.forEach(function (dayName) {
                html += '<span>' + dayName + '</span>';
            });

            html += '</div><div class="search-filter-calendar-days">';

            for (var i = 0; i < 42; i++) {
                var current = new Date(gridStart);
                current.setDate(gridStart.getDate() + i);

                var classes = ['search-filter-calendar-day'];
                if (current.getMonth() !== monthDate.getMonth()) {
                    classes.push('is-outside');
                }

                var activeCheckin = state.draftCheckin || state.checkin;

                if (sameDate(current, activeCheckin)) {
                    classes.push('is-start');
                }
                if (!state.draftCheckin && sameDate(current, state.checkout)) {
                    classes.push('is-end');
                }
                if (!state.draftCheckin && betweenDates(current, state.checkin, state.checkout)) {
                    classes.push('is-in-range');
                }

                html += '<button type="button" class="' + classes.join(' ') + '" data-calendar-date="' + formatInputValue(current) + '">' + current.getDate() + '</button>';
            }

            html += '</div></div>';
            return html;
        }

        function closePopover() {
            popover.classList.add('d-none');
            trigger.setAttribute('aria-expanded', 'false');
        }

        function renderCalendar() {
            monthsContainer.innerHTML = renderMonth(state.visibleMonth) + renderMonth(addMonths(state.visibleMonth, 1));
            monthsContainer.querySelectorAll('[data-calendar-date]').forEach(function (button) {
                button.addEventListener('click', function () {
                    var selectedDate = parseDate(this.getAttribute('data-calendar-date'));
                    if (!selectedDate) {
                        return;
                    }

                    if (state.selecting === 'checkin') {
                        state.draftCheckin = selectedDate;
                        state.selecting = 'checkout';
                        syncInputs();
                    } else {
                        if (selectedDate <= state.draftCheckin) {
                            state.draftCheckin = selectedDate;
                            syncInputs();
                            renderCalendar();
                            return;
                        }

                        state.checkin = state.draftCheckin;
                        state.checkout = selectedDate;
                        state.draftCheckin = null;
                        state.selecting = 'checkin';
                        syncInputs();
                        closePopover();
                    }

                    renderCalendar();
                });
            });
        }

        function openPopover() {
            state.draftCheckin = null;
            state.selecting = 'checkin';
            popover.classList.remove('d-none');
            trigger.setAttribute('aria-expanded', 'true');
            renderCalendar();
        }

        trigger.addEventListener('click', function () {
            if (popover.classList.contains('d-none')) {
                openPopover();
            } else {
                closePopover();
            }
        });

        popover.addEventListener('click', function (event) {
            event.stopPropagation();
        });

        prevButton.addEventListener('click', function () {
            state.visibleMonth = addMonths(state.visibleMonth, -1);
            renderCalendar();
        });

        nextButton.addEventListener('click', function () {
            state.visibleMonth = addMonths(state.visibleMonth, 1);
            renderCalendar();
        });

        document.addEventListener('click', function (event) {
            if (!picker.contains(event.target)) {
                closePopover();
            }
        });

        syncInputs();
    }

    document.querySelectorAll('[data-guest-picker]').forEach(initGuestPicker);
    document.querySelectorAll('[data-date-picker], [data-date-picker-main]').forEach(initDateRangePicker);
});

document.addEventListener('DOMContentLoaded', function () {
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

    function initHotelSearch(input) {
        var wrapper = input.parentElement;
        var resultados = wrapper ? wrapper.querySelector('[data-hotel-search-results]') : null;
        var timeoutId = null;
        var controller = null;
        var selectionLocked = false;

        if (!resultados) {
            return;
        }

        function ocultarResultados() {
            resultados.classList.add('d-none');
            resultados.innerHTML = '';
        }

        function pintarResultados(hoteles) {
            if (!hoteles || hoteles.length === 0) {
                resultados.innerHTML = '<div class="ajax-search-empty">No se encontraron hoteles disponibles.</div>';
                resultados.classList.remove('d-none');
                return;
            }

            resultados.innerHTML = hoteles.map(function (hotel) {
                var ubicacion = [hotel.ciudad, hotel.pais].filter(Boolean).join(', ');

                return ''
                    + '<button type="button" class="ajax-search-item" data-hotel-name="' + escaparHtmlAjaxHotel(hotel.nombre) + '">'
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
                    selectionLocked = true;
                    input.value = this.getAttribute('data-hotel-name') || '';
                    ocultarResultados();
                    input.blur();
                });
            });
        }

        async function ejecutarBusqueda(valor) {
            var termino = String(valor || '').trim();

            if (termino.length < 2) {
                ocultarResultados();
                return;
            }

            if (controller) {
                controller.abort();
            }

            controller = new AbortController();

            try {
                var respuesta = await fetch('ajax.php?accion=buscar-hoteles&termino=' + encodeURIComponent(termino), {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    signal: controller.signal
                });

                if (!respuesta.ok) {
                    throw new Error('No se pudo consultar la disponibilidad.');
                }

                var data = await respuesta.json();
                pintarResultados(data.hoteles || []);
            } catch (error) {
                if (error.name === 'AbortError') {
                    return;
                }

                resultados.innerHTML = '<div class="ajax-search-empty">Ocurrio un error al consultar hoteles.</div>';
                resultados.classList.remove('d-none');
            }
        }

        input.addEventListener('input', function () {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(function () {
                ejecutarBusqueda(input.value);
            }, 250);
        });

        input.addEventListener('focus', function () {
            if (selectionLocked) {
                selectionLocked = false;
                return;
            }

            if (input.value.trim().length >= 2) {
                ejecutarBusqueda(input.value);
            }
        });

        document.addEventListener('click', function (event) {
            if (!resultados.contains(event.target) && event.target !== input) {
                ocultarResultados();
            }
        });
    }

    document.querySelectorAll('[data-hotel-search-input]').forEach(initHotelSearch);
});
