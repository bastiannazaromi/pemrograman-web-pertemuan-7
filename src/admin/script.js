document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.querySelector(".toggle-button");
    const menu = document.querySelector(".menu");
    const sidebar = document.querySelector(".sidebar");

    toggleButton.addEventListener("click", function () {
        if (sidebar.style.display === "none" || getComputedStyle(sidebar).display === "none") {
            sidebar.style.display = "block";
        } else {
            sidebar.style.display = "none";
        }
    });

    window.addEventListener("resize", function () {
        if (window.innerWidth > 768) {
            sidebar.style.display = "block"; // Tampilkan sidebar jika lebar layar lebih besar dari 768px
        } else {
			sidebar.style.display = "none";
		}
    });
});