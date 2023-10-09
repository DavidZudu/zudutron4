console.log("zudu-admin.js");

let hiddenItemsToggle;
document.addEventListener("DOMContentLoaded", (e) => {
  addClassToggle();
  hiddenItemsToggle = document.querySelector("#toggle-hidden-items");
  const visibility = sessionStorage.getItem("hidden-item-visibilty");
  visibility ? setHiddenItemVisibility(true) : setHiddenItemVisibility(false)
});

document.addEventListener("change", (e) => {
  if (e.target.matches("#toggle-hidden-items")) {
    const checkbox = e.target;
    setHiddenItemVisibility(checkbox.checked)
  }
});

const addClassToggle = () => {
  let location = document.getElementById("screen-options-wrap");
  // creating button element
  if (location) {
    let el = document.createElement("DIV");
    el.innerHTML = `<label for="toggle-hidden-items"><input type="checkbox" id="toggle-hidden-items">Show Hidden Menu Items (temp)</label>`;
    // appending el to div
    location.appendChild(el);
  }
  
};

const setHiddenItemVisibility = (setTo) => {
  if (setTo) {
    document.body.classList.add("show-hidden-items");
    sessionStorage.setItem("hidden-item-visibilty", true);
    hiddenItemsToggle ? hiddenItemsToggle.checked = true : ''
  } else {
    document.body.classList.remove("show-hidden-items");
    sessionStorage.setItem("hidden-item-visibilty", false);
    hiddenItemsToggle ? hiddenItemsToggle.checked = false : ''
  } 
};

const checkHiddenItemVisibility = () => {
    visibility  = sessionStorage.getItem("hidden-item-visibilty");
    console.log(visibility)
}