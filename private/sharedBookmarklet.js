(function (window) {


    function SB() {
        var importet = {};


        this.import = function (name) {
            if (typeof importet[name] !== 'undefined') {
                return  importet[name];
            }
            throw new Error('The import "' + name + '" was not found!', '', 0);
        };
        this.export = function (name, data) {
            if (typeof importet[name] !== 'undefined') {
                console.warn('You try to override the import "' + name + '", this could be a mistake!');
            }
            importet[name] = data;
        };
    }



    window.SharedBookmarklet = new SB();
})(window);