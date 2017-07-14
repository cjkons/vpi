/*******************************************************************************
 * 
 * CONFIGURAÇÕES DE USUARIO
 *
 *******************************************************************************/

// GLOBALS

var global_isAlterarSenha = false;

// END

$(document).ready(function () {

    $('.fileinput').fileinput();
    
    getUsuario();
    //getGrid();
    carregarChamados();
});

function abrirChamado() {
    
    document.getElementById('telefone').value       = "";  
    document.getElementById('ramal').value          = "";  
    document.getElementById('setor').value          = "";  
    document.getElementById('modulo').value         = "";  
    document.getElementById('prioridade').value     = 0;  
    document.getElementById('descricao').value      = "";  
    document.getElementById('anexo').value      = "";  
    
    $('#abrirChamadoModal').modal('show');
   
    
    
      
}
function fecharModalChamado() {
    
    
    $('#abrirChamadoModal').modal('hide');
   
    
    
     
}

function fecharHistoricoChamado() {
    
    
    $('#historicoChamadoModal').modal('hide');
    carregarChamados();
    
    
     
}
function getUsuario() {
   
    
    $.ajax({
        url: "index.php?m=chamadotecnico&c=visualizarchamadocontroller&f=getUsuario",
        data: {},
        type: "POST",
        dataType: "json",
        async: true,
        cache: false,
        success: function (data) {

           
             $("#nome"). val(data['NOME']);
             $("#email").val(data['EMAIL']);
            
        },
        error: function () {
            
            mensagem('Atenção', 'Houve um problema ao processar as suas informações!!', 'error');
        }
    });
}

function salvarChamado() {

    var nome = document.getElementById("nome").value;
    var email = document.getElementById("email").value;
    var telefone = document.getElementById("telefone").value;
    var ramal = document.getElementById("ramal").value;
    var setor = document.getElementById("setor").value;
    var modulo = document.getElementById("modulo").value;
    var prioridade = document.getElementById("prioridade").value;
    var descricao = document.getElementById("descricao").value;
    var anexo = document.getElementById("anexo").value;

    
    var controleDePreenchimento = 'S';


    if (telefone == "") {
        controleDePreenchimento = 'N';
    }
    if (setor == "") {
        controleDePreenchimento = 'N';
    }
    if (modulo == "") {
        controleDePreenchimento = 'N';
    }
    if (prioridade == 0) {
        controleDePreenchimento = 'N';
    }
    if (descricao == "") {
        controleDePreenchimento = 'N';
    }

    if (controleDePreenchimento == 'S') {


        // VERIFICACAO DE ARQUIVO ANEXADO

        if (anexo != "") {

            var fd = new FormData();

            fd.append('anexo', document.getElementById('anexo').files[0]);



            $.ajax({
                url: 'index.php?m=chamadotecnico&c=visualizarchamadocontroller&f=salvarAnexoAberturaOS',
                type: 'POST',
                cache: false,
                data: fd,
                processData: false,
                contentType: false,
                async: false,
                success: function (enderecoAnexo, pasta) {

                   

                    $('#abrirChamadoModal').modal('hide');

                    bloqueiaTela('Salvando Chamado, aguarde....');

                    $.ajax({
                        url: "index.php?m=chamadotecnico&c=visualizarchamadocontroller&f=salvarChamado",
                        data: {
                            anexo: enderecoAnexo,
                            nome: nome,
                            email: email,
                            telefone: telefone,
                            ramal: ramal,
                            setor: setor,
                            modulo: modulo,
                            prioridade: prioridade,
                            descricao: descricao

                        },
                        type: "POST",
                        dataType: "json",
                        async: true,
                        cache: false,
                        success: function (data) {

                            desbloqueiaTela();

                            if (data == true) {

                                mensagem('Ok', 'Seu chamado foi aberto com sucesso', 'success');

                                document.getElementById('telefone').value = "";
                                document.getElementById('ramal').value = "";
                                document.getElementById('setor').value = "";
                                document.getElementById('modulo').value = "";
                                document.getElementById('prioridade').value = 0;
                                document.getElementById('descricao').value = "";

                                carregarChamados();
                                $('#abrirChamadoModal').modal('hide');
                            } else {
                                mensagem('Atenção', data, 'warning');
                            }
                        },
                        error: function () {
                            desbloquearTela();
                            mensagem('Atenção', 'Houve um problema ao salvar as suas informações!!', 'error');

                            $('#abrirChamadoModal').modal('hide');
                            carregarChamados();
                        }
                    });
                }
            });
        
            
        // SE NAO FOR INSERIDO ANEXO
        } else {

            $('#abrirChamadoModal').modal('hide');

            bloqueiaTela('Salvando Chamado, aguarde....');

            $.ajax({
                url: "index.php?m=chamadotecnico&c=visualizarchamadocontroller&f=salvarChamado",
                data: {
                    
                    nome: nome,
                    email: email,
                    telefone: telefone,
                    ramal: ramal,
                    setor: setor,
                    modulo: modulo,
                    prioridade: prioridade,
                    descricao: descricao

                },
                type: "POST",
                dataType: "json",
                async: true,
                cache: false,
                success: function (data) {

                    desbloqueiaTela();

                    if (data == true) {

                        mensagem('Ok', 'Seu chamado foi aberto com sucesso', 'success');

                        document.getElementById('telefone').value = "";
                        document.getElementById('ramal').value = "";
                        document.getElementById('setor').value = "";
                        document.getElementById('modulo').value = "";
                        document.getElementById('prioridade').value = 0;
                        document.getElementById('descricao').value = "";

                        carregarChamados();
                        $('#abrirChamadoModal').modal('hide');
                    } else {
                        mensagem('Atenção', data, 'warning');
                    }
                },
                error: function () {
                    desbloquearTela();
                    mensagem('Atenção', 'Houve um problema ao salvar as suas informações!!', 'error');

                    $('#abrirChamadoModal').modal('hide');
                    carregarChamados();
                }
            });


        }


    } else {
        mensagem('Atenção', 'Somente o campo Ramal NÃO é necessário', 'error');
    }
}


