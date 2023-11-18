<?php
// --
class M_Kardex extends Model
{
  // --
  public function __construct()
  {
    parent::__construct();
  }

  // --
  public function get_kardex()
  {
    // --
    try {
      // --
      $sql = 'SELECT * FROM kardex';
      // --
      $result = $this->pdo->fetchAll($sql);
      // --
      if ($result) {
        // --
        $response = array('status' => 'OK', 'result' => $result);
      } else {
        // --
        $response = array('status' => 'ERROR', 'result' => array());
      }
    } catch (PDOException $e) {
      // --
      $response = array('status' => 'EXCEPTION', 'result' => $e);
    }
    // --
    return $response;
  }
}
