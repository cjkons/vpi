///////////////////////////////////////////////
/// Cadastro de ASO                         ///
/// CLARIFY - GESTAO DE PESSOAS             ///   
/// Desenvolvido por HEITOR SIQUEIRA        ///
/// JULHO DE 2017                           ///
/// VPI TECNOLOGIA                          ///
///////////////////////////////////////////////

var tipoFilial;

$(document).ready(function() {
  
  carregarEmpresa();    
  carregarFilial();
  carregarFuncionario();
  getGrid();
  
$('#dataExameComplementar').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR"
  });     

$('#dataRealizacao').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR"
  });

$('#dataComplementar1').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR"
  });     
$('#dataComplementar2').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR"
  });

  $('#dataComplementar3').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR"
  }); 
  $('#dataComplementar4').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR"
  });
  $('#dataComplementar5').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR"
  });
  $('#dataComplementar6').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR"
  });
  $('#dataComplementar7').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR"
  });
  $('#dataComplementar8').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR"
  });
  

});

 $(function(){ 
   // abas
   // oculta todas as abas
   $("div.contaba").hide();
   // mostra somente  a primeira aba
   $("div.contaba:first").show(); 
   // seta a primeira aba como selecionada (na lista de abas)
   $("#abas a:first").addClass("selected");

   // quando clicar no link de uma aba
   $("#abas a").click(function(){
   // oculta todas as abas
   $("div.contaba").hide();
   // tira a seleção da aba atual
   $("#abas a").removeClass("selected");

   // adiciona a classe selected na selecionada atualmente
   $(this).addClass("selected");
   // mostra a aba clicada
   $($(this).attr("href")).show();
   // pra nao ir para o link
   return false;
   });
   });



$(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#cep').blur(function(){
       
             
             
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'index.php?m=cadastroaso&c=cadastroasocontroller&f=consultarCep', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'cep=' + $('#cep').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                    
                    if(data.sucesso == 1){
                        $('#endereco').val(data.endereco);
                        $('#bairro').val(data.bairro);
                        $('#cidade').val(data.cidade);
                        $('#estado').val(data.estado);
 
                        $('#numero').focus();
                    }
                    else {
                        mensagem('Atenção', 'CEP Não encontrado', 'error');
                    }
                }
           });   
   return false;    
   })
});

function ocultarGrid(){
    
    
    document.getElementById('grid_wrapper').hidden = true;
}
function mostrarGrid(){
    
    
     
     document.getElementById('grid_wrapper').hidden = false;
}





function novo(){
    
    document.getElementById("idAso").readOnly             = true;
    document.getElementById("empresa").readOnly             = false;
    document.getElementById("filial").readOnly             = false;
    document.getElementById("funcionario").readOnly             = false;
    document.getElementById("matricula").readOnly             = true;
    document.getElementById("setor").readOnly             = true;
    document.getElementById("funcao").readOnly             = true;
    document.getElementById("dataNasc").readOnly             = true;
    document.getElementById("cpf").readOnly             = true;
    document.getElementById("ctps").readOnly             = true;
    document.getElementById("pisPasep").readOnly             = true;
    
    
    document.getElementById("tipoExames").readOnly             = false;
    document.getElementById("outrosExames").readOnly             = false;
    document.getElementById("medico").readOnly             = false;
    document.getElementById("crm").readOnly             = false;
    
    document.getElementById("agBiologico").disabled = false;
    document.getElementById("agFisico").disabled = false;
    document.getElementById("agQuimico").disabled = false;
    document.getElementById("riscoAcidente").disabled = false;
    document.getElementById("riscoErgonomico").disabled = false;
    document.getElementById("ausenciaRisco").disabled = false;
    
    document.getElementById("resultadoExame").readOnly             = true;
    document.getElementById("observacaoExame").readOnly             = false;
    document.getElementById("dataRealizacao").readOnly             = false;
    
    
    document.getElementById("exameComplementar1").readOnly             = false;
    document.getElementById("dataComplementar1").readOnly             = false;
    document.getElementById("exameComplementar2").readOnly             = false;
    document.getElementById("dataComplementar2").readOnly             = false;
    document.getElementById("exameComplementar3").readOnly             = false;
    document.getElementById("dataComplementar3").readOnly             = false;
    document.getElementById("exameComplementar4").readOnly             = false;
    document.getElementById("dataComplementar4").readOnly             = false;
    document.getElementById("exameComplementar5").readOnly             = false;
    document.getElementById("dataComplementar5").readOnly             = false;
    document.getElementById("exameComplementar6").readOnly             = false;
    document.getElementById("dataComplementar6").readOnly             = false;
    document.getElementById("exameComplementar7").readOnly             = false;
    document.getElementById("dataComplementar7").readOnly             = false;
    document.getElementById("exameComplementar8").readOnly             = false;
    document.getElementById("dataComplementar8").readOnly             = false;
    
    document.getElementById("pagamentoExame").readOnly             = false;
    document.getElementById("valorExame").readOnly             = false; 
    
    
    document.getElementById("idAso").value            = "";
    document.getElementById("empresa").value            = 0;
    document.getElementById("filial").value            = 0;
    document.getElementById("funcionario").value            = 0;
    document.getElementById("matricula").value            = "";
    document.getElementById("setor").value            = "";
    document.getElementById("funcao").value            = "";
    document.getElementById("dataNasc").value            = "";
    document.getElementById("cpf").value            = "";
    document.getElementById("ctps").value            = "";
    document.getElementById("pisPasep").value            = "";
    
    
    document.getElementById("tipoExames").value            = 0;
    document.getElementById("outrosExames").value            = "";
    document.getElementById("medico").value            = "";
    document.getElementById("crm").value            = "";
    
    $('#agBiologico').prop('checked', false);
    $('#agFisico').prop('checked', false);
    $('#agQuimico').prop('checked', false);
    $('#riscoAcidente').prop('checked', false);
    $('#riscoErgonomico').prop('checked', false);
    $('#ausenciaRisco').prop('checked', false);
    
    document.getElementById("resultadoExame").value            = 0;
    document.getElementById("observacaoExame").value            = "";
    document.getElementById("dataRealizacao").value            = "";
    
    
    document.getElementById("exameComplementar1").value            = "";
    document.getElementById("dataComplementar1").value            = "";
    document.getElementById("exameComplementar2").value            = "";
    document.getElementById("dataComplementar2").value            = "";
    document.getElementById("exameComplementar3").value            = "";
    document.getElementById("dataComplementar3").value            = "";
    document.getElementById("exameComplementar4").value            = "";
    document.getElementById("dataComplementar4").value            = "";
    document.getElementById("exameComplementar5").value            = "";
    document.getElementById("dataComplementar5").value            = "";
    document.getElementById("exameComplementar6").value            = "";
    document.getElementById("dataComplementar6").value            = "";
    document.getElementById("exameComplementar7").value            = "";
    document.getElementById("dataComplementar7").value            = "";
    document.getElementById("exameComplementar8").value            = "";
    document.getElementById("dataComplementar8").value            = "";
    
    document.getElementById("pagamentoExame").value            = 0;
    document.getElementById("valorExame").value            = "";
    
         
    $.ajax({
        url: 'index.php?m=cadastroaso&c=cadastroasocontroller&f=novo',
        data: {
            
           
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             document.getElementById("idAso").value  = r;
             carregarDataAtual();    
            
        },
        error: function(e) {
           
        }
    }); 
    
}
    
