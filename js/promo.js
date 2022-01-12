const getData = async function(url) {
  const response = await fetch(url);
  if(!response.ok) {
    throw new Error(`Ошибка при загрузке данных. Код ответа: ${response.status}`);
  }
  return await response.json();
};

function kitcut( text, limit=57) {
  text = text.trim();
  if( text.length <= limit) return text;
  text = text.slice( 0, limit); // тупо отрезать по лимиту
  lastSpace = text.lastIndexOf(" ");
  if( lastSpace > 0) { // нашлась граница слов, ещё укорачиваем
    text = text.substr(0, lastSpace);
  }
  return text + "...";
}

function createSlides(items) {
  let it = "";
  const { Id, Hash, Name, Text, Img_url } = items;
  const wrapper = document.querySelector('.swiper-wrapper');
  let a;
  let styleDisc = "display: flex;";
  getData('https://site.lbts.by/db/my.json').then(function(data){
    for(a = 0; a<data[Name].length; a++) {
      if(!data[Name][a]['promo']['discount']) {
        styleDisc = "display: none;"
      }
      it = it + `
      <a href="https://lbts.by/katalog/item/${data[Name][a]['link']}" class="swiper-slide promo_card promo_card_1" style="background: #fff url('https://site.lbts.by/items/${data[Name][a]['photo']}.jpg') no-repeat top 10% center;background-size: contain;"> 
        <div class="promo_card_offer">
          <span class="promo_card_offer_text" style="display: none;">Bestseller</span>
        </div>
        <div class="promo_card_price">
          <div class="promo_card_discount" style="${styleDisc}">
            <span class="promo_card_discount_text">-${data[Name][a]['promo']['discount']}%</span>
          </div>
          <div class="promo_card_price_main">
            <div class="promo_card_price_main_total">
              <span class="promo_card_price_main_rubl">${data[Name][a]['price'][0]}</span>
              <span class="promo_card_price_main_kop">${data[Name][a]['price'][1]}</span>
            </div>
          </div>
        </div>
        <div class="promo_card_title">
          <span class="promo_card_title_text">${kitcut(data[Name][a]['title'])}</span>
        </div>
      </a>
      `;
    }
   let card =  `
    <div data-hash="${Hash}" class="swiper-slide">
      <div class="row g-2">
        <div class="main col-lg-6 col-sm-12">
          <div class="main_info">
            <div class="main_info_logo">
              <img src="${Img_url}" alt="Logo-promo" class="main_info_logo_img">
            </div>
            <span class="main_info_text">${Text}</span>
          </div>
        </div>
        <div class="second col-lg-6 col-sm-12">
          <div class="promo swiper${Id}">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
              <!-- Slides -->
              `+it+`
              
            </div>
          </div>
          <a href="/katalog" class="promo_button">Открыть каталог</a>
        </div>
      </div>
    </div>
  `;
  wrapper.insertAdjacentHTML('beforeEnd', card);
  var swiper = new Swiper(`.swiper${Id}`, {
      effect: "cards",
      autoplay: {
        delay: 5000,
      },
      grabCursor: true,
    });
  }
  );
}

getData('https://site.lbts.by/db/brands.json')
  .then(function(data){
    console.log(window.location.hash);
    data.forEach(function(item){
      if("#"+item['Hash']==window.location.hash) {
        createSlides(item);
      }
    });
    data.forEach(function(item){
      if("#"+item['Hash']!=window.location.hash) {
        createSlides(item);
      }
    });
  })
  .finally(() => {
    console.log("done3");
    var swiper2 = new Swiper(".swiper-main", {
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      loop: true,
      hashNavigation: {
        watchState: true,
      },
      allowTouchMove: false,
    });
  })
  
  




