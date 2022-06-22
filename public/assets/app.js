const shrinkBtn = document.querySelector(".shrink-btn");
const sidebarLinks = document.querySelectorAll(".sidebar-links a");
const activeTab = document.querySelector(".active-tab");
const tooltipElements = document.querySelectorAll(".tooltip-element");

let activeIndex;

shrinkBtn.addEventListener("click", () => {
    document.body.classList.toggle("shrink");
    shrinkBtn.classList.add("hovered");

    setTimeout(moveActiveTab, 400);

    setTimeout(() => {
        shrinkBtn.classList.remove("hovered");
    }, 500);
});

function moveActiveTab() {
    let topPosition = activeIndex * 58 + 2.5;

    activeTab.style.top = `${topPosition}px`;
}

function changeLink() {
    sidebarLinks.forEach((sideLink) => sideLink.classList.remove("active"));
    this.classList.add("active");

    activeIndex = this.dataset.active;

    moveActiveTab();
}

sidebarLinks.forEach((link) => link.addEventListener("click", changeLink));

function showTooltip() {
    let tooltip = this.parentNode.lastElementChild;

    let spans = tooltip.children;
    let tooltipIndex = this.dataset.tooltip;

    Array.from(spans).forEach((sp) => sp.classList.remove("show"));

    spans[tooltipIndex].classList.add("show");

    tooltip.style.top = `${(100 / (spans.length * 2)) * (tooltipIndex * 2 + 1)}%`
}

tooltipElements.forEach((elem) =>
    elem.addEventListener("mouseover", showTooltip)
);
