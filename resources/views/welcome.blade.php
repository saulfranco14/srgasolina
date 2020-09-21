<!doctype html>
<html lang="{{ app()->getLocale() }}">
 
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no"    >
        <title>Sr Gasolina</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="/css/index.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
        <link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />
    </head>
    <body>
        <!-- Nav Bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-success">
            <a class=" navbar navbar-brand colorWhite " href="#"> Sr Gasolina</a>
        </nav>
        <div class="containerDivForm">
            <!-- Maps -->
            <div class="col-lg-6 col-md-8 col-sm-12"> 
                <div id="map" class="mapsContainer">
                </div>
            </div>

            <!-- CP -->
            <div class="col-lg-6 col-md-4 col-sm-12"> 
                <div class="cpContainer">
                    <h2 class="titleCP"> Búsqueda </h2>
                        <div id="StateMun" class="containerDiv">
                                <select
                                    id="optionStates" 
                                    class="form-control col-lg-5 "
                                    onchange="optionState()"
                                >
                                    <option>Estado</option>
                                    @foreach($cpState as $cp)
                                        <option>{{$cp->d_estado}}</option>
                                    @endforeach 
                                </select>
                                <select 
                                    id="optionDelegate"
                                    class="form-control col-lg-6 offset-lg-1 marginTop"
                                    disabled
                                >
                                <option>Municipio</option>
                                </select>
                        </div>  
                        <div id="cpInput" class="containerDiv">
                            <input
                                id="cp"
                                class="form-control  col-lg-12"
                                placeholder="Escribe un codigo postal"
                                max="5"
                            />
                        </div>    
                        <div class="containerDiv">
                                <select 
                                    id="checkOrganizate"
                                    class="form-control col-lg-12"
                                >
                                    <option value="0">Ascedente</option>
                                    <option value="1">Descendente</option>
                                </select>
                        </div>  
                        <div class="containerSpan">  
                            <span 
                                id="textSpan"
                                class="cpDiv text-info "
                                onclick="searchCP()"
                            > 
                            </span>
                        </div> 
                        <div class="containerDiv">   
                            <button 
                                id="buttonSearch"
                                type="button" 
                                class="col-lg-12 btn btn-success"
                                onclick="searchGas()"
                            > 
                                Buscar
                            </button>
                        </div>
                        <div id="resultSearch" class="containerDiv">   
                           
                        </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <span class="text-success"> Consulta de precio de gasolina </span>
            </div>
        </footer>

    <script type="text/javascript" src="/js/index.js"></script>
    </body>
</html>
