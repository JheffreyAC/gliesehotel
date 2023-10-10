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
      $sql = 'SELECT room.id_room,room.room_number, room.room_status, room_type.bed_type, room_type.type_name, room_type.person_limit, room_type.price_temporary, room_type.price_half, room_type.price_day
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



  public function get_room_by_id($bind)
  {
    // --
    try {
      // --
      $sql = 'SELECT room.id_room,room.room_number, room.room_status, room_type.bed_type, room_type.type_name, room_type.person_limit, room_type.price_temporary, room_type.price_half, room_type.price_day
      FROM room 
      JOIN room_type ON room.id_type = room_type.id_type WHERE room.id_room = :id_room';
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

  public function service_room()
  {
    try {
      $sqlFood = 'SELECT food_description FROM food WHERE food_stock > 0';
      $sqlAccessories = 'SELECT accesory_description FROM accesory WHERE accesory_stock > 0';
      $resultFood = $this->pdo->fetchAll($sqlFood);
      $resultAccessories = $this->pdo->fetchAll($sqlAccessories);
      if ($resultFood && $resultAccessories) {
        $response = array('status' => 'OK', 'result' => array('food' => $resultFood, 'accessories' => $resultAccessories));
      } else {
        $response = array('status' => 'ERROR', 'result' => array());
      }
      // return $result;
    } catch (PDOException $e) {
      return $e;
    }

    return $response;
  }

  public function create_guest_reservation($bind)
  {
    try {
      // --
      $sql = 'INSERT INTO guest (document_type, document_number, first_names, last_names, address, company_name) VALUES (:document_type, :document_number, :first_names, :last_names, :address,:company_name)';
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

  public function get_guest($bind)
  {
    try {
      $sql = 'SELECT id_guest, document_type, document_number, first_names, last_names, company_name
      FROM guest 
      WHERE (document_type = :document_type AND document_number LIKE :document_number)';
      $result = $this->pdo->fetchAll($sql, $bind);

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


  public function create_reservation($bind)
  {
    try {
      // --
      $sql = 'INSERT INTO reservation (checkin_date, checkin_time,checkout_date,checkout_time, id_room, id_guest,payment_room,payment_sales,payment_extra,payment_all) VALUES (:checkin_date, :checkin_time, :checkout_date, :checkout_time, :id_room, :id_guest,:payment_room,null,null,:payment_all)';
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







  public function get_rooms_price($bind)
  {
    try {
      $sql = 'SELECT id_type,type_name,person_limit,price_temporary, price_half, price_day FROM room_type WHERE type_name = :type_name';
      $result = $this->pdo->fetchAll($sql, $bind);

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
