<?php
require('admin/sql_connect.php');

function get_cars($type){
    global $mysqli; //pobranie tablicy z danymi

    switch($type){
        case 'avalible':
        $sql = "SELECT id,name,photo_url, type, price FROM cars WHERE avalible=1";  
        break;
        case 'unvalible':
        $sql = "SELECT cars.id, cars.name, cars.photo_url, cars.type, cars.price, reservations.to_date FROM cars INNER JOIN reservations ON cars.id = reservations.car_id WHERE cars.avalible=0";  
        break;
        case 'select':
        $sql = "SELECT id, name FROM cars WHERE avalible=1";  
        break;
    }

    $result = $mysqli ->query($sql);
    $rows = $result -> fetch_all(MYSQLI_ASSOC);

    return $rows;
}

function generate_dashboard(){
    global $mysqli;

    $sql = "SELECT cars.name, clients.surname, reservations.cost, reservations.to_date FROM reservations INNER JOIN cars ON reservations.car_id = cars.id INNER JOIN clients ON reservations.client_id = clients.id; ";

    $result = $mysqli -> query($sql);
    $rows = $result ->fetch_all(MYSQLI_ASSOC);

    return $rows;

}
?>
