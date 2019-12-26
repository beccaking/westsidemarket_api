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
    $dbconn = pg_connect("host=localhost dbname=comments");
}

class Comment {
  public $id;
  public $vendorid;
  public $content;
  public $username;
  public $commentdate;

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

  static function create($comment){
    $query = "INSERT INTO comments (username, vendorid, content, commentdate) VALUES ($1, $2, $3, CONVERT(date, CURRENT_TIMESTAMP))";
    $query_params = array($comment->username, $comment->vendorid, $comment->content);
    $result = pg_query_params($query, $query_params);
    return self::all();
  }

  static function update($updated_comment){
    $query = "UPDATE comments SET username = $1, vendorid = $2, content = $3, commentdate = CURRENT_TIMESTAMP WHERE id=$4";
    $query_params = array($updated_comment->username, $updated_comment->vendorid, $updated_comment->content, $updated_comment->id);
    $result = pg_query_params($query, $query_params);
    return self::all();
  }

  static function delete($id){
    $query = "DELETE FROM comments WHERE id = $1";
    $query_params = array($id);
    $result = pg_query_params($query, $query_params);
    return self::all();
  }
}
?>
