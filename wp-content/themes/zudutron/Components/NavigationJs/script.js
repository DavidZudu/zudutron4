const mainNav = document.querySelector('[name="NavigationJs"]')
const mainLinks = mainNav.querySelector('.main-links')
const dropdowns = mainNav.querySelectorAll('.top-level > .menu-item-has-children')

let toggle
let target

document.addEventListener('click', function (e) {
  // MOBILE NAV TOGGLE
  if (e.target && (e.target.closest('.nav-toggle') || e.target.closest('.close'))) {
    // console.log("navtoggled")
    toggleNav()
  }
  if (e.target && !e.target.closest('[name="NavigationJs"]') && mainLinks.classList.contains('open-nav')) {
    // console.log("notnav clicked")
    closeNav()
  }

  // MOBILE SUB MENU OPEN
  if (e.target && e.target.closest('.sub-menu-button')) {
    toggle = e.target.closest('.sub-menu-button')
    target = toggle.nextElementSibling
    dropdownToggle(toggle, target, 0)
  }

  // MOBILE SUB MENU BACK BUTTON
  if (e.target && e.target.closest('.sub-menu .back')) {
    toggle = e.target.closest('.sub-menu .back')
    target = toggle.closest('.sub-menu')
    console.log(toggle, target)
    dropdownToggle(toggle, target, 0)
  }
})

// DESKTOP NAV DROPDOWN MOUSE OVER
dropdowns.forEach((el) => {
  el.addEventListener('mouseover', function (e) {
    // console.log(el);
    if (window.matchMedia('(min-width: 768px)').matches) {
      dropdowns.forEach((el) => {
        const sub = el.querySelector('.sub-menu')
        sub.classList.remove('open')
      })
      const sub = el.querySelector('.sub-menu')
      sub.classList.add('open')
    }
  })
})

// DESKTOP NAV DROPDOWN MOUSE LEAVE
if (mainLinks) {
  mainLinks.addEventListener('mouseleave', function (e) {
    if (window.matchMedia('(min-width: 768px)').matches) {
      dropdowns.forEach((el) => {
        const sub = el.querySelector('.sub-menu')
        sub.classList.remove('open')
      })
    }
  })
}

// FUNCTIONS
function dropdownToggle (toggle, target, min) {
  if (target.classList.contains('open')) {
    // closing
    toggle.classList.remove('open')
    target.classList.remove('open')
  } else {
    // opening
    toggle.classList.add('open')
    target.classList.add('open')
  }
}
const openNav = () => {
  console.log("opennav")
  document.body.classList.add('pause-overflow')
  mainLinks.classList.add('open-nav')
}
const closeNav = () => {
  console.log("closenav")
  document.body.classList.remove('pause-overflow')
  mainLinks.classList.remove('open-nav')
  document.querySelectorAll('.sub-menu.open').forEach(el => {
    el.classList.remove('open')
  })
}
const toggleNav = () => {
  if (mainLinks.classList.contains('open-nav')) {
    closeNav()
  } else {
    openNav()
  }
}
