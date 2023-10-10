<?php
// --
class M_Reservation extends Model
{
  // --
  public function __construct()
  {
    parent::__construct();
  }
  public function get_reservations()
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
                g.company_name,
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

  // public function get_reservation($bind)
  // {
  //   // --
  //   try {
  //     // --
  //     $sql = 'SELECT 
  //                   r.id_reservation,
  //                   r.checkin_date,
  //                   r.checkout_date,
  //                   ro.room_number,
  //                   ro.room_status,
  //                   rt.type_name,
  //                   rt.person_limit,
  //                   rt.price_temporary,
  //                   rt.price_half,
  //                   rt.price_day,
  //                   rt.bed_type,
  //                   g.document_type,
  //                   g.document_number,
  //                   g.first_names,
  //                   g.last_names,
  //                   g.birth_date,
  //                   g.address,
  //                   g.company_name,
  //                   va.id_accesory,
  //                   va.venta_cantidad as cantidad_accesorio,
  //                   va.price_venta_ac as precio_accesorio,
  //                   vf.id_food,
  //                   vf.venta_cantidad as cantidad_comida,
  //                   vf.price_venta_fo as precio_comida
  //                 FROM reservation r
  //                 JOIN room ro ON ro.id_room = r.id_room
  //                 JOIN room_type rt ON rt.id_type = ro.id_type
  //                 JOIN guest g ON g.id_guest = r.id_guest
  //                 LEFT JOIN venta_accesory va ON va.id_venta_ac = r.id_venta_ac
  //                 LEFT JOIN venta_food vf ON vf.id_venta_fo = r.id_venta_fo
  //                 WHERE r.id_reservation = :id_reservation ;';
  //     // --
  //     $result = $this->pdo->fetchOne($sql, $bind);
  //     // --
  //     if ($result) {
  //       // --
  //       $response = array('status' => 'OK', 'result' => $result);
  //     } else {
  //       // --
  //       $response = array('status' => 'ERROR', 'result' => array());
  //     }
  //   } catch (PDOException $e) {
  //     // --
  //     $response = array('status' => 'EXCEPTION', 'result' => $e);
  //   }
  //   // --
  //   return $response;
  // }
}
