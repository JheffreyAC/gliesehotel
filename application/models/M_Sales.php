<?php
// --
class M_Sales extends Model
{
  // --
  public function __construct()
  {
    parent::__construct();
  }

  public function get_reservation_by_id()
  {
    // --
    try {
      // --
      $sql = 'SELECT 
      r.*,
      room.room_number,
      room.id_type,
      room_type.type_name,
      guest.document_type,
      guest.document_number,
      guest.first_names,
      guest.last_names,
      guest.address,
      guest.company_name
      FROM reservation AS r
      JOIN room ON r.id_room = room.id_room
      JOIN guest ON r.id_guest = guest.id_guest
      JOIN room_type ON room.id_type = room_type.id_type
      r.id_reservation = :id_reservation';

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
