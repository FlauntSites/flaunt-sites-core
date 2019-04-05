const body = document.body
const welcomeModal = document.createElement("div")
const tint = document.createElement("div")
const button = document.createElement("button")

/**
 *
 * First time screen
 *
 */

const firstLoadWelcome = function() {
  const header = document.createElement("header")

  const h1 = document.createElement("h1")
  const divLeft = document.createElement("div")
  const divRight = document.createElement("div")
  const content = document.createElement("p")
  const video =
    '<iframe width="560" height="315" src="https://www.youtube.com/embed/Nmxd3vAiZdg?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>'

  const footer = document.createElement("footer")

  // Prevent scroll and add a background tint.
  body.style = "overflow-y: hidden;"
  tint.classList = "tint"
  body.appendChild(tint)

  // Append modal to body.
  welcomeModal.classList = "welcome-modal"
  body.appendChild(welcomeModal)

  // Add Header and H1 to modal
  welcomeModal.appendChild(header)
  header.appendChild(h1)
  h1.innerText = "Welcome to Flaunt Sites!"

  welcomeModal.appendChild(divLeft)
  divLeft.appendChild(content)
  content.innerHTML =
    "<h3>Cool, you made it!</h3><p>Welcome to your new home. If you're comfortable with WordPress, you'll feel right at home from the start. If you haven't used WordPress before, don't worry we've got you covered in multiple ways.</p><h3>First steps...</h3><p>We have some fantastic features you won't find anywhere else. So we do suggest going through the tutorials and steps to get your website up (Tutorials will be visible on the right side of the dashboard). You'll find all kinds of great SEO tips and tricks in them, so get familiar with the power of your new home.</p><h3>Getting Assistance</h3><p>If you ever need help, feel free to reach out to us. You can click on the chat bubble in the lower right hand corner of the window, and we'll gladly help you.</p>"

  welcomeModal.appendChild(divRight)
  divRight.innerHTML = video

  welcomeModal.appendChild(footer)
  footer.appendChild(button)
  text = document.createTextNode("Lets get started")
  button.appendChild(text)

  localStorage.setItem("FlauntSitesInitial", "true")
}
firstLoadWelcome()

const removeWelcomeModal = function() {
  body.removeChild(welcomeModal)
  body.removeChild(tint)
  body.style = "overflow-y: initial;"
}

document.onkeydown = function(evt) {
  evt = evt || window.event
  var isEscape = false
  if ("key" in evt) {
    isEscape = evt.key == "Escape" || evt.key == "Esc"
  } else {
    isEscape = evt.keyCode == 27
  }
  if (isEscape) {
    removeWelcomeModal()
  }
}

button.addEventListener("click", function() {
  removeWelcomeModal()
})
