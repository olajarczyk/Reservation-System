<?php
require('admin/sql_connect.php');

//Wyświetlanie danych 
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
//Wyświetlanie danych w panelu - łączenie tabel
function generate_dashboard(){
    global $mysqli;

    $sql = "SELECT cars.name, clients.surname, reservations.cost, reservations.to_date FROM reservations INNER JOIN cars ON reservations.car_id = cars.id INNER JOIN clients ON reservations.client_id = clients.id; ";

    $result = $mysqli -> query($sql);
    $rows = $result ->fetch_all(MYSQLI_ASSOC);

    return $rows;

}
//Pobranie danych z formularza - do panelu dashboard
function reserve($name, $surname, $phone_number, $car_id, $termin, $days, $hours)
{
    global $mysqli;
    $from_date = $termin;

    $to_date = date('Y-m-d H:i', strtotime($from_date.'+ '.$days.' days + '.$hours. 'hours'));
    $sql = "SELECT price FROM cars WHERE id=$car_id";

    $result = $mysqli -> query($sql);
    $row = $result ->fetch_row();

    $price = $row[0];

    $cost = ($days * 24 + $hours) * $price;

    $sql_2 = "INSERT INTO clients (`name`, `surname`, `phone_number`) VALUES (?,?,?)";

    if($statement = $mysqli -> prepare($sql_2)){
        if($statement->bind_param('sss', $name, $surname, $phone_number)){
            $statement ->execute();
            $client_id = $mysqli ->insert_id;
                $sql_3 = "INSERT INTO reservations (`client_id`, `car_id`, `from_date`, `to_date`, `cost`) VALUES (?,?,?,?,?)";
                if($statement_2 = $mysqli -> prepare($sql_3)){
                    if($statement_2 -> bind_param('iissi', $client_id, $car_id, $from_date, $to_date, $cost)){
                        $statement_2 -> execute();
                        $mysqli -> query("UPDATE cars SET avalible =0 WHERE id=$car_id");
                        header("Location: index.php");
                    }
                }

        }
    } else {
        die('Niepoprawne zapytanie!'.$mysqli->err_message());
    }


}
?>
