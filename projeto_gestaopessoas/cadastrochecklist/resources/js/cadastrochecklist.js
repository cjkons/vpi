/////////////////////////////////////////////
// CLARIFY - GESTAO DE ATIVOS             ///
// CADASTRO CHECKLIST  1.00               ///   
// Desenvolvido por Heitor Siqueira       ///
// junho de 2017                          ///
// VPI GESTAO                             ///
/////////////////////////////////////////////

var totalEditar = 1;
var cache = {};
var lastXhr;
var cache1 = {};
var lastXhr1;
cont = 1;
 i = 1;

$(document).ready(function() {

// carregarCodItem();
 
 
    
});
function novo(){
      
    
    
    
    document.getElementById("checkList").readOnly  = false;
    document.getElementById("descricao").readOnly  = false;
    document.getElementById("grupo").readOnly      = false;
    document.getElementById("subGrupo").readOnly   = false;
    
    
    document.getElementById("idCheckList").value        = "";
    document.getElementById("checkList").value          = "";
    document.getElementById("descricao").value          = "";
    document.getElementById("grupo").value              = "";
    document.getElementById("subGrupo").value           = "";
    document.getElementById('tabelaPreco2').innerHTML   = "";
    
    
    
    
   
     
    $.ajax({
        url: 'index.php?m=cadastrochecklist&c=cadastrochecklistcontroller&f=novo',
        data: {
            
           
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            document.getElementById("idCheckList").value  = r;
            novoIdDesc();
                 
            
        },
        error: function(e) {
           
        }
    }); 
    
  
}

function novoIdDesc(){
    
    var idCheckList     =   $('#idCheckList').val(); 
    
     
    $.ajax({
        url: 'index.php?m=cadastrochecklist&c=cadastrochecklistcontroller&f=novoIdDesc',
        data: {
            idCheckList: idCheckList 
           
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             document.getElementById("idCheckListDesc").value  = r;
            
                 
            
        },
        error: function(e) {
           
        }
    }); 
    
  
}
    
