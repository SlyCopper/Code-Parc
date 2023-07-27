<?php
    class Database
    {
        private static $user = 'root';
        private static $host = 'localhost';
        private static $db = 'profisc';
        private static $connexion = NULL;
        public static function connect(){
            try
            {
                self::$connexion = new PDO('mysql:host=localhost; dbname=parc','root','');
                return self::$connexion;
            }
            catch(Exception $e)
            {
                die('Erreur : ' . $e->getMessage());
            }
        }
        public static function deconnect(){
            return self::$connexion = NULL;
        }
    }
?>