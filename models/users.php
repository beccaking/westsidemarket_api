<?php
$dbconn = null;
if(getenv('DATABASE_URL')){
    $connectionConfig = parse_url(getenv('DATABASE_URL'));
    $host = $connectionConfig['host'];
    $user = $connectionConfig['user'];
    $password = $connectionConfig['pass'];
    $port = $connectionConfig['port'];
    $dbname = trim($connectionConfig['path'],'/');
    $dbconn = pg_connect(
        "host=".$host." ".
        "user=".$user." ".
        "password=".$password." ".
        "port=".$port." ".
        "dbname=".$dbname
    );
} else {
    $dbconn = pg_connect("host=localhost dbname=users");
}

class User {
  public $id;
  public $username;
  public $password;

  public function __construct($id, $username, $password){
    $this->id = $id;
    $this->username = $username;
    $this->password = $password;
  }
}

class Users {
  static function all(){
    $users = array();

    $results = pg_query("SELECT * FROM users");

    $row_object = pg_fetch_object($results);
    while($row_object){
      $new_user = new User (
        intval($row_object->id),
        $row_object->username,
        $row_object->password
      );
    }
    return $users;
  }
  static function create($username, $password){
    $query = "INSERT INTO users (username, password) VALUES ($1, $2)";
    $query_params = array($username, $password);
    pg_query_params($query, $query_params);
    return self::all();
  }
}
?>
