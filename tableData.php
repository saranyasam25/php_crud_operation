<table class="table" id="usertable">
    <thead class="table-data">
        <tr>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Operations</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>














































<?php
    // include 'connect.php';

    // class User extends Database{
    //     protected $tableName="usertable";

    //     // function to add get rows
    //     public function add($data){
    //         if(!empty($data)){
    //             $fileds = $placeholder = [];
    //             foreach ($data as $field => $value) {
    //                 $fileds[]=$field;
    //                 $placeholder[]=":{$field}";
    //             }
    //         }
    //         //$sql="INSERT INTO {$this->tablename} (name,email,phone) VALUES (":name,:email,:phone);"
    //         $sql="INSERT INTO {$this->tableName} (". implode(',',$fileds).") VALUES (" . implode(',',$placeholder).")";

    //         $stmt=$this->conn->prepare($sql);

    //         try{
    //             $this->conn->beginTransaction();
    //             $stmt->execute($data);
    //             $lastInsertedId= $this->conn->lastInsertId();
    //             $this->conn->commit();
    //             return $lastInsertedId;

    //         }catch(PDOException $e){
    //             echo "Error:" .$e->getMessage();
    //             $this->conn->rollback();
    //         }

    //     }

    //     // function to get rows


    //     function getRows($start = 0,$limit = 4){
    //         $sql="SELECT * FROM {$this->tableName} ORDER BY id DESC LIMIT {$start},{$limit}"; 
    //         $stmt=$this->conn->prepare($sql);
    //         $stmt->execute();
    //         if($stmt->rowCount() > 0){
    //             $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
    //         }else {
    //            $results=[];
    //         }
    //         return $results;
    //     }

    //     // function to get single row

    //      function getRow($field,$value){
    //         $sql="SELECT * FROM {$this->tableName} WHERE {$field}=:{$field}";
    //         $stmt=$this->conn->prepare($sql);
    //         $stmt->execute([":{$field}" => $value]);
    //         if($stmt->rowCount() > 0){
    //             $result=$stmt->fetch(PDO::FETCH_ASSOC);
                
    //         }else {
    //            $result=[];
    //         }
    //         return $result;
    //      } 

    //     //   FUNCTION TO COUNT NUMBER OF ROWS

    //      public function getCount(){
    //         $sql="SELECT  COUNT(*) as pcount FROM {$this->tableName}";
    //         $stmt=$this->conn->prepare($sql);
    //         $stmt->execute();
    //         $result=$stmt->fetch(PDO::FETCH_ASSOC);
    //         return $result['pcount'];
    //      }

    //     //  function to uploadphoto
    //     function uploadPhoto($file){

    //         if(!empty($file)){
    //             $fileTemPath=$file['tmp_name'];
    //             $fileName=$file['name'];
    //             $fileSize = $file['size'];
    //             $fileType = $file['type'];
    //             $fileNameCmps = explode('.',$fileName);
    //             $fileExtension = strtolower(end($fileNameCmps));
    //             $newFileName = md5(time().$fileName). '.' .$fileExtension;
    //             $allowedExtn = ["png","jpg","jpeg"];

    //             if(in_array($fileExtension,$allowedExtn)){
    //                 $uploadFileDir=getcwd().'/uploads/';
    //                 $destFilePath=$uploadFileDir . $newFileName;

    //                 if(move_uploaded_file($fileTemPath,$destFilePath)){
    //                     return $newFileName;
    //                 }
    //             }
    //         }
    //     }



    //     // function to update 

    //     // function update($data,$id){
    //     //     $fields="";
    //     //     $x=1;
    //     //     $fieldsCount=count($data);
    //     //     foreach ($data as $field => $value) {
    //     //         # code...
    //     //         $field.="{$field}=:{$field}";
    //     //         if($x<$fieldsCount){
    //     //             $fields.=",";

    //     //         }
    //     //         $x++;
    //     //     }
    //     // }
    //     // $sql="UPDATE {$this->tableName} SET {$fields} WHERE id =:id";
    //     // $stmt =$t
        
    // }
?>
