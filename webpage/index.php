<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>
  <?php
  // Connessione al database PostgreSQL
  $conn_string = "host=database port=5432 dbname=mydb user=user password=userpassword";
  $dbconn = pg_connect($conn_string);

  if (!$dbconn) {
    echo "Connessione al database fallita.";
    exit;
  }
  ?>

  <?php
    if (isset($_GET['username']) && isset($_GET['password'])) {
      $username = $_GET['username'];
      $password = $_GET['password'];

      $query = "SELECT * FROM utenti WHERE username = '$username' AND password = '$password'";
      $result = pg_query($dbconn, $query);

      if ($result && pg_num_rows($result) > 0) {
        echo "Login effettuato!<br>";
        while ($row = pg_fetch_assoc($result)) {
            echo "Benvenuto, " . $row["username"] . "<br>";
        }
      } else {
          echo "Login fallito.";
      }
    }
  ?>
  <h2>Login</h2>
  <form action="index.php" method="GET">
    <label>Username:</label>
    <input type="text" name="username"><br>
    <label>Password:</label>
    <input type="password" name="password"><br><br>
    <input type="submit" value="Login">
  </form>
</body>
</html>
