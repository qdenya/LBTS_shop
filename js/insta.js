const getData = async function(url) {
  const response = await fetch(url);
  if(!response.ok) {
    throw new Error(`Ошибка при загрузке данных. Код ответа: ${response.status}`);
  }
  return await response.json();
};

function createGalery(items) {
  const { id, media_url, permalink } = items;
  const wrapper = document.querySelector('.insta_container');

   let card =  `
    <div class="swiper-slide insta_slide">
      <div class="insta_slide_head">
        <div class="insta_slide_head_logo"></div>
        <div class="insta_slide_head_texts">
          <a href="${permalink}" class="insta_slide_head_nickname">lbtsshop</a>
          <h6 class="insta_slide_head_geo">Minsk, Belarus</h6>
        </div>
        <div class="insta_slide_head_btn">
          <button class="insta_slide_footer_dots"></button>
        </div>
      </div>
      <div class="insta_slide_photo" style="background: url(${media_url}) center center; background-size: cover; "></div>
      <div class="insta_slide_footer">
        <div class="insta_slide_footer_left">
          <a href="${permalink}" class="insta_slide_footer_like"></a>
          <a href="${permalink}" class="insta_slide_footer_comment"></a>
          <a href="${permalink}" class="insta_slide_footer_direct"></a>
        </div>
        <div class="insta_slide_footer_right">
          <a href="${permalink}" class="insta_slide_footer_save"></a>
        </div>
      </div>
    </div>
  `;
  wrapper.insertAdjacentHTML('beforeEnd', card);

}


 getData('https://site.lbts.by/api/insta.php').then(function(data) {
  data['data'].forEach(createGalery);
  });
  
  
  




