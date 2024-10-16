
<h1>Concepción</h1>
<h2>Estación meteorológica Carriel Sur</h2>
<?php 
$url = 'https://climatologia.meteochile.gob.cl/application/diario/informeClimatologicoDiario/360019/2024/10/16';
$ch = curl_init();
$options = array(
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_SSL_VERIFYHOST => 2,
    CURLOPT_SSL_VERIFYPEER => true,
    CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0',
    CURLOPT_URL => $url
);
curl_setopt_array($ch, $options);
$output = curl_exec($ch);

if (curl_errno($ch)) {
    echo "cURL error: " . curl_error($ch);
} else {
    // Verificar el código HTTP de la respuesta
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($httpcode == 200) {
        $dom = new DOMDocument();
        $dom->loadHTML($output);
        $table = $dom->getElementById('excel');
        if($table){
            echo $dom->saveHTML($table);
        } else {
            // Imprimir la respuesta HTML
            echo $output;  // Renderiza el HTML directamente
        }

    } else {
        echo "HTTP error: " . $httpcode;
    }
}


curl_close($ch);
?>