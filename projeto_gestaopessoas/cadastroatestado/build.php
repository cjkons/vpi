<?php 

$appName = "cadastroatestado";// nome da pasta do projeto 
$appPath = "C:\\server\\projetos_vpi\\projeto_gestaopessoas"; // caminho onde esta o projeto no pc
$wwwPath = "C:\\server\\htdocs\\gestaopessoas"; // caminho onde salva o projeto no servidor
$fwkDir = "fwk"; 

if(!is_dir($wwwPath . "\\" . $fwkDir . "\\application\\" . $appName)){
    mkdir($wwwPath . "\\" . $fwkDir . "\\application\\" . $appName);
}
 
try { 

    echo "Copiando pasta cache...\n\n";

    $src = $appPath . "\\" . $appName . "\\cache";
    $dst = $wwwPath . "\\" . $fwkDir . "\\application\\" . $appName . "\\cache";

    rcopy($src, $dst);
} catch (Exception $err) {

    echo "Ocorreu o seguinte erro:" . $err->getMessage();

    exit;
}

try {

    echo "Copiando pasta config...\n\n";

    $src = $appPath . "\\" . $appName . "\\config";
    $dst = $wwwPath . "\\" . $fwkDir . "\\application\\" . $appName . "\\config";

    rcopy($src, $dst);
} catch (Exception $err) {

    echo "Ocorreu o seguinte erro:" . $err->getMessage();

    exit;
}

try {

    echo "Copiando pasta controllers...\n\n";

    $src = $appPath . "\\" . $appName . "\\controllers";
    $dst = $wwwPath . "\\" . $fwkDir . "\\application\\" . $appName . "\\controllers";

    rcopy($src, $dst);
} catch (Exception $err) {

    echo "Ocorreu o seguinte erro:" . $err->getMessage();

    exit;
}

try {

    echo "Copiando pasta core...\n\n";

    $src = $appPath . "\\" . $appName . "\\core";
    $dst = $wwwPath . "\\" . $fwkDir . "\\application\\" . $appName . "\\core";

    rcopy($src, $dst);
} catch (Exception $err) {

    echo "Ocorreu o seguinte erro:" . $err->getMessage();

    exit;
}

try {

    echo "Copiando pasta errors...\n\n";

    $src = $appPath . "\\" . $appName . "\\errors";
    $dst = $wwwPath . "\\" . $fwkDir . "\\application\\" . $appName . "\\errors";

    rcopy($src, $dst);
} catch (Exception $err) {

    echo "Ocorreu o seguinte erro:" . $err->getMessage();

    exit;
}

try {

    echo "Copiando pasta helpers...\n\n";

    $src = $appPath . "\\" . $appName . "\\helpers";
    $dst = $wwwPath . "\\" . $fwkDir . "\\application\\" . $appName . "\\helpers";

    rcopy($src, $dst);
} catch (Exception $err) {

    echo "Ocorreu o seguinte erro:" . $err->getMessage();

    exit;
}

try {

    echo "Copiando pasta hooks...\n\n";

    $src = $appPath . "\\" . $appName . "\\hooks";
    $dst = $wwwPath . "\\" . $fwkDir . "\\application\\" . $appName . "\\hooks";

    rcopy($src, $dst);
} catch (Exception $err) {

    echo "Ocorreu o seguinte erro:" . $err->getMessage();

    exit;
}

try {

    echo "Copiando pasta libraries...\n\n";

    $src = $appPath . "\\" . $appName . "\\libraries";
    $dst = $wwwPath . "\\" . $fwkDir . "\\application\\" . $appName . "\\libraries";

    rcopy($src, $dst);
} catch (Exception $err) {

    echo "Ocorreu o seguinte erro:" . $err->getMessage();

    exit;
}

try {

    echo "Copiando pasta logs...\n\n";

    $src = $appPath . "\\" . $appName . "\\logs";
    $dst = $wwwPath . "\\" . $fwkDir . "\\application\\" . $appName . "\\logs";

    rcopy($src, $dst);
} catch (Exception $err) {

    echo "Ocorreu o seguinte erro:" . $err->getMessage();

    exit;
}

try {

    echo "Copiando pasta models...\n\n";

    $src = $appPath . "\\" . $appName . "\\models";
    $dst = $wwwPath . "\\" . $fwkDir . "\\application\\" . $appName . "\\models";

    rcopy($src, $dst);
} catch (Exception $err) {

    echo "Ocorreu o seguinte erro:" . $err->getMessage();

    exit;
}

try {

    echo "Copiando pasta third_party...\n\n";

    $src = $appPath . "\\" . $appName . "\\third_party";
    $dst = $wwwPath . "\\" . $fwkDir . "\\application\\" . $appName . "\\third_party";

    rcopy($src, $dst);
} catch (Exception $err) {

    echo "Ocorreu o seguinte erro:" . $err->getMessage();

    exit;
}

try {

    echo "Copiando pasta views...\n\n";

    $src = $appPath . "\\" . $appName . "\\views";
    $dst = $wwwPath . "\\" . $fwkDir . "\\application\\" . $appName . "\\views";

    rcopy($src, $dst);
} catch (Exception $err) {

    echo "Ocorreu o seguinte erro:" . $err->getMessage();

    exit;
}

try {

    echo "Copiando pasta resources...\n\n";

    $src = $appPath . "\\" . $appName . "\\resources";
    $dst = $wwwPath . "\\" . $fwkDir . "\\resources\\" . $appName;

    rcopy($src, $dst);
} catch (Exception $err) {

    echo "Ocorreu o seguinte erro:" . $err->getMessage();

    exit;
}

try {

    echo "Copiando pasta language...\n\n";

    $src = $appPath . "\\" . $appName . "\\language\\" . $appName;
    $dst = $wwwPath . "\\" . $fwkDir . "\\system\\language\\pt-BR\\" . $appName;

    rcopy($src, $dst);
} catch (Exception $err) {

    echo "Ocorreu o seguinte erro:" . $err->getMessage();

    exit;
}

echo "Projeto " . $appName . " implantado com sucesso!!!";

function rcopy($src, $dst) {

    if (file_exists($dst)) {

        rrmdir($dst);
    }

    if (is_dir($src)) {

        mkdir($dst);

        $files = scandir($src);

        foreach ($files as $file) {

            if ($file != "." && $file != ".." && $file != ".svn") {

                rcopy("$src/$file", "$dst/$file");
            }
        }
    } else if (file_exists($src)) {

        copy($src, $dst);
    }
}

function rrmdir($dir) {

    if (is_dir($dir)) {

        $files = scandir($dir);

        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                rrmdir("$dir/$file");
            }
        }

        rmdir($dir);
    } else if (file_exists($dir)) {

        unlink($dir);
    }
}