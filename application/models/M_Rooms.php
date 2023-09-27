<?php
// --
class M_Rooms extends Model
{
  // --
  public function __construct()
  {
    parent::__construct();
  }
  public function get_rooms()
  {
    try {
      $sql = 'SELECT room.id_room, room.room_number, room.room_status, room_type.bed_type, room_type.type_name, room_type.person_limit, room_type.price_temporary, room_type.price_half, room_type.price_day
      FROM room
      JOIN room_type ON room.id_type = room_type.id_type';
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


  public function create_rooms($bind)
  {
    // --
    try {
      // --
      $sql = 'INSERT INTO room(room_number,room_status,id_type) VALUES(:room_number,:room_status,:id_type)';
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
  public function get_option_rooms()
  {
    try {
      $sql = 'SELECT id_type, type_name
      FROM room_type';
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

  public function get_room_by_id($bind)
  {
    // --
    try {
      // --
      $sql = 'SELECT id_room, room_number, room_status, id_type FROM room WHERE id_room = :id_room';
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




  public function update_rooms($bind)
  {
    // --
    try {
      // --
      $sql = 'UPDATE room SET room_number=:room_number,room_status=:room_status,id_type=:id_type WHERE id_room=:id_room';
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

    return $response;
  }

  public function delete_rooms($bind)
  {
    // --
    try {
      // --
      $sql = 'DELETE FROM room WHERE id_room=:id_room';
      // --
      $result = $this->pdo->perform($sql, $bind);

      // --
      if ($result) {
        $response = array('status' => 'OK', 'result' => array());
      } else {
        $response = array('status' => 'ERROR', 'result' => array());
      }
    } catch (PDOException $e) {
      $response = array('status' => 'EXCEPTION', 'result' => $e);
    }
    // --
    return $response;
  }
}
