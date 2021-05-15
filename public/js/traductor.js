
function traducir(){
    let idioma = $('#idioma').val();
    let traducir = $('#traducir').val();
    traducir = traducir.replaceAll(' ',"%20");
    traducir = traducir.replaceAll(',',"%2C");
    let url = "https://systran-systran-platform-for-language-processing-v1.p.rapidapi.com/translation/text/translate?source=auto&target="+idioma+"&input="+traducir;
    console.log(idioma,traducir);
    console.log(url);
    const settings = {
        "async": true,
        "crossDomain": true,
        "url": url,
        "method": "GET",
        "headers": {
            "x-rapidapi-key": "f62a84aedbmsh68f2e45bc0fc05ap14c898jsn039588dc1d59",
            "x-rapidapi-host": "systran-systran-platform-for-language-processing-v1.p.rapidapi.com"
        }
    };
    
    $.ajax(settings).done(function (response) {
        console.log(response.outputs[0].output);
       // console.log(traduccion[0].output);

        $('#traducido').val(response.outputs[0].output);
    });
}

