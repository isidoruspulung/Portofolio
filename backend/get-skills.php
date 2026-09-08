<?php
include '../koneksi.php';

$querySkills = mysqli_query($conn, "SELECT * FROM skills");
$labels = [];
$data_percentage = [];
$bg_colors = [];
$border_colors = [];

while($row = mysqli_fetch_assoc($querySkills)) {
    $labels[] = $row['skill_name'];
    $data_percentage[] = $row['percentage'];
    $bg_colors[] = $row['bg_color'];
    $border_colors[] = $row['border_color'];
}

header('Content-Type: application/json');
echo json_encode([
    'labels' => $labels,
    'data' => $data_percentage,
    'bgColors' => $bg_colors,
    'borderColors' => $border_colors
]);
?>