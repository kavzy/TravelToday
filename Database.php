<?php

    class Database
    {
        private $servername = "localhost";
        private $username = "root";
        private $password = "";
        private $database = "traveltoday";

         public function __construct()
         {
            // session_start();
         }

        public function db()
        {
            $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

            if($conn->connect_errno)
            {
                die("Failed".$conn->connect_errno);
            }

            return $conn;
        }
    }

?>