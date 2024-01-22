console.log('swiper specific code here')
const swiperEls = document.querySelectorAll('.posts-swiper');
let swipers = [];

swiperEls.forEach((el) => {
  let columns = parseInt(el.dataset.columns);
  console.log(typeof columns);
  console.log(columns);
  swipers[el] = new Swiper('.posts-swiper', {
    // Optional parameters
    direction: 'horizontal',
    loop: false,
    slidesPerView: 1.5,
    spaceBetween: 40,
  
    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },
  
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  
    // And if we need scrollbar
    scrollbar: {
      el: '.swiper-scrollbar',
    },

    breakpoints: {
      // when window width is >= 320px
      768: {
        slidesPerView: 2 <= columns ? 2 : columns,
      },
      // when window width is >= 480px
      992: {
        slidesPerView: 3 <= columns ? 3 : columns,
        spaceBetween: 30
      },
      // when window width is >= 640px
      1200: {
        slidesPerView: 4 <= columns ? 4 : columns,
      }
    } 
    
    });
       
 

});


console.log(swipers);