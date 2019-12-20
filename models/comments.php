<?php
$dbconn = pg_connect("host=localhost dbname=westsidemarket")

class Comment {
  public $id;
  public $vendorid;
  public $text;
  public $username;
  public $datetime;

  public function __construct($id, $vendorid, $content, $username, $commentdate){
    $this->id = $id;
    $this->vendorid = $vendorid;
    $this->content = $content;
    $this->username = $username;
    $this->commentdate = $commentdate;
  }
}

class Comments {
  static function all(){
    $comments = array();

    $results = pg_query("SELECT * FROM comments");

    $row_object = pg_fetch_object($results);
    while($row_object){
      $new_comment = new Comment(
        intval($row_object->id),
        $row_object->vendorid,
        $row_object->content,
        $row_object->username,
        $row_object->commentdate
      );
      $comments[] = $new_comment;
      $row_object = pg_fetch_object($results);
    }
    return $comments;
  }

  static function create($username, $vendorid, $comment){
    $query = "INSERT INTO comments (username, vendorid, content, commentdate) VALUES $1, $2, $3, CURRENT_TIMESTAMP)";
    $query_params = array($username, $vendorid, $comment);
    $result = pg_query_params($query, $query_params);
    return self::all();
  }
}
?>
