import $ from "jquery";
var Isotope = require("isotope-layout");


// quick search regex
var qsRegex;
var filterSelector = "*";

// init Isotope
var isoGrid = document.querySelector(".grid");
if (isoGrid) {
  var iso = new Isotope(isoGrid, {
    margin: 100,
    filter: function(itemElem) {
      var post = jQuery(this)[0];
      // var search = qsRegex ? post.textContent.match(qsRegex) : true;      
     
      var filterRes = filterSelector != '*' ? post.dataset.cat.includes(filterSelector) : true;

      
      return filterRes;
    }
  });
}

// use value of search field to filter
var quicksearch = document.querySelector(".quicksearch");
if (quicksearch) {
  quicksearch.addEventListener(
    "keyup",
    debounce(function() {
      qsRegex = new RegExp(quicksearch.value, "gi");
      iso.arrange();
    }, 300)
  );
}

// bind filter button click
var filtersElem = document.querySelector(".filters.live");
console.log(filtersElem);
if (filtersElem) {
  filtersElem.addEventListener("click", function(event) {
    // only work with buttons
    if (!event.target.matches(".filter")) {
      return;
    }
    event.preventDefault();
    var filterValue = event.target.getAttribute("data-filter");
    // filterSelector = filterValue == '*' ? filterValue : '[data-cat='+filterValue+']';
    filterSelector = filterValue.trim();
        
    iso.arrange();
  });
}

// change is-checked class on buttons
var buttonGroups = document.querySelectorAll(".filters.live");
for (var i = 0, len = buttonGroups.length; i < len; i++) {
  var buttonGroup = buttonGroups[i];
  radioButtonGroup(buttonGroup);
}

function radioButtonGroup(buttonGroup) {
  buttonGroup.addEventListener("click", function(event) {
    // only work with buttons
    if (!event.target.matches(".filter")) {
      return;
    }
    event.preventDefault();
    buttonGroup.querySelector(".active").classList.remove("active");
    event.target.classList.add("active");
  });
}

function debounce(fn, threshold) {
  var timeout;
  threshold = threshold || 100;
  return function debounced() {
    clearTimeout(timeout);
    var args = arguments;
    var _this = this;

    function delayed() {
      fn.apply(_this, args);
    }
    timeout = setTimeout(delayed, threshold);
  };
}
