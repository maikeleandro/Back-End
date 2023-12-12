function Buscar() {
    $('#edt-pesquisa-retorno').html("");
    let cTipo = $('#edt_tipo').val();
    let nId = $('#edt_quantidade').val();

    SetLoadingVisible(true);
    

    $.ajax({
        type: "post",
        dataType: "",
        url: "./includes/pesquisar.php",
        data: {
            Tipo: cTipo,
            Id: nId
        },
        success: function (e) {             
            var obj = $.parseJSON(e);  
            
            SetLoadingVisible(false);

            $(obj).each((key, item)=> { 
                if(cTipo == "people"){ 
                    if(nId == 0){
                        $('#edt-pesquisa-retorno').html(JSON.stringify(item.Retorno));
                    }
                    else{
                        $('#edt-pesquisa-retorno').html(                            
                                "Nome: " + JSON.stringify(item.Retorno.name)
                            + "\nAltura: " + JSON.stringify(item.Retorno.height)
                            + "\nCor do Cabelo: " + JSON.stringify(item.Retorno.hair_color)
                            + "\nCor da Pele: " + JSON.stringify(item.Retorno.skin_color)
                            + "\nCor dos olhos: " + JSON.stringify(item.Retorno.eye_color)
                            + "\nAno de Nascimento: " + JSON.stringify(item.Retorno.birth_year)
                            + "\nPlaneta Natal: " + JSON.stringify(item.Retorno.homeworld)                        
                            + "\nFilmes: " + JSON.stringify(item.Retorno.films)
                            + "\nEspécies: " + JSON.stringify(item.Retorno.species)
                            + "\nVeiculos: " + JSON.stringify(item.Retorno.vehicles)
                            + "\nNaves estelares: " + JSON.stringify(item.Retorno.starships)
                            + "\nCriada: " + JSON.stringify(item.Retorno.created) 
                            + "\nEditado: " + JSON.stringify(item.Retorno.edited) 
                            + "\nURL: " + JSON.stringify(item.Retorno.url)
                            + "\n"
                            
                        ); 
                    }
                }
                else if(cTipo == "planets"){
                    if(nId == 0){
                        $('#edt-pesquisa-retorno').html(JSON.stringify(item.Retorno));
                    }
                    else{
                        $('#edt-pesquisa-retorno').html(
                              "Nome: " + JSON.stringify(item.Retorno.name)
                            + "\nPeríodo de rotação: " + JSON.stringify(item.Retorno.rotation_period)
                            + "\nPeríodo orbital: " + JSON.stringify(item.Retorno.orbital_period)
                            + "\nDiâmetro: " + JSON.stringify(item.Retorno.diameter)
                            + "\nClima: " + JSON.stringify(item.Retorno.climate)
                            + "\nGravidade: " + JSON.stringify(item.Retorno.gravity)
                            + "\nTerreno: " + JSON.stringify(item.Retorno.terrain)
                            + "\nÁgua da superfície: " + JSON.stringify(item.Retorno.surface_water)
                            + "\nPopulação: " + JSON.stringify(item.Retorno.population)
                            + "\nMoradores: " + JSON.stringify(item.Retorno.residents)
                            + "\nFilmes: " + JSON.stringify(item.Retorno.films)
                            + "\nCriada: " + JSON.stringify(item.Retorno.created) 
                            + "\nEditado: " + JSON.stringify(item.Retorno.edited) 
                            + "\nURL: " + JSON.stringify(item.Retorno.url)
                            + "\n"

                        );
                    }

                }
                else if(cTipo == "starships"){
                    if(nId == 0){
                        $('#edt-pesquisa-retorno').html(JSON.stringify(item.Retorno));
                    }
                    else{
                        $('#edt-pesquisa-retorno').html(
                            "Nome: " + JSON.stringify(item.Retorno.name)
                            + "\nModelo: " + JSON.stringify(item.Retorno.model)
                            + "\nFabricante: " + JSON.stringify(item.Retorno.manufacturer)
                            + "\nCusto em créditos: " + JSON.stringify(item.Retorno.cost_in_credits)
                            + "\Comprimento: " + JSON.stringify(item.Retorno.length)
                            + "\nvelocidade máxima de atmosfera: " + JSON.stringify(item.Retorno.max_atmosphering_speed)
                            + "\nEquipe: " + JSON.stringify(item.Retorno.crew)
                            + "\nPassageiros: " + JSON.stringify(item.Retorno.passengers)
                            + "\nCapacidade de carga: " + JSON.stringify(item.Retorno.cargo_capacity)
                            + "\nConsumo: " + JSON.stringify(item.Retorno.consumables)
                            + "\nClassificação de hiperdrive: " + JSON.stringify(item.Retorno.hyperdrive_rating)
                            + "\nRevista: " + JSON.stringify(item.Retorno.MGLT)
                            + "\nClasse de nave estelar: " + JSON.stringify(item.Retorno.starship_class)
                            + "\nPilotos: " + JSON.stringify(item.Retorno.pilots)
                            + "\nFilmes: " + JSON.stringify(item.Retorno.films)
                            + "\nCriado: " + JSON.stringify(item.Retorno.created) 
                            + "\nEditado: " + JSON.stringify(item.Retorno.edited) 
                            + "\nURL: " + JSON.stringify(item.Retorno.url)
                            + "\n"
                        );
                    }
                }
               
                // ↓ Gerar Log ↓
                GerarLog(JSON.stringify(item.Url), JSON.stringify(item.Retorno), cTipo, nId);
                // ↑ Gerar Log ↑
            });          
        }
    }).fail(
        function (jqXHR, textStatus, errorThrown) {
            let msg;
            SetLoadingVisible(false);
            msg = "Não foi possível carregar sua tarefa, tente novamente em instantes. </b>" + errorThrown;
            $('#edt-retorn-pesquisa').html(msg);
        }
    );

    //$('#loading').hide();
}

function GerarLog(cUrl = null, cMsg = null, cTipo = null, nId = null){

    $.ajax({
        type: "post",
        dataType: "",
        url: "./includes/gerar_log.php",
        data: {
            Url: cUrl,
            Msg: cMsg,
            Tipo: cTipo,
            Id: nId
        },
        success: function (e) { 
            var obj = $.parseJSON(e);          
            $(obj).each((key, item)=> { 
                $('#edt-log-retorno').val(JSON.stringify(item.Mensagem));
            });
        }
    }).fail(
        function (jqXHR, textStatus, errorThrown) {
            let msg;
            msg = "Não foi possível gerar o log, tente novamente em instantes. " + errorThrown;
            $('#edt-log-retorno').val(msg);
        }
    );
}

function SetLoadingVisible(bVisible)
{
    if (bVisible == true)
    {
        $('#loading').css('display', 'block');
    }
    else 
    {
        $('#loading').css('display', 'none');
    }
    
    return true;
}

$(document).ready(function () {

    $('#edt_tipo').val('people');
    $('#edt_quantidade').val(0);
    $('#edt-pesquisa-retorno').html("");

    $('#edt-pesquisar').on('click', function () {           
        Buscar();        
    });

    $('#edt-limpar').on('click', function () {
        $('#edt-pesquisa-retorno').html("");
    });
});