<?php
$db = mysqli_connect('localhost', 'root', '', 'web_tiket');

function select($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
function create_pendaftaran($data)
{
    global $db;
    $email = $data['email'];
    $username = $data['username'];

    $password = $data['password'];
    $query = "INSERT INTO regist VALUES (null, '$email', '$username', '$password')";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
