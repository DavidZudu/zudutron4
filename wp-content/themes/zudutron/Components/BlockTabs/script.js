document.addEventListener("click", (e) => {
    if (e.target.closest(".tablinks")) {
      tabToggle(e.target.closest(".tablinks"));
    }
  });
  
  document.addEventListener("change", (e) => {
    if (e.target.closest(".tab-select")) {
      let value = e.target.closest(".tab-select").value;
      tabToggle(document.querySelector('[data-tab="'+value+'"]'));
    }
  });
  
  const tabToggle = (selectedTab) => {
    let tabSection = selectedTab.closest(".tab-section");
    let tabContents = tabSection.querySelectorAll(".tabcontent");
    let tabLinks = tabSection.querySelectorAll(".tablinks");
    let tabSelect = tabSection.querySelector(".tab-select");
    let selectedContentId = selectedTab.value ? selectedTab.dataset.tab : selectedTab.dataset.tab
    let selectedContent = tabSection.querySelector("#" + selectedContentId);
    tabContents.forEach((el) => el.classList.remove("active"));
    tabLinks.forEach((el) => el.classList.remove("active"));
    selectedTab.classList.add("active");
    selectedContent.classList.add("active");
    tabSelect ? tabSelect.value = selectedContentId : '';
  };
  
  const tabsReset = () => {
    document.querySelectorAll(".tab-section").forEach((el) => {
      let tabSection = el;
      let tabContents = tabSection.querySelectorAll(".tabcontent");
      let tabLinks = tabSection.querySelectorAll(".tablinks");
      let tabSelect = tabSection.querySelector(".tab-select");
  
      tabContents.forEach((el) => {
        el.matches('*:first-of-type') ? el.classList.add('active') : el.classList.remove("active");
      });
      tabLinks.forEach((el) => {
        el.matches('*:first-of-type') ? el.classList.add('active') : el.classList.remove("active");
      });
      tabSelect ? tabSelect.value = tabSelect.options[0].value : '';
    });
  };
  