function salvarInformacoes() {
    
    var chamado                = document.getElementById("numChamadoAdicionar").value;

    var status              = document.getElementById("statusAdicionar").value;  
    var descricao           = document.getElementById("descricaoAdicionar").value;  
   
    var controleDePreenchimento = 'S';
 
   
    if(status == 0){
        controleDePreenchimento = 'N';
    }
    if(descricao == ""){
        controleDePreenchimento = 'N';
    }
    
    if(controleDePreenchimento ==  'S'){
        
        $('#informacoesChamadoModal').modal('hide');
        bloquearTela();
        
        $.ajax({
            url: "index.php?m=chamadotecnico&c=visualizarchamadocontroller&f=salvarInformacoesChamado",
            data: {
                
                chamado: chamado,
                status: status,
                descricao: descricao

            },
            type: "POST",
            dataType: "json",
            async: true,
            cache: false,
            success: function (data) {

                desbloquearTela();

                if (data == true) {

                    mensagem('Ok', 'Informações salvas', 'success');

                    
                    document.getElementById('statusAdicionar').value     = 0;  
                    document.getElementById('descricaoAdicionar').value      = "";  
                    
                    historicoChamado(chamado);
                    $('#informacoesChamadoModal').modal('hide');
                }
                else {
                    mensagem('Atenção', data, 'warning');
                }
            },
            error: function () {
                desbloquearTela();
                mensagem('Atenção', 'Houve um problema ao salvar as suas informações!!', 'error');
                
                $('#informacoesChamadoModal').modal('hide');
                historicoChamado(chamado);
            }
        });

    }else{
        mensagem('Atenção', 'Os campos são necessários', 'error'); 
    }
}




