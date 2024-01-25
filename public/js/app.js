let i = 0;
let text = "Selamat Datang di, DispoManager";
let speed = 100;

function typeWriter() {
    let demoElement = document.getElementById("myElement");

    if (i < text.length) {
        demoElement.innerHTML += text.charAt(i);
        i++;
        setTimeout(typeWriter, speed);
    } else {
      
        setTimeout(function() {
            for (let j = text.length; j >= 0; j--) {
                setTimeout(function() {
                    demoElement.innerHTML = text.substring(0, j);
                }, speed * (text.length - j));
            }

            setTimeout(function() {
                i = 0;
                typeWriter();
            }, speed * (text.length + 1));
        }, 1000); 
    }
}

typeWriter();



function toggleActive(userType) {
    var menuList = document.getElementById('menuList');
    var clickedElement = document.querySelector(`#menuList li[data-user="${userType}"]`);
    var activeElement = document.querySelector('#menuList li.active');

    if (activeElement !== null) {
        activeElement.classList.remove('active');
    }

    clickedElement.classList.add('active');

  
    var userUrl = clickedElement.getAttribute('data-url');
    window.location.href = userUrl;

    var userImage = document.getElementById('userImage');
    var imagePath = clickedElement.getAttribute('data-image');
    userImage.src = imagePath;
}

function pilihKategori(elem) {
    // Menghapus kelas 'active' dari semua elemen kategori
    document.querySelectorAll('#kategori li').forEach(function (el) {
        el.classList.remove('active');
    });

    // Menambahkan kelas 'active' pada elemen kategori yang dipilih
    elem.classList.add('active');

    // Mendapatkan nilai teks dari elemen kategori yang dipilih
    var kategori = elem.innerText;

    // Menampilkan atau menyembunyikan tabel berdasarkan kategori
    tampilkanTabel(kategori);
}

function tampilkanTabel(kategori) {
    // Menyembunyikan semua tabel
    document.querySelectorAll('table').forEach(function (tabel) {
        tabel.classList.add('hidden');
    });

    // Menampilkan tabel yang sesuai dengan kategori
    if (kategori === 'Semua') {
        document.getElementById('tabelSemua').classList.remove('hidden');
    } else if (kategori === 'Surat Masuk') {
        document.getElementById('tabelMasuk').classList.remove('hidden');
    } 
    else if (kategori === 'Surat Keluar') {
        document.getElementById('tabelKeluar').classList.remove('hidden');
    }
}

function confirmLogout() {
    Swal.fire({
        title: 'Konfirmasi',
        text: 'Anda yakin ingin keluar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Keluar!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logout-form').submit();
        }
    });
}

function deleteConfirm(deleteForm) {
    var formElement = document.getElementById(deleteForm);

    if (formElement) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Anda yakin ingin Menghapus?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                formElement.submit();
            }
        });
    } else {
        console.error('Elemen formulir tidak ditemukan dengan ID: ' + deleteForm);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    let eyeicon = document.getElementById("eyeicon");
    let password = document.getElementById("password");

    eyeicon.onclick = function() {
        if (password.type === "password") {
            password.type = "text";
            eyeicon.src = "img/eye.svg";
        } else {
            password.type = "password";
            eyeicon.src = "img/eye-slash.svg";
        }
    };
});



  