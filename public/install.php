<?php
            include 'connect.php';
            try {
                $conn = new PDO($dsn, $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "CREATE TABLE IF NOT EXISTS guestbook (
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    rating INT NOT NULL,
                    subject VARCHAR(100) NOT NULL,
                    body TEXT NOT NULL,
                    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                    )";

                $stmt = $conn->prepare($sql);
                $stmt->execute();
                }
                catch(PDOException $e) {
                echo $e->getMessage();
                }