function salvar(){
    
   
     
    var idAso           =   $('#idAso').val();
    var empresa           =   $('#empresa').val();
    var filial           =   $('#filial').val();
    var funcionario           =   $('#funcionario').val();
    var matricula           =   $('#matricula').val();
    var setor           =   $('#setor').val();
    var funcao           =   $('#funcao').val();
    var dataNasc          =   $('#dataNasc').val();
    var cpf           =   $('#cpf').val();
    var ctps           =   $('#ctps').val();
    var pisPasep           =   $('#pisPasep').val();
    
    var tipoExames           =   $('#tipoExames').val();
    var outrosExames           =   $('#outrosExames').val();
    var medico           =   $('#medico').val();
    var crm           =   $('#crm').val();
    
    var resultadoExame           =   $('#resultadoExame').val();
    var observacaoExame           =   $('#observacaoExame').val();
    var dataRealizacao           =   $('#dataRealizacao').val();
    
    var exameComplementar1           =   $('#exameComplementar1').val();
    var dataComplementar1           =   $('#dataComplementar1').val();
    var exameComplementar2           =   $('#exameComplementar2').val();
    var dataComplementar2           =   $('#dataComplementar2').val();
    var exameComplementar3           =   $('#exameComplementar3').val();
    var dataComplementar3          =   $('#dataComplementar3').val();
    var exameComplementar4           =   $('#exameComplementar4').val();
    var dataComplementar4           =   $('#dataComplementar4').val();
    var exameComplementar5           =   $('#exameComplementar5').val();
    var dataComplementar5           =   $('#dataComplementar5').val();
    var exameComplementar6           =   $('#exameComplementar6').val();
    var dataComplementar6           =   $('#dataComplementar6').val();
    var exameComplementar7           =   $('#exameComplementar7').val();
    var dataComplementar7           =   $('#dataComplementar7').val();
    var exameComplementar8           =   $('#exameComplementar8').val();
    var dataComplementar8           =   $('#dataComplementar8').val();
    
    var pagamentoExame           =   $('#pagamentoExame').val();
    var valorExame           =   $('#valorExame').val();
    
    if ($('#agBiologico').is(':checked') == true) {
    
        var agBiologico = "S";
        
    }else{
        
        var agBiologico = "N";
    }
    
    if ($('#agFisico').is(':checked') == true) {
    
        var agFisico = "S";
        
    }else{
        
        var agFisico = "N";
    }
    
    if ($('#agQuimico').is(':checked') == true) {
    
        var agQuimico = "S";
        
    }else{
        
        var agQuimico = "N";
    }
    
    if ($('#riscoAcidente').is(':checked') == true) {
    
        var riscoAcidente = "S";
        
    }else{
        
        var riscoAcidente = "N";
    }
    
    if ($('#riscoErgonomico').is(':checked') == true) {
    
        var riscoErgonomico = "S";
        
    }else{
        
        var riscoErgonomico = "N";
    }
    
    if ($('#ausenciaRisco').is(':checked') == true) {
    
        var ausenciaRisco = "S";
        
    }else{
        
        var ausenciaRisco = "N";
    }
    
    var controleDePreenchimento = 'S';
 
    if(idAso == ""){
        controleDePreenchimento = 'N';
    }
    if(empresa == 0){
        controleDePreenchimento = 'N';
    }
    if(filial == 0){
        controleDePreenchimento = 'N';
    }
    if(funcionario == 0){
        controleDePreenchimento = 'N';
    }
    if(tipoExames == 0){
        controleDePreenchimento = 'N';
    }
    if(medico == ""){
        controleDePreenchimento = 'N';
    }
       
    if(crm == ""){
        controleDePreenchimento = 'N';
    }
    
    if(agBiologico == "N"){
        if(agFisico == "N"){
            if(agQuimico == "N"){
                if(riscoAcidente == "N"){
                    if(riscoErgonomico == "N"){
                        if(ausenciaRisco == "N"){
                            
                            controleDePreenchimento = 'N';
                        }
                    }
                }
            }
        }
    }
    
    if(resultadoExame == 0){
        controleDePreenchimento = 'N';
    }
    if(dataRealizacao == ""){
        controleDePreenchimento = 'N';
    }
    if(pagamentoExame == 0){
        controleDePreenchimento = 'N';
    }
    
    
    
    
    
    if(controleDePreenchimento ==  'S'){
        
                document.getElementById("idAso").readOnly             = true;
                document.getElementById("empresa").readOnly             = false;
                document.getElementById("filial").readOnly             = false;
                document.getElementById("funcionario").readOnly             = false;
                document.getElementById("matricula").readOnly             = true;
                document.getElementById("setor").readOnly             = true;
                document.getElementById("funcao").readOnly             = true;
                document.getElementById("dataNasc").readOnly             = true;
                document.getElementById("cpf").readOnly             = true;
                document.getElementById("ctps").readOnly             = true;
                document.getElementById("pisPasep").readOnly             = true;


                document.getElementById("tipoExames").readOnly             = true;
                document.getElementById("outrosExames").readOnly             = true;
                document.getElementById("medico").readOnly             = true;
                document.getElementById("crm").readOnly             = true;

                document.getElementById("agBiologico").disabled = true;
                document.getElementById("agFisico").disabled = true;
                document.getElementById("agQuimico").disabled = true;
                document.getElementById("riscoAcidente").disabled = true;
                document.getElementById("riscoErgonomico").disabled = true;
                document.getElementById("ausenciaRisco").disabled = true;

                document.getElementById("resultadoExame").readOnly             = true;
                document.getElementById("observacaoExame").readOnly             = true;
                document.getElementById("dataRealizacao").readOnly             = true;


                document.getElementById("exameComplementar1").readOnly             = true;
                document.getElementById("dataComplementar1").readOnly             = true;
                document.getElementById("exameComplementar2").readOnly             = true;
                document.getElementById("dataComplementar2").readOnly             = true;
                document.getElementById("exameComplementar3").readOnly             = true;
                document.getElementById("dataComplementar3").readOnly             = true;
                document.getElementById("exameComplementar4").readOnly             = true;
                document.getElementById("dataComplementar4").readOnly             = true;
                document.getElementById("exameComplementar5").readOnly             = true;
                document.getElementById("dataComplementar5").readOnly             = true;
                document.getElementById("exameComplementar6").readOnly             = true;
                document.getElementById("dataComplementar6").readOnly             = true;
                document.getElementById("exameComplementar7").readOnly             = true;
                document.getElementById("dataComplementar7").readOnly             = true;
                document.getElementById("exameComplementar8").readOnly             = true;
                document.getElementById("dataComplementar8").readOnly             = true;

                document.getElementById("pagamentoExame").readOnly             = true;
                document.getElementById("valorExame").readOnly             = true; 
    
        
        
        
        
            $.ajax({
                        url: 'index.php?m=cadastrofuncionarios&c=cadastrofuncionarioscontroller&f=salvar',
                        data: {
                            
                                    idAso: idAso,
                                    empresa: empresa,
                                    filial: filial,
                                    funcionario: funcionario,
                                    matricula: matricula,
                                    setor: setor,
                                    funcao: funcao,
                                    dataNasc: dataNasc,
                                    cpf: cpf,
                                    ctps: ctps,
                                    pisPasep: pisPasep,
                                    
                                    
                                    tipoExames: tipoExames,
                                    outrosExames: outrosExames,
                                    medico: medico,
                                    crm: crm,
                                    agBiologico: agBiologico,
                                    agFisico: agFisico,
                                    agQuimico: agQuimico,
                                    riscoAcidente: riscoAcidente,
                                    riscoErgonomico: riscoErgonomico,
                                    ausenciaRisco: ausenciaRisco,
                                    observacaoExame: observacaoExame,
                                    dataRealizacao: dataRealizacao,
                                    
                                    
                                    exameComplementar1: exameComplementar1,
                                    dataComplementar1: dataComplementar1,
                                    exameComplementar2: exameComplementar2,
                                    dataComplementar2: dataComplementar2,
                                    exameComplementar3: exameComplementar3,
                                    dataComplementar3: dataComplementar3,
                                    exameComplementar4: exameComplementar4,
                                    dataComplementar4: dataComplementar4,
                                    exameComplementar5: exameComplementar5,
                                    dataComplementar5: dataComplementar5,
                                    exameComplementar6: exameComplementar6,
                                    dataComplementar6: dataComplementar6,
                                    exameComplementar7: exameComplementar7,
                                    dataComplementar7: dataComplementar7,
                                    exameComplementar8: exameComplementar8,
                                    dataComplementar8: dataComplementar8,
                                    
                                    pagamentoExame: pagamentoExame,
                                    valorExame: valorExame
                                    
                            


                        },
                        type: 'POST',
                        dataType: 'json',
                        async: true,
                        success: function(r) {

                            if (r == true) {
                                mensagem('Sucesso', 'Salvo com sucesso', 'success');
                                $('#basicModal').modal('hide');
                                document.getElementById("imagemView").innerHTML = "";
                                atualizar();
                            }
                            else {
                                mensagem('Atenção', 'Erro ao salvar', 'error'); 
                            }
                        },
                        error: function(e) {
                             mensagem('Atenção', 'Erro ao salvar', 'error'); 
                        }
                    });
        }
            
    
            
    else{
        mensagem('Atenção', 'Prencha todos os campos', 'alert');
        
      
            
    }
    
}

