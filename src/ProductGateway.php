<?php
//this file will be fetching records from the db
class ProductGateway{

    private PDO $conn;
    public function __construct(Database $database){
        $this->conn = $database->getConnection();
    }
    public function getAll():array{
        $sql = "SELECT * 
                FROM product";
        $stmt = $this->conn->query($sql);
        $data = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
        return $data;
    }
    public function getProductBySize(string $size):array{
        $sql = "SELECT * 
                FROM product 
                WHERE size > $size";
        $stmt = $this->conn->query($sql);
        $data = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $row["is_available"] = (bool) $row["is_available"];
            $data[] = $row;
        }
        return $data;
    }
    public function create(array $data):string{

        $sql = "INSERT INTO product(name, size, is_available) VALUES (:name, :size,:is_available)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":name",$data["name"], PDO::PARAM_STR);
        $stmt->bindValue(":size",$data["size"] ?? 0, PDO::PARAM_INT);
        $stmt->bindValue(":is_available", (bool)$data["is_available"] ?? false, PDO::PARAM_BOOL);
        
        $stmt->execute();
        return $this->conn->lastInsertId();
    }
}