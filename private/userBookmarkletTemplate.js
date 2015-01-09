(function (url, user, token) {
    var sendParam = (function (data) {
        function recKV(ob, oi) {
            var ret = '';
            oi = typeof oi !== 'undefined' ? '[' + encodeURIComponent(oi) + ']' : '';
            for (var index in ob) {
                if (typeof ob[index] === 'object') {
                    ret += recKV(ob[index], index);
                } else {
                    ret += encodeURIComponent(index) + oi + '=' + encodeURIComponent(ob[index]) + '&';
                }
            }
            return ret.replace(/\&$/, '');
        }
        return recKV(data);
    })({
        domain: (location.host.match(/([^.]+)\.\w{2,3}(?:\.\w{2})?$/) || [])[1],
        auth: {
            user: user,
            token: token
        }
    });
    var xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4) {
            if (xmlhttp.status === 200) {
                try {
                    eval(xmlhttp.responseText);
                } catch (e) {
                    alert('JavaScript Error!');
                }
            }
        }
    };

    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(sendParam);
})('http://localhost/shared-bookmarklet/www/bookmarklet.php', 'userA', '123456789');