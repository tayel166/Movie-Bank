class Person {
    constructor(img, name) {
        this.img = img;
        this.name = name;
    }
}

class Item {
    constructor(id, title, overview, img, rate, language) {
        this.id = id;
        this.title = title;
        this.overview = overview;
        this.img = img;
        this.rate = rate;
        this.language = language;
    }
}

function slideright_cast() {
    document.getElementById('casts-cards-id').scrollLeft += 260;
};

function slideleft_cast() {
    document.getElementById('casts-cards-id').scrollLeft -= 260;
};


function slideright_crew() {
    document.getElementById('crew-cards-id').scrollLeft += 260;
};

function slideleft_crew() {
    document.getElementById('crew-cards-id').scrollLeft -= 260;
};

function reveal() {
    var reveals = document.querySelectorAll(".reveal");
    for (var i = 0; i < reveals.length; i++) {
        var windowHeight = window.innerHeight;
        var elementTop = reveals[i].getBoundingClientRect().top;
        var elementVisible = 150;
        if (elementTop < windowHeight - elementVisible) {
            reveals[i].classList.add("active");
        } else {
            reveals[i].classList.remove("active");
        }
    }
}

window.addEventListener("scroll", reveal);

// To check the scroll position on page load
reveal();

////////////////////////////////////////////////////////////////////////////////////////////

var cast  = [];
var crew  = [];

const urlParams = new URLSearchParams(window.location.search);
const type = urlParams.get('type');
var thisItem = new Item(
    urlParams.get('id'),
    urlParams.get('title'),
    urlParams.get('overview'),
    urlParams.get('img'),
    urlParams.get('rate'),
    urlParams.get('language')
);

async function call_api () {
    const url = 'https://api.themoviedb.org/3/' + type + '/' + thisItem.id + '/credits?api_key=bdd10d2b8f52bc0a5320d5c9d88bd1ff&language=en-US';
    const response = await fetch(url);
    const myJson = await response.json();
    let cast_list = myJson.cast;
    let crew_list = myJson.crew;
    
    cast_list.forEach(function (item) {
        cast.push(new Person('https://image.tmdb.org/t/p/w500' + item.profile_path, item.name));
    });
    crew_list.forEach(function (item) {
        crew.push(new Person('https://image.tmdb.org/t/p/w500' + item.profile_path, item.name));
    });
}

function load_people(holderID, list) {
    let holder = document.getElementById(holderID);
    list.forEach(function (element) {
        let div = document.createElement("div");
        div.className = "cast-card";
        div.innerHTML = '<img class="cast-img" src="' + element.img + '" alt="' + element.name + '"><p class="cast-name">' + element.name + '</p>';
        holder.appendChild(div);
    });
}

async function loadDetails() {
    document.getElementById("poster").style.backgroundImage = "linear-gradient(rgba(0, 0, 0, 0), #1e1e1e), url(" + thisItem.img + ")";
    document.getElementById("poster-text").innerHTML = thisItem.title;
    document.getElementById("overview").innerHTML = thisItem.overview;
    document.getElementById("rate").innerHTML = parseFloat(thisItem.rate).toPrecision(2);
    document.getElementById("language").innerHTML = thisItem.language.toUpperCase();
    await call_api();
    load_people('casts-cards-id', cast);
    load_people('crew-cards-id', crew);
}
