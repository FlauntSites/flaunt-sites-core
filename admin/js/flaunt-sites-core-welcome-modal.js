/***************
 * HELPERS
 ***************/

const helpers = {}

helpers.init = () => {
    data.init()
}

/**
 * Returns the Body Element
 */
helpers.body = () => document.querySelector("body")

/**
 * Returns the Flaunt Sites Button
 */
helpers.fsTutsButton = () =>
    document.querySelector("#wp-admin-bar-flaunt-sites-tuts")

/**
 * Launches the Modal
 */
helpers.fsTutsButton().addEventListener(
    "click",
    function(e) {
        const modal = document.querySelector(".tint")
        if (!modal || null == modal) {
            window.location.hash = "tutorials"
            view.createModal()
            e.preventDefault()
        } else if (modal.style.display == "none") {
            modal.style.display = "flex"
            window.location.hash = "tutorials"
            e.preventDefault()
        } else if (modal.style.display == "flex") {
            view.removeModal()
            e.preventDefault()
        }
    },
    false
)

/**
 * Removes the Modal window.
 */
helpers.removeModal = () => {
    if (document.querySelector(".tint")) {
        helpers.body().querySelector(".tint").style.display = "none"
        helpers.body().style = "overflow-y: initial;"
        history.pushState(
            "",
            document.title,
            window.location.pathname + window.location.search
        )
    }
}

/**
 * Removes the modal on Escape Key press.
 */
helpers.escButton = () => {
    document.onkeydown = function(evt) {
        evt = evt || window.event
        var isEscape = false
        if ("key" in evt) {
            isEscape = evt.key == "Escape" || evt.key == "Esc"
        } else {
            isEscape = evt.keyCode == 27
        }
        if (isEscape) {
            helpers.removeModal()
        }
    }
}
helpers.escButton()

helpers.closeButton = () => {
    const closeButton = document.querySelector(".close-button")
    closeButton.addEventListener("click", function(e) {
        helpers.removeModal()
        e.preventDefault()
    })
}

/***************
 * DATA
 ***************/
const data = {}

data.init = () => {}

/**
 * WordPress Tutorials route.
 */
data.tutsRoute = () => "https://flauntsites.com/wp-json/wp/v2"

/**
 * Get Noticed SEO Tutorials route.
 */
// data.gnTutsRoute = () => "https://getnoticed.flauntsites.com/wp-json/wp/v2"

/**
 * Fetch the data from Flaunt Sites Tutorials.
 */
data.fetchFsTutorials = () => {
    fetch(data.tutsRoute() + "/tutorials")
        .then(function(response) {
            if (response.status !== 200) {
                console.log(
                    "Looks like there was a problem. Status Code: " +
                        response.status
                )
                return
            }

            // Examine the text in the response
            response.json().then(function(posts) {
                data.updateLocalStorage("fsTutorials", posts)
            })
        })
        .catch(function(err) {
            console.log("Fetch Error :-S", err)
        })
}
data.fetchFsTutorials()

/**
 * Fetch the SECTIONS from Get Noticed .
 */
data.fetchGnSections = () => {
    const gnurl = BB_DATA.bb_ajax_url
    const gnonce = BB_DATA.bb_nonce

    let form = new FormData()
    form.append("action", "get_noticed_sections")
    form.append("nonce", gnonce)

    fetch(gnurl, { method: "POST", body: form })
        .then(function(response) {
            if (response.status !== 200) {
                console.log(
                    "Looks like there was a problem. Status Code: " +
                        response.status
                )
                return
            }

            // Examine the text in the response
            response.json().then(function({ success, data }) {
                if (!success) {
                    console.log(
                        "Whatever error you want to show here for wp_remote_get() PHP error"
                    )
                    return
                }
                sessionStorage.setItem("gnSections", data)
            })
        })
        .catch(function(err) {
            console.log("Fetch Error :-S", err)
        })
}
data.fetchGnSections()

/**
 * Fetch the LESSONS from Get Noticed .
 */
