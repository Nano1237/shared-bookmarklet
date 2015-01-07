(function (SB) {
    /**
     * 
     * @description Simple ajax function without any options (just as demo for the export/imports)
     * @param {type} url the target url
     * @param {type} callback
     * @returns {undefined}
     */
    function loadXMLDoc(url, callback) {
        var xmlhttp;
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4) {
                if (xmlhttp.status === 200) {
                    callback(xmlhttp);
                }
            }
        };

        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }
    //export the ajax method with the name "ajax"
    SB.export('ajax', loadXMLDoc);
})(SharedBookmarklet);