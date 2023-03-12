<?php

    

    $conn = mysqli_connect("localhost","root","welC0me$","guvi");        //connecting the database
    if(!$conn)
    {
        echo "Database not connected" . mysqli_connect_error();
    }

    require '../assets/redis/vendor/autoload.php';
    $redis = new Predis\Client();

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($email) && !empty($password))  {       

        $query = " SELECT * FROM users WHERE email = ? "; // SQL with parameters
        $stmt = $conn->prepare($query); 
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
  

        if(mysqli_num_rows($result) > 0)
        {
                $row = $result->fetch_assoc();

                $user_password = $row['password'];

                $name = $row['name'];

                if($user_password === $password)
                {
                    $redis->set('name', $name);
                    echo "success" . $redis->get('name');
                }
                else
                {
                    echo "Email or Password is Incorrect!";
                }
        }
        else
        {
            echo "Email or Password is Incorrect!";
        }

    }
    else
    {
        echo "All input fields are required!";
    }

?>