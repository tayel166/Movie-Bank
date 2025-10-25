class Item {
    constructor(id, title, overview, img, banner, rate, language) {
        this.id = id;
        this.title = title;
        this.overview = overview;
        this.img = img;
        this.banner = banner;
        this.rate = rate;
        this.language = language;
    }
}

function slideright_trending() {
    document.getElementById('trending-movies').scrollLeft += 260;
};

function slideleft_trending() {
    document.getElementById('trending-movies').scrollLeft -= 260;
};

function slideright_popular() {
    document.getElementById('popular-movies').scrollLeft += 260;
};

function slideleft_popular() {
    document.getElementById('popular-movies').scrollLeft -= 260;
};

function goto_Details(id, type, title, overview, img, rate, language) {
    // type = movie or tv
    window.location.href = "../details/details.html?id=" + id + "&type=" + type + "&title=" + title + "&overview=" + overview + "&img=" + img + "&rate=" + rate + "&language=" + language;
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

var popular_movies_list = [];
var trending_movies_list = [];

function createBanners(itemList, holderID) {
    let holder = document.getElementById(holderID);
    itemList.forEach(element => {
        let title = document.createElement('p');
        title.classList.add('card-text');
        title.innerHTML = element.title;
        
        let body = document.createElement('div');
        body.classList.add('card-body');
        body.appendChild(title);

        let img = document.createElement('img');
        img.src = element.img;
        img.classList.add('card-img-top');
        img.alt = element.title;
        
        let banner = document.createElement('div');
        banner.classList.add('card');
        banner.classList.add('movie-card');
        banner.appendChild(img);
        banner.appendChild(body);
        banner.onclick = function() {
            goto_Details(
                element.id,
                'movie',
                element.title,
                element.overview,
                element.banner,
                element.rate,
                element.language
            );
        };
        holder.appendChild(banner);
    });
}


async function call_api (url, list) {
    const response = await fetch(url);
    const myJson = await response.json();
    myJson.results.forEach(element => {
        let item = new Item(
            element.id,
            element.title,
            element.overview,
            'https://image.tmdb.org/t/p/w500' + element.poster_path,
            'https://image.tmdb.org/t/p/w500' + element.backdrop_path,
            element.vote_average,
            element.original_language
        );
        list.push(item);
    });
}


async function loadData() {
    await call_api('https://api.themoviedb.org/3/movie/popular?api_key=bdd10d2b8f52bc0a5320d5c9d88bd1ff', popular_movies_list);
    await call_api('https://api.themoviedb.org/3/trending/movie/day?api_key=bdd10d2b8f52bc0a5320d5c9d88bd1ff', trending_movies_list);
    createBanners(popular_movies_list, 'popular-movies');
    createBanners(trending_movies_list, 'trending-movies');
}

async function PlayNow(id){
    goto_Details(
        id, 
        'movie',
        'Land of Mine',
        'In the days following the surrender of Germany in May 1945, a group of young German prisoners of war is handed over to the Danish authorities and subsequently sent to the West Coast, where they are ordered to remove the more than two million mines that the Germans had placed in the sand along the coast. With their bare hands, crawling around in the sand, the boys are forced to perform the dangerous work under the leadership of a Danish sergeant.', 
        'https://www.coffeeandcigarettes.co.uk/wp-content/uploads/2017/08/LandOfMine_CCWebsite_1600x900-1.jpg',
        '7.8',
        'DK'
    );
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }