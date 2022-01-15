<?php
namespace App\Http\Services;

//use GuzzleHttp\Client;
//use http\Client;
//use phpDocumentor\Reflection\Types\This;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class FatoorahServices
{

    private $base_url;
    private $headers;
    private $request_client;

    public function __construct(Client $request_client)
    {
        $this->request_client=$request_client;
        $this->base_url=env('fatoorah_base_url');
        $this->headers=[
            'Content-Type' => 'application/json',
            'authorization' => 'Bearer' . env('authorization')
        ];
    }


    public function buildRequest($method,$uri,$data=[]){

        $request=new Request($method,$this->base_url . $uri ,$this->headers) ;

        if (! $data)
            return false ;

        $response=$this->request_client->send($request,[
            'json' => $data
        ]);

        if ($response->getStatusCode() !=200){
            return false;
        }

        $response=json_decode($response->getBody(),true);
        return $response;
    }


    public function sendPayment($data){

        return $response=$this->buildRequest('v2/SendPayment','POST',$data);
    }

}
?>

