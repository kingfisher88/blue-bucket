<?php
include 'connect.php';
if ($_POST) {
  if (isset($_POST['submit'])) {
    $v_subject = $_POST['subject'];
    $v_rating = $_POST['rating'];
    $v_body = $_POST['body'];

    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $insert_review = $conn->prepare('INSERT INTO guestbook(rating, subject, body) VALUES(:rating, :subject, :body)');

    $insert_review->execute([
      'rating' => $v_rating,
      'subject' => $v_subject,
      'body' => $v_body
    ]);
    header('Location: /guestbook.php', TRUE, 303);
    exit();
  }
}

