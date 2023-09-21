<?php
// --
class M_Reception extends Model
{
  // --
  public function __construct()
  {
    parent::__construct();
  }
  public function get_rooms()
  {
    try {
      $sql = 'SELECT room.room_number, room.room_status, room_type.bed_type, room_type.type_name, room_type.person_limit, room_type.price_temporary, room_type.price_half, room_type.price_day
      FROM room 
      JOIN room_type ON room.id_type = room_type.id_type ORDER BY 1';
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
}
