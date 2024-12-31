<?php
include "dbconnect.php";


// Get the current request URI
$request = $_SERVER['REQUEST_URI'];

// Remove the project folder name from the URI (if applicable)
#$request = str_replace('/my_project', '', $request);
#$request = str_replace('/EDGE-RUET-CSE-RUETCSEB0103/EDGE-RUET-CSE-RUETCSEB0103/10.Module/my_project', '', $request);
$request = str_replace('/EDGE-RUET-CSE-RUETCSEB0101/12.Module/Project01/', '', $request);

// Match the requested path
switch ($request) {
    case '/home':
        echo "Welcome to the Home page!";
        break;
    case '/about':
        echo "Welcome to the About page!";
        break;
    case '/':
        echo "Welcome to the Default Home page!";
        break;
    case "/page1":
        include"page1.php";
        break;
    
    case "/page2":

        echo "Page 2";
        break;

    case "/all-user":

        header('Content-Type: application/json');

        $sql = "SELECT * FROM `user`;";
        $result = $conn->query($sql);

        $output = $result->fetch_all(MYSQLI_ASSOC);

        #print_r($output);

        #echo $output;

        
        #echo "<br> <br>";

        #print_r($output[1]["username"]);

        #echo "<br> <br>";

        $finaloutput = json_encode($output);

        echo $finaloutput;

        #echo "<br> <br>";

        break;
    
    case "/registration":

        include "views/reg.php";

        break;

    case "/createuser":

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get form data
            $name = $_POST['name'];
            $mobile = $_POST['mobile'];
            $password = $_POST['password'];
            $address = $_POST['address'];
        
            // Display or save data (For demonstration, we're just echoing)
    
    
              $sql1 = "INSERT INTO `user` (`userid`, `username`, `contactnumber`, `password`, `division`, `district`, `thana`, `village`, `DoB`) VALUES (NULL, '$name', '$mobile', '$password', 'AHSg', 'sjdnm,nm,', 'asdjJNK', 'asdBJJ', 'asdjhjh');";
                $result1 = $conn->query($sql1);
    
                if ($result1 === false) {
    
                        echo "Error executing query: " . $conn->error;  // Print the error message
    
                } else {
    
                 #echo "Success Insert Query";

                 echo "Log In Page";
    
                }
            
            #include "views/profile.php";
        }

        break;
    
        case "/login":

            include "views/login.php";
    
            break;
    
        case "/logincheck":

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // Get form data
                   
                    $mobile = $_POST['mobile'];
                    $password = $_POST['password'];
                    
                
                    // Display or save data (For demonstration, we're just echoing)
            
            
                      $sql1 = "SELECT * FROM `user` WHERE contactnumber = '$mobile';";
                        $result1 = $conn->query($sql1);
            
                        if ($result1 === false) {
            
                                echo "Error executing query: " . $conn->error;  // Print the error message
            
                        } else {

                            $output = $result1->fetch_all(MYSQLI_ASSOC);
                            #print_r($output);

                            $lenth =  count($output);

                            if ($lenth == 0) {
                                echo "No User Exist";
                            } else {

                                if ($password == $output[0]["password"]) {
                                    #echo "Password Match". $output[0]["password"] ."";

                                    #echo "Name ". $output[0]["username"] ."";
                                    include "views/profile.php";

                                    #include "profile.php";


                                } else {
                                    echo "Wrong Password";
                                }


                            }

                        
            
                        }
                    
                    
                }
        
        break;




    default:
        echo "Page not found!";
        break;  

}




?>