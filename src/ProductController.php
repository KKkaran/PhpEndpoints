<?php

class ProductController{
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

    }
    private function processCollectionRequest(string $method):void{
        switch($method){
            case "GET":
                echo json_encode(["id"=>123]);
                break;
    
        }        
    }
}