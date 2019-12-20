<?php
$dbconn = pg_connect("host=localhost dbname=westsidemarket")

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
