$(document).ready(function () {
    if ($('#sameBillingCheckbox').is(':checked')) {
        $('#billingForm').hide();
    }

    $('#sameBillingCheckbox').on('change', function () {
        if ($(this).is(':checked')) {
            $('#billingForm').hide();
        } else {
            $('#billingForm').show();
        }
    });

    $('#cardNameValid, #cardNumValid, #expData, #cvcValid').hide();

    $('#sameBillingCheckbox').on('change', function () {
        if ($(this).is(':checked')) {
            $('#billingForm').hide();
        } else {
            $('#billingForm').show();
        }
    });

    $('#paymentForm').submit(function (e) {
        e.preventDefault();

        var cardName = $('#card_name').val().trim();
        if (cardName === '') {
            $('#cardNameValid').text('Please enter the card name.').show();
            return false;
        } else {
            $('#cardNameValid').text('').hide();
        }

        var cardNumber = $('#card_number').val().trim();
        if (cardNumber === '' || !isValidCardNumber(cardNumber)) {
            $('#cardNumValid').text('Please enter a valid card number.').show();
            return false;
        } else {
            $('#cardNumValid').text('').hide();
        }

        var expiration = $('#expiration').val().trim();
        if (expiration === '') {
            $('#expData').text('Please enter the expiration date.').show();
            return false;
        } else {
            $('#expData').text('').hide();
        }

        var cvc = $('#cvc').val().trim();
        if (cvc === '') {
            $('#cvcValid').text('Please enter the CVC.').show();
            return false;
        } else {
            $('#cvcValid').text('').hide();
        }

        this.submit();
    });

    function isValidCardNumber(cardNumber) {
        return /^\d{16}$/.test(cardNumber);
    }
});
