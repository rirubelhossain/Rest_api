<?php

//include 'db.php';
header('content-type: application/json');

$var = $_SERVER['REQUEST_METHOD'];

switch($var)
{
    case 'GET' :
        test() ;
        //echo '{"name": "Get method"}';
        break ;
    case 'POST':
        echo '{"name": "post method"}';
        break ;
    case 'PUT':
        echo '{"name": "put method"}';
        break ;
    case 'DELETE':
        echo '{"name": "Delete method"}';
        break ;
    default:
        echo '{"name": "data not found"}';
        break ;
}

function test()
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


?>