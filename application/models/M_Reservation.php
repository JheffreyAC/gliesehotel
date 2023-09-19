<?php 
// --
class M_Reservation extends Model {
    // --
    public function __construct() {
		parent::__construct();
    }

    public function get_reservation() {
      // --
      try {
          // --
          $sql = 'SELECT 
                  id_reservation,
                  checkin_date,
                  checkout_date,
                  id_room,
                  id_guest,
              FROM reservation';
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

  // --
  public function get_reservation($bind) {
      // --
      try {
          // --
          $sql = 'SELECT 
                  id_reservation,
                  checkin_date,
                  checkout_date,
                  id_room,
                  id_guest,
                FROM reservation WHERE id_reservation = :id_reservation';
          // --
          $result = $this->pdo->fetchOne($sql, $bind);
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