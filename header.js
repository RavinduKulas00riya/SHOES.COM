let listDiv = document.getElementById('header-list');
let searchDiv = document.getElementById('search-bar');

let listShown = false;
let searchBarShown = false;

function dropdown() {

    if (searchBarShown) {
        searchBar();
    }

    if (listShown) {

        listDiv.style.height = "0";
        listDiv.style.paddingTop = "0";
        listDiv.style.paddingBottom = "0";
        setTimeout(() => {
            listDiv.style.display = "none";
        }, 300);
        listShown = false;

    } else {

        listDiv.style.display = "flex";

        setTimeout(() => {
            listDiv.style.height = "456.5px";
            listDiv.style.paddingTop = "20px";
            listDiv.style.paddingBottom = "20px";
        }, 10);

        listShown = true;
    }
}

function searchBar() {

    if (listShown) {
        dropdown();
    }

    if (searchBarShown) {

        searchDiv.style.height = "0";
        searchDiv.style.marginTop = "0";
        searchDiv.style.marginBottom = "0";
        setTimeout(() => {
            searchDiv.style.display = "none";
        }, 250);
        searchBarShown = false;

    } else {

        searchDiv.style.display = "flex";

        setTimeout(() => {
            searchDiv.style.height = "40px";
            searchDiv.style.marginTop = "20px";
            searchDiv.style.marginBottom = "20px";
        }, 10);

        searchBarShown = true;
    }
}