function excluir(){
    
    var idFuncionario  =   $('#idFuncionario').val();
     
    $.ajax({
        url: 'index.php?m=cadastrofuncionarios&c=cadastrofuncionarioscontroller&f=excluir',
        data: {
            idFuncionario: idFuncionario
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {

            if (r == true) {
                mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                $('#basicModal').modal('hide');
                document.getElementById("imagemView").innerHTML = "";
                atualizar();
            }
            else {
               mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                $('#basicModal').modal('hide');
                document.getElementById("imagemView").innerHTML = "";
                atualizar();
            }
        },
        error: function(e) {
            mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
            $('#basicModal').modal('hide');
            document.getElementById("imagemView").innerHTML = "";

        }
    }); 
     
}


function pesquisar() {
    
    $('#pesquisarModal').modal('show');
    
    document.getElementById("idPesquisarInicio").value   = "";
    document.getElementById("idPesquisarFim").value      = "";
    document.getElementById("nomePesquisarInicio").value = "";
    document.getElementById("nomePesquisarFim").value   = "";
  
}

function editar(){
    
    document.getElementById("idFuncionario").readOnly = true;
    document.getElementById("empresa").readOnly = false;
    document.getElementById("filial").readOnly = false;
    document.getElementById("livro").readOnly = false;
    document.getElementById("pagina").readOnly = false;
    document.getElementById("matricula").readOnly = false;
    document.getElementById("funcao").readOnly = false;
    document.getElementById("salarioValor").readOnly = false;
    document.getElementById("salarioPagamento").readOnly = false;
    document.getElementById("dataAdmissao").readOnly = false;
    document.getElementById("experiencia").readOnly = false;
    document.getElementById("horarioInicial1").readOnly = false;
    document.getElementById("horarioFinal1").readOnly = false;
    document.getElementById("horarioInicial2").readOnly = false;
    document.getElementById("horarioFinal2").readOnly = false;
    document.getElementById("dataCadastro").readOnly = true;
    document.getElementById("nomeFuncionario").readOnly = false;
    document.getElementById("dataNasc").readOnly = false;
    document.getElementById("cidadeNasc").readOnly = false;
    document.getElementById("estadoNasc").readOnly = false;
    document.getElementById("nomeMae").readOnly = false;
    document.getElementById("nomePai").readOnly = false;
    document.getElementById("imagem").readOnly = false;
    document.getElementById("cep").readOnly = false;
    document.getElementById("endereco").readOnly = false;
    document.getElementById("numero").readOnly = false;
    document.getElementById("bairro").readOnly = false;
    document.getElementById("cidade").readOnly = false;
    document.getElementById("estado").readOnly = false;
    document.getElementById("telefone1").readOnly = false;
    document.getElementById("telefone2").readOnly = false;
    document.getElementById("telefone3").readOnly = false;
    document.getElementById("email").readOnly = false;
    document.getElementById("cpf").readOnly = false;
    document.getElementById("identidade").readOnly = false;
    document.getElementById("expedidorIdentidade").readOnly = false;
    document.getElementById("estadoIdentidade").readOnly = false;
    document.getElementById("dataIdentidade").readOnly = false;
    document.getElementById("ctps").readOnly = false;
    document.getElementById("serieCtps").readOnly = false;
    document.getElementById("pisPasep").readOnly = false;
    document.getElementById("estadoCtps").readOnly = false;
    document.getElementById("dataCtps").readOnly = false;
    document.getElementById("tituloEleitor").readOnly = false;
    document.getElementById("zonaEleitor").readOnly = false;
    document.getElementById("secaoEleitor").readOnly = false;
    document.getElementById("sexo").readOnly = false;
    document.getElementById("estadoCivil").readOnly = false;
    document.getElementById("deficienteFisico").readOnly = false;
    document.getElementById("grauInstrucao").readOnly = false;
    document.getElementById("etnia").readOnly = false;
    document.getElementById("corOlhos").readOnly = false;
    document.getElementById("corCabelos").readOnly = false;
    document.getElementById("altura").readOnly = false;
    document.getElementById("peso").readOnly = false;
    document.getElementById("nomeFilho1").readOnly = false;
    document.getElementById("dataNasc1").readOnly = false;
    document.getElementById("nomeFilho2").readOnly = false;
    document.getElementById("dataNasc2").readOnly = false;
    document.getElementById("nomeFilho3").readOnly = false;
    document.getElementById("dataNasc3").readOnly = false;
    document.getElementById("nomeFilho4").readOnly = false;
    document.getElementById("dataNasc4").readOnly = false;
    document.getElementById("nomeFilho5").readOnly = false;
    document.getElementById("dataNasc5").readOnly = false;
    document.getElementById("nomeFilho6").readOnly = false;
    document.getElementById("dataNasc6").readOnly = false;
    document.getElementById("setor").readOnly = false;
    document.getElementById("desativado").disabled = false;
    
         
       
    
}

function buscaPrimeiroRegistro(){
    
    document.getElementById("idFuncionario").readOnly = true;
    document.getElementById("empresa").readOnly = true;
    document.getElementById("filial").readOnly = true;
    document.getElementById("livro").readOnly = true;
    document.getElementById("pagina").readOnly = true;
    document.getElementById("matricula").readOnly = true;
    document.getElementById("funcao").readOnly = true;
    document.getElementById("salarioValor").readOnly = true;
    document.getElementById("salarioPagamento").readOnly = true;
    document.getElementById("dataAdmissao").readOnly = true;
    document.getElementById("experiencia").readOnly = true;
    document.getElementById("horarioInicial1").readOnly = true;
    document.getElementById("horarioFinal1").readOnly = true;
    document.getElementById("horarioInicial2").readOnly = true;
    document.getElementById("horarioFinal2").readOnly = true;
    document.getElementById("dataCadastro").readOnly = true;
    document.getElementById("nomeFuncionario").readOnly = true;
    document.getElementById("dataNasc").readOnly = true;
    document.getElementById("cidadeNasc").readOnly = true;
    document.getElementById("estadoNasc").readOnly = true;
    document.getElementById("nomeMae").readOnly = true;
    document.getElementById("nomePai").readOnly = true;
    document.getElementById("imagem").readOnly = true;
    document.getElementById("cep").readOnly = true;
    document.getElementById("endereco").readOnly = true;
    document.getElementById("numero").readOnly = true;
    document.getElementById("bairro").readOnly = true;
    document.getElementById("cidade").readOnly = true;
    document.getElementById("estado").readOnly = true;
    document.getElementById("telefone1").readOnly = true;
    document.getElementById("telefone2").readOnly = true;
    document.getElementById("telefone3").readOnly = true;
    document.getElementById("email").readOnly = true;
    document.getElementById("cpf").readOnly = true;
    document.getElementById("identidade").readOnly = true;
    document.getElementById("expedidorIdentidade").readOnly = true;
    document.getElementById("estadoIdentidade").readOnly = true;
    document.getElementById("dataIdentidade").readOnly = true;
    document.getElementById("ctps").readOnly = true;
    document.getElementById("serieCtps").readOnly = true;
    document.getElementById("pisPasep").readOnly = true;
    document.getElementById("estadoCtps").readOnly = true;
    document.getElementById("dataCtps").readOnly = true;
    document.getElementById("tituloEleitor").readOnly = true;
    document.getElementById("zonaEleitor").readOnly = true;
    document.getElementById("secaoEleitor").readOnly = true;
    document.getElementById("sexo").readOnly = true;
    document.getElementById("estadoCivil").readOnly = true;
    document.getElementById("deficienteFisico").readOnly = true;
    document.getElementById("grauInstrucao").readOnly = true;
    document.getElementById("etnia").readOnly = true;
    document.getElementById("corOlhos").readOnly = true;
    document.getElementById("corCabelos").readOnly = true;
    document.getElementById("altura").readOnly = true;
    document.getElementById("peso").readOnly = true;
    document.getElementById("nomeFilho1").readOnly = true;
    document.getElementById("dataNasc1").readOnly = true;
    document.getElementById("nomeFilho2").readOnly = true;
    document.getElementById("dataNasc2").readOnly = true;
    document.getElementById("nomeFilho3").readOnly = true;
    document.getElementById("dataNasc3").readOnly = true;
    document.getElementById("nomeFilho4").readOnly = true;
    document.getElementById("dataNasc4").readOnly = true;
    document.getElementById("nomeFilho5").readOnly = true;
    document.getElementById("dataNasc5").readOnly = true;
    document.getElementById("nomeFilho6").readOnly = true;
    document.getElementById("dataNasc6").readOnly = true;
    document.getElementById("setor").readOnly = true;
    document.getElementById("desativado").disabled = true;

   
    
    $.ajax({
        url: 'index.php?m=cadastrofuncionarios&c=cadastrofuncionarioscontroller&f=buscaPrimeiroRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
                   
            document.getElementById("idFuncionario").value = r[0];
            document.getElementById("empresa").value = r[1];
            document.getElementById("filial").value = r[2];
            document.getElementById("livro").value = r[3];
            document.getElementById("pagina").value = r[4];
            document.getElementById("nomeFuncionario").value = r[5];
            document.getElementById("dataNasc").value = r[6];
            document.getElementById("cidadeNasc").value = r[7];
            document.getElementById("estadoNasc").value = r[8];
            document.getElementById("dataCadastro").value = r[9];
            
            document.getElementById("matricula").value = r[10];
            document.getElementById("funcao").value = r[11];
            document.getElementById("salarioValor").value = r[12];
            document.getElementById("salarioPagamento").value = r[13];
            document.getElementById("dataAdmissao").value = r[14];
            document.getElementById("experiencia").value = r[15];
            document.getElementById("horarioInicial1").value = r[16];
            document.getElementById("horarioFinal1").value = r[17];
            document.getElementById("horarioInicial2").value = r[18];
            document.getElementById("horarioFinal2").value = r[19];
            document.getElementById("imagemView").value = r[20];
            
            document.getElementById("cep").value = r[21];
            document.getElementById("endereco").value = r[22];
            document.getElementById("numero").value = r[23];
            document.getElementById("bairro").value = r[24];
            document.getElementById("cidade").value = r[25];
            document.getElementById("estado").value = r[26];
            document.getElementById("email").value = r[27];
            document.getElementById("telefone1").value = r[28];
            document.getElementById("telefone2").value = r[29];
            document.getElementById("telefone3").value = r[30];
            
            document.getElementById("cpf").value = r[31];
            document.getElementById("identidade").value = r[32];
            document.getElementById("expedidorIdentidade").value = r[33];
            document.getElementById("estadoIdentidade").value = r[34];
            document.getElementById("dataIdentidade").value = r[35];
            document.getElementById("ctps").value = r[36];
            document.getElementById("serieCtps").value = r[37];
            document.getElementById("pisPasep").value = r[38];
            document.getElementById("estadoCtps").value = r[39];
            document.getElementById("dataCtps").value = r[40];
            document.getElementById("tituloEleitor").value = r[41];
            document.getElementById("zonaEleitor").value = r[42];
            document.getElementById("secaoEleitor").value = r[43];
            
            
            document.getElementById("nomeMae").value = r[44];
            document.getElementById("nomePai").value = r[45];
            document.getElementById("sexo").value = r[46];
            document.getElementById("estadoCivil").value = r[47];
            document.getElementById("deficienteFisico").value = r[48];
            document.getElementById("grauInstrucao").value = r[49];
            document.getElementById("etnia").value = r[50];
            document.getElementById("corOlhos").value = r[51];
            document.getElementById("corCabelos").value = r[52];
            document.getElementById("altura").value = r[53];
            document.getElementById("peso").value = r[54];
            
            document.getElementById("nomeFilho1").value = r[55];
            document.getElementById("dataNasc1").value = r[56];
            document.getElementById("nomeFilho2").value = r[57];
            document.getElementById("dataNasc2").value = r[58];
            document.getElementById("nomeFilho3").value = r[59];
            document.getElementById("dataNasc3").value = r[60];
            document.getElementById("nomeFilho4").value = r[61];
            document.getElementById("dataNasc4").value = r[62];
            document.getElementById("nomeFilho5").value = r[63];
            document.getElementById("dataNasc5").value = r[64];
            document.getElementById("nomeFilho6").value = r[65];
            document.getElementById("dataNasc6").value = r[66];
            
             document.getElementById("setor").value = r[67];
            document.getElementById("desativado").value = r[68];
             
            if (r[68] == 'S' ) {
                
                $('#desativado').prop('checked', true);
                
            }else{
                
                $('#desativado').prop('checked', false);
            }
            
            document.getElementById("imagem").value = "";
            
            var imagemView = r[20];
             
            carregarImagem(imagemView);  
           
            
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroAnterior(){
    
    
    document.getElementById("idFuncionario").readOnly = true;
    document.getElementById("empresa").readOnly = true;
    document.getElementById("filial").readOnly = true;
    document.getElementById("livro").readOnly = true;
    document.getElementById("pagina").readOnly = true;
    document.getElementById("matricula").readOnly = true;
    document.getElementById("funcao").readOnly = true;
    document.getElementById("salarioValor").readOnly = true;
    document.getElementById("salarioPagamento").readOnly = true;
    document.getElementById("dataAdmissao").readOnly = true;
    document.getElementById("experiencia").readOnly = true;
    document.getElementById("horarioInicial1").readOnly = true;
    document.getElementById("horarioFinal1").readOnly = true;
    document.getElementById("horarioInicial2").readOnly = true;
    document.getElementById("horarioFinal2").readOnly = true;
    document.getElementById("dataCadastro").readOnly = true;
    document.getElementById("nomeFuncionario").readOnly = true;
    document.getElementById("dataNasc").readOnly = true;
    document.getElementById("cidadeNasc").readOnly = true;
    document.getElementById("estadoNasc").readOnly = true;
    document.getElementById("nomeMae").readOnly = true;
    document.getElementById("nomePai").readOnly = true;
    document.getElementById("imagem").readOnly = true;
    document.getElementById("cep").readOnly = true;
    document.getElementById("endereco").readOnly = true;
    document.getElementById("numero").readOnly = true;
    document.getElementById("bairro").readOnly = true;
    document.getElementById("cidade").readOnly = true;
    document.getElementById("estado").readOnly = true;
    document.getElementById("telefone1").readOnly = true;
    document.getElementById("telefone2").readOnly = true;
    document.getElementById("telefone3").readOnly = true;
    document.getElementById("email").readOnly = true;
    document.getElementById("cpf").readOnly = true;
    document.getElementById("identidade").readOnly = true;
    document.getElementById("expedidorIdentidade").readOnly = true;
    document.getElementById("estadoIdentidade").readOnly = true;
    document.getElementById("dataIdentidade").readOnly = true;
    document.getElementById("ctps").readOnly = true;
    document.getElementById("serieCtps").readOnly = true;
    document.getElementById("pisPasep").readOnly = true;
    document.getElementById("estadoCtps").readOnly = true;
    document.getElementById("dataCtps").readOnly = true;
    document.getElementById("tituloEleitor").readOnly = true;
    document.getElementById("zonaEleitor").readOnly = true;
    document.getElementById("secaoEleitor").readOnly = true;
    document.getElementById("sexo").readOnly = true;
    document.getElementById("estadoCivil").readOnly = true;
    document.getElementById("deficienteFisico").readOnly = true;
    document.getElementById("grauInstrucao").readOnly = true;
    document.getElementById("etnia").readOnly = true;
    document.getElementById("corOlhos").readOnly = true;
    document.getElementById("corCabelos").readOnly = true;
    document.getElementById("altura").readOnly = true;
    document.getElementById("peso").readOnly = true;
    document.getElementById("nomeFilho1").readOnly = true;
    document.getElementById("dataNasc1").readOnly = true;
    document.getElementById("nomeFilho2").readOnly = true;
    document.getElementById("dataNasc2").readOnly = true;
    document.getElementById("nomeFilho3").readOnly = true;
    document.getElementById("dataNasc3").readOnly = true;
    document.getElementById("nomeFilho4").readOnly = true;
    document.getElementById("dataNasc4").readOnly = true;
    document.getElementById("nomeFilho5").readOnly = true;
    document.getElementById("dataNasc5").readOnly = true;
    document.getElementById("nomeFilho6").readOnly = true;
    document.getElementById("dataNasc6").readOnly = true;
    document.getElementById("setor").readOnly = true;
    document.getElementById("desativado").disabled = true;

    
    var idFuncionario  =  $('#idFuncionario').val();  
  
    
    $.ajax({
        url: 'index.php?m=cadastrofuncionarios&c=cadastrofuncionarioscontroller&f=buscaRegistroAnterior',
        data: {
            idFuncionario: idFuncionario
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){

                document.getElementById("idFuncionario").value = r[0];
                document.getElementById("empresa").value = r[1];
                document.getElementById("filial").value = r[2];
                document.getElementById("livro").value = r[3];
                document.getElementById("pagina").value = r[4];
                document.getElementById("nomeFuncionario").value = r[5];
                document.getElementById("dataNasc").value = r[6];
                document.getElementById("cidadeNasc").value = r[7];
                document.getElementById("estadoNasc").value = r[8];
                document.getElementById("dataCadastro").value = r[9];

                document.getElementById("matricula").value = r[10];
                document.getElementById("funcao").value = r[11];
                document.getElementById("salarioValor").value = r[12];
                document.getElementById("salarioPagamento").value = r[13];
                document.getElementById("dataAdmissao").value = r[14];
                document.getElementById("experiencia").value = r[15];
                document.getElementById("horarioInicial1").value = r[16];
                document.getElementById("horarioFinal1").value = r[17];
                document.getElementById("horarioInicial2").value = r[18];
                document.getElementById("horarioFinal2").value = r[19];
                document.getElementById("imagemView").value = r[20];

                document.getElementById("cep").value = r[21];
                document.getElementById("endereco").value = r[22];
                document.getElementById("numero").value = r[23];
                document.getElementById("bairro").value = r[24];
                document.getElementById("cidade").value = r[25];
                document.getElementById("estado").value = r[26];
                document.getElementById("email").value = r[27];
                document.getElementById("telefone1").value = r[28];
                document.getElementById("telefone2").value = r[29];
                document.getElementById("telefone3").value = r[30];

                document.getElementById("cpf").value = r[31];
                document.getElementById("identidade").value = r[32];
                document.getElementById("expedidorIdentidade").value = r[33];
                document.getElementById("estadoIdentidade").value = r[34];
                document.getElementById("dataIdentidade").value = r[35];
                document.getElementById("ctps").value = r[36];
                document.getElementById("serieCtps").value = r[37];
                document.getElementById("pisPasep").value = r[38];
                document.getElementById("estadoCtps").value = r[39];
                document.getElementById("dataCtps").value = r[40];
                document.getElementById("tituloEleitor").value = r[41];
                document.getElementById("zonaEleitor").value = r[42];
                document.getElementById("secaoEleitor").value = r[43];


                document.getElementById("nomeMae").value = r[44];
                document.getElementById("nomePai").value = r[45];
                document.getElementById("sexo").value = r[46];
                document.getElementById("estadoCivil").value = r[47];
                document.getElementById("deficienteFisico").value = r[48];
                document.getElementById("grauInstrucao").value = r[49];
                document.getElementById("etnia").value = r[50];
                document.getElementById("corOlhos").value = r[51];
                document.getElementById("corCabelos").value = r[52];
                document.getElementById("altura").value = r[53];
                document.getElementById("peso").value = r[54];

                document.getElementById("nomeFilho1").value = r[55];
                document.getElementById("dataNasc1").value = r[56];
                document.getElementById("nomeFilho2").value = r[57];
                document.getElementById("dataNasc2").value = r[58];
                document.getElementById("nomeFilho3").value = r[59];
                document.getElementById("dataNasc3").value = r[60];
                document.getElementById("nomeFilho4").value = r[61];
                document.getElementById("dataNasc4").value = r[62];
                document.getElementById("nomeFilho5").value = r[63];
                document.getElementById("dataNasc5").value = r[64];
                document.getElementById("nomeFilho6").value = r[65];
                document.getElementById("dataNasc6").value = r[66];
                
                document.getElementById("setor").value = r[67];
                document.getElementById("desativado").value = r[68];
             
                if (r[68] == 'S' ) {

                    $('#desativado').prop('checked', true);

                }else{

                    $('#desativado').prop('checked', false);
                }


                document.getElementById("imagem").value = "";
                var imagemView = r[20];
                   
                carregarImagem(imagemView); 

            }
          
            
            
            
        },
        error: function(e) {
            
             

        }
    }); 
 
    
}
function buscaRegistroProximo(){
    
    
    document.getElementById("idFuncionario").readOnly = true;
    document.getElementById("empresa").readOnly = true;
    document.getElementById("filial").readOnly = true;
    document.getElementById("livro").readOnly = true;
    document.getElementById("pagina").readOnly = true;
    document.getElementById("matricula").readOnly = true;
    document.getElementById("funcao").readOnly = true;
    document.getElementById("salarioValor").readOnly = true;
    document.getElementById("salarioPagamento").readOnly = true;
    document.getElementById("dataAdmissao").readOnly = true;
    document.getElementById("experiencia").readOnly = true;
    document.getElementById("horarioInicial1").readOnly = true;
    document.getElementById("horarioFinal1").readOnly = true;
    document.getElementById("horarioInicial2").readOnly = true;
    document.getElementById("horarioFinal2").readOnly = true;
    document.getElementById("dataCadastro").readOnly = true;
    document.getElementById("nomeFuncionario").readOnly = true;
    document.getElementById("dataNasc").readOnly = true;
    document.getElementById("cidadeNasc").readOnly = true;
    document.getElementById("estadoNasc").readOnly = true;
    document.getElementById("nomeMae").readOnly = true;
    document.getElementById("nomePai").readOnly = true;
    document.getElementById("imagem").readOnly = true;
    document.getElementById("cep").readOnly = true;
    document.getElementById("endereco").readOnly = true;
    document.getElementById("numero").readOnly = true;
    document.getElementById("bairro").readOnly = true;
    document.getElementById("cidade").readOnly = true;
    document.getElementById("estado").readOnly = true;
    document.getElementById("telefone1").readOnly = true;
    document.getElementById("telefone2").readOnly = true;
    document.getElementById("telefone3").readOnly = true;
    document.getElementById("email").readOnly = true;
    document.getElementById("cpf").readOnly = true;
    document.getElementById("identidade").readOnly = true;
    document.getElementById("expedidorIdentidade").readOnly = true;
    document.getElementById("estadoIdentidade").readOnly = true;
    document.getElementById("dataIdentidade").readOnly = true;
    document.getElementById("ctps").readOnly = true;
    document.getElementById("serieCtps").readOnly = true;
    document.getElementById("pisPasep").readOnly = true;
    document.getElementById("estadoCtps").readOnly = true;
    document.getElementById("dataCtps").readOnly = true;
    document.getElementById("tituloEleitor").readOnly = true;
    document.getElementById("zonaEleitor").readOnly = true;
    document.getElementById("secaoEleitor").readOnly = true;
    document.getElementById("sexo").readOnly = true;
    document.getElementById("estadoCivil").readOnly = true;
    document.getElementById("deficienteFisico").readOnly = true;
    document.getElementById("grauInstrucao").readOnly = true;
    document.getElementById("etnia").readOnly = true;
    document.getElementById("corOlhos").readOnly = true;
    document.getElementById("corCabelos").readOnly = true;
    document.getElementById("altura").readOnly = true;
    document.getElementById("peso").readOnly = true;
    document.getElementById("nomeFilho1").readOnly = true;
    document.getElementById("dataNasc1").readOnly = true;
    document.getElementById("nomeFilho2").readOnly = true;
    document.getElementById("dataNasc2").readOnly = true;
    document.getElementById("nomeFilho3").readOnly = true;
    document.getElementById("dataNasc3").readOnly = true;
    document.getElementById("nomeFilho4").readOnly = true;
    document.getElementById("dataNasc4").readOnly = true;
    document.getElementById("nomeFilho5").readOnly = true;
    document.getElementById("dataNasc5").readOnly = true;
    document.getElementById("nomeFilho6").readOnly = true;
    document.getElementById("dataNasc6").readOnly = true;
    document.getElementById("setor").readOnly = true;
    document.getElementById("desativado").disabled = true;

    
    var idFuncionario  =  $('#idFuncionario').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastrofuncionarios&c=cadastrofuncionarioscontroller&f=buscaRegistroProximo',
        data: {
            idFuncionario: idFuncionario
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                    
                    document.getElementById("idFuncionario").value = r[0];
                    document.getElementById("empresa").value = r[1];
                    document.getElementById("filial").value = r[2];
                    document.getElementById("livro").value = r[3];
                    document.getElementById("pagina").value = r[4];
                    document.getElementById("nomeFuncionario").value = r[5];
                    document.getElementById("dataNasc").value = r[6];
                    document.getElementById("cidadeNasc").value = r[7];
                    document.getElementById("estadoNasc").value = r[8];
                    document.getElementById("dataCadastro").value = r[9];

                    document.getElementById("matricula").value = r[10];
                    document.getElementById("funcao").value = r[11];
                    document.getElementById("salarioValor").value = r[12];
                    document.getElementById("salarioPagamento").value = r[13];
                    document.getElementById("dataAdmissao").value = r[14];
                    document.getElementById("experiencia").value = r[15];
                    document.getElementById("horarioInicial1").value = r[16];
                    document.getElementById("horarioFinal1").value = r[17];
                    document.getElementById("horarioInicial2").value = r[18];
                    document.getElementById("horarioFinal2").value = r[19];
                    document.getElementById("imagemView").value = r[20];

                    document.getElementById("cep").value = r[21];
                    document.getElementById("endereco").value = r[22];
                    document.getElementById("numero").value = r[23];
                    document.getElementById("bairro").value = r[24];
                    document.getElementById("cidade").value = r[25];
                    document.getElementById("estado").value = r[26];
                    document.getElementById("email").value = r[27];
                    document.getElementById("telefone1").value = r[28];
                    document.getElementById("telefone2").value = r[29];
                    document.getElementById("telefone3").value = r[30];

                    document.getElementById("cpf").value = r[31];
                    document.getElementById("identidade").value = r[32];
                    document.getElementById("expedidorIdentidade").value = r[33];
                    document.getElementById("estadoIdentidade").value = r[34];
                    document.getElementById("dataIdentidade").value = r[35];
                    document.getElementById("ctps").value = r[36];
                    document.getElementById("serieCtps").value = r[37];
                    document.getElementById("pisPasep").value = r[38];
                    document.getElementById("estadoCtps").value = r[39];
                    document.getElementById("dataCtps").value = r[40];
                    document.getElementById("tituloEleitor").value = r[41];
                    document.getElementById("zonaEleitor").value = r[42];
                    document.getElementById("secaoEleitor").value = r[43];


                    document.getElementById("nomeMae").value = r[44];
                    document.getElementById("nomePai").value = r[45];
                    document.getElementById("sexo").value = r[46];
                    document.getElementById("estadoCivil").value = r[47];
                    document.getElementById("deficienteFisico").value = r[48];
                    document.getElementById("grauInstrucao").value = r[49];
                    document.getElementById("etnia").value = r[50];
                    document.getElementById("corOlhos").value = r[51];
                    document.getElementById("corCabelos").value = r[52];
                    document.getElementById("altura").value = r[53];
                    document.getElementById("peso").value = r[54];

                    document.getElementById("nomeFilho1").value = r[55];
                    document.getElementById("dataNasc1").value = r[56];
                    document.getElementById("nomeFilho2").value = r[57];
                    document.getElementById("dataNasc2").value = r[58];
                    document.getElementById("nomeFilho3").value = r[59];
                    document.getElementById("dataNasc3").value = r[60];
                    document.getElementById("nomeFilho4").value = r[61];
                    document.getElementById("dataNasc4").value = r[62];
                    document.getElementById("nomeFilho5").value = r[63];
                    document.getElementById("dataNasc5").value = r[64];
                    document.getElementById("nomeFilho6").value = r[65];
                    document.getElementById("dataNasc6").value = r[66];
                    
                    document.getElementById("setor").value = r[67];
                    document.getElementById("desativado").value = r[68];
             
                    if (r[68] == 'S' ) {

                        $('#desativado').prop('checked', true);

                    }else{

                        $('#desativado').prop('checked', false);
                    }

                    document.getElementById("imagem").value = "";
                    var imagemView = r[20];
                
                    carregarImagem(imagemView);     
            
            }
           
        },
        error: function(e) {

        }
    }); 
 
    
}


