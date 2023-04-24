function valasz_mentes(id,valasz_szam){
    localStorage.setItem('valasz_'+id, valasz_szam);
}

function mult_ellenorzo(id){
    if (!(localStorage.getItem("valasz_"+id) === null)) {
        jelolt_szam = localStorage.getItem("valasz_"+id);
        radiobtn = document.getElementById("lehetoseg_"+id+"_"+jelolt_szam);
        radiobtn.checked = true;
    }
    
}

