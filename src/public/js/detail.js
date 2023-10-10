document.addEventListener("DOMContentLoaded", function () {
    let dateInput = document.querySelector('input[name="date"]');
    let timeSelect = document.querySelector('select[name="time"]');
    let numberSelect = document.querySelector('select[name="number"]');

    let dateId = document.getElementById('dateId');
    let timeId = document.getElementById('timeId');
    let numberId = document.getElementById('numberId');

    dateInput.addEventListener('change', function () {
        dateId.textContent = dateInput.value;
    });

    timeSelect.addEventListener('change', function () {
        timeId.textContent = timeSelect.options[timeSelect.selectedIndex].text;
    });

    numberSelect.addEventListener('change', function () {
        numberId.textContent = numberSelect.options[numberSelect.selectedIndex].text;
    });
})