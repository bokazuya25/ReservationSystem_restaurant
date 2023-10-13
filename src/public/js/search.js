document.addEventListener("DOMContentLoaded", function () {
    const areaSelect = document.querySelector("[name='area']");
    const genreSelect = document.querySelector("[name='genre']");
    const wordInput = document.querySelector("[name='word']");
    const shopWrap = document.querySelector(".shop__wrap");

    function escapeHTML(str) {
        const div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }

    function generateFavoriteButton(shop, isLoggedIn, favorites) {
        if (isLoggedIn) {
            if (favorites.includes(shop.id)) {
                return `
                    <form action="/favorite/destroy/${shop.id}" method="post" class="shop__button-favorite">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="shop__button-favorite-btn--red"></button>
                    </form>`;
            } else {
                return `
                    <form action="/favorite/store/${shop.id}" method="post" class="shop__button-favorite">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <button type="submit" class="shop__button-favorite-btn"></button>
                    </form>`;
            }
        } else {
            return `<button type="button" onclick="location.href='/login'" class="shop__button-favorite-btn"></button>`;
        }
    }

    function fetchShops() {
        const area = areaSelect.value;
        const genre = genreSelect.value;
        const word = wordInput.value;

        fetch(`/search?area=${area}&genre=${genre}&word=${word}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then(data => {
                shopWrap.innerHTML = "";

                data.shops.forEach(shop => {
                    const favoriteButton = generateFavoriteButton(shop, data.isLoggedIn, data.favorites);
                    let shopElement = `
                        <div class="shop__content">
                            <img class="shop__image" src="${escapeHTML(shop.image_url)}" alt="Shop Image of ${escapeHTML(shop.name)}">
                            <div class="shop__item">
                                <span class="shop__title">${escapeHTML(shop.name)}</span>
                                <div class="shop__tag">
                                    <p class="shop__tag-info">#${escapeHTML(shop.area.area)}</p>
                                    <p class="shop__tag-info">#${escapeHTML(shop.genre.genre)}</p>
                                </div>
                                <div class="shop__button">
                                    <a href="/detail/${shop.id}?from=index" class="shop__button-detail">詳しくみる</a>
                                    ${favoriteButton}
                                </div>
                            </div>
                        </div>`;
                    shopWrap.insertAdjacentHTML("beforeend", shopElement);
                });
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error.message);
            });
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    areaSelect.addEventListener("change", fetchShops);
    genreSelect.addEventListener("change", fetchShops);
    wordInput.addEventListener("input", fetchShops);
});
