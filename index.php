if (isset($_GET['s'])) {
    
    $short_url = $_GET['s'];
    $short_url = "http://localhost:8080/".$short_url;
    $sql = "SELECT url_completa FROM redireccion WHERE short_url = ?";

    $stm = $conn->prepare($sql);
    $stmt->bind_param("s", $short_url);
    $stmt->execute();
    
    $result = $stmt->get_result();
    if($result -> num_rows > 0) {
        $full_url = "";
        while($fila = $result -> fetch_assoc()) {
            $full_url = $fila('url_completa');
        }

        $stmt->close();
        header("Location: ".$full_url);
    } else {
        exit();
    }

} else {
    exit();
}