function buscaUltimoRegistro(){
    
    document.getElementById("idFuncionario").readOnly = true;
    document.getElementById("empresa").readOnly = true;
    document.getElementById("filial").readOnly = true;
    document.getElementById("livro").readOnly = true;
    document.getElementById("pagina").readOnly = true;
    document.getElementById("matricula").readOnly = true;
    document.getElementById("funcao").readOnly = true;
    document.getElementById("salarioValor").readOnly = true;
    document.getElementById("salarioPagamento").readOnly = true;
    document.getElementById("dataAdmissao").readOnly = true;
    document.getElementById("experiencia").readOnly = true;
    document.getElementById("horarioInicial1").readOnly = true;
    document.getElementById("horarioFinal1").readOnly = true;
    document.getElementById("horarioInicial2").readOnly = true;
    document.getElementById("horarioFinal2").readOnly = true;
    document.getElementById("dataCadastro").readOnly = true;
    document.getElementById("nomeFuncionario").readOnly = true;
    document.getElementById("dataNasc").readOnly = true;
    document.getElementById("cidadeNasc").readOnly = true;
    document.getElementById("estadoNasc").readOnly = true;
    document.getElementById("nomeMae").readOnly = true;
    document.getElementById("nomePai").readOnly = true;
    document.getElementById("imagem").readOnly = true;
    document.getElementById("cep").readOnly = true;
    document.getElementById("endereco").readOnly = true;
    document.getElementById("numero").readOnly = true;
    document.getElementById("bairro").readOnly = true;
    document.getElementById("cidade").readOnly = true;
    document.getElementById("estado").readOnly = true;
    document.getElementById("telefone1").readOnly = true;
    document.getElementById("telefone2").readOnly = true;
    document.getElementById("telefone3").readOnly = true;
    document.getElementById("email").readOnly = true;
    document.getElementById("cpf").readOnly = true;
    document.getElementById("identidade").readOnly = true;
    document.getElementById("expedidorIdentidade").readOnly = true;
    document.getElementById("estadoIdentidade").readOnly = true;
    document.getElementById("dataIdentidade").readOnly = true;
    document.getElementById("ctps").readOnly = true;
    document.getElementById("serieCtps").readOnly = true;
    document.getElementById("pisPasep").readOnly = true;
    document.getElementById("estadoCtps").readOnly = true;
    document.getElementById("dataCtps").readOnly = true;
    document.getElementById("tituloEleitor").readOnly = true;
    document.getElementById("zonaEleitor").readOnly = true;
    document.getElementById("secaoEleitor").readOnly = true;
    document.getElementById("sexo").readOnly = true;
    document.getElementById("estadoCivil").readOnly = true;
    document.getElementById("deficienteFisico").readOnly = true;
    document.getElementById("grauInstrucao").readOnly = true;
    document.getElementById("etnia").readOnly = true;
    document.getElementById("corOlhos").readOnly = true;
    document.getElementById("corCabelos").readOnly = true;
    document.getElementById("altura").readOnly = true;
    document.getElementById("peso").readOnly = true;
    document.getElementById("nomeFilho1").readOnly = true;
    document.getElementById("dataNasc1").readOnly = true;
    document.getElementById("nomeFilho2").readOnly = true;
    document.getElementById("dataNasc2").readOnly = true;
    document.getElementById("nomeFilho3").readOnly = true;
    document.getElementById("dataNasc3").readOnly = true;
    document.getElementById("nomeFilho4").readOnly = true;
    document.getElementById("dataNasc4").readOnly = true;
    document.getElementById("nomeFilho5").readOnly = true;
    document.getElementById("dataNasc5").readOnly = true;
    document.getElementById("nomeFilho6").readOnly = true;
    document.getElementById("dataNasc6").readOnly = true;
    document.getElementById("setor").readOnly = true;
    document.getElementById("desativado").disabled = true;

    
    $.ajax({
        url: 'index.php?m=cadastrofuncionarios&c=cadastrofuncionarioscontroller&f=buscaUltimoRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
                document.getElementById("idFuncionario").value = r[0];
                document.getElementById("empresa").value = r[1];
                document.getElementById("filial").value = r[2];
                document.getElementById("livro").value = r[3];
                document.getElementById("pagina").value = r[4];
                document.getElementById("nomeFuncionario").value = r[5];
                document.getElementById("dataNasc").value = r[6];
                document.getElementById("cidadeNasc").value = r[7];
                document.getElementById("estadoNasc").value = r[8];
                document.getElementById("dataCadastro").value = r[9];

                document.getElementById("matricula").value = r[10];
                document.getElementById("funcao").value = r[11];
                document.getElementById("salarioValor").value = r[12];
                document.getElementById("salarioPagamento").value = r[13];
                document.getElementById("dataAdmissao").value = r[14];
                document.getElementById("experiencia").value = r[15];
                document.getElementById("horarioInicial1").value = r[16];
                document.getElementById("horarioFinal1").value = r[17];
                document.getElementById("horarioInicial2").value = r[18];
                document.getElementById("horarioFinal2").value = r[19];
                document.getElementById("imagemView").value = r[20];

                document.getElementById("cep").value = r[21];
                document.getElementById("endereco").value = r[22];
                document.getElementById("numero").value = r[23];
                document.getElementById("bairro").value = r[24];
                document.getElementById("cidade").value = r[25];
                document.getElementById("estado").value = r[26];
                document.getElementById("email").value = r[27];
                document.getElementById("telefone1").value = r[28];
                document.getElementById("telefone2").value = r[29];
                document.getElementById("telefone3").value = r[30];

                document.getElementById("cpf").value = r[31];
                document.getElementById("identidade").value = r[32];
                document.getElementById("expedidorIdentidade").value = r[33];
                document.getElementById("estadoIdentidade").value = r[34];
                document.getElementById("dataIdentidade").value = r[35];
                document.getElementById("ctps").value = r[36];
                document.getElementById("serieCtps").value = r[37];
                document.getElementById("pisPasep").value = r[38];
                document.getElementById("estadoCtps").value = r[39];
                document.getElementById("dataCtps").value = r[40];
                document.getElementById("tituloEleitor").value = r[41];
                document.getElementById("zonaEleitor").value = r[42];
                document.getElementById("secaoEleitor").value = r[43];


                document.getElementById("nomeMae").value = r[44];
                document.getElementById("nomePai").value = r[45];
                document.getElementById("sexo").value = r[46];
                document.getElementById("estadoCivil").value = r[47];
                document.getElementById("deficienteFisico").value = r[48];
                document.getElementById("grauInstrucao").value = r[49];
                document.getElementById("etnia").value = r[50];
                document.getElementById("corOlhos").value = r[51];
                document.getElementById("corCabelos").value = r[52];
                document.getElementById("altura").value = r[53];
                document.getElementById("peso").value = r[54];

                document.getElementById("nomeFilho1").value = r[55];
                document.getElementById("dataNasc1").value = r[56];
                document.getElementById("nomeFilho2").value = r[57];
                document.getElementById("dataNasc2").value = r[58];
                document.getElementById("nomeFilho3").value = r[59];
                document.getElementById("dataNasc3").value = r[60];
                document.getElementById("nomeFilho4").value = r[61];
                document.getElementById("dataNasc4").value = r[62];
                document.getElementById("nomeFilho5").value = r[63];
                document.getElementById("dataNasc5").value = r[64];
                document.getElementById("nomeFilho6").value = r[65];
                document.getElementById("dataNasc6").value = r[66];
                
                document.getElementById("setor").value = r[67];
                document.getElementById("desativado").value = r[68];
             
                    if (r[68] == 'S' ) {

                        $('#desativado').prop('checked', true);

                    }else{

                        $('#desativado').prop('checked', false);
                    }
            
                document.getElementById("imagem").value = "";
                var imagemView = r[20];
                
                carregarImagem(imagemView); 
           
        },
        error: function(e) {

        }
    }); 

}

