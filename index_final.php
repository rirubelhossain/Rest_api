<?php

//include 'db.php';
header('content-type: application/json');

$var = $_SERVER['REQUEST_METHOD'];

switch($var)
{
    case 'GET' :
        get_method() ;
        //echo '{"name": "Get method"}';
        break ;
    case 'POST':
        ///echo '{"name": "post method"}';
        $data = json_decode(file_get_contents('php://input'), true ) ;
        post_data($data) ;
        break ;
    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true ) ;
        put($data) ;
        break ;
    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true ) ;
        del($data) ;
        break ;
    default:
        echo '{"name": "data not found"}';
        break ;
}
/// this is for get method
function get_method()
{
    $sql = "SELECT * FROM rest" ;
    include 'db.php';
    $result = mysqli_query($conn , $sql);

    if(mysqli_num_rows($result) > 0 )
    {
        $rows = array() ;
        while($r = mysqli_fetch_assoc($result))
        {
            $rows["result"][] =  $r ;
        }
        echo json_encode($rows) ;
    }
    else{
        echo '{"result": "no data found"}';
    }
}
/// this is for post method
function post_data($data)
{
    include 'db.php';
    $id = $data["id"] ;
    $name = $data['name'];
    $email = $data['email'];

    $sql = "INSERT INTO rest(id , name , email) VALUES('$id' , '$name' , '$email')";
    if(mysqli_query($conn , $sql))
    {
        echo('{"result": "data inserted"}');
    }
    else{
        echo '{"result": "data not inserted"}';
    }
}

/// this is for put method
function put($data)
{
    include 'db.php';
    $id = $data["id"] ;
    $name = $data['name'];
    $email = $data['email'];

    $sql = "UPDATE rest SET name = '$name' , email = '$email' where id = '$id'";
    if(mysqli_query($conn , $sql))
    {
        echo('{"result": "update successfully"}');
    }
    else{
        echo '{"result": "update not successfully"}';
    }
}

/// this is delete method
function del($data)
{
    include 'db.php';
    $id = $data["id"] ;
    $name = $data['name'];
    $email = $data['email'];

    $sql = "DELETE FROM rest where id = '$id'";
    if(mysqli_query($conn , $sql))
    {
        echo('{"result": "delete successfully"}');
    }
    else{
        echo '{"result": "delete not successfully"}';
    }
}

///finally end here 


?>