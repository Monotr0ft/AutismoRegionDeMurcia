$(document).ready(function() {
    if (!getCookie('cookiesAccepted')) {
        $('#cookiesModal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#cookiesModal').modal('show');
    }

    $('.acceptCookiesForm').on('submit', function(event) {
        document.cookie = "cookiesAccepted=true; path=/; max-age=" + (60 * 60 * 24 * 365); // 1 año
        this.submit();
    });
});

function getCookie(name) {
    console.log(document.cookie);
    let cookieArr = document.cookie.split(";");
    console.log("Cookies disponibles:", cookieArr);
    for (let i = 0; i < cookieArr.length; i++) {
        let cookiePair = cookieArr[i].split("=");
        console.log("Procesando cookie:", cookiePair[0].trim());
        if (name === cookiePair[0].trim()) {
            console.log("Cookie encontrada:", cookiePair[1]);
            return decodeURIComponent(cookiePair[1]);
        }
    }
    return null;
}