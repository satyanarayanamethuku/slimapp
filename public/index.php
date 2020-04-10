<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require '../vendor/autoload.php';
$app = AppFactory::create();

$app->addBodyParsingMiddleware();

$app->get('/hello', function (Request $request, Response $response, $args) {   
    	  $servername = "localhost";
    		$username = "root";
    		$password = "republic";
    		$dbname = "school";
        $conn = new mysqli($servername, $username, $password, $dbname);
    	  $sql = "select * from employee13";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()) {
        	$data[]=$row;
        	
        }
        echo json_encode($data);
        
        $conn->close();
       
 });


$app->post('/hello/post', function (Request $request, Response $response, $args) {  
	   
	      $eid = $_POST['eid'];
        $name =$_POST['name'];
        $salary = $_POST['salary'];
        $dept = $_POST['dept'];
        $address = $_POST['address'];
	      $servername = "localhost";
    		$username = "root";
    		$password = "republic";
    		$dbname = "school";
        $conn = new mysqli($servername, $username, $password, $dbname);

        $sql = "insert into employee13 values('$eid', '$name', '$salary', '$dept', '$address')";

        if ($conn->query($sql) === TRUE) {
              echo "New record created successfully";

        }else{
    			
    			echo "Error: " . $sql . "<br>" . $conn->error;
		}
    });


$app->delete('/hello/{eid}', function (Request $request, Response $response, $args) {
	
	      $id = $args['eid'];
	      $servername = "localhost";
    		$username = "root";
    		$password = "republic";
    		$dbname = "school";
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "delete from employee13 where eid=$id";
        $result = $conn->query($sql);
        if ($conn->query($sql) === TRUE) {
              echo "sucessfully delete this: $id";

        }else{
    			
    			echo "Error deleting record: " . $conn->error;
		}
    
});



$app->put('/hello/update/{id}', function(Request $request, Response $response, $args){
  $eid = $request->getAttribute('id');
      echo $eid;
      $request_data = $request->getParsedBody();
      $name=$request_data['name'];
      echo $name;
      $salary=$request_data['salary'];
      echo $salary;
      $dept=$request_data['dept'];
      $address=$request_data['address'];
     #$name = $request->getQueryParams('name');
      
  try {
        $servername = "localhost";
        $username = "root";
        $password = "republic";
        $dbname = "school";
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE  employee13 SET name =?, salary=?,   dept=?,address=? WHERE eid=?";
        $conn->prepare($sql)->execute([$name,$salary,$dept,$address, $eid]);
        echo '{"notice": {"text": "User '. $name .' has been just updated now"}}';
        
    }catch (PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }
        
$conn = null;
	    /*$servername = "localhost";
  		  $username = "root";
  		  $password = "republic";
  		  $dbname = "school";
        $connection = new mysqli($servername, $username, $password, $dbname);
        $get_id = $request->getAttribute('id');
        echo $get_id;
        $query = "update employee13 set name = ?, salary = ?, dept = ?, address=?  where eid = $get_id ";

		     $stmt = $connection->prepare($query);
		     $stmt->bind_param("sss",$name,$salary,$dept,$address);
         $name = $request->getParsedBody()['name'];
         $salary= $request->getParsedBody()['salary'];
         $dept = $request->getParsedBody()['dept'];
         $address = $request->getParsedBody()['address'];
         $stmt->execute();

         echo "update sucessfully";*/
		 
       

        
});
$app->patch('/hello/edit/{id}', function(Request $request, Response $response, $args){
  $eid = $request->getAttribute('id');
      echo $eid;
      $request_data = $request->getParsedBody();
      $name=$request_data['name'];
      echo $name;
      $salary=$request_data['salary'];
      echo $salary;
      $dept=$request_data['dept'];
      $address=$request_data['address'];
     #$name = $request->getQueryParams('name');
      
  try {
        $servername = "localhost";
        $username = "root";
        $password = "republic";
        $dbname = "school";
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE  employee13 SET name =?, salary=?,   dept=?,address=? WHERE eid=?";
        $conn->prepare($sql)->execute([$name,$salary,$dept,$address, $eid]);
        echo '{"notice": {"text": "User '. $name .' has been just updated now"}}';
        
    }catch (PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }
        
$conn = null;
});


$app->run();
