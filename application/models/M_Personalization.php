<?php
// --
class M_Personalization extends Model
{
  // --
  public function __construct()
  {
    parent::__construct();
  }
  public function get_company_profile()
  {
    try {
      $sql = 'SELECT * FROM company_profile';
      $result = $this->pdo->fetchAll($sql);

      if ($result) {
        $response = array('status' => 'OK', 'result' => $result);
      } else {
        $response = array('status' => 'ERROR', 'result' => array());
      }
    } catch (PDOException $e) {
      $response = array('status' => 'EXCEPTION', 'result' => $e);
    }
    return $response;
  }
  public function create_company_profile($bind)
  {
    // --
    try {
      // --
      $sql = 'INSERT INTO company_profile(company_name,ruc,address,logo) VALUES(:company_name,:ruc,:address,null)';
      // --
      $result = $this->pdo->perform($sql, $bind);

      // --
      if ($result) {
        // --
        $response = array('status' => 'OK', 'result' => array());
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
