<?php
class PrintBestCustomerClass {

public function PrintCustomer($sname,$uname,$password,$db_name){
			$this->sname= $sname;
			$this->uname=$uname;
			$this->password =$password;
			$this->db_name =$db_name;
			$this->idnumber =$idnumber;
							
							//connect to database
							$conn = mysqli_connect($sname, $uname, $password, $db_name);
							
							$query_orderdelete = ("DROP TABLE IF EXISTS customer_order");
							$query_orderdelete1=mysqli_query($conn,$query_orderdelete);

							$query_order = ("CREATE TABLE IF NOT EXISTS customer_order (`id` int auto_increment primary key ,`customer_name` varchar(50) DEFAULT NULL,`number_of_orders` int DEFAULT NULL) ");
							$query_order1=mysqli_query($conn,$query_order);



							 $sql_get0= "SELECT user_login FROM wp_users";
								$report0=mysqli_query($conn,$sql_get0);

								
								if($report0 == TRUE){

								while($row=mysqli_fetch_array($report0))
									{
					$data = $row['user_login'];

							$sql_get= "SELECT * FROM wp_users WHERE user_login='$data'";
							$report=mysqli_query($conn,$sql_get);

							$row0=mysqli_fetch_array($report);
							$data1 = $row0['ID'];

							$sql_get1= "SELECT * FROM wp_wc_customer_lookup WHERE user_id='$data1'";
							$report1=mysqli_query($conn,$sql_get1);
							$row1=mysqli_fetch_array($report1);
							$data2 = $row1['customer_id'];

							$query = ("SELECT * FROM wp_wc_order_stats WHERE customer_id='$data2'");
							$query1=mysqli_query($conn,$query);
							$total_count = mysqli_num_rows($query1);
						
							$query_insert = ("INSERT INTO customer_order (customer_name,number_of_orders) VALUES('$data','$total_count')");
							$query_insert1=mysqli_query($conn,$query_insert);
						}
					}


									$sql_top_order="SELECT * FROM customer_order order by number_of_orders desc";
									$report_top_order=mysqli_query($conn,$sql_top_order);
									if($report_top_order== TRUE){ 
									echo "<table border='5'>";
									echo "<tr><th></th><th>Customer Name</th><th>Number Of Orders</th></tr>";
									$num=1;

									while($row_top_order=mysqli_fetch_array($report_top_order) )
									{

									
										echo "<tr><td>";									
										echo $num;
										echo "</td><td>";
										echo$row_top_order['customer_name'];
										echo "</td><td>";									
										echo$row_top_order['number_of_orders'];
										echo "</td></tr>";
										echo"<tr></tr>";
										echo"<tr></tr>";
										echo"<tr></tr>";

										$num=$num+1;
								
									
								}
								echo"</table>";
								
					}
				}

public function PrintCustomer_JSON($sname,$uname,$password,$db_name){
			$this->sname= $sname;
			$this->uname=$uname;
			$this->password =$password;
			$this->db_name =$db_name;
			$this->idnumber =$idnumber;
							
							//connect to database
							$conn = mysqli_connect($sname, $uname, $password, $db_name);

							$sql_top_order="SELECT * FROM customer_order";
									$report_top_order=mysqli_query($conn,$sql_top_order);
									
									if($report_top_order== TRUE){ 

										while($row_top_order=mysqli_fetch_array($report_top_order) )
										{
										$n = $row_top_order['customer_name'];
										$o = $row_top_order['number_of_orders'];
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "http://192.168.16.120:6066/user/info?userName=$n&quantity=$o",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'PATCH',
  CURLOPT_HTTPHEADER => array(
    'auth: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;




									}
									

									// put your code here
								
					}
					return $response;		

		}
	}

?>