
// Don't call if this is the Setup page
if (!document.querySelector('body').classList.contains('wu-setup')) {


  /**
   * 
   * Fade the Flaunt Sites logo out, and replace it with Site Owner logo.
   * 
   */

  function logoFade() {
    var logo = document.getElementsByTagName("h1")[0];
    logoBackground = document.getElementById("login").getElementsByTagName("a")[0];
    logoBackground.style.cssText = "background-size:contain!important;";
    document.getElementById('login').style.cssText = "position:relative; z-index:100; background:none;";

    tl = new TimelineMax;
    tl.to(logo, 2, { top: -300, delay: 1.75, ease: Power2.easeInOut })
      .to(logo, 1, { opacity: 0, delay: 2, onComplete: makeItRain })
      .set(logoBackground, { backgroundImage: 'none' })
    // pull in and set site owner logo
    // .fromTo(logo, 2, { top: 0, opacity: 0 }, { top: 0, opacity: 1 });
  }
  logoFade()




  var ourRequest = new XMLHttpRequest();
  ourRequest.open('GET', flaunt_sites_custom_login_ajaxify.currentSite + '/wp-json/wp/v2/media?_embed');
  ourRequest.onload = function () {
    if (ourRequest.status >= 200 && ourRequest.status < 400) {
      var data = JSON.parse(ourRequest.responseText);
      makeItRain(data);

    } else {
      console.log("We connected to the server, but it returned an error.");
    }
  };

  ourRequest.onerror = function () {
    console.log("Connection error");
  };

  ourRequest.send();



  function makeItRain(featuredImageData) {

    for (var i = 0; i < featuredImageData.length; i++) {

      rain = document.createElement("div");
      rainStyle = rain.style.cssText = "width:250px; height: 150px; position:absolute; top:-30vh; opacity:0; background-repeat: no-repeat; background-position-x: center; background-size: contain;";

      rain.style.setProperty('left', Math.floor(Math.random() * screen.width) + 'px');
      rain.style.setProperty('background-image', 'url(" ' + featuredImageData[i].media_details.sizes.medium.source_url + ' ")');

      rainStagger = document.body.appendChild(rain);


      var tl = new TimelineMax({ repeat: -1 });
      tl
        .to(rainStagger, Math.floor(Math.random() * ((13 - 8) + 1) + 8), { transform: 'translateY(130vh)', ease: Linear.easeNone }, Math.random() * 12)
        .to(rainStagger, .5, { opacity: 1 }, 0)
        .to(rainStagger, 1, { opacity: 0 });

    }

  }


}




/**
 * 
 * 
 *  
 */

const addDomainMessage = function () {

  const label = document.querySelector('#blogname-field');



}
addDomainMessage()


/**
* 
* Prevents users from adding "." in the subdomain section of the Signup process.
* 
*/

const addKeypress = function () {
  const field = document.querySelector('#blogname');
  field.setAttribute("onkeypress", "return restrictCharacters(this, event, /[1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-]/g);")
}
addKeypress()

function restrictCharacters(myfield, e, restrictionType) {

  if (!e) var e = window.event
  if (e.keyCode) code = e.keyCode;
  else if (e.which) code = e.which;
  var character = String.fromCharCode(code);

  // if they pressed esc... remove focus from field...
  if (code == 27) { this.blur(); return false; }

  // ignore if they are press other keys
  // strange because code: 39 is the down key AND ' key...
  // and DEL also equals .
  if (!e.ctrlKey && code != 9 && code != 8 && code != 36 && code != 37 && code != 38 && (code != 39 || (code == 39 && character == "'")) && code != 40) {
    if (character.match(restrictionType)) {
      return true;
    } else {
      return false;
    }

  }
}