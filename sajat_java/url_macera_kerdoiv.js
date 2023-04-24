var szam = 0;

function url_rako(){
    var rates = document.getElementsByName('ans');
    var rate_value;
    for(var i = 0; i < rates.length; i++){
        if(rates[i].checked){
            rate_value = rates[i].value;
        }
    }

    location.href = URL_add_parameter(location.href, 'param', rate_value);
    
    
    
}

function URL_add_parameter(url, param, value){
    var hash = {};
    var parser = document.createElement('a');

    parser.href = url;

    var parameters = parser.search.split(/\?|&/);

    for(var i=0; i < parameters.length; i++) {
        if(!parameters[i])
            continue;

        var ary = parameters[i].split('=');
        hash[ary[0]] = ary[1];
    }

    hash[param] = value;

    var list = [];  
    Object.keys(hash).forEach(function (key) {
        list.push(key + '=' + hash[key]);
    });

    parser.search = '?' + list.join('&');
    return parser.href;
}