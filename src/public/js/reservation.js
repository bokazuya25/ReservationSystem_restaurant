document.addEventListener("DOMContentLoaded", function () {

    function confirmReservation() {
        return confirm('本当に予約しますか？');
    }

    let reservationButton = document.querySelector('.reservation__button-btn');
    if (reservationButton) {
        reservationButton.addEventListener('click', function (event) {
            if (!confirmReservation()) {
                event.preventDefault();
            }
        });
    };

    function confirmCancel() {
        return confirm('本当に予約をキャンセルしますか？');
    }

    let cancelButtons = document.querySelectorAll('.form__button--cancel');
    cancelButtons.forEach(function (cancelButton) {
        cancelButton.addEventListener('click', function (event) {
            if (!confirmCancel()) {
                event.preventDefault();
            }
        });
    })

    function confirmEdit() {
        return confirm('予約内容を変更しますか？');
    }

    let editButtons = document.querySelectorAll('.form__button--edit');
    editButtons.forEach(function (editButton) {
        editButton.addEventListener('click', function (event) {
            if (!confirmEdit()) {
                event.preventDefault();
            }
        });
    })
});