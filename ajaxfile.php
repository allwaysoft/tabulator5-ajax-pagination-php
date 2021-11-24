<?php

include 'config.php';

## Read value
$page = $_GET['page'];
$size = $_GET['size']; // Rows display per page
## Total number of records without filtering
$sel = mysqli_query($con, "select count(*) as allcount from employee");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];
$last_page = ceil($totalRecords / $size);

## Fetch records
$empQuery = "select * from employee limit " . ($page - 1) * $size . "," . $size;
$empRecords = mysqli_query($con, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
    $data[] = array(
        "emp_name" => $row['emp_name'],
        "email" => $row['email'],
        "gender" => $row['gender'],
        "salary" => $row['salary'],
        "city" => $row['city']
    );
}

## Response
$response = array(
    "last_page" => $last_page,
    "data" => $data
);

echo json_encode($response);
