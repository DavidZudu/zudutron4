const pageNav = document.getElementById("pageNav");

if (pageNav) {
  const idEls = document.querySelectorAll(".anchor-element[id]");
  const anchorElements = [];
  idEls.forEach((el) => {
    const hashAnchor = el.id;
    const currentUrl = window.location.href;
    let updatedUrlWithHash;
    if (window.location.hash) {
      const urlWithoutHash = currentUrl.replace(window.location.hash, "");
      updatedUrlWithHash = `${urlWithoutHash}#${hashAnchor}`;
    } else {
      updatedUrlWithHash = `${currentUrl}#${hashAnchor}`;
    }
    const text = `${el.dataset.label}`;
    const anchorElement = `<a href="${updatedUrlWithHash}">${text}</a>`;
    pageNav.innerHTML += anchorElement;
  });
}
