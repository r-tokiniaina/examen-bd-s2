<?php

function connect_to_db()
{
    static $mysql = null;
    if ($mysql === null) {
        // $mysql = mysqli_connect('localhost', 'ETU004158', 'S4slCDoX', 'db_s2_ETU004158');
        // $mysql = mysqli_connect('localhost', 'ETU004035', '2lxvLJOu', 'db_s2_ETU004035');
        $mysql = mysqli_connect('localhost', 'root', '', 'marche');
        if (! $mysql) {
            die("Failed to connect to the database : " . mysqli_connect_error());
        }
        mysqli_set_charset($mysql, 'utf8mb4');
    }
    return $mysql;
}

function connect_to_db_object()
{
    // $mysqli = new mysqli('localhost', 'ETU004158', 'S4slCDoX', 'db_s2_ETU004158');
    // $mysqli = new mysqli('localhost', 'ETU004035', '2lxvLJOu', 'db_s2_ETU004035');
    $mysqli = new mysqli('localhost', 'root', '', 'marche');
    return $mysqli;
}


function query_db($query)
{
    $mysql = connect_to_db();
    $result = mysqli_query($mysql, $query);
    if ($result === false) {
        die("Failed to query on the database : " . mysqli_error($mysql));
    }
    return $result;
}


function get_db_result_array($result)
{
    $result_array = array();
    while (true) {
        $row = mysqli_fetch_assoc($result);
        if ($row === null) { // No more rows
            break;
        }
        if ($row === false) {
            $mysqli = connect_to_db();
            die("Failed to fetch result : " . mysqli_error($mysqli));
        }
        $result_array[] = $row;
    }
    return $result_array;
}


function query_db_without_result($query)
{
    $result = query_db($query);
    mysqli_free_result($result);
}


function query_db_and_count_result($query)
{
    $result = query_db($query);
    $count = mysqli_num_rows($result);
    mysqli_free_result($result);
    return $count;
}


function query_db_and_get_result_array($query)
{
    $result = query_db($query);
    $array = get_db_result_array($result);
    mysqli_free_result($result);
    return $array;
}


function query_db_and_get_inserted_id($query)
{
    $mysqli = connect_to_db_object();

    $result = $mysqli->query($query);
    if ($result === false) {
        die("Failed to query on the database : " . $mysqli->error);
    }

    $inserted_id = $mysqli->insert_id;
    $mysqli->close();

    return $inserted_id;
}

?>
