let currentPage = 1;

function setCurrentPage(page) {
    currentPage = page;
    loadShop();
}

function getCurrentPage() {
    return currentPage;
}

// function test(){
//     var category = document.getElementById("category").value;
// }

function loadShop() {

    var f = new FormData();
    f.append("category", document.getElementById("category").value);
    f.append("brand", document.getElementById("brand").value);
    f.append("size", document.getElementById("size").value);
    f.append("gender", document.getElementById("gender").value);
    f.append("color", document.getElementById("color").value);
    f.append("sort", document.getElementById("sort").value);
    f.append("currentPage", currentPage);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = JSON.parse(r.responseText);
            renderItems(t.items);
            renderPagination(t.totalItems, currentPage);
            console.log(r.responseText);
        }
    };

    r.open("POST", "loadShop.php", true);
    r.send(f);
}

function renderItems(items) {

    const shopContentDiv = document.querySelector('.shop-content');
    shopContentDiv.innerHTML = "";

    items.forEach(item => {

        const shopItemDiv = document.createElement('div');
        shopItemDiv.className = 'shop-item';
        shopItemDiv.onclick = function () {
            window.location.href = 'singleProductView.php?id=' + item.shoe_id;
        };

        const img = document.createElement('img');
        img.src = 'resources/' + item.shoe_id + '.jpg';
        shopItemDiv.appendChild(img);

        const shopItemDetailsDiv = document.createElement('div');
        shopItemDetailsDiv.className = 'shop-item-details';

        const productNameSpan = document.createElement('span');
        productNameSpan.className = 'bold';
        productNameSpan.textContent = item.shoe_name;
        shopItemDetailsDiv.appendChild(productNameSpan);

        const brandPriceSpan = document.createElement('span');
        brandPriceSpan.className = 'medium text-muted';
        brandPriceSpan.innerHTML = item.brand_name + ' | <span class="bold text-black">LKR ' + new Intl.NumberFormat('en-US', {
            style: 'decimal',
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }).format(item.price); +'</span>';
        shopItemDetailsDiv.appendChild(brandPriceSpan);

        const availabilitySpan = document.createElement('span');

        if (item.qty == 0) {
            availabilitySpan.className = 'medium text-danger';
            availabilitySpan.textContent = 'Out of Stock';
        } else {
            availabilitySpan.className = 'medium text-muted';
            availabilitySpan.textContent = item.qty + ' Available';

        }

        shopItemDetailsDiv.appendChild(availabilitySpan);

        // const button = document.createElement('button');
        // button.className = 'medium text-white';
        // button.onclick = function() {
        //     window.location.href = 'singleProductView.php?id='+item.shoe_id;
        // };
        // const icon = document.createElement('i');
        // icon.className = 'bi bi-cart-fill text-white fs-4';
        // button.appendChild(icon);
        // shopItemDetailsDiv.appendChild(button);

        shopItemDiv.appendChild(shopItemDetailsDiv);
        shopContentDiv.appendChild(shopItemDiv);
    });
}

function renderPagination(totalItems, currentPage) {
    const totalPages = Math.ceil(totalItems / 6);
    const paginationDiv = document.getElementById('pagination');
    let buttons = '';

    if (currentPage > 1) {
        buttons += `<button onclick="setCurrentPage(getCurrentPage() - 1)" class="inactive-btn"><i class="bi bi-arrow-left"></i></button>`;
    }

    for (let i = 1; i <= totalPages; i++) {
        buttons += `<button onclick="setCurrentPage(${i})" class="${i === currentPage ? 'active-btn' : 'inactive-btn'}">${i}</button>`;
    }

    if (totalPages > currentPage) {
        buttons += `<button onclick="setCurrentPage(getCurrentPage() + 1)" class="inactive-btn"><i class="bi bi-arrow-right"></i></button>`;
    }

    paginationDiv.innerHTML = buttons;
}

function reset() {
    document.getElementById("category").value = 0;
    document.getElementById("brand").value = 0;
    document.getElementById("size").value = 0;
    document.getElementById("gender").value = 0;
    document.getElementById("color").value = 0;
    document.getElementById("sort").value = 0;
    setCurrentPage(1);
}