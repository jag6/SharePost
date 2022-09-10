document.getElementById("hamburger-icon").onclick = () => openToggleNav();
document.getElementById("close-btn").onclick = () => closeToggleNav();

const openToggleNav = () => {
    document.getElementById("mobile-nav").style.height = "100%";
}

const closeToggleNav = () => {
    document.getElementById("mobile-nav").style.height = "0%";
}


