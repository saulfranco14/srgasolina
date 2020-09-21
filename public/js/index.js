// mapbox
mapboxgl.accessToken = 'pk.eyJ1Ijoic2F1bDE0MjAiLCJhIjoiY2tmYm95eWRsMTRkajJxbzM3bDc0MXo5eCJ9.0cjInbdHspfhevnMuw7puQ';

let map = new mapboxgl.Map({
    container   : 'map',
    style       : 'mapbox://styles/mapbox/streets-v11',
    center      : [-99.165813,19.3910038 ],
    zoom        : 10,
    boxZoom		: true
});

map.addControl(new mapboxgl.NavigationControl());
map.addControl(new mapboxgl.FullscreenControl());


// NONE CP
document.getElementById("cpInput").style.display = "none";
document.getElementById("textSpan").innerHTML="¿No encuentras tu Estado? da click aqui";

// States and Delegate
async function optionState(){
    let  nameState          =  document.getElementById("optionStates").value;
    let  optionsState       =  document.getElementById("optionDelegate");
    optionsState.disabled   = false;
 
    if(nameState){
        const url           = `/delegateOptions/${nameState}`;
        const respuesta     = await fetch(decodeURIComponent(url));
        const resultado     = await respuesta.json();
        let delegOptions    = '<option value=""></option>';

        for(var i=0; i < resultado.length; i++){
            delegOptions += '<option value="'+ resultado[i].d_codigo +'">'+resultado[i].d_asenta+'</option>';
        };
        optionsState.innerHTML= delegOptions;
    }
}

// Search of gas depending of the state and municipality
async function searchGas(){
    let check           =   document.getElementById("checkOrganizate").value;
    let valueDelegate   =   document.getElementById("optionDelegate").value;
    let cpInput         =   document.getElementById("cp").value;
    let divContainer    =   document.getElementById("resultSearch");
    let cp;

    if( valueDelegate.length > 1 ){
        cp = valueDelegate;
    }

    if( cpInput.length > 1 ){
        cp = cpInput;
        
    }
    
    const url           = `https://api.datos.gob.mx/v1/precio.gasolina.publico`;
    const responseGas   = await fetch(url);
    const resultGas     = await responseGas.json();
    let   objectGas          = {
        "success" : true,
        "results" : resultGas.results,
    }
 
    // Searching Gas station depending the cp
    const  resultGasStation = objectGas.results.filter( gasStation =>{
        let intCP = parseInt(gasStation.codigopostal);
        return intCP === parseInt(cp);
    })

    resultGasStation.length === 0 ? 
        divContainer.innerHTML =`<span> No hay resultado en ese Estado y/o Municipio </span>` 
    : 
        resultGasStation.map(producto => {
                return  divContainer.innerHTML= `<h4> El resultado de la búsqueda es: </h4> <br/>
                                                <ul>
                                                    <li> Calle: ${producto.calle} </span> 
                                                    <li> Precio regular: ${producto.regular} </span> 
                                                    <li> Precio premium: ${producto.premium} </span> 
                                                </ul>
                `
        })
    ;

    let  latitudeMap    = resultGasStation[0].latitude;
    let  longitudeMap   = resultGasStation[0].longitude;

    // Mapbox Markers
    let element         = document.createElement('div');
    element.className   ='marker';
    let popup             = new mapboxgl.Popup( {
        offset             : 25
    } );

    let marker = new mapboxgl.Marker(element)
    .setLngLat([longitudeMap, latitudeMap])
    .setPopup( popup )
    .addTo(map);

    // center Map
    map.flyTo({center: [longitudeMap, latitudeMap]})
    
}

function searchCP(){
    document.getElementById("StateMun").style.display   = "none";
    document.getElementById("cpInput").style.display    = "block";
    document.getElementById("textSpan").innerHTML       = "Ver por estados";
}