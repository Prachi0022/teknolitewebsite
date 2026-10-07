$(document).ready(function () {
  var e = {};
  (e[Astro.breakpoints.tablet.size] = { slidesPerView: 4 }),
    (e[Astro.breakpoints.mobile.size] = { slidesPerView: 2 });
  new Swiper(".awards__container", {
    nextButton: ".js-awards__next",
    prevButton: ".js-awards__previous",
    slidesPerView: 6,
    autoplay: 2500,
    autoplayDisableOnInteraction: !1,
    loop: !0,
    breakpoints: e,
  });
});
p
