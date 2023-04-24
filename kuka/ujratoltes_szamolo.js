var x = document.getElementById("bekuldo_gomb_hatter");

x.style.display = 'none';

window.addEventListener("unload", function(){
    var count = parseInt(localStorage.getItem('counter') || 0);

    localStorage.setItem('counter', ++count)
}, false);

console.log("újratöltések száma: "+localStorage.getItem('counter'))

if (localStorage.getItem('counter') > 2) {
    x.style.display = "block";
}
