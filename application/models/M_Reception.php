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
      WHERE (document_type = :document_type)';
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

  public function create_payment($bind)
  {
    try {
      // --
      $sql = 'INSERT INTO payment (payment_room) VALUES (:payment_room)';
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



  public function create_reservation($bind)
  {
    try {
      // --
      $sql = 'INSERT INTO reservation (checkin_date, checkin_time, checkout_date, checkout_time, id_room, id_guest,status)  VALUES (:checkin_date, :checkin_time, :checkout_date, :checkout_time, :id_room, :id_guest,:status);

      INSERT INTO payment (id_reservation, payment_room, pre_payment)  
      VALUES (LAST_INSERT_ID(),:payment_room, :pre_payment)';
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


  public function update_state_reservation($bind)
  {
    // --
    try {
      // --
      $sql = 'UPDATE room SET room_status=:room_status WHERE id_room=:id_room';
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

  public function update_state_timer($bind)
  {
    try {
      $sql = '
DELETE FROM payment WHERE id_reservation=:id_reservation;
DELETE FROM reservation WHERE id_reservation=:id_reservation;
UPDATE room SET room_status=:room_status WHERE id_room=:id_room;';
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

  public function get_reservation_room($bind)
  {
    try {
      $sql = '
      SELECT
      r.id_reservation,
      r.id_room,
      r.id_guest,
      r.status,
      g.first_names,
      g.last_names,
      g.company_name
    FROM
      reservation r
    JOIN
      guest g ON g.id_guest = r.id_guest
    WHERE
      r.id_room = :id_room
    AND
      r.status = "Pendiente"
  ';
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


  public function clean_rooms($bind)
  {
    // --
    try {
      // --
      $sql = 'UPDATE room SET room_status="Disponible" WHERE id_room=:id_room';
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
  public function date_reservation($bind)
  {
    // --
    try {
      // --
      $sql = 'SELECT 
                  r.id_reservation,
                  r.checkin_date,
                  r.checkin_time,
                  r.checkout_date,
                  r.checkout_time,
                  r.status,
                  r.id_room,
                  ro.room_number,
                  ro.room_status
                FROM reservation r
                JOIN room ro ON ro.id_room = r.id_room
                WHERE r.status IN ("Reservado", "Ocupado","Pendiente") AND r.id_room = :id_room
                AND (CONCAT(r.checkin_date, " ", r.checkin_time) BETWEEN CONCAT(:checkin_date) AND CONCAT(:checkout_date)
                OR CONCAT(r.checkout_date, " ", r.checkout_time) BETWEEN CONCAT(:checkin_date) AND CONCAT(:checkout_date));
                ';
      // --
      $result = $this->pdo->fetchAll($sql, $bind);
      // --
      if (count($result) == 0) {
        // --
        $response = array('status' => 'OK', 'result' => $result);
      } else {
        // --
        $response = array('status' => 'ERROR', 'result' => $result);
      }
    } catch (PDOException $e) {
      // --
      $response = array('status' => 'EXCEPTION', 'result' => $e);
    }
    // --
    return $response;
  }
}
