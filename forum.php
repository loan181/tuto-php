<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="test.css">

    <title>Hello, world!</title></head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

<main role="=main" class="container">
    <?php
    $room = $_GET["room"];

    if ($room == "banane") {
        echo "<h3>Vive les bananes!!!!</h3>";
    }
    ?>

    <h2>Salle <?php echo $_GET["room"] ?></h2>

    <form action="/forum_message.php" method="post">
        <div class="mb-3">
            <label for="leza" class="form-label">Nom:</label>
            <input class="form-control" id="leza" name="lezaaaa" placeholder="Leza le roi">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder=leza@lebigboss.com>
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
            <textarea class="form-control" id="walaaa" name="walaaa" rows="3"></textarea>
        </div>

        <div class="col-12">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </form>



    <?php
    // Database connection
    $db = new mysqli("localhost", "root", "", "forum");
    if ($db -> connect_errno) {
        echo "Failed to connect to MySQL: " . $db -> connect_error;
        exit();
    }

    // Insertion dans la table
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $test = htmlspecialchars($_POST["lezaaaa"]);
        $test2 = htmlspecialchars($_POST["walaaa"]);
        $test3 = htmlspecialchars($_POST["email"]);
        if ($test) {
            //    $sql = "INSERT INTO message (name, content) VALUES ('" . $test . "','" . $test2 . "','" )";
            $sql = "INSERT INTO message (name, content, email) VALUES (?, ?, ?)";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("sss", $test, $test2, $test3);
            $stmt->execute();
        }
    }


    // Affichage table
    $sql = "SELECT * FROM message";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        echo '<table id="tabspecial" style="width:100%" class="table table-striped">';
        echo '<tr>';
        echo '<th>Name</th>';
        echo '<th>Message</th>';
        echo '<th>Sent date</th>';
        echo '<th>La mail</th>';
        echo '</tr>';
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["name"]. "</td><td>" . $row["content"]. "</td><td>" . $row["date_received"]. "</td><td>" . $row["email"]. "</td></tr>";
        }
        ?>
        </table>
        <?php
    } else {
        echo "0 results";
    }


    ?>
</main>
</body>
</html>
