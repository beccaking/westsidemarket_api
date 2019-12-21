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
    $dbconn = pg_connect("host=localhost dbname=market");
}

class Vendor {
  public $id;
  public $name;
  public $image;
  public $description;

  public function __construct($id, $name, $image, $description){
    $this->id = $id;
    $this->name = $name;
    $this->image = $image;
    $this->description = $description;
  }
}

class Market {
  static function all(){
    $vendors = array();

    $results = pg_query("SELECT * FROM vendors");

    $row_object = pg_fetch_object($results);
    while($row_object){
      $vendor = new Vendor(
        $row_object->id,
        $row_object->name,
        $row_object->image,
        $row_object->description
      );
      $vendors[] = $vendor;
      $row_object = pg_fetch_object($results);
    }
    return $vendors;
  }
}
?>