function mascara(telefone1){ 
    if(telefone1.value.length == 0){
         telefone1.value = '' + telefone1.value;
    }     
    if(telefone1.value.length == 2){
        telefone1.value = telefone1.value + ' ';
    }    
//    if(telefone1.value.length == 9){
//        telefone1.value = telefone1.value + '-'; 
//    }
}

function getGrid() {
    
    var objFiltro = new Object();
         
    objFiltro.idEmpresa        = $("#idEmpresaFiltro").val();
    objFiltro.idFilial         = $("#idFilialFiltro").val();
    objFiltro.idRepresentante  = $("#idRepresentanteFiltro").val();
    objFiltro.situacao         = $("#situacaoFiltro").val();
    objFiltro.idCliente        = $("#idClienteFiltro").val();
    
               
    $('#grid').DataTable({
        "destroy": true,
        ajax: {
            "url": "index.php?m=chamadotecnico&c=visualizarchamadocontroller&f=getGrid",
            "data": objFiltro,
            "type": "POST",
        },
        
        
        language: {
            "url": '//cdn.datatables.net/plug-ins/1.10.7/i18n/Portuguese-Brasil.json'
        },
        
        
         
        
        "columns": [
            {"data": "CHAMADO"},
            {"data": "DATA_ABERTURA"},
            {"data": "STATUS"},
            {"data": "NOME"},
            {"data": "CONTATO"},
            {"data": "DESCRICAO"},
            {"data": "HISTORICO"},
            
         
        ],
         "order": [
                [0, 'desc']
            ],
        searching: false
        
    });
    
    
    $('#grid')
        .removeClass('display')
        .addClass('table table-hover table-striped table-bordered');
   
  
     
        
}

function  carregarChamados() {

    

    $.ajax({
        url: 'index.php?m=chamadotecnico&c=visualizarchamadocontroller&f=carregarChamados',
        data: {
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {


            document.getElementById('tabelaChamado').innerHTML = r;
            




        },
        error: function (e) {
            
        }
    });


}

function historicoChamado(chamado) {


    $.ajax({
        url: 'index.php?m=chamadotecnico&c=visualizarchamadocontroller&f=historicoChamado',
        data: {
            chamado: chamado
            


        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {


            $('#historicoChamadoModal').modal('show');
            
            
          
            document.getElementById('tabelaHistorico').innerHTML = r;
            
            document.getElementById('numChamadoHistorico').value = chamado;

        },
        error: function () {

        }
    });

}

function  novasInformacoesChamado() {
    
    
   
    var chamado = document.getElementById('numChamadoHistorico').value;
    
    $.ajax({
        url: 'index.php?m=chamadotecnico&c=visualizarchamadocontroller&f=verificastatusChamado',
        data: {
            chamado: chamado
        
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {
            
            
            if (r != true) {
                
               
                    
                document.getElementById('statusAdicionar').value     = 0;  
                document.getElementById('descricaoAdicionar').value      = ""; 
                document.getElementById('numChamadoAdicionar').value = chamado;
                $('#informacoesChamadoModal').modal('show');

                   
            }else {
               mensagem('', 'Chamado Cancelado/Finalizado!!', 'error');
            }


            

        },
        error: function () {

        }
    });
  
    
}

function  fecharModalInformacoesChamado() {
    
   
    $('#informacoesChamadoModal').modal('hide');
   
}


function bloquearTela() {
      

    $('#carregandoModal').modal('show');
    
//    
}

function desbloquearTela() {
    $('#carregandoModal').modal('hide');
}

function bloqueiaTela(texto) {
      

    $.blockUI({
        css: {
            backgroundColor: '#FFFFFF',
            border: '0px'
        },
        overlayCSS: {
            backgroundColor: '#c6d8ec',
            opacity: 0.3
        },
        message: '<table class="carregando"><tr><td><img width="50px" src="resources/chamadotecnico/img/loading.gif" /></td><td style="font-size: 18px;">' + texto + '</td></tr></table>'
    });
}

function desbloqueiaTela() {
    $.unblockUI();
}