data.fetchGnLessons = () => {
    const gnurl = BB_DATA.bb_ajax_url
    const gnonce = BB_DATA.bb_nonce

    let form = new FormData()
    form.append("action", "get_noticed_lessons")
    form.append("nonce", gnonce)

    fetch(gnurl, { method: "POST", body: form })
        .then(function(response) {
            if (response.status !== 200) {
                console.log(
                    "Looks like there was a problem. Status Code: " +
                        response.status
                )
                return
            }

            // Examine the text in the response
            response.json().then(function({ success, data }) {
                if (!success) {
                    console.log(
                        "Whatever error you want to show here for wp_remote_get() PHP error"
                    )
                    return
                }
                sessionStorage.setItem("gnLessons", data)
            })
        })
        .catch(function(err) {
            console.log("Fetch Error :-S", err)
        })
}
data.fetchGnLessons()

/**
 * Updates local storage with retrieved data.
 */
data.updateLocalStorage = (name, posts) =>
    sessionStorage.setItem(name, JSON.stringify(posts))

/**
 * Takes data and sorts it alphabetically based on slug.
 */
data.compare = (a, b) => {
    const titleA = a.slug
    const titleB = b.slug

    let comparison = 0
    if (titleA > titleB) {
        comparison = 1
    } else if (titleA < titleB) {
        comparison = -1
    }
    return comparison
}

/***************
 * MODEL
 ***************/

/**
 * Model Object
 */
const model = {}

/**
 * Model Init function.
 */
model.init = () => {}

/**
 * Get All posts.
 */
model.getPosts = tuts => {
    let posts
    if ("fsTuts" === tuts) {
        posts = JSON.parse(sessionStorage.getItem("fsTutorials"))
        posts = posts.sort(data.compare)
    } else if ("gnTuts" === tuts) {
        posts = JSON.parse(sessionStorage.getItem("gnSections"))
        posts = posts.sort(data.compare)
    } else if ("gnLessons" === tuts) {
        posts = JSON.parse(sessionStorage.getItem("gnLessons"))
        posts = posts.sort(data.compare)
    }
    return posts
}

/**
 * Gets single post based on slug
 */
model.getPost = slug => {
    const fsTuts = JSON.parse(sessionStorage.getItem("fsTutorials"))
    const gnTuts = JSON.parse(sessionStorage.getItem("gnLessons"))
    const posts = fsTuts.concat(gnTuts)

    for (i = 0; i < posts.length; i++) {
        if (slug === posts[i].slug) {
            return posts[i]
        }
    }
}

/***************
 * ROUTER
 ***************/

const router = {}

router.init = () => {
    router.slugListenChange()
}

/**
 * Get slug from URL.
 * @return {string} slug for post.
 */
router.getSlug = () => window.location.hash.substring(1)

/**
 *
 */
router.slugListenChange = () => {
    window.addEventListener(
        "hashchange",
        function(e) {
            router.loadContent()
            e.preventDefault()
        },
        false
    )
}
/**
 *
 */
router.loadContent = () => {
    const slug = router.getSlug()
    if ("tutorials" === slug) {
        view.clearContent()
        view.loadPost("0-welcome")
    } else if ("" === slug || null === slug) {
        return
    } else {
        view.clearContent()
        view.loadPost(slug)
    }
}
/***************
 * VIEW
 ***************/
/**
 * View model.
 */
const view = {}

/**
 * View Init.
 */
view.init = () => {
    //   view.stage()
    //   view.loadPosts()
    //   view.menuSection()
}

/**
 * Builds the Modal.
 */
view.createModal = () => {
    //   Apply tint background
    const tint = document.createElement("div")
    tint.className = "tint"
    helpers.body().appendChild(tint)
    helpers.body().style = "overflow-y: hidden;"

    // Create modal
    const modal = document.createElement("div")
    modal.className = "welcome-modal"
    tint.appendChild(modal)

    const header = document.createElement("header")
    modal.appendChild(header)
    const h1 = document.createElement("h1")
    h1.innerHTML = "Flaunt Sites Learning Center"
    header.appendChild(h1)

    //   Append the Modal close button.
    modal.appendChild(view.closeButton())

    const stage = document.createElement("div")
    stage.className = "tuts-stage"
    modal.appendChild(stage)

    const menu = document.createElement("div")
    menu.className = "tuts-menu"
    menu.innerHTML = "<h3>Tutorials</h3>"
    modal.appendChild(menu)

    menu.appendChild(view.menuSection("fsTuts"))
    menu.appendChild(view.menuSection("gnTuts"))

    stage.focus()
    router.init()
    view.lessonAccordion()
    helpers.closeButton()
}

view.closeButton = () => {
    const closeButton = document.createElement("button")
    closeButton.className = "close-button"
    return closeButton
}

