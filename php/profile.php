<?php

    $conn = mysqli_connect("localhost","root","welC0me$","guvi");        //connecting the database
    if(!$conn)
    {
        echo "Database not connected" . mysqli_connect_error();
    }

    $email = mysqli_real_escape_string($conn, $_POST['hiddenValue']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);


    require '../assets/mongo/vendor/autoload.php';

    // Creating Connection  
    $serverApi = new \MongoDB\Driver\ServerApi(\MongoDB\Driver\ServerApi::V1);
    $client = new \MongoDB\Client('mongodb+srv://rajkousik20:YRzev3Psr80LZMcZ@cluster0.gpl8uqx.mongodb.net/GuviDB', [], ['serverApi' => $serverApi]);

    $db = $client->GuviDB;

    // Creating Document  
    $collection = $db->users;

    // Insering Record  

    // $condition = array('email' => 'raj20@gmail.com');
    // $newData = array('$set' => array(
    //     'date-of-birth' => '2000-10-10' 
    //     // 'contact-no' => $contact,
    //     // 'age' => $age,
    //     //  'gender' => $gender
    // ));

    // $options = array('$upsert'=>true);

    // $collection->replaceOne($condition, $newData, $options);

    // // const update = { $set: { name: "Deli Llama", address: "3 Nassau St" }};
    
    // // const options = { upsert: true };
    // // myColl.updateOne(query, update, options);


    $collection->insertOne( [ 'date-of-bitrh' => $dob, 'contact-no' => $contact, 'age' => $age, 'gender' => $gender ] ); 
     




    echo "success";
   

?>