function salvar(){
     
    var idCheckList     =   $('#idCheckList').val();             
    var checkList       =   $('#checkList').val(); 
    
              
    var controleDePreenchimento = 'S';
 
    if(idCheckList == ""){
        controleDePreenchimento = 'N';
    }
    if(checkList == ""){
        controleDePreenchimento = 'N';
    }
   
        
    if(controleDePreenchimento ==  'S'){
          
        document.getElementById("idCheckList").readOnly     = true;
        document.getElementById("checkList").readOnly   = true;
        

        $.ajax({
            url: 'index.php?m=cadastrochecklist&c=cadastrochecklistcontroller&f=salvar',
            data: {
                idCheckList: idCheckList,
                checkList: checkList
                
                 },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(r) {

                if (r == true) {
                    mensagem('Sucesso', 'Salvo com sucesso', 'success');
                    salvarDescricao(1);
                    $('#basicModal').modal('hide');
                    
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
       // mensagens de erro
        
          
    }
    
}


function salvarDescricao(id){
      
    var  idCheckList        =  document.getElementById('idCheckList').value;   
    
    if( id == 1){
        
        var  idCheckListDesc        =  document.getElementById('idCheckListDesc').value; 
        var  descricao              =  document.getElementById('descricao').value;
        var  grupo                  =  document.getElementById('grupo').value;
        var  subGrupo               =  document.getElementById('subGrupo').value; 
       
    }    
    else{
         
        var idIdCheckListDesc = id;
        var idDescricao       = id + '_' + id;
        var idGrupo           = id + '_' + id + '_' + id;
        var idSubGrupo        = id + '_' + id + '_' + id + '_' + id;
        
        var  idCheckListDesc        =  document.getElementById(idIdCheckListDesc).value;
        var  descricao              =  document.getElementById(idDescricao).value;
        var  grupo                  =  document.getElementById(idGrupo).value;
        var  subGrupo               =  document.getElementById(idSubGrupo).value; 
       
        
    }
    

        $.ajax({
        url: 'index.php?m=cadastrochecklist&c=cadastrochecklistcontroller&f=salvarDescricao',
        data: {
            
            idCheckList: idCheckList,
            idCheckListDesc: idCheckListDesc,
            descricao: descricao,
            grupo: grupo,
            subGrupo: subGrupo
            
            
          
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {

            if (r == true) {
                mensagem('Sucesso', 'Descrição salvo com Sucesso', 'success');
                $('#basicModal').modal('hide');
               
            }
            else {
                mensagem('Atenção', 'Erro ao salvar Descrição', 'error');
                $('#basicModal').modal('hide');
              
            }
        },
        error: function(e) {
            mensagem('Atenção', 'Erro ao salvar Descrição', 'error');
            $('#basicModal').modal('hide');
         
            

        }
    }); 
    
    
    
    
}


function excluir(){
    
    var idCheckList =   $('#idCheckList').val();
     
    $.ajax({
        url: 'index.php?m=cadastrochecklist&c=cadastrochecklistcontroller&f=excluir',
        data: {
            idCheckList: idCheckList
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {

            if (r == true || r == 1) {
                mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                $('#basicModal').modal('hide');
                atualizar();
            }
            else {
                mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                $('#basicModal').modal('hide'); 
                atualizar();
            }
        },
        error: function(e) {
            mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
            $('#basicModal').modal('hide');
                atualizar();
        }
    }); 
     
}

function excluirDescricao(id){
   
    id = id - 1;
    
    var  idCheckList        =  document.getElementById('idCheckList').value;
  
    if( id == 0 ){
                
        var  idCheckListDesc      =  document.getElementById('idCheckListDesc').value;
          
    }    
    else{
       
               
        var  idCheckListDesc     =  id;
        
    }
    $.ajax({
        url: 'index.php?m=cadastrochecklist&c=cadastrochecklistcontroller&f=excluirDescricao',
        data: {
            idCheckList: idCheckList,
            idCheckListDesc: idCheckListDesc
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {

            if (r == true || r == 1) {
                mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                $('#basicModal').modal('hide');
                
                
            }
            else {
                mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                $('#basicModal').modal('hide'); 
                
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
    
    document.getElementById("idPreco").value   = "";
    document.getElementById("descPreco").value   = "";
    document.getElementById("codProduto").disabled  = "";
    document.getElementById("produto").value   = "";
    document.getElementById("undMedida").value   = "";
    document.getElementById("precoVendas").value   = "";
    document.getElementById("comissao").value   = "";
    document.getElementById('tabelaPreco2').innerHTML = "";
    
    
    
  
}

function editar(id){
    
    id = cont;
    
    if(id == 1){ 
    
        document.getElementById("checkList").readOnly  = false;
        document.getElementById("descricao").readOnly  = false;
        document.getElementById("grupo").readOnly      = false;
        document.getElementById("subGrupo").readOnly   = false;
    
    }
    else{   
    
        document.getElementById("checkList").readOnly  = false;
        document.getElementById("descricao").readOnly  = false;
        document.getElementById("grupo").readOnly      = false;
        document.getElementById("subGrupo").readOnly   = false;
        
    
        for(var i = 1; i <= id; i++){
            
            var idIdCheckListDesc = i;
            var idDescricao       = i + '_' + i;
            var idGrupo           = i + '_' + i + '_' + i;
            var idSubGrupo        = i + '_' + i + '_' + i + '_' + i;
            
            
            document.getElementById(idIdCheckListDesc).readOnly = false;
            document.getElementById(idDescricao).readOnly = false;
            document.getElementById(idGrupo).readOnly = false;
            document.getElementById(idSubGrupo).readOnly = false;
            
            
//                
                 
                
                
                
            
            
            
        }
        
    }
}

function buscaPrimeiroRegistro(){

    document.getElementById("idCheckList").readOnly      = true;
    document.getElementById("checkList").readOnly       = true;
    document.getElementById("descricao").readOnly       = true;
    document.getElementById("grupo").readOnly           = true;
    document.getElementById("subGrupo").readOnly        = true;
    document.getElementById('tabelaPreco2').innerHTML   = "";
    
     
    $.ajax({
        url: 'index.php?m=cadastrochecklist&c=cadastrochecklistcontroller&f=buscaPrimeiroRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
          
            document.getElementById("idCheckList").value = r[0];
            document.getElementById("checkList").value = r[1];
            var total = r[2];
            cont = total;
            
            addLinhas(total);

            
            
            
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroAnterior(){
    
    var idCheckList  =  $('#idCheckList').val();      
    
    document.getElementById("idCheckList").readOnly      = true;
    document.getElementById("checkList").readOnly       = true;
    document.getElementById("descricao").readOnly       = true;
    document.getElementById("grupo").readOnly           = true;
    document.getElementById("subGrupo").readOnly        = true;
    document.getElementById('tabelaPreco2').innerHTML   = "";
    
    
    $.ajax({
        url: 'index.php?m=cadastrochecklist&c=cadastrochecklistcontroller&f&f=buscaRegistroAnterior',
        data: {
            idCheckList: idCheckList
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                
                document.getElementById("idCheckList").value = r[0];
                document.getElementById("checkList").value = r[1];
                var total = r[2];
                cont = total;

                addLinhas(total);

            
            }
            
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroProximo(){
    
    var idCheckList  =  $('#idCheckList').val();      
    
    document.getElementById("idCheckList").readOnly      = true;
    document.getElementById("checkList").readOnly       = true;
    document.getElementById("descricao").readOnly       = true;
    document.getElementById("grupo").readOnly           = true;
    document.getElementById("subGrupo").readOnly        = true;
    document.getElementById('tabelaPreco2').innerHTML   = "";
    
    
    $.ajax({
        url: 'index.php?m=cadastrochecklist&c=cadastrochecklistcontroller&f&f=buscaRegistroProximo',
        data: {
            idCheckList: idCheckList
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                
                document.getElementById("idCheckList").value = r[0];
                document.getElementById("checkList").value = r[1];
                var total = r[2];
                cont = total;

                addLinhas(total);

            
            }
            
        },
        error: function(e) {

        }
    }); 
 
    
}


function buscaUltimoRegistro(){
    
    document.getElementById("idCheckList").readOnly     = true;
    document.getElementById("checkList").readOnly       = true;
    document.getElementById("descricao").readOnly       = true;
    document.getElementById("grupo").readOnly           = true;
    document.getElementById("subGrupo").readOnly        = true;
    document.getElementById('tabelaPreco2').innerHTML   = "";
    
     
    
    $.ajax({
        url: 'index.php?m=cadastrochecklist&c=cadastrochecklistcontroller&f=buscaUltimoRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            
            
           
            document.getElementById("idCheckList").value = r[0];
            document.getElementById("checkList").value = r[1];
            var total = r[2];
            cont = total;
            
            addLinhas(total);

            
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
    document.getElementById('tabelaPreco2').innerHTML   = "";
    document.getElementById("checkList").disabled  = true;
    
    
    // Pesquisa Para alimentar campos
    
    $.ajax({
        url: 'index.php?m=cadastrochecklist&c=cadastrochecklistcontroller&f=pesquisaSimples',
        data: {
            idInicial: idInicial,
            nomeInicial: nomeInicial
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             
            document.getElementById("idCheckList").value = r[0];
            document.getElementById("checkList").value = r[1];
            var total = r[2];
            totalEditar = total;
            addLinhas(total);
            $('#pesquisarModal').modal('hide');     
            
                     
        },
        error: function(e) {

        }
    }); 
            
    
}
  
   
function atualizar(){
           
    document.getElementById("idCheckList").value      = "";
    document.getElementById("checkList").value        = "";
    document.getElementById("idCheckListDesc").value  = "";
    document.getElementById("descricao").value        = "";
    document.getElementById("grupo").value            = "";
    document.getElementById("subGrupo").value         = "";
    document.getElementById('tabelaPreco2').innerHTML = "";
    
    
    document.getElementById("idCheckList").readOnly      = true;
    document.getElementById("checkList").readOnly        = true;
    document.getElementById("idCheckListDesc").readOnly  = true;
    document.getElementById("descricao").readOnly        = true;
    document.getElementById("grupo").readOnly            = true;
    document.getElementById("subGrupo").readOnly         = true;
    
    
            
    
}

function plusTabelaPrecos(){
  
    cont = parseInt(cont) + parseInt(1);
    var idCheckList      =   $('#idCheckList').val();
    
   
    
    $.ajax({
        url: 'index.php?m=cadastrochecklist&c=cadastrochecklistcontroller&f=plusTabelaPreco',
        data: {
            cont: cont,
            idCheckList: idCheckList
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(html) {
                
                              
            $("#tabelaPreco2").append(html);
            
            
            
               
         

        },
        error: function() {
            desbloqueiaTela();
        }
    });


}

function removerTr(xthis, idCheckListDesc) {
   
    
    $(xthis).parents('tr').remove();
    $(xthis).parents('tr').remove();
    $(xthis).parents('tr').remove();
    //excluirDescricao(cont);
    
     var idCheckList      =   $('#idCheckList').val();
    
    
   
    $.ajax({
        url: 'index.php?m=cadastrochecklist&c=cadastrochecklistcontroller&f=excluirItem',
        data: {
            idCheckList: idCheckList,
            idCheckListDesc: idCheckListDesc
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {

            if (r == true || r == 1) {
               
                mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                
                
                
            }
            else {
                mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                
                
            }
        },
        error: function(e) {
            mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
            

        }
    }); 
 }
 
 

 
 function carregarCodItem(){

           
    $.ajax({
        url: 'index.php?m=descricaotabelapreco&c=descricaotabelaprecocontroller&f=carregarCodItem',
        data: {
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('codProduto').innerHTML = data;
               
               
            } else {
                alert('Erro ao carregar a lista de Cod Produto')
            }

        },
        error: function() {
            desbloqueiaTela();
        }
    });
 }
 
 
function carregarCodItemId(id){
   
           
    var idCodProduto =  id;
      
    var  codProduto   =  document.getElementById(idCodProduto).value; 
    

    $.ajax({
        url: 'index.php?m=descricaotabelapreco&c=descricaotabelaprecocontroller&f=carregarCodItem',
       data: {
            
            codProduto: codProduto
          
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(data) {
                
            if (data != false) {
                document.getElementById(idCodProduto).innerHTML = data;
                
       
               
            } else {
                alert('Erro ao carregar a lista de Cod Produto');
            }

        },
        error: function() {
            desbloqueiaTela();
        }
    }); 
 } 


function carregarItem(){
    
    var codProduto                 =   $('#codProduto').val(); 
           
    $.ajax({
        url: 'index.php?m=descricaotabelapreco&c=descricaotabelaprecocontroller&f=carregarItem',
        data: {
            codProduto: codProduto
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(r) {
                 document.getElementById("produto").value = r[0];
                document.getElementById("undMedida").value = r[1];
          
            
               
            
        },
        error: function() {
            desbloqueiaTela();
        }
    });
 }  
function carregarItemId(id){
      
      
        var idCodProduto =  id ;
        var idProduto    =  id + '_' + id;
        var idUndMedida  =  id + '_' + id + '_' + id;
         
               
        var codProduto =   document.getElementById(idCodProduto).value; 
   
           
    $.ajax({
        url: 'index.php?m=descricaotabelapreco&c=descricaotabelaprecocontroller&f=carregarItem',
        data: {
           codProduto: codProduto
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(r) {
                document.getElementById(idProduto).value = r[0];
                document.getElementById(idUndMedida).value = r[1];
                
               
            
        },
        error: function() {
            alert('Erro ao carregar a lista');
        }
    });
 }  
 
 function addLinhas(total){
           
     var  idCheckList   =   $('#idCheckList').val();            
        
    $.ajax({
        url: 'index.php?m=cadastrochecklist&c=cadastrochecklistcontroller&f=plusParcelaBusca',
        data: {
            total: total,
            idCheckList: idCheckList

        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(html) {
            
            $("#tabelaPreco2").append(html);
            
            addParcela1();
            //carregarCombo(total);
         

        },
        error: function() {

        }
    });
    
    
}

function addParcela1(){
    
    var  idCheckList   =   $('#idCheckList').val(); 

            
       
        $.ajax({
            url: 'index.php?m=cadastrochecklist&c=cadastrochecklistcontroller&f=addParcela1',
            data: {
                idCheckList: idCheckList

            },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(r) {
                document.getElementById('idCheckListDesc').value     = r[0];
                document.getElementById('descricao').value        = r[1];
                document.getElementById('grupo').value      = r[2];
                document.getElementById('subGrupo').value    = r[3];
               
               
                
            },
            error: function() {

            }
        }); 
    
}


function carregarCombo(total){
   
    var i = 1;
    
    for(i = 1; i < total; i++ ){
        
        carregarCodItemId(i);
       
    }
    
}

function carregarValorCombo(total){
    
       
    var idPreco = $('#idPreco').val();
    
    var idCodProduto =  i;
  
   
    $.ajax({
            url: 'index.php?m=descricaotabelapreco&c=descricaotabelaprecocontroller&f=carregarValorCombo',
            data: {
                idPreco: idPreco
                

            },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(r) {
                for(var i = 1; i < total; i++){
                    
                }
                
                alert(r);
                document.getElementById(idCodProduto).value      = r[0];
                 
             
            },
            error: function() {

            }
        });
}

function numeroParaMoeda(n, c, d, t){
    c = isNaN(c = Math.abs(c)) ? 4 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}



/* Máscaras ER */
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
	
    v=v.replace(/(\d)(\d{2})$/,"$1,$2");//coloca a virgula antes dos 2 últimos dígitos
    return v;
}






 
 