function pesquisaFiltro(){
    
    var idInicial   = document.getElementById("idPesquisarInicio").value;
    var idFinal     = document.getElementById("idPesquisarFim").value;
    var nomeInicial = document.getElementById("nomePesquisarInicio").value;
    var nomeFim     = document.getElementById("nomePesquisarFim").value;
    
    
    // Pesquisa Para alimentar campos
    
    $.ajax({
        url: 'index.php?m=cadastrofuncionarios&c=cadastrofuncionarioscontroller&f=pesquisaSimples',
        data: {
            idInicial: idInicial,
            nomeInicial: nomeInicial
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             
                document.getElementById("idFuncionario").value = r[0];
                document.getElementById("empresa").value = r[1];
                document.getElementById("filial").value = r[2];
                document.getElementById("livro").value = r[3];
                document.getElementById("pagina").value = r[4];
                document.getElementById("nomeFuncionario").value = r[5];
                document.getElementById("dataNasc").value = r[6];
                document.getElementById("cidadeNasc").value = r[7];
                document.getElementById("estadoNasc").value = r[8];
                document.getElementById("dataCadastro").value = r[9];

                document.getElementById("matricula").value = r[10];
                document.getElementById("funcao").value = r[11];
                document.getElementById("salarioValor").value = r[12];
                document.getElementById("salarioPagamento").value = r[13];
                document.getElementById("dataAdmissao").value = r[14];
                document.getElementById("experiencia").value = r[15];
                document.getElementById("horarioInicial1").value = r[16];
                document.getElementById("horarioFinal1").value = r[17];
                document.getElementById("horarioInicial2").value = r[18];
                document.getElementById("horarioFinal2").value = r[19];
                document.getElementById("imagemView").value = r[20];

                document.getElementById("cep").value = r[21];
                document.getElementById("endereco").value = r[22];
                document.getElementById("numero").value = r[23];
                document.getElementById("bairro").value = r[24];
                document.getElementById("cidade").value = r[25];
                document.getElementById("estado").value = r[26];
                document.getElementById("email").value = r[27];
                document.getElementById("telefone1").value = r[28];
                document.getElementById("telefone2").value = r[29];
                document.getElementById("telefone3").value = r[30];

                document.getElementById("cpf").value = r[31];
                document.getElementById("identidade").value = r[32];
                document.getElementById("expedidorIdentidade").value = r[33];
                document.getElementById("estadoIdentidade").value = r[34];
                document.getElementById("dataIdentidade").value = r[35];
                document.getElementById("ctps").value = r[36];
                document.getElementById("serieCtps").value = r[37];
                document.getElementById("pisPasep").value = r[38];
                document.getElementById("estadoCtps").value = r[39];
                document.getElementById("dataCtps").value = r[40];
                document.getElementById("tituloEleitor").value = r[41];
                document.getElementById("zonaEleitor").value = r[42];
                document.getElementById("secaoEleitor").value = r[43];


                document.getElementById("nomeMae").value = r[44];
                document.getElementById("nomePai").value = r[45];
                document.getElementById("sexo").value = r[46];
                document.getElementById("estadoCivil").value = r[47];
                document.getElementById("deficienteFisico").value = r[48];
                document.getElementById("grauInstrucao").value = r[49];
                document.getElementById("etnia").value = r[50];
                document.getElementById("corOlhos").value = r[51];
                document.getElementById("corCabelos").value = r[52];
                document.getElementById("altura").value = r[53];
                document.getElementById("peso").value = r[54];

                document.getElementById("nomeFilho1").value = r[55];
                document.getElementById("dataNasc1").value = r[56];
                document.getElementById("nomeFilho2").value = r[57];
                document.getElementById("dataNasc2").value = r[58];
                document.getElementById("nomeFilho3").value = r[59];
                document.getElementById("dataNasc3").value = r[60];
                document.getElementById("nomeFilho4").value = r[61];
                document.getElementById("dataNasc4").value = r[62];
                document.getElementById("nomeFilho5").value = r[63];
                document.getElementById("dataNasc5").value = r[64];
                document.getElementById("nomeFilho6").value = r[65];
                document.getElementById("dataNasc6").value = r[66];
                
                document.getElementById("setor").value = r[67];
                document.getElementById("desativado").value = r[68];
             
                    if (r[68] == 'S' ) {

                        $('#desativado').prop('checked', true);

                    }else{

                        $('#desativado').prop('checked', false);
                    }
            
            
                document.getElementById("imagem").value = "";
                var imagemView = r[20];
                
                carregarImagem(imagemView); 
                
            $('#pesquisarModal').modal('hide');          
            
            
            
                     
        },
        error: function(e) {

        }
    }); 
            
    
}
function getGrid() {
    
    
    $('#grid').DataTable({
        "processing": true,
        "serverSide": true,
        ajax: {
            "url": "index.php?m=cadastrofuncionarios&c=cadastrofuncionarioscontroller&f=getGrid",
              
            "type": "POST",
        },
         language: {
            "url": '//cdn.datatables.net/plug-ins/1.10.7/i18n/Portuguese-Brasil.json'
        },
        "columns": [
            {"data": "ID_FUNCIONARIO"},
            {"data": "EMPRESA"},
            {"data": "FILIAL"},
            {"data": "NOME_FUNCIONARIO"},
            {"data": "MATRICULA"},
            {"data": "SETOR"},
            {"data": "FUNCAO"},
            {"data": "SELECIONAR"},       
            
            
            
           
        ],
        searching: false
    });

    $('#grid')
            .removeClass('display')
            .addClass('table table-hover table-striped table-bordered');
    
    
  
    
  
  
 }
 
 function selecionaGrid(idFuncionario){
    
   
    // Pesquisa Para alimentar campos
    //alert(idFuncionario);
    
    document.getElementById("idFuncionario").readOnly = true;
    document.getElementById("empresa").readOnly = true;
    document.getElementById("filial").readOnly = true;
    document.getElementById("livro").readOnly = true;
    document.getElementById("pagina").readOnly = true;
    document.getElementById("matricula").readOnly = true;
    document.getElementById("funcao").readOnly = true;
    document.getElementById("salarioValor").readOnly = true;
    document.getElementById("salarioPagamento").readOnly = true;
    document.getElementById("dataAdmissao").readOnly = true;
    document.getElementById("experiencia").readOnly = true;
    document.getElementById("horarioInicial1").readOnly = true;
    document.getElementById("horarioFinal1").readOnly = true;
    document.getElementById("horarioInicial2").readOnly = true;
    document.getElementById("horarioFinal2").readOnly = true;
    document.getElementById("dataCadastro").readOnly = true;
    document.getElementById("nomeFuncionario").readOnly = true;
    document.getElementById("dataNasc").readOnly = true;
    document.getElementById("cidadeNasc").readOnly = true;
    document.getElementById("estadoNasc").readOnly = true;
    document.getElementById("nomeMae").readOnly = true;
    document.getElementById("nomePai").readOnly = true;
    document.getElementById("imagem").readOnly = true;
    document.getElementById("cep").readOnly = true;
    document.getElementById("endereco").readOnly = true;
    document.getElementById("numero").readOnly = true;
    document.getElementById("bairro").readOnly = true;
    document.getElementById("cidade").readOnly = true;
    document.getElementById("estado").readOnly = true;
    document.getElementById("telefone1").readOnly = true;
    document.getElementById("telefone2").readOnly = true;
    document.getElementById("telefone3").readOnly = true;
    document.getElementById("email").readOnly = true;
    document.getElementById("cpf").readOnly = true;
    document.getElementById("identidade").readOnly = true;
    document.getElementById("expedidorIdentidade").readOnly = true;
    document.getElementById("estadoIdentidade").readOnly = true;
    document.getElementById("dataIdentidade").readOnly = true;
    document.getElementById("ctps").readOnly = true;
    document.getElementById("serieCtps").readOnly = true;
    document.getElementById("pisPasep").readOnly = true;
    document.getElementById("estadoCtps").readOnly = true;
    document.getElementById("dataCtps").readOnly = true;
    document.getElementById("tituloEleitor").readOnly = true;
    document.getElementById("zonaEleitor").readOnly = true;
    document.getElementById("secaoEleitor").readOnly = true;
    document.getElementById("sexo").readOnly = true;
    document.getElementById("estadoCivil").readOnly = true;
    document.getElementById("deficienteFisico").readOnly = true;
    document.getElementById("grauInstrucao").readOnly = true;
    document.getElementById("etnia").readOnly = true;
    document.getElementById("corOlhos").readOnly = true;
    document.getElementById("corCabelos").readOnly = true;
    document.getElementById("altura").readOnly = true;
    document.getElementById("peso").readOnly = true;
    document.getElementById("nomeFilho1").readOnly = true;
    document.getElementById("dataNasc1").readOnly = true;
    document.getElementById("nomeFilho2").readOnly = true;
    document.getElementById("dataNasc2").readOnly = true;
    document.getElementById("nomeFilho3").readOnly = true;
    document.getElementById("dataNasc3").readOnly = true;
    document.getElementById("nomeFilho4").readOnly = true;
    document.getElementById("dataNasc4").readOnly = true;
    document.getElementById("nomeFilho5").readOnly = true;
    document.getElementById("dataNasc5").readOnly = true;
    document.getElementById("nomeFilho6").readOnly = true;
    document.getElementById("dataNasc6").readOnly = true;
    document.getElementById("setor").readOnly = true;
    document.getElementById("desativado").disabled = true;
    

    
      
    
    
    $.ajax({
        url: 'index.php?m=cadastrofuncionarios&c=cadastrofuncionarioscontroller&f=selecionaGrid',
        data: {
            idFuncionario: idFuncionario
            
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             
                document.getElementById("idFuncionario").value = r[0];
                document.getElementById("empresa").value = r[1];
                document.getElementById("filial").value = r[2];
                document.getElementById("livro").value = r[3];
                document.getElementById("pagina").value = r[4];
                document.getElementById("nomeFuncionario").value = r[5];
                document.getElementById("dataNasc").value = r[6];
                document.getElementById("cidadeNasc").value = r[7];
                document.getElementById("estadoNasc").value = r[8];
                document.getElementById("dataCadastro").value = r[9];

                document.getElementById("matricula").value = r[10];
                document.getElementById("funcao").value = r[11];
                document.getElementById("salarioValor").value = r[12];
                document.getElementById("salarioPagamento").value = r[13];
                document.getElementById("dataAdmissao").value = r[14];
                document.getElementById("experiencia").value = r[15];
                document.getElementById("horarioInicial1").value = r[16];
                document.getElementById("horarioFinal1").value = r[17];
                document.getElementById("horarioInicial2").value = r[18];
                document.getElementById("horarioFinal2").value = r[19];
                document.getElementById("imagemView").value = r[20];

                document.getElementById("cep").value = r[21];
                document.getElementById("endereco").value = r[22];
                document.getElementById("numero").value = r[23];
                document.getElementById("bairro").value = r[24];
                document.getElementById("cidade").value = r[25];
                document.getElementById("estado").value = r[26];
                document.getElementById("email").value = r[27];
                document.getElementById("telefone1").value = r[28];
                document.getElementById("telefone2").value = r[29];
                document.getElementById("telefone3").value = r[30];

                document.getElementById("cpf").value = r[31];
                document.getElementById("identidade").value = r[32];
                document.getElementById("expedidorIdentidade").value = r[33];
                document.getElementById("estadoIdentidade").value = r[34];
                document.getElementById("dataIdentidade").value = r[35];
                document.getElementById("ctps").value = r[36];
                document.getElementById("serieCtps").value = r[37];
                document.getElementById("pisPasep").value = r[38];
                document.getElementById("estadoCtps").value = r[39];
                document.getElementById("dataCtps").value = r[40];
                document.getElementById("tituloEleitor").value = r[41];
                document.getElementById("zonaEleitor").value = r[42];
                document.getElementById("secaoEleitor").value = r[43];


                document.getElementById("nomeMae").value = r[44];
                document.getElementById("nomePai").value = r[45];
                document.getElementById("sexo").value = r[46];
                document.getElementById("estadoCivil").value = r[47];
                document.getElementById("deficienteFisico").value = r[48];
                document.getElementById("grauInstrucao").value = r[49];
                document.getElementById("etnia").value = r[50];
                document.getElementById("corOlhos").value = r[51];
                document.getElementById("corCabelos").value = r[52];
                document.getElementById("altura").value = r[53];
                document.getElementById("peso").value = r[54];

                document.getElementById("nomeFilho1").value = r[55];
                document.getElementById("dataNasc1").value = r[56];
                document.getElementById("nomeFilho2").value = r[57];
                document.getElementById("dataNasc2").value = r[58];
                document.getElementById("nomeFilho3").value = r[59];
                document.getElementById("dataNasc3").value = r[60];
                document.getElementById("nomeFilho4").value = r[61];
                document.getElementById("dataNasc4").value = r[62];
                document.getElementById("nomeFilho5").value = r[63];
                document.getElementById("dataNasc5").value = r[64];
                document.getElementById("nomeFilho6").value = r[65];
                document.getElementById("dataNasc6").value = r[66];
                
                document.getElementById("setor").value = r[67];
                document.getElementById("desativado").value = r[68];
             
                    if (r[68] == 'S' ) {

                        $('#desativado').prop('checked', true);

                    }else{

                        $('#desativado').prop('checked', false);
                    }
            
             
                document.getElementById("imagem").value = "";
                var imagemView = r[20];
                
                carregarImagem(imagemView); 
            
                     
        },
        error: function(e) {

        }
    }); 
            
    
}
function atualizar() {


    document.getElementById("idFuncionario").readOnly = true;
    document.getElementById("empresa").readOnly = true;
    document.getElementById("filial").readOnly = true;
    document.getElementById("livro").readOnly = true;
    document.getElementById("pagina").readOnly = true;
    document.getElementById("matricula").readOnly = true;
    document.getElementById("funcao").readOnly = true;
    document.getElementById("salarioValor").readOnly = true;
    document.getElementById("salarioPagamento").readOnly = true;
    document.getElementById("dataAdmissao").readOnly = true;
    document.getElementById("experiencia").readOnly = true;
    document.getElementById("horarioInicial1").readOnly = true;
    document.getElementById("horarioFinal1").readOnly = true;
    document.getElementById("horarioInicial2").readOnly = true;
    document.getElementById("horarioFinal2").readOnly = true;
    document.getElementById("dataCadastro").readOnly = true;
    document.getElementById("nomeFuncionario").readOnly = true;
    document.getElementById("dataNasc").readOnly = true;
    document.getElementById("cidadeNasc").readOnly = true;
    document.getElementById("estadoNasc").readOnly = true;
    document.getElementById("nomeMae").readOnly = true;
    document.getElementById("nomePai").readOnly = true;
    document.getElementById("imagem").readOnly = true;
    document.getElementById("cep").readOnly = true;
    document.getElementById("endereco").readOnly = true;
    document.getElementById("numero").readOnly = true;
    document.getElementById("bairro").readOnly = true;
    document.getElementById("cidade").readOnly = true;
    document.getElementById("estado").readOnly = true;
    document.getElementById("telefone1").readOnly = true;
    document.getElementById("telefone2").readOnly = true;
    document.getElementById("telefone3").readOnly = true;
    document.getElementById("email").readOnly = true;
    document.getElementById("cpf").readOnly = true;
    document.getElementById("identidade").readOnly = true;
    document.getElementById("expedidorIdentidade").readOnly = true;
    document.getElementById("estadoIdentidade").readOnly = true;
    document.getElementById("dataIdentidade").readOnly = true;
    document.getElementById("ctps").readOnly = true;
    document.getElementById("serieCtps").readOnly = true;
    document.getElementById("pisPasep").readOnly = true;
    document.getElementById("estadoCtps").readOnly = true;
    document.getElementById("dataCtps").readOnly = true;
    document.getElementById("tituloEleitor").readOnly = true;
    document.getElementById("zonaEleitor").readOnly = true;
    document.getElementById("secaoEleitor").readOnly = true;
    document.getElementById("sexo").readOnly = true;
    document.getElementById("estadoCivil").readOnly = true;
    document.getElementById("deficienteFisico").readOnly = true;
    document.getElementById("grauInstrucao").readOnly = true;
    document.getElementById("etnia").readOnly = true;
    document.getElementById("corOlhos").readOnly = true;
    document.getElementById("corCabelos").readOnly = true;
    document.getElementById("altura").readOnly = true;
    document.getElementById("peso").readOnly = true;
    document.getElementById("nomeFilho1").readOnly = true;
    document.getElementById("dataNasc1").readOnly = true;
    document.getElementById("nomeFilho2").readOnly = true;
    document.getElementById("dataNasc2").readOnly = true;
    document.getElementById("nomeFilho3").readOnly = true;
    document.getElementById("dataNasc3").readOnly = true;
    document.getElementById("nomeFilho4").readOnly = true;
    document.getElementById("dataNasc4").readOnly = true;
    document.getElementById("nomeFilho5").readOnly = true;
    document.getElementById("dataNasc5").readOnly = true;
    document.getElementById("nomeFilho6").readOnly = true;
    document.getElementById("dataNasc6").readOnly = true;
    document.getElementById("setor").readOnly = true;
    document.getElementById("desativado").disabled = true;



    document.getElementById("idFuncionario").value = "";
    document.getElementById("empresa").value = 0;
    document.getElementById("filial").value = 0;
    document.getElementById("livro").value = "";
    document.getElementById("pagina").value = "";
    document.getElementById("matricula").value = "";
    document.getElementById("funcao").value = 0;
    document.getElementById("salarioValor").value = "";
    document.getElementById("salarioPagamento").value = 0;
    document.getElementById("dataAdmissao").value = "";
    document.getElementById("experiencia").value = 0;
    document.getElementById("horarioInicial1").value = "";
    document.getElementById("horarioFinal1").value = "";
    document.getElementById("horarioInicial2").value = "";
    document.getElementById("horarioFinal2").value = "";
    document.getElementById("dataCadastro").value = "";
    document.getElementById("nomeFuncionario").value = "";
    document.getElementById("dataNasc").value = "";
    document.getElementById("cidadeNasc").value = "";
    document.getElementById("estadoNasc").value = 0;
    document.getElementById("nomeMae").value = "";
    document.getElementById("nomePai").value = "";
    document.getElementById("imagem").value = "";
    document.getElementById("cep").value = "";
    document.getElementById("endereco").value = "";
    document.getElementById("numero").value = "";
    document.getElementById("bairro").value = "";
    document.getElementById("cidade").value = "";
    document.getElementById("estado").value = 0;
    document.getElementById("telefone1").value = "";
    document.getElementById("telefone2").value = "";
    document.getElementById("telefone3").value = "";
    document.getElementById("email").value = "";
    document.getElementById("cpf").value = "";
    document.getElementById("identidade").value = "";
    document.getElementById("expedidorIdentidade").value = "";
    document.getElementById("estadoIdentidade").value = 0;
    document.getElementById("dataIdentidade").value = "";
    document.getElementById("ctps").value = "";
    document.getElementById("serieCtps").value = "";
    document.getElementById("pisPasep").value = "";
    document.getElementById("estadoCtps").value = 0;
    document.getElementById("dataCtps").value = "";
    document.getElementById("tituloEleitor").value = "";
    document.getElementById("zonaEleitor").value = "";
    document.getElementById("secaoEleitor").value = "";
    document.getElementById("sexo").value = 0;
    document.getElementById("estadoCivil").value = 0;
    document.getElementById("deficienteFisico").value = 0;
    document.getElementById("grauInstrucao").value = 0;
    document.getElementById("etnia").value = 0;
    document.getElementById("corOlhos").value = "";
    document.getElementById("corCabelos").value = "";
    document.getElementById("altura").value = "";
    document.getElementById("peso").value = "";
    document.getElementById("nomeFilho1").value = "";
    document.getElementById("dataNasc1").value = "";
    document.getElementById("nomeFilho2").value = "";
    document.getElementById("dataNasc2").value = "";
    document.getElementById("nomeFilho3").value = "";
    document.getElementById("dataNasc3").value = "";
    document.getElementById("nomeFilho4").value = "";
    document.getElementById("dataNasc4").value = "";
    document.getElementById("nomeFilho5").value = "";
    document.getElementById("dataNasc5").value = "";
    document.getElementById("nomeFilho6").value = "";
    document.getElementById("dataNasc6").value = "";
    
    document.getElementById("setor").value = 0;
    
    $('#desativado').prop('checked', false);
                   
    
    document.getElementById("imagemView").value = " ";

}


