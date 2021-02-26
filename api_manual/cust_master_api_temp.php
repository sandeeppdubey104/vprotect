<?php



//echo file_get_contents("php://input");




$books = array(
    array(
        "title" => "Professional JavaScript",
        "author" => "Nicholas C. Zakas"
    ),
    array(
        "title" => "JavaScript: The Definitive Guide",
        "author" => "David Flanagan"
    ),
    array(
        "title" => "High Performance JavaScript",
        "author" => "Nicholas C. Zakas"
    )
);


$data = json_encode($books);
print_r($data);
?>



