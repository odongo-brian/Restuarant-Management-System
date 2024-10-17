<?php
    require "../config/config.php";

?>

<?php
    class App{
        public $host = HOST;
        public $dbname = DBNAME;
        public $user = USER;
        public $pass = PASSWORD;

        public $link;

        //create a constructor
        public function __construct(){

            $this->connect();
           // $this->host;
        }

        public function connect(){
            $this->link = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname."", $this->user, $this->pass);

            if($this->link){
                echo "db connection is working";
            }
        }

        //select all
        public function selectAll($query){
            $rows = $this->link->query($query);
            $rows->execute();

            $allRows = $rows->fetchAll(PDO::FETCH_OBJ);

            if($allRows){
                return $allRows;
            }
            else{
                return false;
            }
        }

        //select one row
        public function selectOne($query){
            $row = $this->link->query($query);
            $rows->execute();

            $singleRow = $row->fetch(PDO::FETCH_OBJ);

            if($singleRow){
                return $singleRow;
            }
            else{
                return false;
            }
        }


        //insert query
        public function insert($query, $arr, $path){

            if($this->validate($arr) == "empty"){
                echo "<script>alert('one or more inputs are empty')</script>";
            }
            else{
                $insert_record = $this->link->prepare($query);
                $insert_record->execute($arr);

                header("location: ".$path."");
            }
        }

        //update query
        public function update($query, $arr, $path){

            if($this->validate($arr) == "empty"){
                echo "<script>alert('one or more inputs are empty')</script>";
            }
            else{
                $update_record = $this->link->prepare($query);
                $update_record->execute($arr);

                header("location: ".$path."");
            }
        }

        //delete query
        public function delete($query, $path){

                $delete_record = $this->link->query($query);
                $delete_record->execute();

                header("location: ".$path."");
            
        }

        public function validate($arr){

            if(in_array("", $arr)){
                echo "empty"; //array empty
            }
        }




    }


    $obj = new App();

?>