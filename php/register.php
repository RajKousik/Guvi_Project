<?php

    $conn = mysqli_connect("localhost","root","welC0me$","guvi");        //connecting the database
    if(!$conn)
    {
        echo "Database not connected" . mysqli_connect_error();
    }

    require '../assets/redis/vendor/autoload.php';
    $redis = new Predis\Client();

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);


    if(!empty($name) && !empty($email) && !empty($password) && !empty($cpassword))
    {
        if(strlen($name) <= 10 && strlen($name) >= 5)
        {

            if($password === $cpassword)
            {
                    //checking email
                    if(filter_var($email, FILTER_VALIDATE_EMAIL))
                    {


                        $query = " SELECT email FROM users WHERE email = ? "; // SQL with parameters
                        $stmt = $conn->prepare($query); 
                        $stmt->bind_param("s", $email);
                        $stmt->execute();
                        $result = $stmt->get_result(); // get the mysqli result

                        if(mysqli_num_rows($result) > 0)
                        {
                            echo "$email - This email already exist";
                        }
                        else
                        {
                            //lets do password validation
                            
                            $uppercase = preg_match('@[A-Z]@', $password);
                            $lowercase = preg_match('@[a-z]@', $password);
                            $number    = preg_match('@[0-9]@', $password);
                            $specialChars = preg_match('@[^\w]@', $password);

                            if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8)
                            {
                                echo "The Password should contain atleast 8 characters, one uppercase, one lowercase, one number and one symbol";
                            }
                            else
                            {
                            
                                $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
                                $stmt->bind_param("sss", $name, $email, $password);
                                $stmt->execute();
                                
                                $redis->set('name', $name);

                                echo "done";
                                
                            }
                        }
                    }
                    else
                    {
                        echo "$email - This is not a valid Email!";
                    }
                }
                else
                {
                    echo "confirm Password not matched";
                }
        }
        else
        {
            echo "Please Give a Short First Name";
        }
    }
    else
    {
        echo "All input field are required!";
    }

?>