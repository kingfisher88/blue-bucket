<?php
include 'guestbooksave.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Dell' antonio</title>
    <link rel="shortcut icon" href="images/da_logo.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="fonts.css">
    <link rel="stylesheet" href="stylesheet_gb.css">
    <meta name="author" content="itrainee-2020-coffee" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta
      name="keywords"
      content="coffee, italian coffee, milano spirit, sicilia spirit, toscana spirit" />
    <meta
      name="description"
      content="Dell'antonio is an italian coffee distributer from Milano." />
  </head>
  <body>
    <header class="guestbook">
      <div class="wrapper"><img src="images/da_logo.png" alt="logo" class="gblogo"></div>
      <h1 class="wrapper">Guestbook</h1>
    </header>
    <main>
      <section class="container">
        <h2>Leave a Message in our Guestbook</h2>
        <div id="guestbook_main">
          <form name="form" id="guestbook" method="POST" action="guestbook.php" class="framed">
            <label>Rating:</label><br>
            <?php
            echo '<div class="rating">';
            for ($radiobtn = 1; $radiobtn <= 5; $radiobtn++) {
              $checked = '';
              if (isset($_POST['preview'])) {
                if (isset($_POST['rating']) && $_POST['rating'] == $radiobtn) {
                  $checked = 'checked="checked"';
                }
              };
              echo "<div class=\"rating\">
                      <div class=\"rating__element\">
                        <input type=\"radio\" id=\"radio-$radiobtn\" name=\"rating\" value=\"$radiobtn\" $checked required/>
                        <label for=\"radio-$radiobtn\">$radiobtn</label><br>
                      </div>
                    </div>";
            }
            echo '</div>';
            ?>
            <div class="subject">
              <label for="subject">Your name:</label><br>
              <input type="text" id="subject" name="subject" value="<?php if (isset($_POST['preview'])) {
                echo htmlentities($_POST['subject']);
              } ?>"><br>
            </div>
            <div class="body">
              <label for="body">Comment:</label><br>
              <textarea id="body" name="body" form="guestbook"><?php if (isset($_POST['preview'])) {
                  echo htmlentities($_POST['body']);
                } ?></textarea><br>
            </div>
            <div class="submit">
              <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-lg">
              <input type="submit" name="preview" value="Preview text" class="btn btn-primary btn-lg">
            </div>
          </form>
          <?php
          try {
            $conn = new PDO($dsn, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM guestbook ORDER BY created_on DESC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
          } catch (PDOException $e) {
            echo $e->getMessage();
          }
          $message_with_emoji_pr = isset($_POST['body']) ? $_POST['body'] : '';
          function emoticons($message_with_emoji_pr)
          {
            $message_with_emoji_pr = htmlentities($message_with_emoji_pr);
            $dir = "./images/emoticons";
            $images = opendir($dir);
            while ($images && false !== ($fname = readdir($images))) {
              if (($fname != '.') && ($fname != '..')) {
                $new_var = pathinfo($fname);
                $embed_code = ':' . $new_var['filename'] . ':';
                $img = "<img src = './images/emoticons/$fname'>";
                $message_with_emoji_pr = str_replace($embed_code, $img, $message_with_emoji_pr);
              }
            }
            closedir($images);
            return $message_with_emoji_pr;
          }

          if (isset($_POST['preview'])) {
            ?>
            <div id="preview" class="boxbg">
              <div><p class="preview__title">Preview of your comment:</p></div>
              <div><p class="preview__txt">Your name:</p></div>
              <div><p> <?php echo emoticons($_POST['subject']) ?></p></div>
              <div><p class="preview__txt">Text:</p></div>
              <div><p><?php echo emoticons($_POST['body']); ?></p></div>
              <div><p class="preview__txt">Rating:</p></div>
              <div><p><?php echo htmlentities($_POST['rating']) ?></p></div>
            </div>
            <hr>
            <?php
          }
          foreach ($posts as $row) {
            ?>
            <div class="boxbg">
              <div><p><?php print emoticons($row['subject']); ?></p></div>
              <div><p><?php print emoticons($row['body']); ?></p></div>
              <div>Rating: <?php print strip_tags($row['rating']); ?></div>
              <div>Created on: <?php print strip_tags($row['created_on']); ?></div>
            </div>
            <?php
          }
          ?>
      </section>
      </div>
    </main>
  </body>
  <footer>
    <p class="smalltext">
      <a href="https://www.lipsum.com/" target="_blank">Read the Terms and Conditions</a><br>
      Dell'antonio, Corso Buenos Aires 32. 20143 Milano ITALY,
      <a href="tel:39-028-736-14263">+3902873614253</a> ,
      e-mail:<a href="mailto:dell@antonio.com">dell@antonio.com</a>
    </p>
  </footer>
</html>