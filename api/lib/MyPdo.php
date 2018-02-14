<?php


class MyPdo
{

    private static $connection = null;

    /**
     *
     * @return PDO
     */
    public static function connect()
    {
        if (!self::$connection) {
            try{
                self::$connection = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME . ';charset=utf8', USER, PASSWORD);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(\Exception $e){
                throw new \Exception('Falha no banco de dados, verifique arquivo "bd.php"');
            }
            
        }
        return self::$connection;
    }

}