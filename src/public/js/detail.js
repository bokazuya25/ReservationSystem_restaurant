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

document.addEventListener("DOMContentLoaded", function() {
  // すべてのrating__star要素を取得
    const stars = document.querySelectorAll('.rating__star');

    stars.forEach(star => {
    // data-rate属性の値を取得
    const rate = parseFloat(star.getAttribute('data-rate'));
    // 幅を計算（例：4.8 => 96%）
    const width = Math.floor((rate / 5) * 100);
    // ::after疑似要素に直接スタイルを適用するのは難しいため、インラインスタイルを使用
    star.style.setProperty('--star-width', `${width}%`);
    });
});
