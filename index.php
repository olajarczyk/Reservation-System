<?php
require("functions.php");
?>
<!doctype html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wypożyczalnia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet"> 
  </head>
  <body>
    <!--header-->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark pl-4">
            <div class="container-fluid">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item pr-3">
                    <a class="nav-link" href="https://localhost/rental/">HOME</a>
                  </li>
                  <li class="nav-item pr-3">
                    <a class="nav-link" onclick="smoothScroll('#avalible')">SAMOCHODY</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" onclick="smoothScroll('#unvalible')">ZAREZERWOWANE</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" onclick="smoothScroll('#reservation')">REZERWACJA</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
          <div class="container h-75 d-flex align-items-center">
            <div class="row">
              <div class= "col-12">
                <h1 class="text-white font-weight-bold font-size: 60px; font-weight: 800;">WYPOŻYCZALNIA SAMOCHODÓW</h1>
              </div>
              <div class="col-12">
                <div class="row mt-5 d-flex">
                  <button class="col-lg-3 col-md-6 col-sm-12 m-4 font-weight-bold" onclick="smoothScroll('#avalible')">OFERTA</button>
                  <button class="col-lg-3 col-md-6 col-sm-12 m-4 font-weight-bold" onclick="smoothScroll('#reservation')">REZERWACJA</button>
                </div>
              </div>
            </div>
          </div>
    </header>
    <!--header-->
    <!--avalible-->
      <section id="avalible">
        <div class="container-fluid p-5">
          <div class="row">
            <div class="col-12">
              <h1 class="text-center p-5">DOSTĘPNE SAMOCHODY</h1>
            </div>
          </div>
          <div class="row">
            <?php
              $rows = get_cars('avalible');
              foreach($rows as $r){
                echo '<div class="col-lg-3 col-md-6 col-sm-12 mt-3">';
                echo '<div class="card">';
                echo '<img src = "assets/'.$r['photo_url']. '" class="card-img-top" alt="car">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title text-center">'.$r['name'].'</h5>';
                echo '<p class="text-center">'.$r['type'].'</p>';
                echo '<p class="text-center font-weight-bold">'.$r['price'].' zł / h</p>';
                echo '<button href="" class="btn btn-primary col-12" onclick="reserve('.$r['id'].')">REZERWUJ</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
              }
            ?>
          </div>
        </div>
      </section>
    <!--avalible-->
    <!--unvalible-->
    <section id="unvalible">
      <div class="container-fluid p-5">
        <div class="row">
          <div class="col-12">
            <h1 class="text-center p-5">OBECNIE ZAREZERWOWANE</h1>
          </div>
        </div>
        <div class="row">
            
          <?php
              $rows = get_cars('unvalible');
              foreach($rows as $r){
                echo '<div class="col-lg-3 col-md-6 col-sm-12 mt-3">';
                echo '<div class="card">';
                echo '<img src = "assets/'.$r['photo_url']. '" class="card-img-top" alt="car">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title text-center">'.$r['name'].'</h5>';
                echo '<p class="text-center">'.$r['type'].'</p>';
                echo '<p class="text-center font-weight-bold">'.$r['price'].' zł / h</p>';
                echo '<button href="" class="btn btn-danger col-12" disabled>DOSTĘPNY OD '.$r['to_date'].'</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
              }
            ?>
          
        </div>
      </div>
    </section>
    <!--unvalible-->
    <!--reservation form-->
    <section id="reservation">
      <div class="container-fluid">
        <h1 class="text-center p-5 font-weight-bold">REZERWACJA</h1>
        <div class="row">
          <div class="col-12 d-flex justify-content-center p-5 text-white">
            <form action="reserve.php" method="POST" style="background-color: rgba(255,255,255,0.3); padding: 20px; border-radius: 5px;">
              <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="name">Imię</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Podaj imię"required>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="surname">Nazwisko</label>
                  <input type="text" class="form-control" name="surname" id="surname" placeholder="Podaj nazwisko"required>
                </div>
              </div>
            </div>
              <div class="form-group">
                <label for="phone">Telefon</label>
                <input type="tel" name="phone" class="form-control" placeholder="Podaj numer telefonu"required>
              </div>
              <div class="form-group">
                <label for="car">Samochód</label>
                <select name="car"class="form-control" id="car" required>
                <option value="" disabled selected>Wybierz samochód</option>
                  <?php
                  $rows = get_cars('select');
                    foreach($rows as $r){
                      echo '<option value = "'.$r['id'].'">'.$r['name'].'</option>';
                    }
                  ?>
                </select>
                </div>
                <div class="row">
                <div class="col-sm-5">
                  <div class="form-group">
                    <label for="date">Termin</label>
                    <input type="datetime-local" class="form-control" name="date" id="date" required>
                  </div>
                </div>
                <div class="col-sm-7">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="days">Dni</label>
                        <input type="number" class="form-control" name="days" id="days" min="0" max="13">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="hours">Godzin</label>
                        <input type="number" class="form-control"name="hours" id="hours" min="0" max="23">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 mt-4">
                <input type="submit" value="REZERWUJ" class="btn btn-danger col-12" >
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <button onclick="smoothScroll('header')" id="up-button"></button>
    <!--reservation form-->
    <footer>
      <div class="col-12" style="background: transparent; color: black;">
        <h6 class="text-center font-weight-bold p-2">COPYRIGHT ALEKSANDRA JARCZYK</h6>
      </div>
    </footer>
    <!--Optional Javascript-->
    <script src="js/main.js"></script>
    <!--Jqyery, Popper, Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>
</html>
