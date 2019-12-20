<?php
$dbconn = pg_connect("host=localhost dbname=westsidemarket");

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
