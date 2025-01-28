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
    let cookieArr = document.cookie.split(";");
    for (let i = 0; i < cookieArr.length; i++) {
        let cookiePair = cookieArr[i].split("=");
        if (name === cookiePair[0].trim()) {
            return decodeURIComponent(cookiePair[1]);
        }
    }
    return null;
}