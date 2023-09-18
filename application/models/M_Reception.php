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
      $sql = 'SELECT room.room_number,room.room_status, room_type.type_name,room_type.person_limit ,room_type.price_temporary,bed_type.bed_name
      FROM room
      JOIN room_type ON room.id_type = room_type.id_type
      JOIN bed_type ON room_type.id_bed = bed_type.id_bed ORDER BY room.room_number';
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
