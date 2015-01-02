(function (SB) {
    SB.export('demo', function () {//this will define a new anonymous function with the SB name "demo"
        return 6;
    });
    var demo = SB.import('demo');//here you load this "demo" function and put it into the demo var
    console.log(demo);//returns function()
    console.log(demo());//returns 6
    SB.export('demo', 3);//shows a warning for probably mistake override (but it will still be overriden)
    console.log(demo); //here you see the function() because you need to load the new export again
    var newImport = SB.import('demo');//gets the 3
    console.log(newImport);//outputs the 3
})(SharedBookmarklet);