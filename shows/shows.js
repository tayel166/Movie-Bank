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
    document.getElementById('trending-shows').scrollLeft += 260;
};

function slideleft_trending() {
    document.getElementById('trending-shows').scrollLeft -= 260;
};

function slideright_popular() {
    document.getElementById('popular-shows').scrollLeft += 260;
};

function slideleft_popular() {
    document.getElementById('popular-shows').scrollLeft -= 260;
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

var popular_show_list = [];
var trending_show_list = [];

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
        banner.classList.add('show-card');
        banner.appendChild(img);
        banner.appendChild(body);
        banner.onclick = function() {
            goto_Details(
                element.id,
                'tv',
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


async function call_api(url, list) {
    const response = await fetch(url);
    const myJson = await response.json();
    myJson.results.forEach(element => {
        let item = new Item(
            element.id,
            element.name,
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
    await call_api('https://api.themoviedb.org/3/tv/popular?api_key=bdd10d2b8f52bc0a5320d5c9d88bd1ff', popular_show_list);
    await call_api('https://api.themoviedb.org/3/tv/top_rated?api_key=bdd10d2b8f52bc0a5320d5c9d88bd1ff', trending_show_list);
    createBanners(popular_show_list, 'popular-shows');
    createBanners(trending_show_list, 'trending-shows');
}

async function PlayNow(id){
    goto_Details(
        id, 
        'tv',
        'Wonder Egg Priority',
        'Ai, a young girl with shut-in tendencies, who tries not to interact with others. She keeps one of her eyes hidden behind her hair. One day, she happens to stop by a deserted arcade, where she meets "Aka." Spinning the gacha at their urging, she acquires a "Wonder Egg," and from that moment, her fate begins to change...', 
        'https://th.bing.com/th/id/R.1cc1ae9396fe9e3cbc4b9f449e05d1e0?rik=H%2fhgD%2fLQhqR2Zw&pid=ImgRaw&r=0',
        '6.9',
        'JP'
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