///////////////////////////////////////////////////
///     Funções específicas para esse BRD        //
///                                             //
//////////////////////////////////////////////////

function carregarEmpresa(){
    
           
    $.ajax({
        url: 'index.php?m=cadastroaso&c=cadastroasocontroller&f=carregarEmpresa',
        data: {
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('empresa').innerHTML = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de  EMPRESA', 'error'); 
               
            }

        },
        error: function() {
            desbloqueiaTela();
        }
    });
}


function carregarFilial(){
    
    var empresa                 =   $('#empresa').val(); 
           
    $.ajax({
        url: 'index.php?m=cadastroaso&c=cadastroasocontroller&f=carregarFilial',
        data: {
            empresa: empresa
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('filial').innerHTML = data;
               
            } else {
                alert('Erro ao carregar a lista de FILIAL');
            }

        },
        error: function() {
            desbloqueiaTela();
        }
    });
 }



function carregarFuncionario(){
    
    var empresa                 =   $('#empresa').val(); 
    var filial                  =   $('#filial').val(); 
    
    
           
    $.ajax({
        url: 'index.php?m=cadastroaso&c=cadastroasocontroller&f=carregarFuncionario',
        data: {
            
            empresa: empresa,
            filial: filial
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('funcionario').innerHTML = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de Funcionarios', 'error'); 
               
            }

        },
        error: function() {
            desbloqueiaTela();
        }
    });
}