// Stage area markup
view.stage = () => document.querySelector(".tuts-stage")
view.menuArea = () => document.querySelector(".tuts-menu")

/**
 * Load the Posts.
 */
view.loadPosts = () => {
    const posts = model.getPosts()
    const postMarkup = document.createDocumentFragment()
    for (i = 0; i < posts.length; i++) {
        postMarkup.appendChild(view.createPostMarkup(posts[i]))
    }
    view.stage().appendChild(postMarkup)
}

/**
 * Load single post
 */
view.loadPost = slug => {
    const post = model.getPost(slug)
    const postMarkup = document.createDocumentFragment()
    postMarkup.appendChild(view.createPostMarkup(post))
    view.stage().appendChild(postMarkup)
    view.lessonCompletionStatus()
}

/**
 * Creates the individual posts.
 */
view.createPostMarkup = post => {
    const article = document.createElement("article")

    article.innerHTML =
        "<header>" +
        "<h2>" +
        post.title.rendered +
        "</h2>" +
        view.lessonButton(post) +
        "</header>" +
        '<div class="entry-content">' +
        post.content.rendered +
        "</div>"

    return article
}

/**
 * Clears content from Stage.
 */
view.clearContent = () => {
    view.stage().innerHTML = ""
}

/**
 * Menu section
 */
view.menuSection = tuts => {
    const section = document.createElement("div")
    if ("fsTuts" === tuts) {
        section.id = "fstuts"
    }
    if ("gnTuts" === tuts) {
        section.id = "gntuts"
    }
    if ("gnLessons" === tuts) {
        return
    }

    const curriculumArea = document.createElement("div")
    curriculumArea.className = "curriculum"
    section.appendChild(curriculumArea)

    const sectionTitle = document.createElement("h4")
    sectionTitle.className = "section-title"

    if ("fsTuts" === tuts) {
        sectionTitle.innerHTML =
            "<span class='back-arrow'>&larr; </span> WordPress Tutorials"
    }
    if ("gnTuts" === tuts) {
        sectionTitle.innerHTML =
            "<span class='back-arrow'>&larr; </span> SEO Tutorials"
    }
    if ("gnLessons" === tuts) {
        return
    }

    curriculumArea.appendChild(sectionTitle)

    curriculumArea.appendChild(view.menuUl(tuts))

    return section
}

view.menuUl = tuts => {
    const posts = model.getPosts(tuts)
    const menuUl = document.createElement("ul")
    menuUl.className = "section-list"

    if ("fsTuts" === tuts) {
        for (i = 0; i < posts.length; i++) {
            menuUl.appendChild(view.menuItems(posts[i]))
        }
        return menuUl
    }
    if ("gnTuts" === tuts) {
        for (i = 0; i < posts.length; i++) {
            menuUl.appendChild(view.menuSubSections(posts[i]))
        }
        return menuUl
    }
}

/**
 * Menu Lesson Sections
 */
view.menuSubSections = post => {
    const menuSubSections = document.createElement("li")
    menuSubSections.className = "section-link"
    menuSubSections.innerHTML =
        '<a href="#" dataset-id ="' +
        post.id +
        '"><span class="back-arrow">&larr; </span>' +
        post.name +
        " (" +
        post.count +
        " lessons)</a>"
    menuSubSections.appendChild(view.menuSubsectionUl("gnLessons", post.id))
    return menuSubSections
}

view.menuSubsectionUl = (tuts, postId) => {
    const posts = model.getPosts(tuts)
    const menuSubsectionUl = document.createElement("ul")
    //   menuSubsectionUl.className = "section-list"
    const frag = document.createDocumentFragment()

    for (j = 0; j < posts.length; j++) {
        if (postId === posts[j].sections[0]) {
            frag.appendChild(view.menuItems(posts[j]))
        }
    }
    menuSubsectionUl.appendChild(frag)

    return menuSubsectionUl
}

/**
 * Menu Items
 */
view.menuItems = post => {
    const lessonLink = document.createElement("li")
    lessonLink.className = "lesson-link"
    lessonLink.innerHTML =
        view.check() +
        '<a href="#' +
        post.slug +
        '">' +
        post.title.rendered +
        "</a>"
    return lessonLink
}

