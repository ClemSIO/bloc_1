document.addEventListener("DOMContentLoaded", function () {
    const links = document.querySelectorAll("nav a");
    const sections = document.querySelectorAll("section");

    links.forEach((link) => {
        link.addEventListener("click", function (e) {
            e.preventDefault();

            // Masquer toutes les sections
            sections.forEach((section) => {
                section.style.display = "none";
            });

            // Afficher la section correspondante
            const targetId = this.getAttribute("href").substring(1);
            const targetSection = document.getElementById(targetId);
            if (targetSection) {
                targetSection.style.display = "block";
            }
        });
    });
});