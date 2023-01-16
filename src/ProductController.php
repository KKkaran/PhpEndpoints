<?php

class ProductController{
    public function __construct(private ProductGateway $gateway){

    }
                                                    //nullable
    public function processRequest(string $method, ?string $id): void{
        //var_dump($method. "   " . $id);
        if($id){
            $this -> processResourceRequest($method,$id);
        }else{
            $this -> processCollectionRequest($method);
        }
    }
    private function processResourceRequest(string $method, string $id):void{
        echo json_encode($this->gateway->getProductBySize($id));
    }
    private function processCollectionRequest(string $method):void{
        switch($method){
            case "GET":
                echo json_encode($this->gateway->getAll());
                break;
            case "POST":
                echo json_encode(["id"=>'not specified',"method"=>$method]);
                break;
    
        }        
    }
}