function kitoltottseg_ell(){
    var egyedi = [];
    var szamlalo = 0;
    var valaszok = [];
    for (var i = 0; i < localStorage.length; i++){
        
        storage_nev = localStorage.key(i);
        if(storage_nev.split("_")[0] == "valasz"){
            if(!(egyedi.includes(storage_nev))){
                egyedi.push(storage_nev);
                valaszok.push(localStorage.key(i)+" "+localStorage.getItem(localStorage.key(i)));
                szamlalo++;
            }
        }
    }

    for (var i = 0; i < valaszok.length; i++){
        var local_ans = valaszok[i].split(" ");
        var nev = "v_"+local_ans[0].split("_")[1];
        var ertek = local_ans[1];
        parameter_linkhez_adas(nev,ertek);
        
    }
    parameter_linkhez_adas("kitoltes",true);
    location.reload();
    
}
function parameter_linkhez_adas(kulcs, ertek){
    const kereso_param = new URLSearchParams(window.location.search);
    kereso_param.set(kulcs, ertek);
    const uj_alternativ_vonal = window.location.pathname+"?"+kereso_param.toString();
    history.pushState(null, "", uj_alternativ_vonal);

    
}

