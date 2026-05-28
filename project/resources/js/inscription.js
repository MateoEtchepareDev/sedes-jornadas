document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("inscriptionForm");

    const successMessage = document.getElementById("successMessage");

    form.addEventListener("submit", function (e) {

        const paymentMethod = document.querySelector(
            'input[name="payment_method"]:checked'
        );

        if (!paymentMethod) {
            return;
        }

        if (paymentMethod.value === "cash") {

            e.preventDefault();

            form.style.display = "none";

            successMessage.style.display = "block";
        }

        if (paymentMethod.value === "mercadopago") {

            form.action = "/pagar";
        }

    });

});