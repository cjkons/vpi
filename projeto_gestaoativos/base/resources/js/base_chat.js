var Server;

function log(text) {

    console.log(text);
}

//function send(text) {
//    Server.send('message', _idUsuarioLogado + '|' + text);
//}

function send(texto, de, para) {

    var a = new Array(de, para, texto);

    Server.send('Enviando mensagem', a);
}
