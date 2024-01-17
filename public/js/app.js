new TypeIt("#myElement", {
    strings: ["Selamat Datang di", "DispoManager."],
}).go();


function toggleActive(userType) {
    var menuList = document.getElementById('menuList');
    var clickedElement = document.querySelector(`#menuList li[data-user="${userType}"]`);
    var activeElement = document.querySelector('#menuList li.active');

    // Hapus kelas 'active' dari elemen yang memiliki kelas 'active' sebelumnya
    if (activeElement !== null) {
        activeElement.classList.remove('active');
    }

    // Tambahkan kelas 'active' pada elemen yang diklik
    clickedElement.classList.add('active');

    // Ganti URL sesuai dengan data-url pada elemen yang diklik
    var userUrl = clickedElement.getAttribute('data-url');
    window.location.href = userUrl;

    var userImage = document.getElementById('userImage');
    var imagePath = clickedElement.getAttribute('data-image');
    userImage.src = imagePath;
}

  