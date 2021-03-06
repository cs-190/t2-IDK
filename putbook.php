<?php
#Written by Wilson, enters the book into the database
session_start();


require_once('database.php');



$name = $_SESSION["booktitle"]; 
$name = mysql_real_escape_string($name);
$price = $_SESSION['price'];
$isbn10 = $_SESSION["isbn10"];   
$isbn13 = $_SESSION["isbn13"];  
$author = $_SESSION["author"]; 
$author = mysql_real_escape_string($author);
$img = $_SESSION["imglink"]; 
$img = mysql_real_escape_string($img);
$additional = $_SESSION["additional"];
$additional = mysql_real_escape_string($additional);
$class = $_SESSION['class'];
$class = mysql_real_escape_string($class);
unset($_SESSION["booktitle"]);
unset($_SESSION["price"]);
unset($_SESSION["isbn10"]);
unset($_SESSION["isbn13"]);
unset($_SESSION["author"]);
unset($_SESSION["imglink"]);
unset($_SESSION["additional"]);
unset($_SESSION["class"]);

//Verifcation 
    $sql = 'INSERT INTO Books (BookName ,Price, ISBN10,ISBN13, author, addition,img, class) VALUES (:BookName,:Price,:ISBN10,:ISBN13,:author,:addition,:img, :class)';    

    $query = $db->prepare($sql);
    $query->execute(array(

    ':BookName' => $name,
    ':Price' => $price,
    ':ISBN10' => $isbn10,
	':ISBN13' => $isbn13,
    ':author' => $author,
	':class' => $class,
    ':addition' => $additional,
	':img' => $img


    ));
  
    $sqls = 'SELECT * FROM Books WHERE BookName = :BookName AND ISBN10 = :ISBN10 AND ISBN13 = :ISBN13 AND author = :author AND Price = :Price AND addition = :add AND img = :img';    
    $query1 = $db->prepare($sqls);
    $query1->execute(array(

    ':BookName' => $name,
	':Price' => $price,
    ':ISBN10' => $isbn10,
    ':ISBN13' => $isbn13,
    ':author' => $author,
	':add' => $additional,
	':img' => $img

    ));
    $idd;
	while($row = $query1 -> fetch(PDO::FETCH_ASSOC)){
		$idd = $row['id'];
	}
    
	$sql2 = 'INSERT INTO ownedBooks (user_id , book_id) VALUES (:userid,:bookid)';    
    $query = $db->prepare($sql2);
    $query->execute(array(

    ':userid' => $_SESSION['userid'],
    ':bookid' => $idd
    ));
    
       $sthandler = $db->prepare("SELECT BookName FROM Books ");
	$sthandler->execute();
	$arr = array();
	$counter = 0;
	while($row = $sthandler -> fetch(PDO::FETCH_ASSOC)){
		$arr[$counter] = $row;
		$counter = $counter +1;	
	}
	
	$_SESSION['bookname'] = $arr;
	header("Location: dashboard.php");
	exit();

    
    

?>
