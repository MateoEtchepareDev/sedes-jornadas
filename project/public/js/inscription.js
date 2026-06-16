const mercadoPagoPublicKey = window.mercadoPagoPublicKey || '';
const mp = mercadoPagoPublicKey ? new MercadoPago(mercadoPagoPublicKey) : null;
const form = document.getElementById('inscription-form');

function showError(message) {
    Swal.fire({
        title: 'Error!',
        text: message,
        icon: 'error',
        confirmButtonText: 'Aceptar'
    });
}

if (form) {
    form.addEventListener('submit', function(event) {
        const paymentMethodInput = document.querySelector('input[name="payment_method"]:checked');
        if (!paymentMethodInput) {
            event.preventDefault();
            showError('Selecciona un método de pago.');
            return;
        }

        if (paymentMethodInput.value !== 'mercado_pago') {
            return;
        }

        event.preventDefault();

        if (!mp) {
            showError('No se pudo iniciar Mercado Pago. Intenta de nuevo más tarde.');
            return;
        }

        const fullName = document.querySelector('input[name="full_name"]').value.trim();
        const dni = document.querySelector('input[name="dni"]').value.trim();
        const email = document.querySelector('input[name="email"]').value.trim();
        const role = document.querySelector('select[name="role"]').value;
        const modalityInput = document.querySelector('input[name="modality"]:checked');
        const eventId = document.querySelector('input[name="event_id"]').value;
        const paymentStatus = document.querySelector('input[name="payment_status"]').value;

        if (!fullName || !dni || !email || !role || !modalityInput) {
            showError('Por favor, completa todos los campos del formulario.');
            return;
        }

        const [name, ...surnameParts] = fullName.split(' ');
        const surname = surnameParts.join(' ');

        const orderData = {
            product: [{
                id: eventId,
                title: `Inscripción evento ${eventId}`,
                description: 'Inscripción a jornada',
                currency_id: 'ARS',
                quantity: 500,
                unit_price: 1,
            }],
            name: name,
            surname: surname,
            email: email,
            phone: '',
            address: '',
            full_name: fullName,
            dni: dni,
            role: role,
            modality: modalityInput.value,
            payment_method: paymentMethodInput.value,
            event_id: eventId,
            payment_status: paymentStatus,
        };

        fetch('/create-preference', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(orderData)
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(body => Promise.reject(body.error || 'Error en la respuesta del servidor'));
            }
            return response.json();
        })
        .then(preference => {
            if (preference.error) {
                return Promise.reject(preference.error);
            }

            mp.checkout({
                preference: {
                    id: preference.id
                },
                autoOpen: true
            });
            
        })
        .catch(error => {
            console.error('Error al crear la preferencia:', error);
            showError(typeof error === 'string' ? error : 'No se pudo iniciar el pago.');
        });
    });
}