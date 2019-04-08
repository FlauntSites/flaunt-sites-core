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
