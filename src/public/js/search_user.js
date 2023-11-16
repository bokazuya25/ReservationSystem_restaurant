document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('roles').addEventListener('change', function () {
        var roleId = this.value;
        fetch('/admin/search-users/index?role_id=' + roleId)
            .then(response => response.json())
            .then(data => {
                var tbody = document.querySelector('.user__table tbody');
                tbody.innerHTML = '';

                data.forEach(user => {
                    var tr = document.createElement('tr');

                    var roles = user.roles.map(role => role.name).join(',');
                    if (!roles) roles = 'user';

                    tr.innerHTML = `
                        <td class="table__data">${user.id}</td>
                        <td class="table__data">${user.name}</td>
                        <td class="table__data data-email">${user.email}</td>
                        <td class="table__data">${roles}</td>
                    `;

                    tbody.appendChild(tr);
                });

                updatePaginationControls(response);
            })
    })
})

function updatePaginationControls(response) {
    var paginationContainer = document.getElementById('pagination-controls');
    paginationContainer.innerHTML = '';

    if (response.last_page > 1) {
        var ul = document.createElement('ul');
        ul.className = 'pagination__nav';

        // 前のページリンク
        if (response.current_page > 1) {
            ul.appendChild(createPageItem(response.prev_page_url, '‹', false));
        }

        // ページ番号リンク
        for (var page = 1; page <= response.last_page; page++) {
            var url = response.path + '?page=' + page;
            var isActive = response.current_page === page;
            ul.appendChild(createPageItem(url, page, isActive));
        }

        // 次のページリンク
        if (response.current_page < response.last_page) {
            ul.appendChild(createPageItem(response.next_page_url, '›', false));
        }

        paginationContainer.appendChild(ul);
    }
}

function createPageItem(url, text, isActive) {
    var li = document.createElement('li');
    li.className = 'pagination__list';

    var a = document.createElement('a');
    a.className = 'pagination__item';
    a.href = isActive ? '#' : url;
    a.textContent = text;

    if (isActive) {
        a.classList.add('active');
    }

    a.addEventListener('click', function (event) {
        if (!isActive) {
            event.preventDefault();
            loadPage(url);
        }
    });

    li.appendChild(a);
    return li;
}
