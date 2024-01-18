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

  