function carregarDadosFuncionario(){
    
    var empresa                 =   $('#empresa').val(); 
    var filial                  =   $('#filial').val(); 
    var funcionario             =   $('#funcionario').val();
    
    
    document.getElementById("matricula").value = "";
    document.getElementById("setor").value = "";
    document.getElementById("funcao").value = "";
    document.getElementById("dataNasc").value = "";
    document.getElementById("cpf").value = "";
    document.getElementById("ctps").value = "";
    document.getElementById("pisPasep").value = "";
           
    $.ajax({
        url: 'index.php?m=cadastroaso&c=cadastroasocontroller&f=carregarDadosFuncionario',
        data: {
            
            empresa: empresa,
            filial: filial,
            funcionario: funcionario
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(r) {
            
                document.getElementById("matricula").value = r[0];
                document.getElementById("setor").value = r[1];
                document.getElementById("funcao").value = r[2];
                document.getElementById("dataNasc").value = r[3];
                document.getElementById("cpf").value = r[4];
                document.getElementById("ctps").value = r[5];
                document.getElementById("pisPasep").value = r[6];
                

        },
        error: function() {
            desbloqueiaTela();
        }
    });
}

function carregarDataAtual() {


    $.ajax({
        url: 'index.php?m=cadastroaso&c=cadastroasocontroller&f=carregarDataAtual',
        data: {
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (data) {

            document.getElementById('dataCadastro').value = data;


        },
        error: function () {

        }
    });


}

function carregarOutrosExames(){
    
    var tipoExames                 =   $('#tipoExames').val(); 
    
    if (tipoExames != "OUTROS"){
         
         document.getElementById("outrosExames").value = "";
         document.getElementById("outrosExames").disabled = true; 
        
    }else{
        document.getElementById("outrosExames").disabled = false;
    }
    
    
}

function carregarValorExame(){
    
    var pagamentoExame                 =   $('#pagamentoExame').val(); 
    
    if (pagamentoExame != "S"){
         
         document.getElementById("valorExame").value = "";
         document.getElementById("valorExame").disabled = true; 
        
    }else{
        document.getElementById("valorExame").disabled = false;
    }
    
    
}


function selecionarTipo(){
   
    var tipo = document.getElementById("tipoFilial").value;
   
    tipoFilial = tipo;
     
        
    if(tipoFilial == 1){
       document.getElementById("codigoCNPJ").readOnly  = true;       
       document.getElementById("codigoCEI").readOnly = false;               
    }
    else{      
       document.getElementById("codigoCEI").readOnly  = true;
       document.getElementById("codigoCNPJ").readOnly   = false;
   }
    
}

function validarCNPJ(cnpj) {
 
    cnpj = cnpj.replace(/[^\d]+/g,'');
   
    if(cnpj == '') return false;
     
    if (cnpj.length != 14)
        return false;
 
    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" || 
        cnpj == "11111111111111" || 
        cnpj == "22222222222222" || 
        cnpj == "33333333333333" || 
        cnpj == "44444444444444" || 
        cnpj == "55555555555555" || 
        cnpj == "66666666666666" || 
        cnpj == "77777777777777" || 
        cnpj == "88888888888888" || 
        cnpj == "99999999999999")
        return false;
         
    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;
         
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
          return false;
           
    return true;
    
}
function mascaraTelefone(telefone1){ 
    if(telefone1.value.length == 0){
         telefone1.value = '(' + telefone1.value;
    }     
    if(telefone1.value.length == 3){
        telefone1.value = telefone1.value + ') ';
    }
     
   
}



function mascaraCPF(cpf){
    
    if(cpf.value.length == 3){
      cpf.value =  cpf.value + '.';
    }  
    if(cpf.value.length == 7){
      cpf.value = cpf.value + '.';
    }  
    if(cpf.value.length == 11){
      cpf.value = cpf.value + '-';
    }  
           
}

function mascaraCEP(cep){
    
    if(cep.value.length == 5){
      cep.value =  cep.value + '-';
    }  
    
}

function mascaraCEI(cnpj){
    
    if(cnpj.value.length == 2){
      cnpj.value =  cnpj.value + '.';
    }  
    if(cnpj.value.length == 6){
      cnpj.value = cnpj.value + '.';
    }  
    if(cnpj.value.length == 11){
      cnpj.value = cnpj.value + '/';
    }  
    
}

/* Máscaras Horario */
function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}
function mvalor(v){
    v=v.replace(/\D/g,"");//Remove tudo o que não é dígito
    v=v.replace(/(\d)(\d{8})$/,"$1.$2");//coloca o ponto dos milhões
    v=v.replace(/(\d)(\d{5})$/,"$1.$2");//coloca o ponto dos milhares
	
    v=v.replace(/(\d)(\d{2})$/,"$1:$2");//coloca a virgula antes dos 2 últimos dígitos
    return v;
}


