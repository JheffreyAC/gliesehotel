<?php 
// --
class M_Reservation extends Model {
    // --
    public function __construct() {
		parent::__construct();
    }
    public function get_reservations() {
      // --
        try {
          // --
            $sql = 'SELECT 
                r.id_reservation,
                r.checkin_date,
                r.checkin_time,
                r.checkout_date,
                r.checkout_time,
                ro.room_number,
                ro.room_status,
                rt.type_name,
                rt.bed_type,
                g.document_type,
                g.document_number,
                g.first_names,
                g.last_names,
                g.company_name
              FROM reservation r
              JOIN room ro ON ro.id_room = r.id_room
              JOIN room_type rt ON rt.id_type = ro.id_type
              JOIN guest g ON g.id_guest = r.id_guest;
              ';
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
                    r.id_reservation,
                    r.checkin_date,
                    r.checkin_time,
                    r.checkout_date,
                    r.checkout_time,
                    r.id_room,
                    r.id_guest,
                    ro.room_number,
                    ro.room_status,
                    rt.type_name,
                    rt.person_limit,
                    rt.price_temporary,
                    rt.price_half,
                    rt.price_day,
                    rt.bed_type,
                    g.document_type,
                    g.document_number,
                    g.first_names,
                    g.last_names,
                    g.address,
                    g.company_name
                FROM reservation r
                JOIN room ro ON ro.id_room = r.id_room
                JOIN room_type rt ON rt.id_type = ro.id_type
                JOIN guest g ON g.id_guest = r.id_guest
                WHERE r.id_reservation = :id_reservation;
                ';
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

  // --

public function get_sales_food($bind) {
    // --
    try {
        // --
        $sql = 'SELECT 
                    food.food_description, 
                    food.food_price, 
                    sales_food.amount_fd
                FROM sales_food
                INNER JOIN food ON sales_food.id_food = food.id_food
                WHERE sales_food.id_reservation = :id_reservation;
                ';
        // --
        $result = $this->pdo->fetchAll($sql, $bind);
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

public function get_sales_accessory($bind) {
  // --
  try {
      // --
      $sql = 'SELECT 
                  accessory.accessory_description, 
                  accessory.accessory_price, 
                  sales_accessory.amount_ac
              FROM sales_accessory
              INNER JOIN accessory ON sales_accessory.id_accessory = accessory.id_accessory
              WHERE sales_accessory.id_reservation = :id_reservation;
              ';
      // --
      $result = $this->pdo->fetchAll($sql, $bind);
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
  public function update_reservation($bind) {
    // --
    $this->pdo->beginTransaction();
    // --
    try {
        // --
        $sql = 'UPDATE reservation
                  SET
                      id_room = :id_room
                  WHERE id_reservation = :id_reservation; ';
        // --
        $bind_reservation = array(
            'id_reservation' => $bind['id_reservation'],
            'id_room' => $bind['id_room'],
        );
        // --
        $result = $this->pdo->perform($sql, $bind_reservation);
  
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
        $this->pdo->rollBack();
        $response = array('status' => 'EXCEPTION', 'result' => $e);
    }
    // --
    return $response;
  }


}