view.check = () => {
    check = '<svg class="fstuts-check uncheck '
    check += 'xmlns="http://www.w3.org/2000/svg" viewBox="0 0 406 507.5">'
    check += '<circle cx="203" cy="203" r="203" fill="#FFF"/>'
    check +=
        '<g class="check"><path d="M170 249l118-118c12-12 30 6 18 17L179 275c-5 5-13 6-18 0l-61-61c-12-12 6-29 18-18l52 53z" />'
    check +=
        '<path d="M203 0c112 0 203 91 203 203s-91 203-203 203S0 315 0 203 91 0 203 0zm0 25c-98 0-178 80-178 178s80 178 178 178 178-80 178-178S301 25 203 25z" /></g>'
    check += "</svg>"

    return check
}

/**
 * Accordion
 */

view.lessonAccordion = () => {
    const curriculumItems = document.querySelectorAll(".curriculum")
    for (i = 0; i < curriculumItems.length; i++) {
        let sectionTitle = curriculumItems[i].querySelector(".section-title")
        let sectionList = curriculumItems[i].querySelector(".section-list")
        let firstLevel = curriculumItems[i].querySelectorAll(
            ".section-list > li"
        )
        view.accordianAnimation(firstLevel, sectionTitle, sectionList)

        for (j = 0; j < firstLevel.length; j++) {
            if (firstLevel[j].classList.contains("section-link")) {
                let sectionTitle = firstLevel[j].querySelector(
                    ".section-link a"
                )
                let sectionList = firstLevel[j].querySelector(
                    ".section-link ul"
                )
                let secondLevel = firstLevel[j].querySelectorAll(
                    ".section-link ul li"
                )
                view.accordianAnimation(secondLevel, sectionTitle, sectionList)
            }
        }
    }
}

/**
 * Accordian Animation
 */
view.accordianAnimation = (level, sectionTitle, sectionList) => {
    const tl = new TimelineMax({ paused: true })
    tl.to([level, sectionList], 0.1, { height: "100%" }, "-=0.1").staggerTo(
        level,
        0.025,
        {
            right: 0,
            ease: "elastic.out(1, .5)"
        },
        0.05
    )

    sectionTitle.addEventListener("click", function(event) {
        if (!sectionTitle.classList.contains("toggled")) {
            tl.play(0)
            sectionTitle.classList.add("toggled")
            this.querySelector(".back-arrow").style.visibility = "visible"
            event.preventDefault()
        } else {
            tl.reverse(0)
            sectionTitle.classList.remove("toggled")
            this.querySelector(".back-arrow").style.visibility = "hidden"
            event.preventDefault()
        }
    })
}

view.lessonButton = post => {
    if (data.checkLessonsStatus(post.slug) == "completed") {
        button =
            '<button class="lesson-status ' +
            data.checkLessonsStatus(post.slug) +
            '" data-lesson="' +
            post.slug +
            '">&#10003; Completed</button>'
        return button
    } else {
        button =
            '<button class="lesson-status" data-lesson="' +
            post.slug +
            '">Mark lesson complete</button>'
        return button
    }
}

/**
 * Saves the completion status of lesson on click of button to Local Storage.
 */
view.lessonCompletionStatus = () => {
    const button = document.querySelector(".lesson-status")
    button.addEventListener("click", function(e) {
        let completedLessons = JSON.parse(
            localStorage.getItem("completedLessons")
        )
        if (completedLessons == null) completedLessons = []

        let updatedEntry = { lesson: this.dataset.lesson }
        // localStorage.setItem("updatedEntry", JSON.stringify(updatedEntry))

        if (!button.classList.contains("completed")) {
            button.classList.add("completed")
            button.innerHTML = "&#10003; Completed"
            completedLessons.push(updatedEntry)
        } else {
            button.classList.remove("completed")
            button.innerHTML = "Mark lesson complete"
            for (i = 0; i < completedLessons.length; i++) {
                if (completedLessons[i].lesson === this.dataset.lesson) {
                    delete completedLessons[i].lesson
                }
            }
        }
        localStorage.setItem(
            "completedLessons",
            JSON.stringify(completedLessons)
        )
        e.preventDefault()
    })
}

data.checkLessonsStatus = post => {
    let completedLessons = JSON.parse(localStorage.getItem("completedLessons"))
    if (completedLessons) {
        for (i = 0; i < completedLessons.length; i++) {
            if (completedLessons[i].lesson == post) {
                return "completed"
            }
        }
    }
}
