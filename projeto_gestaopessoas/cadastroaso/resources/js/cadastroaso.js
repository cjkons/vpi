///////////////////////////////////////////////
/// Cadastro de ASO                         ///
/// CLARIFY - GESTAO DE PESSOAS             ///   
/// Desenvolvido por HEITOR SIQUEIRA        ///
/// JULHO DE 2017                           ///
/// VPI TECNOLOGIA                          ///
///////////////////////////////////////////////



$(document).ready(function() {
  
  carregarEmpresa();    
  carregarFilial();
  carregarFuncionario();
  carregarListaExames();
  getGrid();
  
 

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
    document.getElementById("localRealizacao").readOnly             = false;
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
    
    document.getElementById("anexoExame").readOnly             = false; 
    document.getElementById("anexoView").hidden             = true; 
    
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
    document.getElementById("localRealizacao").value            = "";
    document.getElementById("dataRealizacao").value            = "";
    
    
    document.getElementById("exameComplementar1").value            = 0;
    document.getElementById("dataComplementar1").value            = "";
    document.getElementById("exameComplementar2").value            = 0;
    document.getElementById("dataComplementar2").value            = "";
    document.getElementById("exameComplementar3").value            = 0;
    document.getElementById("dataComplementar3").value            = "";
    document.getElementById("exameComplementar4").value            = 0;
    document.getElementById("dataComplementar4").value            = "";
    document.getElementById("exameComplementar5").value            = 0;
    document.getElementById("dataComplementar5").value            = "";
    document.getElementById("exameComplementar6").value            = 0;
    document.getElementById("dataComplementar6").value            = "";
    document.getElementById("exameComplementar7").value            = 0;
    document.getElementById("dataComplementar7").value            = "";
    document.getElementById("exameComplementar8").value            = 0;
    document.getElementById("dataComplementar8").value            = "";
    
    document.getElementById("pagamentoExame").value            = 0;
    document.getElementById("valorExame").value            = "";
    document.getElementById("anexoExame").value            = "";
    document.getElementById("anexoView").value            = "";
    
         
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
    var localRealizacao           =   $('#localRealizacao').val();
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
    
    var anexoExame           =   $('#anexoExame').val();
    var anexoView           =   $('#anexoView').val();
    
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
    if(localRealizacao == ""){
        controleDePreenchimento = 'N';
    }
    if(dataRealizacao == ""){
        controleDePreenchimento = 'N';
    }
    if(pagamentoExame == 0){
        controleDePreenchimento = 'N';
    }
    
    if(anexoExame == ""){
        if(anexoView == ""){
            controleDePreenchimento = 'N';
        }
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
                document.getElementById("localRealizacao").readOnly             = true;
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
                
                document.getElementById("anexoExame").readOnly             = true;
                document.getElementById("anexoView").readOnly             = true;
    
        
        if (anexoExame != "") {


            var fd1 = new FormData();

            fd1.append('anexo', document.getElementById('anexoExame').files[0]);


            $.ajax({
                url: 'index.php?m=cadastroaso&c=cadastroasocontroller&f=salvarAnexo',
                type: 'POST',
                cache: false,
                data: fd1,
                processData: false,
                contentType: false,
                async: false,
                success: function (enderecoAnexo, pasta) {
        
        
        
            $.ajax({
                        url: 'index.php?m=cadastroaso&c=cadastroasocontroller&f=salvar',
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
                                    resultadoExame: resultadoExame,
                                    observacaoExame: observacaoExame,
                                    localRealizacao: localRealizacao,
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
                                    valorExame: valorExame,
                                    
                                    
                                    anexoExame: enderecoAnexo // PASSANDO VALOR DA ARQUIVO VINDO DO ANEXO
                                    
                                    
                                    
                                    
                            


                        },
                        type: 'POST',
                        dataType: 'json',
                        async: true,
                        success: function(r) {

                            if (r == true) {
                                mensagem('Sucesso', 'Salvo com sucesso', 'success');
                                
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
            });   
    
    // SEM NOVO ANEXO, BUSCA VALOR NO ANEXO VIEW        
        }else{
            $.ajax({
                        url: 'index.php?m=cadastroaso&c=cadastroasocontroller&f=salvar',
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
                                    resultadoExame: resultadoExame,
                                    observacaoExame: observacaoExame,
                                    localRealizacao: localRealizacao,
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
            
    }
            
    else{
        
        mensagem('Atenção', 'Prencha todos os campos', 'r', 'e', 2000, 1);
        
      
            
    }
    
}

function excluir(){
    
    var idAso  =   $('#idAso').val();
     
    $.ajax({
        url: 'index.php?m=cadastroaso&c=cadastroasocontroller&f=excluir',
        data: {
            idAso: idAso
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {

            if (r == true) {
                mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
               
               atualizar();
            }
            else {
               mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
              
               atualizar();
            }
        },
        error: function(e) {
            mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
            $('#basicModal').modal('hide');
            

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
    document.getElementById("localRealizacao").readOnly             = false;
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
    
    document.getElementById("anexoExame").readOnly             = false; 
    document.getElementById("anexoView").readOnly             = true; 
    
    
    
    
         
       
    
}

function buscaPrimeiroRegistro(){
    
    document.getElementById("idAso").readOnly             = true;
    document.getElementById("empresa").readOnly             = true;
    document.getElementById("filial").readOnly             = true;
    document.getElementById("funcionario").readOnly             = true;
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
    document.getElementById("localRealizacao").readOnly             = true;
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
    
    document.getElementById("anexoExame").readOnly             = true; 
    document.getElementById("anexoView").readOnly             = true; 
    
    document.getElementById("anexoView").value = "";
   
    
    $.ajax({
        url: 'index.php?m=cadastroaso&c=cadastroasocontroller&f=buscaPrimeiroRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
                   
            document.getElementById("idAso").value = r[0];
            document.getElementById("empresa").value = r[1];
            document.getElementById("filial").value = r[2];
            document.getElementById("funcionario").value = r[3];
            document.getElementById("matricula").value = r[4];
            document.getElementById("setor").value = r[5];
            document.getElementById("funcao").value = r[6];
            document.getElementById("dataNasc").value = r[7];
            document.getElementById("cpf").value = r[8];
            document.getElementById("ctps").value = r[9];
            document.getElementById("pisPasep").value = r[10];
            document.getElementById("tipoExames").value = r[11];
            document.getElementById("outrosExames").value = r[12];
            document.getElementById("medico").value = r[13];
            document.getElementById("crm").value = r[14];
            
            if (r[15] == 'S' ) {
                
                $('#agBiologico').prop('checked', true);
                
            }else{
                
                $('#agBiologico').prop('checked', false);
            }
            
            if (r[16] == 'S' ) {
                
                $('#agFisico').prop('checked', true);
                
            }else{
                
                $('#agFisico').prop('checked', false);
            }
            
            if (r[17] == 'S' ) {
                
                $('#agQuimico').prop('checked', true);
                
            }else{
                
                $('#agQuimico').prop('checked', false);
            }
            
            if (r[18] == 'S' ) {
                
                $('#riscoAcidente').prop('checked', true);
                
            }else{
                
                $('#riscoAcidente').prop('checked', false);
            }
            
            if (r[19] == 'S' ) {
                
                $('#riscoErgonomico').prop('checked', true);
                
            }else{
                
                $('#riscoErgonomico').prop('checked', false);
            }
            
            if (r[20] == 'S' ) {
                
                $('#ausenciaRisco').prop('checked', true);
                
            }else{
                
                $('#ausenciaRisco').prop('checked', false);
            }

            document.getElementById("resultadoExame").value = r[21];
            document.getElementById("observacaoExame").value = r[22];
            document.getElementById("dataRealizacao").value = r[23];
            document.getElementById("exameComplementar1").value = r[24];
            document.getElementById("dataComplementar1").value = r[25];
            document.getElementById("exameComplementar2").value = r[26];
            document.getElementById("dataComplementar2").value = r[27];
            document.getElementById("exameComplementar3").value = r[28];
            document.getElementById("dataComplementar3").value = r[29];
            document.getElementById("exameComplementar4").value = r[30];
            document.getElementById("dataComplementar4").value = r[31];
            document.getElementById("exameComplementar5").value = r[32];
            document.getElementById("dataComplementar5").value = r[33];
            document.getElementById("exameComplementar6").value = r[34];
            document.getElementById("dataComplementar6").value = r[35];
            document.getElementById("exameComplementar7").value = r[36];
            document.getElementById("dataComplementar7").value = r[37];
            document.getElementById("exameComplementar8").value = r[38];
            document.getElementById("dataComplementar8").value = r[39];
            document.getElementById("pagamentoExame").value = r[40];
            document.getElementById("valorExame").value = r[41];
            
            document.getElementById("localRealizacao").value = r[42];
            
            document.getElementById("anexoExame").value = "";
            
            var anexoView = r[43];
            var anexoView = anexoView.substr(57);
            document.getElementById("anexoView").value = anexoView;
           
            
            
            
            
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroAnterior(){
    
    
    document.getElementById("idAso").readOnly             = true;
    document.getElementById("empresa").readOnly             = true;
    document.getElementById("filial").readOnly             = true;
    document.getElementById("funcionario").readOnly             = true;
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
    document.getElementById("localRealizacao").readOnly             = true;
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

    document.getElementById("anexoExame").readOnly             = true; 
    document.getElementById("anexoView").readOnly             = true;
    
    document.getElementById("anexoView").value = "";
    
    var idAso  =  $('#idAso').val();  
        
    $.ajax({
        url: 'index.php?m=cadastroaso&c=cadastroasocontroller&f=buscaRegistroAnterior',
        data: {
            idAso: idAso
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                
                document.getElementById("idAso").value = r[0];
                document.getElementById("empresa").value = r[1];
                document.getElementById("filial").value = r[2];
                document.getElementById("funcionario").value = r[3];
                document.getElementById("matricula").value = r[4];
                document.getElementById("setor").value = r[5];
                document.getElementById("funcao").value = r[6];
                document.getElementById("dataNasc").value = r[7];
                document.getElementById("cpf").value = r[8];
                document.getElementById("ctps").value = r[9];
                document.getElementById("pisPasep").value = r[10];
                document.getElementById("tipoExames").value = r[11];
                document.getElementById("outrosExames").value = r[12];
                document.getElementById("medico").value = r[13];
                document.getElementById("crm").value = r[14];

                if (r[15] == 'S' ) {

                    $('#agBiologico').prop('checked', true);

                }else{

                    $('#agBiologico').prop('checked', false);
                }

                if (r[16] == 'S' ) {

                    $('#agFisico').prop('checked', true);

                }else{

                    $('#agFisico').prop('checked', false);
                }

                if (r[17] == 'S' ) {

                    $('#agQuimico').prop('checked', true);

                }else{

                    $('#agQuimico').prop('checked', false);
                }

                if (r[18] == 'S' ) {

                    $('#riscoAcidente').prop('checked', true);

                }else{

                    $('#riscoAcidente').prop('checked', false);
                }

                if (r[19] == 'S' ) {

                    $('#riscoErgonomico').prop('checked', true);

                }else{

                    $('#riscoErgonomico').prop('checked', false);
                }

                if (r[20] == 'S' ) {

                    $('#ausenciaRisco').prop('checked', true);

                }else{

                    $('#ausenciaRisco').prop('checked', false);
                }

                document.getElementById("resultadoExame").value = r[21];
                document.getElementById("observacaoExame").value = r[22];
                document.getElementById("dataRealizacao").value = r[23];
                document.getElementById("exameComplementar1").value = r[24];
                document.getElementById("dataComplementar1").value = r[25];
                document.getElementById("exameComplementar2").value = r[26];
                document.getElementById("dataComplementar2").value = r[27];
                document.getElementById("exameComplementar3").value = r[28];
                document.getElementById("dataComplementar3").value = r[29];
                document.getElementById("exameComplementar4").value = r[30];
                document.getElementById("dataComplementar4").value = r[31];
                document.getElementById("exameComplementar5").value = r[32];
                document.getElementById("dataComplementar5").value = r[33];
                document.getElementById("exameComplementar6").value = r[34];
                document.getElementById("dataComplementar6").value = r[35];
                document.getElementById("exameComplementar7").value = r[36];
                document.getElementById("dataComplementar7").value = r[37];
                document.getElementById("exameComplementar8").value = r[38];
                document.getElementById("dataComplementar8").value = r[39];
                document.getElementById("pagamentoExame").value = r[40];
                document.getElementById("valorExame").value = r[41];
                
                document.getElementById("localRealizacao").value = r[42];
                
                document.getElementById("anexoExame").value = "";
                
                
                var anexoView = r[43];
                var anexoView = anexoView.substr(57);
                document.getElementById("anexoView").value = anexoView;
                



            }
          
            
            
            
        },
        error: function(e) {
            
             

        }
    }); 
 
    
}
function buscaRegistroProximo(){
    
    
    document.getElementById("idAso").readOnly             = true;
    document.getElementById("empresa").readOnly             = true;
    document.getElementById("filial").readOnly             = true;
    document.getElementById("funcionario").readOnly             = true;
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
    document.getElementById("localRealizacao").readOnly             = true;
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
    
    document.getElementById("anexoExame").readOnly             = true; 
    document.getElementById("anexoView").readOnly             = true;

    document.getElementById("anexoView").value = "";
    
    var idAso  =  $('#idAso').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastroaso&c=cadastroasocontroller&f=buscaRegistroProximo',
        data: {
            idAso: idAso
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                    
                    document.getElementById("idAso").value = r[0];
                    document.getElementById("empresa").value = r[1];
                    document.getElementById("filial").value = r[2];
                    document.getElementById("funcionario").value = r[3];
                    document.getElementById("matricula").value = r[4];
                    document.getElementById("setor").value = r[5];
                    document.getElementById("funcao").value = r[6];
                    document.getElementById("dataNasc").value = r[7];
                    document.getElementById("cpf").value = r[8];
                    document.getElementById("ctps").value = r[9];
                    document.getElementById("pisPasep").value = r[10];
                    document.getElementById("tipoExames").value = r[11];
                    document.getElementById("outrosExames").value = r[12];
                    document.getElementById("medico").value = r[13];
                    document.getElementById("crm").value = r[14];

                    if (r[15] == 'S' ) {

                        $('#agBiologico').prop('checked', true);

                    }else{

                        $('#agBiologico').prop('checked', false);
                    }

                    if (r[16] == 'S' ) {

                        $('#agFisico').prop('checked', true);

                    }else{

                        $('#agFisico').prop('checked', false);
                    }

                    if (r[17] == 'S' ) {

                        $('#agQuimico').prop('checked', true);

                    }else{

                        $('#agQuimico').prop('checked', false);
                    }

                    if (r[18] == 'S' ) {

                        $('#riscoAcidente').prop('checked', true);

                    }else{

                        $('#riscoAcidente').prop('checked', false);
                    }

                    if (r[19] == 'S' ) {

                        $('#riscoErgonomico').prop('checked', true);

                    }else{

                        $('#riscoErgonomico').prop('checked', false);
                    }

                    if (r[20] == 'S' ) {

                        $('#ausenciaRisco').prop('checked', true);

                    }else{

                        $('#ausenciaRisco').prop('checked', false);
                    }

                    document.getElementById("resultadoExame").value = r[21];
                    document.getElementById("observacaoExame").value = r[22];
                    document.getElementById("dataRealizacao").value = r[23];
                    document.getElementById("exameComplementar1").value = r[24];
                    document.getElementById("dataComplementar1").value = r[25];
                    document.getElementById("exameComplementar2").value = r[26];
                    document.getElementById("dataComplementar2").value = r[27];
                    document.getElementById("exameComplementar3").value = r[28];
                    document.getElementById("dataComplementar3").value = r[29];
                    document.getElementById("exameComplementar4").value = r[30];
                    document.getElementById("dataComplementar4").value = r[31];
                    document.getElementById("exameComplementar5").value = r[32];
                    document.getElementById("dataComplementar5").value = r[33];
                    document.getElementById("exameComplementar6").value = r[34];
                    document.getElementById("dataComplementar6").value = r[35];
                    document.getElementById("exameComplementar7").value = r[36];
                    document.getElementById("dataComplementar7").value = r[37];
                    document.getElementById("exameComplementar8").value = r[38];
                    document.getElementById("dataComplementar8").value = r[39];
                    document.getElementById("pagamentoExame").value = r[40];
                    document.getElementById("valorExame").value = r[41];
                
                    document.getElementById("localRealizacao").value = r[42];
                    
                    document.getElementById("anexoExame").value = "";
                    
                    var anexoView = r[43];
                    var anexoView = anexoView.substr(57);
                    document.getElementById("anexoView").value = anexoView;
            }
           
        },
        error: function(e) {

        }
    }); 
 
    
}


function buscaUltimoRegistro(){
    
    document.getElementById("idAso").readOnly             = true;
    document.getElementById("empresa").readOnly             = true;
    document.getElementById("filial").readOnly             = true;
    document.getElementById("funcionario").readOnly             = true;
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
    document.getElementById("localRealizacao").readOnly             = true;
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
    
    document.getElementById("anexoExame").readOnly             = true; 
    document.getElementById("anexoView").readOnly             = true;

    document.getElementById("anexoView").value = "";
    
    
    $.ajax({
        url: 'index.php?m=cadastroaso&c=cadastroasocontroller&f=buscaUltimoRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
                document.getElementById("idAso").value = r[0];
                document.getElementById("empresa").value = r[1];
                document.getElementById("filial").value = r[2];
                document.getElementById("funcionario").value = r[3];
                document.getElementById("matricula").value = r[4];
                document.getElementById("setor").value = r[5];
                document.getElementById("funcao").value = r[6];
                document.getElementById("dataNasc").value = r[7];
                document.getElementById("cpf").value = r[8];
                document.getElementById("ctps").value = r[9];
                document.getElementById("pisPasep").value = r[10];
                document.getElementById("tipoExames").value = r[11];
                document.getElementById("outrosExames").value = r[12];
                document.getElementById("medico").value = r[13];
                document.getElementById("crm").value = r[14];

                if (r[15] == 'S' ) {

                    $('#agBiologico').prop('checked', true);

                }else{

                    $('#agBiologico').prop('checked', false);
                }

                if (r[16] == 'S' ) {

                    $('#agFisico').prop('checked', true);

                }else{

                    $('#agFisico').prop('checked', false);
                }

                if (r[17] == 'S' ) {

                    $('#agQuimico').prop('checked', true);

                }else{

                    $('#agQuimico').prop('checked', false);
                }

                if (r[18] == 'S' ) {

                    $('#riscoAcidente').prop('checked', true);

                }else{

                    $('#riscoAcidente').prop('checked', false);
                }

                if (r[19] == 'S' ) {

                    $('#riscoErgonomico').prop('checked', true);

                }else{

                    $('#riscoErgonomico').prop('checked', false);
                }

                if (r[20] == 'S' ) {

                    $('#ausenciaRisco').prop('checked', true);

                }else{

                    $('#ausenciaRisco').prop('checked', false);
                }

                document.getElementById("resultadoExame").value = r[21];
                document.getElementById("observacaoExame").value = r[22];
                document.getElementById("dataRealizacao").value = r[23];
                document.getElementById("exameComplementar1").value = r[24];
                document.getElementById("dataComplementar1").value = r[25];
                document.getElementById("exameComplementar2").value = r[26];
                document.getElementById("dataComplementar2").value = r[27];
                document.getElementById("exameComplementar3").value = r[28];
                document.getElementById("dataComplementar3").value = r[29];
                document.getElementById("exameComplementar4").value = r[30];
                document.getElementById("dataComplementar4").value = r[31];
                document.getElementById("exameComplementar5").value = r[32];
                document.getElementById("dataComplementar5").value = r[33];
                document.getElementById("exameComplementar6").value = r[34];
                document.getElementById("dataComplementar6").value = r[35];
                document.getElementById("exameComplementar7").value = r[36];
                document.getElementById("dataComplementar7").value = r[37];
                document.getElementById("exameComplementar8").value = r[38];
                document.getElementById("dataComplementar8").value = r[39];
                document.getElementById("pagamentoExame").value = r[40];
                document.getElementById("valorExame").value = r[41];
                
                document.getElementById("localRealizacao").value = r[42];
                
                document.getElementById("anexoExame").value = "";
                
                
                    var anexoView = r[43];
                    var anexoView = anexoView.substr(57);
                    document.getElementById("anexoView").value = anexoView;
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
        url: 'index.php?m=cadastroaso&c=cadastroasocontroller&f=pesquisaSimples',
        data: {
            idInicial: idInicial,
            nomeInicial: nomeInicial
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             
                document.getElementById("idAso").value = r[0];
                document.getElementById("empresa").value = r[1];
                document.getElementById("filial").value = r[2];
                document.getElementById("funcionario").value = r[3];
                document.getElementById("matricula").value = r[4];
                document.getElementById("setor").value = r[5];
                document.getElementById("funcao").value = r[6];
                document.getElementById("dataNasc").value = r[7];
                document.getElementById("cpf").value = r[8];
                document.getElementById("ctps").value = r[9];
                document.getElementById("pisPasep").value = r[10];
                document.getElementById("tipoExames").value = r[11];
                document.getElementById("outrosExames").value = r[12];
                document.getElementById("medico").value = r[13];
                document.getElementById("crm").value = r[14];

                if (r[15] == 'S' ) {

                    $('#agBiologico').prop('checked', true);

                }else{

                    $('#agBiologico').prop('checked', false);
                }

                if (r[16] == 'S' ) {

                    $('#agFisico').prop('checked', true);

                }else{

                    $('#agFisico').prop('checked', false);
                }

                if (r[17] == 'S' ) {

                    $('#agQuimico').prop('checked', true);

                }else{

                    $('#agQuimico').prop('checked', false);
                }

                if (r[18] == 'S' ) {

                    $('#riscoAcidente').prop('checked', true);

                }else{

                    $('#riscoAcidente').prop('checked', false);
                }

                if (r[19] == 'S' ) {

                    $('#riscoErgonomico').prop('checked', true);

                }else{

                    $('#riscoErgonomico').prop('checked', false);
                }

                if (r[20] == 'S' ) {

                    $('#ausenciaRisco').prop('checked', true);

                }else{

                    $('#ausenciaRisco').prop('checked', false);
                }

                document.getElementById("resultadoExame").value = r[21];
                document.getElementById("observacaoExame").value = r[22];
                document.getElementById("dataRealizacao").value = r[23];
                document.getElementById("exameComplementar1").value = r[24];
                document.getElementById("dataComplementar1").value = r[25];
                document.getElementById("exameComplementar2").value = r[26];
                document.getElementById("dataComplementar2").value = r[27];
                document.getElementById("exameComplementar3").value = r[28];
                document.getElementById("dataComplementar3").value = r[29];
                document.getElementById("exameComplementar4").value = r[30];
                document.getElementById("dataComplementar4").value = r[31];
                document.getElementById("exameComplementar5").value = r[32];
                document.getElementById("dataComplementar5").value = r[33];
                document.getElementById("exameComplementar6").value = r[34];
                document.getElementById("dataComplementar6").value = r[35];
                document.getElementById("exameComplementar7").value = r[36];
                document.getElementById("dataComplementar7").value = r[37];
                document.getElementById("exameComplementar8").value = r[38];
                document.getElementById("dataComplementar8").value = r[39];
                document.getElementById("pagamentoExame").value = r[40];
                document.getElementById("valorExame").value = r[41];
                
                document.getElementById("localRealizacao").value = r[42];
                
                document.getElementById("anexoExame").value = "";
                
                
                    var anexoView = r[43];
                    var anexoView = anexoView.substr(57);
                    document.getElementById("anexoView").value = anexoView;
                
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
            "url": "index.php?m=cadastroaso&c=cadastroasocontroller&f=getGrid",
              
            "type": "POST",
        },
         language: {
            "url": '//cdn.datatables.net/plug-ins/1.10.7/i18n/Portuguese-Brasil.json'
        },
        "columns": [
            {"data": "ID_ASO"},
            {"data": "EMPRESA"},
            {"data": "FILIAL"},
            {"data": "FUNCIONARIO"},
            {"data": "MATRICULA"},
            {"data": "SETOR"},
            {"data": "FUNCAO"},
            {"data": "SELECIONAR"}       
            
            
            
           
        ],
        searching: false
    });

    $('#grid')
            .removeClass('display')
            .addClass('table table-hover table-striped table-bordered');
    
    
  
    
  
  
 }
 
 function selecionaGrid(idAso){
    
   
    // Pesquisa Para alimentar campos
    //alert(idFuncionario);
    
    document.getElementById("idAso").readOnly             = true;
    document.getElementById("empresa").readOnly             = true;
    document.getElementById("filial").readOnly             = true;
    document.getElementById("funcionario").readOnly             = true;
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
    document.getElementById("localRealizacao").readOnly             = true;
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
    
    document.getElementById("anexoExame").readOnly             = true; 
    document.getElementById("anexoView").readOnly             = true;
    

    
      
    
    
    $.ajax({
        url: 'index.php?m=cadastroaso&c=cadastroasocontroller&f=selecionaGrid',
        data: {
            idAso: idAso
            
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             
                document.getElementById("idAso").value = r[0];
                document.getElementById("empresa").value = r[1];
                document.getElementById("filial").value = r[2];
                document.getElementById("funcionario").value = r[3];
                document.getElementById("matricula").value = r[4];
                document.getElementById("setor").value = r[5];
                document.getElementById("funcao").value = r[6];
                document.getElementById("dataNasc").value = r[7];
                document.getElementById("cpf").value = r[8];
                document.getElementById("ctps").value = r[9];
                document.getElementById("pisPasep").value = r[10];
                document.getElementById("tipoExames").value = r[11];
                document.getElementById("outrosExames").value = r[12];
                document.getElementById("medico").value = r[13];
                document.getElementById("crm").value = r[14];

                if (r[15] == 'S' ) {

                    $('#agBiologico').prop('checked', true);

                }else{

                    $('#agBiologico').prop('checked', false);
                }

                if (r[16] == 'S' ) {

                    $('#agFisico').prop('checked', true);

                }else{

                    $('#agFisico').prop('checked', false);
                }

                if (r[17] == 'S' ) {

                    $('#agQuimico').prop('checked', true);

                }else{

                    $('#agQuimico').prop('checked', false);
                }

                if (r[18] == 'S' ) {

                    $('#riscoAcidente').prop('checked', true);

                }else{

                    $('#riscoAcidente').prop('checked', false);
                }

                if (r[19] == 'S' ) {

                    $('#riscoErgonomico').prop('checked', true);

                }else{

                    $('#riscoErgonomico').prop('checked', false);
                }

                if (r[20] == 'S' ) {

                    $('#ausenciaRisco').prop('checked', true);

                }else{

                    $('#ausenciaRisco').prop('checked', false);
                }

                document.getElementById("resultadoExame").value = r[21];
                document.getElementById("observacaoExame").value = r[22];
                document.getElementById("dataRealizacao").value = r[23];
                document.getElementById("exameComplementar1").value = r[24];
                document.getElementById("dataComplementar1").value = r[25];
                document.getElementById("exameComplementar2").value = r[26];
                document.getElementById("dataComplementar2").value = r[27];
                document.getElementById("exameComplementar3").value = r[28];
                document.getElementById("dataComplementar3").value = r[29];
                document.getElementById("exameComplementar4").value = r[30];
                document.getElementById("dataComplementar4").value = r[31];
                document.getElementById("exameComplementar5").value = r[32];
                document.getElementById("dataComplementar5").value = r[33];
                document.getElementById("exameComplementar6").value = r[34];
                document.getElementById("dataComplementar6").value = r[35];
                document.getElementById("exameComplementar7").value = r[36];
                document.getElementById("dataComplementar7").value = r[37];
                document.getElementById("exameComplementar8").value = r[38];
                document.getElementById("dataComplementar8").value = r[39];
                document.getElementById("pagamentoExame").value = r[40];
                document.getElementById("valorExame").value = r[41];
                
                document.getElementById("localExame").value = r[42];
                
                document.getElementById("anexoExame").value = "";               
                
                
                    var anexoView = r[43];
                    var anexoView = anexoView.substr(57);
                    document.getElementById("anexoView").value = anexoView;
                     
        },
        error: function(e) {

        }
    }); 
            
    
}
function atualizar() {


    document.getElementById("idAso").readOnly             = true;
    document.getElementById("empresa").readOnly             = true;
    document.getElementById("filial").readOnly             = true;
    document.getElementById("funcionario").readOnly             = true;
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
    document.getElementById("localRealizacao").readOnly             = true;
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
    
    document.getElementById("anexoExame").readOnly             = true; 
    document.getElementById("anexoView").hidden             = true;
    
    
    
    document.getElementById("idAso").value = "";
    document.getElementById("empresa").value = 0;
    document.getElementById("filial").value = 0;
    document.getElementById("funcionario").value = 0;
    document.getElementById("matricula").value = "";
    document.getElementById("setor").value = "";
    document.getElementById("funcao").value = "";
    document.getElementById("dataNasc").value = "";
    document.getElementById("cpf").value = "";
    document.getElementById("ctps").value = "";
    document.getElementById("pisPasep").value = "";
    document.getElementById("tipoExames").value = 0;
    document.getElementById("outrosExames").value = "";
    document.getElementById("medico").value = "";
    document.getElementById("crm").value = "";
    
    $('#agBiologico').prop('checked', false);
    $('#agFisico').prop('checked', false);
    $('#agQuimico').prop('checked', false);
    $('#riscoAcidente').prop('checked', false);
    $('#riscoErgonomico').prop('checked', false);
    $('#ausenciaRisco').prop('checked', false);
    
    document.getElementById("resultadoExame").value = 0;
    document.getElementById("observacaoExame").value = "";
    document.getElementById("localRealizacao").value = "";
    document.getElementById("dataRealizacao").value = "";
    document.getElementById("exameComplementar1").value = 0;
    document.getElementById("dataComplementar1").value = "";
    document.getElementById("exameComplementar2").value = 0;
    document.getElementById("dataComplementar2").value = "";
    document.getElementById("exameComplementar3").value = 0;
    document.getElementById("dataComplementar3").value = "";
    document.getElementById("exameComplementar4").value = 0;
    document.getElementById("dataComplementar4").value = "";
    document.getElementById("exameComplementar5").value = 0;
    document.getElementById("dataComplementar5").value = "";
    document.getElementById("exameComplementar6").value = 0; 
    document.getElementById("dataComplementar6").value = "";
    document.getElementById("exameComplementar7").value = 0;
    document.getElementById("dataComplementar7").value = "";
    document.getElementById("exameComplementar8").value = 0;
    document.getElementById("dataComplementar8").value = "";
    document.getElementById("pagamentoExame").value = 0;
    document.getElementById("valorExame").value = "";
    
    document.getElementById("anexoExame").value = "";
    document.getElementById("anexoView").value = "";
    
    
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

function carregarListaExames(){
    
           
    $.ajax({
        url: 'index.php?m=cadastroaso&c=cadastroasocontroller&f=carregarListaExames',
        data: {
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('exameComplementar1').innerHTML = data;
                document.getElementById('exameComplementar2').innerHTML = data;
                document.getElementById('exameComplementar3').innerHTML = data;
                document.getElementById('exameComplementar4').innerHTML = data;
                document.getElementById('exameComplementar5').innerHTML = data;
                document.getElementById('exameComplementar6').innerHTML = data;
                document.getElementById('exameComplementar7').innerHTML = data;
                document.getElementById('exameComplementar8').innerHTML = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de EXAMES', 'error'); 
               
            }

        },
        error: function() {
            desbloqueiaTela();
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

function carregaExame2(){
    
    var dataComplementar1                 =   $('#dataComplementar1').val(); 
 
    if (dataComplementar1 != ""){
         
         document.getElementById("exameComplementar2").disabled = false;
         document.getElementById("dataComplementar2").disabled = false; 
        
    }else{
        document.getElementById("exameComplementar2").disabled = true;
        document.getElementById("dataComplementar2").disabled = true;
    }
    
}
function carregaExame3(){
    
    var dataComplementar2                 =   $('#dataComplementar2').val(); 
   
    if (dataComplementar2 != ""){
         
         document.getElementById("exameComplementar3").disabled = false;
         document.getElementById("dataComplementar3").disabled = false; 
        
    }else{
        document.getElementById("exameComplementar3").disabled = true;
        document.getElementById("dataComplementar3").disabled = true;
    }
    
}
function carregaExame4(){
    
    var dataComplementar3                 =   $('#dataComplementar3').val(); 
   
    if (dataComplementar3 != ""){
         
         document.getElementById("exameComplementar4").disabled = false;
         document.getElementById("dataComplementar4").disabled = false; 
        
    }else{
        document.getElementById("exameComplementar4").disabled = true;
        document.getElementById("dataComplementar4").disabled = true;
    }
    
}
function carregaExame5(){
    
    var dataComplementar4                 =   $('#dataComplementar4').val(); 
   
    if (dataComplementar4 != ""){
         
         document.getElementById("exameComplementar5").disabled = false;
         document.getElementById("dataComplementar5").disabled = false; 
        
    }else{
        document.getElementById("exameComplementar5").disabled = true;
        document.getElementById("dataComplementar5").disabled = true;
    }
    
}

function carregaExame6(){
    
    var dataComplementar5                 =   $('#dataComplementar5').val(); 
   
    if (dataComplementar5 != ""){
         
         document.getElementById("exameComplementar6").disabled = false;
         document.getElementById("dataComplementar6").disabled = false; 
        
    }else{
        document.getElementById("exameComplementar6").disabled = true;
        document.getElementById("dataComplementar6").disabled = true;
    }
    
}

function carregaExame7(){
    
    var dataComplementar6                 =   $('#dataComplementar6').val(); 
   
    if (dataComplementar6 != ""){
         
         document.getElementById("exameComplementar7").disabled = false;
         document.getElementById("dataComplementar7").disabled = false; 
        
    }else{
        document.getElementById("exameComplementar7").disabled = true;
        document.getElementById("dataComplementar7").disabled = true;
    }
    
}

function carregaExame8(){
    
    var dataComplementar7                 =   $('#dataComplementar7').val(); 
   
    if (dataComplementar7 != ""){
         
         document.getElementById("exameComplementar8").disabled = false;
         document.getElementById("dataComplementar8").disabled = false; 
        
    }else{
        document.getElementById("exameComplementar8").disabled = true;
        document.getElementById("dataComplementar8").disabled = true;
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

// Mensagens de Alerta
 





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


/////////// ABRIR ARQUIVO PDF

function getPdf(){
    
    var idAso  =  $('#idAso').val();       

    $.ajax({
        url: 'index.php?m=cadastroaso&c=cadastroasocontroller&f=getPdf',
        data: {
            idAso: idAso
            


        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(data) {
                   
                    abrirArquivoPdf();
                    
          
        },
        error: function() {
                 
                 abrirArquivoPdf();
                 
        }
    });
      
    
}

function abrirArquivoPdf() {

    //window.open('C:/teste/pdf/.teste1.pdf'); - local
    //window.open('http://www.vpitecnologia.com.br/gcconcreto/relatoriostemp/relatorio/.cadastro_orcamento.pdf'); //gcconcreto
   // window.open('http://localhost/gestaopessoas/fwk/uploads/pdf/.atestado_aso.pdf'); // localhost
    window.open('http://192.168.8.70/gestaopessoas/fwk/uploads/pdf/.atestado_aso.pdf'); // pc local
  
}

function vizualizarAnexo() {
    
    var anexoView = $('#anexoView').val();
    
    
    
    if (anexoView != ""){
        
        //var enderecoContrato = "http://localhost/gestaopessoas/fwk/uploads/pdf/examesAso/"; // localhost
        var enderecoContrato = "http://192.168.8.70/gestaopessoas/fwk/uploads/pdf/examesAso/"; // pc local
        //var enderecoContrato = "http://sig.sulcatarinense.com.br/uploadsPermuta/Contratos/"; // servidor

        window.open(enderecoContrato + anexoView, '_blank');
    }else{
         mensagem('Atenção', 'Nenhum Arquivo em Anexo', 'error'); 
    }
     
   
     
}