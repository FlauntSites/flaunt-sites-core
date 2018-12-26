/**
 *
 * Mobile Sharebar display
 *
 */

const mobileDisplaySharebar = function() {
  const more = document.querySelector(".fs-drawer-mobile-more svg")
  const drawer = document.querySelector(".fs-drawer")

  if (more) {
    more.addEventListener("click", function() {
      more.classList.toggle("toggled")
      drawer.classList.toggle("toggled")
    })
  }
}
// window.onload = mobileDisplaySharebar

/**
 *
 * Adjusts Swiper Slider to Responsive/Fixed Height based on 3/2 ratio.
 *
 */
const swiperSliderResponsiveFix = function() {
  if (document.querySelector(".swiper-wrapper")) {
    const swiperContainer = document.querySelector(".swiper-wrapper")
    swiperContainer.style =
      "height:" + swiperContainer.offsetWidth * 0.666666667 + "px;!important "
  }
}
swiperSliderResponsiveFix()
window.onresize = swiperSliderResponsiveFix
