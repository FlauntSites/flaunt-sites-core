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
 */
const photoLoop = function() {
  article = document.querySelector("article")
  images = article.querySelectorAll("img")
  for (var image of images) {
    // Loop through photos that are wrapped in Figure
    if (image.parentNode.nodeName === "FIGURE") {
      let figure = image.parentNode
      replaceFigureFigure(figure)
    }
    // Loop through photos that are wrapped in A
    if (image.parentNode.nodeName === "A") {
      // If IMG Parent is Figure
      if (image.parentNode.parentNode.nodeName === "FIGURE") {
        let figure = image.parentNode.parentNode
        replaceFigureFigure(figure)
      }
    }
    // Loop through photos that are wrapped in P
    if (image.parentNode.nodeName === "P") {
      replaceParaFigure(image)
    }

    // Loop through photos that are wrapped in Div
    if (image.parentNode.nodeName === "DIV") {
    }
  }
}
// photoLoop()

/**
 * Replace Paragraph with Figure.
 * @param {*} image
 */
function replaceParaFigure(image) {
  // Get parent Paragraph of Image
  const parent = image.parentNode
  // Create new Figure.
  const figure = document.createElement("figure")
  // Get Alignment from IMG and insert in Figure.
  figure.className = pClassFix(image)
  // Get Width from IMG and insert in Figure.
  figure.style.maxWidth = pSizeFix(image) + "px"
  // Place Image in Figure
  figure.appendChild(image)
  // Replace Paragraph with Figure
  parent.replaceWith(figure)

  fsDrawer(figure, "")
}

function replaceFigureFigure(figure) {
  // Get parent Paragraph of Image
  const figCaption = figure.querySelector("figCaption")
  fsDrawer(figure, figCaption)
}

/**
 * Build the Drawer for
 * @param {*} figure
 */
function fsDrawer(figure, figCaption) {
  const drawer = document.createElement("div")
  drawer.className = "fs-drawer"
  if (!figCaption) {
    figCaption = document.createElement("figcaption")
    figCaption.innerHTML = ""
  }
  const sharebar = document.createElement("div")
  sharebar.className = "fs-sharebar"
  shareBar(sharebar)

  drawer.appendChild(figCaption)
  drawer.appendChild(sharebar)

  figure.appendChild(drawer)
}

function shareBar(sharebar) {
  page = window.location.href
  sharebar.innerHTML =
    '<span style="margin-right:5px;">Share:</span>' +
    '<a data-pin-do="buttonPin" data-pin-custom="true" style="cursor:pointer;" href="https://www.pinterest.com/pin/create/button/?url=http://poopies.com&media=&description=Poopies"><svg class="fs-icons"><use xlink:href="#icon-pinterest-square"></use></svg></a>'
}

function pClassFix(image) {
  if (image.classList.contains("alignleft")) {
    return "alignleft"
  }
  if (image.classList.contains("aligncenter")) {
    return "aligncenter"
  }
  if (image.classList.contains("alignright")) {
    return "alignright"
  }
  if (image.classList.contains("alignnone")) {
    return ""
  }
  return
}

function pSizeFix(image) {
  return image.getAttribute("width")
}
