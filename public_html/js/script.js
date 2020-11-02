var dropped = false;
function dropdown() {
    if (dropped == false) {
        document.getElementById("Menu").className = "expanded";
        dropped = true;
    } else {
        document.getElementById("Menu").className = "collapsed";
        dropped = false;
    }
}