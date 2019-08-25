// Tạo 1 cookie
function createCookie(name, value, days) {
    var expires = '';
    if (Number.isInteger(days)) {
        var date = new Date();
        date.setDate(date.getDate() + days);
        expires = '; expires=' + date.toUTCString();
    }
    document.cookie = name + "=" + escape(value) + expires;
}

// Xóa 1 cookie
function deleteCookie(name) {
    createCookie(name, '', -1);
}

// Xem giá trị của cookie
function getCookie(name) {
    var cookies = document.cookie;
    var result = null;
    if (cookies.length > 0) {
        var arrCookies = cookies.split(';');
        // firstName=Nguy%u1EC5n; fullName=Nguy%u1EC5n%20V%u0103n%20A
        var patt = new RegExp(name);
        for (let i = 0; i < arrCookies.length; i++) {
            if (patt.test(arrCookies[i])) {
                result = unescape(arrCookies[i].slice(arrCookies[i].indexOf('=') + 1));
                break;
            }
        }
    }

    return result;
}
