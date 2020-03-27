<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
//require 'vendor/autoload.php';//my add
$app = new \Slim\App;

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

// TCMB guncel kuru getir...
$app->get('/kurgetir', function (Request $request, Response $response) {

    try{
        
        //$kurXML = @simplexml_load_file("https:a//www.tcmb.gov.tr/kurlar/today.xml") or die("Hata: XML dosyası yüklenemedi.");
        $kurXML = @new SimpleXMLElement('https://www.tcmb.gov.tr/kurlar/today.xml', null, true);
        //print_r($kurXML);

        $arrayKur = array(); $index = 0;

        foreach ($kurXML->Currency as $Currency) {
            $newKur = array( 
                'Isim'=> strval($Currency->Isim), 
                'CurrencyName'=> strval($Currency->CurrencyName), 
                'ForexBuying'=> strval($Currency->ForexBuying),
                'ForexSelling'=> strval($Currency->ForexSelling),
                'BanknoteBuying'=> strval($Currency->BanknoteBuying),
                'BanknoteSelling'=> strval($Currency->BanknoteSelling),
                'CrossRateUSD'=> strval($Currency->CrossRateUSD),
                'CrossRateOther'=> strval($Currency->CrossRateOther)       
            );
            $arrayKur[$index] = $newKur;
            //array_push($arrayKur, $newKur);
            $index++;
        }

        $data;
        if (!empty($arrayKur) && $arrayKur != null) {
            $json["TCMB_AnlikKurBilgileri"] = $arrayKur;
            //echo json_encode($json);
            $data = $json;
        }
		
	
        return $response
            ->withStatus(200)
            ->withHeader("Content-Type", 'application/json')
            ->withJson($data, null, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);

    }catch(Exception  $e){
        return $response->withJson(
            array(
                "error" => array(
                    "text"  => $e->getMessage(),
                    "code"  => $e->getCode()
                )
            ), null, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK
        );
    }
});

?>
