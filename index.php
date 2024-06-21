<?php
    include('sys/bd.php');

    if (isset($_GET['numcard'])) {
     
       $numCard = $_GET['numcard'];
       $numCard = ltrim($numCard, '0');
       $numCard = substr($numCard, 4); 
       $numCard = intval($numCard);
    }
    var_dump($numCard);
    $saldoDisponivel = "n/d"
    
    
    
    ?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>Rock Station</title>
        <!-- Favicons -->
        <link href="assets/img/favicon.png" rel="icon">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <!-- Vendor CSS Files -->
        <link href="assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
        <!-- Template Main CSS File -->
        <link href="assets/css/style.css" rel="stylesheet">
        <style>
            #slider-container {
            width: 100%;
            overflow: hidden;
            position: relative;
            }
            #slider {
            display: flex;
            transition: transform 1.5s ease-in-out;
            }
            .slide {
            min-width: 100%;
            box-sizing: border-box;
            }
            img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            max-height: 200px;
            }
            /* Optional: Add styles for navigation buttons */
            #prev, #next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 24px;
            cursor: pointer;
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            border: none;
            padding: 10px;
            }
            #prev { left: 10px; }
            #next { right: 10px; }
            .status {
            text-align: center;
            padding: 20px;
            color: white;
            font-size: 18px;
            font-weight: bold;
            margin: 10px;
            }
            .pago {
            background-color: green;
            }
            .a-pagar {
            background-color: red;
            }
            @media (max-width: 600px) {
            .status {
            font-size: 14px;
            }
            }
        </style>
    </head>
    <body>
        <!-- <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: black">
            <a class="navbar-brand d-flex mx-auto" href="#">
                <img src="assets\img\profile-img.png" style="width: 100px; height: 100px;">
            </a>
            </nav> -->
        <!-- ======= Hero Section ======= -->
        <main id="main">
            <div id="slider-container">
                <div id="slider">
                    <div class="slide"><img src="assets\img\portfolio\portfolio-2.png" alt="Slide 1"></div>
                    <div class="slide"><img src="assets\img\portfolio\portfolio-2.png" alt="Slide 2"></div>
                    <div class="slide"><img src="assets\img\portfolio\portfolio-2.png" alt="Slide 3"></div>
                    <!-- Add more slides as needed -->
                </div>
                <button id="prev" onclick="prevSlide()">❮</button>
                <button id="next" onclick="nextSlide()">❯</button>
            </div>
            <?php 
                $sqlConsumo = "SELECt StartSerie, EndSerie FROM seriesdiscount WHERE PrepaidCards = 1";
                $resultConsumo = mysqli_query($conn, $sqlConsumo) or die("database error:" . mysqli_error($conn));
                
                while ($dados = mysqli_fetch_assoc($resultConsumo)) { 
                  $inicio = $dados['StartSerie']; 
                  $fim = $dados['EndSerie']; 
                  } 
                
                  if ($numCard >= $inicio && $numCard <= $fim) { ?>
            <!-- ======= Contact Section ======= -->
            <section id="contact" class="contact">
                <div class="container">
                    <div class="section-title">
                        <h2>Consumos Pre</h2>
                    </div>
                    <?php 
                        $sqlConsumo = "SELECt StartSerie, EndSerie, MinConsumption FROM seriesdiscount WHERE id = 1";
                        $resultConsumo = mysqli_query($conn, $sqlConsumo) or die("database error:" . mysqli_error($conn));
                        while ($dados = mysqli_fetch_assoc($resultConsumo)) { 
                         $inicio = $dados['StartSerie']; 
                         $fim = $dados['EndSerie']; 
                           } 
                        
                        
                        ?>
                    <div class="row" data-aos="fade-in">
                        <div class="col-lg-12 mt-5 mt-lg-0 d-flex align-items-stretch">
                            <div class="php-email-form">
                                <?php
                                    $sqlTotalTipo56 = "SELECT SUM(Total) AS Total56 FROM documentsbodys WHERE DocumentTypeId = 56 AND SaleZoneAreaObjectId = $numCard";
                                    $sqlTotalTipo58 = "SELECT SUM(Total) AS Total58 FROM documentsbodys WHERE DocumentTypeId = 58 AND SaleZoneAreaObjectId = $numCard";
                                    
                                    $resultTotalTipo56 = $conn->query($sqlTotalTipo56);
                                    $resultTotalTipo58 = $conn->query($sqlTotalTipo58);
                                    
                                    if ($resultTotalTipo56 && $resultTotalTipo58) {
                                        $rowTotalTipo56 = $resultTotalTipo56->fetch_assoc();
                                        $rowTotalTipo58 = $resultTotalTipo58->fetch_assoc();
                                    
                                        if ($rowTotalTipo56 && $rowTotalTipo58) {
                                            $totalTipo56 = $rowTotalTipo56["Total56"];
                                            $totalTipo58 = $rowTotalTipo58["Total58"];
                                    
                                            if ($totalTipo56 !== $totalTipo58) {
                                                $resultado = $totalTipo56 - $totalTipo58;
                                    
                                                $saldoDisponivel = number_format($resultado, 2, ',', '') . '€';
                                    
                                            } else {
                                    
                                                 "Os valores são iguais, não é possível calcular a diferença.";
                                            }
                                        } else {
                                            "Não foi possível obter os valores de ambos os tipos de documento.";
                                        }
                                    } else {
                                        "Erro ao consultar o banco de dados.";
                                    }
                                    if($saldoDisponivel == 0){
                                     echo '<div class="a-pagar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M20 4H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zM4 6h16v2H4V6zm0 12v-6h16.001l.001 6H4z"/><path fill="currentColor" d="M6 14h6v2H6z"/></svg> Saldo Disponível: ' . $saldoDisponivel . '</div>';
                                    
                                    }else{
                                     echo '<div class="status pago"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M20 4H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zM4 6h16v2H4V6zm0 12v-6h16.001l.001 6H4z"/><path fill="currentColor" d="M6 14h6v2H6z"/></svg> Saldo Disponível: ' . $saldoDisponivel . '</div>';
                                    }
                                    
                                      ?>
                                <hr>
                                <div class="form-group">
                                    <div class = "table-responsive-md">
                                        <table class="table table-responsive table-hover" >
                                        <thead>
                                            <tr>
                                                <th scope="col"><i class='bx bx-beer' style="color: #fe0000"></i></th>
                                                <th scope="col"><i class='bx bxs-calculator' style="color: #fe0000"></i></th>
                                                <th scope="col"><i class='bx bxs-coin-stack' style="color: #fe0000"></i></th>
                                                <th scope="col"><i class='bx bxs-time-five' style="color: #fe0000" ></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sql = "SELECT * FROM documentsbodys WHERE SaleZoneAreaObjectId = $numCard  AND RetailPrice != 0 AND DocumentTypeId != 58";
                                                $result = $conn->query($sql);
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<tr>";
                                                        if ($row["ItemDescription"] == "Adiantamento") {
                                                         echo "<td>Carregamento</td>";
                                                     } else {
                                                         echo "<td>" . $row["ItemDescription"] . "</td>";
                                                     }
                                                        echo "<td>" .  intval($row["Quantity"]) . "</td>";
                                                     echo "<td>";
                                                     if (isset($row["RetailPrice"]) && isset($row["Quantity"])) {
                                                         $total = $row["RetailPrice"] * intval($row["Quantity"]);
                                                         if ($row["ItemDescription"] == "Adiantamento") {
                                                           echo "<i class='bx bx-plus-circle' style='color: green; font-size: 12px'></i>" . number_format($total, 2, ',', '') . "€";
                                                       } else {
                                                         echo "<i class='bx bx-minus-circle' style='color: red; font-size: 12px'></i>" . number_format($total, 2, ',', '') . "€";
                                                       }
                                                         
                                                     } else {
                                                         echo "N/A";
                                                     }
                                                     echo "</td>";
                                                        echo "<td>" . date("d/m/y H:i", strtotime($row["CreationDate"])) . "</td>";
                                                        echo "<td>" . "</td>";
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='3'>Nenhum resultado encontrado</td></tr>";
                                                }
                                                echo "</table>"; ?>
                                    </div>
                                </div>
                                <div style="display: flex; align-items: center; justify-content: center;">
                                <p style="font-size: 15px;"><i class='bx bx-closet'></i><strong> Bengaleiro nº:</strong>
                                <?php 
                                    $sqlCloack = "SELECT * FROM cloakroom WHERE CardNumber = ?";
                                    $stmt = $conn->prepare($sqlCloack);
                                    $stmt->bind_param("s", $numCard);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "" . $row["Id"] . ", ";
                                        }
                                    } else {
                                        echo "N/D";
                                    }
                                    ?>
                                </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php } 
                else { ?>
            <!-- ======= Contact Section ======= -->
            <section id="contact" class="contact">
            <div class="container">
            <div class="section-title">
            <h2>Consumos</h2>
            </div>
            <?php 
                $sqlConsumo = "SELECt StartSerie, EndSerie, MinConsumption FROM seriesdiscount WHERE id = 2";
                $resultConsumo = mysqli_query($conn, $sqlConsumo) or die("database error:" . mysqli_error($conn));
                while ($dados = mysqli_fetch_assoc($resultConsumo)) { 
                   $inicio = $dados['StartSerie']; 
                 $fim = $dados['EndSerie']; 
                   } 
                
                
                ?>
            <div class="row" data-aos="fade-in">
            <div class="col-lg-12 mt-5 mt-lg-0 d-flex align-items-stretch">
            <div class="php-email-form">
            <?php
                $sqlPago = "SELECT * FROM tmpdocumentstables WHERE SaleZoneAreaObjectId = $numCard  RetailPrice != 0";
                $result = $conn->query($sqlPago);
                $totalRetailPrice1 = 0;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      
                        number_format($row["RetailPrice"], 2, ',', ''); 
                        $totalRetailPrice1 += $row["RetailPrice"];
                    }
                } 
                if( $totalRetailPrice1 <= 0){
                  echo ' <div class="status pago">Pago</div>';
                }
                else {
                  echo '<div class="status a-pagar">A Pagar ' . number_format($totalRetailPrice1, 2, ',', '') . '€</div>';
                }
                ?>
            <hr>
            <div class="form-group">
            <table class="table">
            <thead>
            <tr>
            <th scope="col"><i class='bx bx-beer' style="color: #fe0000"></i></th>
            <th scope="col"> <i class='bx bx-add-to-queue'></i></th>
            <th scope="col"><i class='bx bxs-calculator' style="color: #fe0000"></i></th>
            <th scope="col"><i class='bx bxs-coin-stack' style="color: #fe0000"></i></th>
            <th scope="col"><i class='bx bxs-receipt' style="color: #fe0000" ></i></th>
            <th scope="col">Total</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $totalRetailPrice = 0;
                $sql = "SELECT * FROM tmpdocumentstables WHERE SaleZoneAreaObjectId = $numCard  AND ItemKeyId != 9014 AND RetailPrice != 0";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["ItemDescription"] . "</td>";
                        echo "<td>" .  intval($row["Quantity"]) . "</td>";
                        echo "<td>" .  number_format($row["Total"], 2, ',', '') . "€</td>";
                        echo "<td>" . date("d/m/y H:i", strtotime($row["CreationDate"])) . "</td>";
                        echo "<td>" . "</td>";
                        echo "</tr>";
                        $totalRetailPrice += $row["RetailPrice"];
                    }
                } else {
                    echo "<tr><td colspan='3'>Nenhum resultado encontrado</td></tr>";
                }
                echo "<tfoot>";
                echo "<tr>";
                echo "<td colspan='4'></td>";
                echo "<td>" . number_format($totalRetailPrice, 2, ',', '') . "€</td>";
                echo "<td></td>";
                echo "</tr>";
                echo "</tfoot>";
                echo "</table>"; ?>
            </div>
            <div style="display: flex; align-items: center; justify-content: center;">
            <p style="font-size: 15px;"><i class='bx bx-closet'></i><strong> Bengaleiro nº:</strong>
            <?php 
                $sqlCloack = "SELECT * FROM cloakroom WHERE CardNumber = ?";
                $stmt = $conn->prepare($sqlCloack);
                $stmt->bind_param("s", $numCard);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "" . $row["Id"] . ", ";
                    }
                } else {
                    echo "N/D ";
                }
                ?>
            </p>
            </div>
            </div>
            </div>
            </div>
            </div>
            </section>
            <?php }?>
            <!-- End Contact Section -->
        </main>
        <!-- End #main -->
        <!-- ======= Footer ======= -->
        <footer class="bg-body-tertiary text-center text-lg-start">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: black; color: white">
        <?php echo date("Y"); ?> -
        <a href="https://rockstationmusic.pt/" style="color: #fe0000;"><strong>Rock Station Music<strong></a>
        </div>
        <!-- Copyright -->
        </footer>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
        <!-- Vendor JS Files -->
        <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
        <script src="assets/vendor/aos/aos.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="assets/vendor/typed.js/typed.umd.js"></script>
        <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>
        <!-- Template Main JS File -->
        <script src="assets/js/main.js"></script>
        <script>
            let currentIndex = 0;
               const slides = document.querySelectorAll('.slide');
               const totalSlides = slides.length;
            
               function showSlide(index) {
                   if (index < 0) {
                       currentIndex = totalSlides - 1;
                   } else if (index >= totalSlides) {
                       currentIndex = 0;
                   } else {
                       currentIndex = index;
                   }
            
                   const transformValue = -currentIndex * 100 + '%';
                   document.getElementById('slider').style.transform = 'translateX(' + transformValue + ')';
               }
            
               function nextSlide() {
                   showSlide(currentIndex + 1);
               }
            
               function prevSlide() {
                   showSlide(currentIndex - 1);
               }
            
               // Autoplay
               setInterval(nextSlide, 5000); // Change slide every 5 seconds
             
        </script>
        <script src="https://kit.fontawesome.com/bebc99a45c.js" crossorigin="anonymous"></script>
    </body>
</html>