/* Máscaras ER */
function mascaraValor(o, f) {
    v_obj = o
    v_fun = f
    setTimeout("execmascaraValor()", 1)
}
function execmascaraValor() {
    v_obj.value = v_fun(v_obj.value)
}
function mvalorValor(valor) {
    valor = valor.replace(/\D/g, "");//Remove tudo o que não é dígito
    valor = valor.replace(/(\d)(\d{8})$/, "$1.$2");//coloca o ponto dos milhões
    valor = valor.replace(/(\d)(\d{5})$/, "$1.$2");//coloca o ponto dos milhares

    valor = valor.replace(/(\d)(\d{2})$/, "$1,$2");//coloca a virgula antes dos 2 últimos dígitos
    return valor;
}



/// CARREGAMENTO DE IMAGEM EM TELA, APOS SALVA


function carregarImagem( img ){
    
    var caminho = img.substr(51);
    
    
    carregar = new Image();
    carregar.src = "/gestaopessoas/fwk/uploads/imagens/" + caminho;
    
    document.getElementById("imagemView").innerHTML = "Carregando...";
    setTimeout( "verificaCarregamento()", 1 );
}
 



function verificaCarregamento(){
    
    if( carregar.complete )
    {
        document.getElementById("imagemView").innerHTML = "<img src=\"" 
                + carregar.src + " \" style='max-width:150px; padding-top: 1px; padding-right: 1px; max-height:140px; background_color: #000000;' onclick='abrirImagem()' />";
    }
    else
    {
        setTimeout( "verificaCarregamento()", 1 );
    }
}