document.addEventListener("DOMContentLoaded", function () {
    const menu = document.querySelector(".menu");
    menu.addEventListener("mouseenter", function () {
      menu.querySelector("ul").style.display = "block";
    });

    menu.addEventListener("mouseleave", function () {
      menu.querySelector("ul").style.display = "none";
    });

});

function setActive(element) {
    // Menghapus kelas 'active' dari semua elemen dengan kelas 'menu-item'
    var menuItems = document.querySelectorAll('.text');
    menuItems.forEach(function(item) {
      item.classList.remove('active');
    });
  
    // Menambahkan kelas 'active' pada elemen yang diklik
    element.classList.add('active');
  }
  