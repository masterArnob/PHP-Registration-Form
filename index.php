<?php
include("database.php");

$name = $email = $gender = $comment = $website = "";
$nameError = $emailError = $genderError = $commentError = $websiteError = "";

if (isset($_POST["submit"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        if (empty($_POST["name"])) {
            $nameError = "Name is required";
        }
        if (empty($_POST["email"])) {
            $emailError = "Email is required";
        }
        if (empty($_POST["gender"])) {
            $genderError = "Gender is required";
        }
        if (empty($_POST["website"])) {
            $websiteError = "Website is required";
        }
        if (empty($_POST["comment"])) {
            $commentError = "Comment is required";
        } else {


            // $name = test_input($_POST["name"]);


            $name = test_input($_POST["name"]);
            $email = test_input($_POST["email"]);
            $website = $_POST["website"];
            $comment = $_POST["comment"];
            $gender = $_POST["gender"];



            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameError = "Only letters and white space allowed";
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailError = "Invalid email format";
            } else if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)) {
                $websiteError = "Invalid URL";
            } else {



                $sql = "INSERT INTO person(personName, personEmail, personWebsite, personGender, personComment) 
                VALUES('$name' , '$email' , '$website' , '$gender' , '$comment')";
                try {
                    mysqli_query($con, $sql);
                    echo "<br> <h2>You are now registered!</h2>";
                    echo "<script>alert('Form is submitted! '); </script>";
                } catch (mysqli_sql_exception) {
                    echo "Error : " . $sql . "<br>" . $con->error;
                }
            }
        }
    }
}



function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


mysqli_close($con);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Form Validition</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <h1>PHP Form Validation</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Name : <input type="text" name="name"><span class="error">* <?php echo $nameError; ?></span></label>
        <br><br>
        <label for="email">Email : <input type="email" name="email"><span class="error">* <?php echo $emailError; ?></span></label>
        <br><br>
        <label for="website">Website : <input type="text" name="website"><span class="error">* <?php echo $websiteError; ?></span></label>
        <br><br>

        <label for="gender">Gender : <input type="radio" name="gender" value="Male" id="gender">Male
            <input type="radio" name="gender" value="Female" id="gender">Female
            <span class="error">* <?php echo $genderError; ?></span>
        </label>

        <br><br>
        <label for="comment">Comment : <textarea name="comment" cols="30" rows="3" placeholder="Comment Here"></textarea><span class="error">* <?php echo $commentError; ?></span></label>
        <br><br>


        <input type="submit" name="submit">

    </form>



</body>

</html>