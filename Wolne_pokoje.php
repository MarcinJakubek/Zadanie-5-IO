<?php
					// Połączenie z bazą
					$link = mysqli_connect("localhost", "root", "", "hotel");
					if($link === false){
						die("ERROR: Nie połączono z bazą. " . mysqli_connect_error());
					}
					$sql = "SELECT * FROM room WHERE place='Free'";
					if($result = mysqli_query($link, $sql)){
						if(mysqli_num_rows($result) > 0){
							echo '<table width=50% id=tabela border=0 cellpadding=8>
								  <tr id="tabela3">
									 <th>Numer</th>
									 <th>Typ pokoju</th>
									 <th>Łóżko</th>
								 </tr>';
							while($row = mysqli_fetch_array($result)){
								echo '<tr id="gwiersz">
									      <td id=dwiersz>' . $row['id'] . '</td>';
									echo '<td>' . $row['type'] . '</td>';
									echo '<td id=dwiersz>' . $row['bedding'] . '</td>';
								   '</tr>';
							}
							echo "</table>";
							// Close result set
							mysqli_free_result($result);
						} else{
							echo "No records matching your query were found.";
						}
					} else{
						echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
					}	 
					mysqli_close($link);
?>