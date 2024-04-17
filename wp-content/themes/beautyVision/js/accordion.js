document.addEventListener("DOMContentLoaded", function () {
  const accordionItems = document.querySelectorAll(".accordion-item");

  accordionItems.forEach((item) => {
    const header = item.querySelector(".accordion-header");
    const content = item.querySelector(".accordion-content");

    header.addEventListener("click", () => {
      item.classList.toggle("accordion-open");

      if (item.classList.contains("accordion-open")) {
        content.style.maxHeight = "100%";
        content.style.minHeight = content.scrollHeight + "px";
      } else {
        content.style.maxHeight = "0";
        content.style.minHeight = null;
      }
    });
  });
});
