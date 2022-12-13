<?php	
						require_once "connect.php";
						$conn = new mysqli($host, $db_user, $db_password , $db_name);

						if 
						($conn->connect_error) {
							die("Połączenie niudane: " . $conn->connect_error);
						}
							$troom=$_POST['troom'];
							$bed=$_POST['bed'];
							$meal=$_POST['posilek'];
							$cin=$_POST['cin'];
							$cout=$_POST['cout'];
							$title=$_POST['title'];
							$fname=$_POST['fname'];
							$lname=$_POST['lname'];
							$email=$_POST['email'];
							$nrid=$_POST['nrid'];
							$phone=$_POST['phone'];
							$new = "Conform";
							

				
								$newUser="SELECT * FROM room WHERE type='$troom' and bedding='$bed' ";
									$result = $conn->query($newUser);	
									if ($result->num_rows > 0) {

										while($row = $result->fetch_assoc()) {
										$place = $row['place'];
									}
								
								} else {
									echo "Brak wyników w poleceniu służącym do pobrania zmiennej z tabeli";
								} 
								
								
								if ("$place"=="NotFree") {
									echo "<br><br><center><b><font color=red>Ten pokój jest już zajęty</font></b></center>";
										$conn->close();
								} else { 
								require_once "connect.php";
							
							
										$conn = new mysqli($host, $db_user, $db_password , $db_name);

										if ($conn->connect_error) {
											die("Connection failed: " . $conn->connect_error);
										}
												$newUser="SELECT * FROM room WHERE  type='$troom' AND bedding='$bed' ";
												$result = $conn->query($newUser);	
												if ($result->num_rows > 0) {

													while($row = $result->fetch_assoc()) {
													$nroom = $row['id'];
												
												}
											} else {
												echo "0 results";
											} 
								
								$sql = "INSERT INTO roombook (Title, FName, LName, Email, nrid, Phone, TRoom, Bed, NRoom, Meal, cin, cout, stat, nodays ) 
								VALUES ('$title','$fname','$lname','$email','$nrid','$phone',
																	'$troom','$bed','$nroom','$meal',
																	'$cin','$cout','$new', datediff('$cout','$cin'))"; 
									
								if ($conn->query($sql) === TRUE ) {
								} else{
									echo "Błąd wstawiania danych: " .$conn->error;
								}
								
									$servername = "localhost";
											$username = "root";
											$password = "";
											$dbname = "hotel";
											

											$conn = mysqli_connect($servername, $username, $password, $dbname);

											if (!$conn) {
												die("Połączenie nieudane: " . mysqli_connect_error());
											}
											
											$spr = "select * from room";
											$sql = "UPDATE room SET place='NotFree', arrival='$cin', departure='$cout' WHERE type='$troom' and bedding='$bed'";

											if (mysqli_query($conn, $sql)) {
												echo "";
											} else {
												echo "Błąd podczas podmiany: " . mysqli_error($conn);
											}
							
							

							
							
							require_once "connect.php";
							
							
							$conn = new mysqli($host, $db_user, $db_password , $db_name);

							if ($conn->connect_error) {
								die("Connection failed: " . $conn->connect_error);
							}
									$newUser="SELECT * FROM price_list WHERE  service='$troom' ";
									$result = $conn->query($newUser);	
									if ($result->num_rows > 0) {

										while($row = $result->fetch_assoc()) {
										$trooma = $row['service'];
										$pricea = $row['price'];

									}
								} else {
									echo "0 results";
								} 
								
									$newUser="SELECT * FROM price_list WHERE  service='$meal' ";
									$result = $conn->query($newUser);	

										while($row = $result->fetch_assoc()) {
										$bedq = $row['service'];
										$priceq = $row['price'];

										}

									$newUser="SELECT * FROM price_list WHERE  service='$bed' ";
									$result = $conn->query($newUser);	
									if ($result->num_rows > 0) {

										while($row = $result->fetch_assoc()) {
										$bedc = $row['service'];
										$pricec = $row['price'];

									}
								} else {
									echo "0 results";
								}
								
								$newUser="SELECT * FROM roombook WHERE  fname='$fname' and lname='$lname' ";
									$result = $conn->query($newUser);	
									if ($result->num_rows > 0) {

										while($row = $result->fetch_assoc()) {
										$days = $row['nodays'];

									}
								
								} else {
									echo "0 results";
								} 
								echo "<br>";
								$price_troom;
								$price_bed;
								$price_eat;
								$suma;
								$price_troom= "$pricea" * "$days";
								$price_bed= "$pricec" * "$days";
								$price_eat= "$priceq" * "$days";
								$suma= "$price_troom"+"$price_bed"+"$price_eat";
								
								$servername = "localhost";
								$username = "root";
								$password = "";
								$dbname = "hotel";

								require_once "connect.php";
								$conn = new mysqli($host, $db_user, $db_password , $db_name);

								if 
								($conn->connect_error) {
								die("Connection failed: " . $conn->connect_error);
								}
								
								$stat="not paid";
								$sql = "INSERT INTO payment (title, fname, lname, troom, tbed, nroom, cin, cout, ttot, fintot, mepr, meal, btot, noofdays, stat_paid) values 
								('$title', '$fname', '$lname', '$troom', '$bed', '$nroom','$cin','$cout','$price_troom','$suma','$price_bed','$meal','$price_eat','$days','$stat')";
			echo "<br><b> &nbsp Należność:</b>";
				if ($conn->query($sql) === TRUE ) {
					echo 
					"<br><br> &nbsp &nbsp <font color=blue>Cena pokoju: </font>". $price_troom. 
					"&nbsp &nbsp <font color=blue>Cena posiłku:     </font>". $price_eat. 
					"&nbsp &nbsp <font color=blue>Cena łóżka    </font>". $price_bed. 
					"&nbsp &nbsp <font color=blue>Należność   </font>". $suma;
				} else{
					echo "Błąd wstawiania danych: " .$conn->error;
				}								
							
						}
?>