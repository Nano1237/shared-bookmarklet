(function (window) {


    /**
     * 
     * @description This is the fundamental bookmarklet javascript object. It allowes the loadet files to communicate.
     * @todo: add more usefull methods (like jquerys dom parser)
     * @returns {sharedBookmarklet_L1.SB}
     */
    function SB() {
        /**
         * 
         * @description All importet variables are stored here
         * @type object
         */
        var importet = {};
        /**
         * 
         * @description Returns one of the importet variables.
         * @param {String} name The name of the imported value
         * @returns {importet|sharedBookmarklet_L1.SB.importet}
         */
        this.import = function (name) {
            if (typeof importet[name] !== 'undefined') {
                return  importet[name];
            }
            throw new Error('The import "' + name + '" was not found!', '', 0);
        };
        /**
         * 
         * @description Saves a new import variable
         * @param {String} name the name of the variable
         * @param {Variable} data the content of the variable
         * @returns {undefined}
         */
        this.export = function (name, data) {
            if (typeof importet[name] !== 'undefined') {
                console.warn('You try to override the import "' + name + '", this could be a mistake!');
            }
            importet[name] = data;
        };
    }



    window.SharedBookmarklet = new SB();
})(window);