/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function navbar() {
    var x = document.getElementById("topnav");
    if (x.className === "nav-bar") {
      x.className += " responsive";
    } else {
      x.className = "nav-bar";
    }
  }