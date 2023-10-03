<?php
include("conn.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database</title>
    <link rel="stylesheet" href="crack.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body>

    <?php
    if (isset($_POST['btn_insert'])) {
        $student_name = $_POST['txt_name'];
        $student_course = $_POST['txt_course'];

        $sql = $conn->query("INSERT INTO tbl_student values('NULL','$student_name','$student_course')");

        if ($sql) {
            echo
                "
            <script>
            window.alert('Successfully added to Database');
            </script>
            ";
        }
    }

    ?>

    <div class="container">
        <div class="one">
            <!-- Left Side -->
            <div class="header">
                <h1>INSERT DATA TO DATABASE</h1>
            </div>

            <form method="POST">
                <input type="text" name="txt_name" placeholder="Name" class="enterInfo" required> <br>
                <input type="text" name="txt_course" placeholder="Course" class="enterInfo" required> <br><br>
                <input type="submit" name="btn_insert" class="button">
            </form>

            <?php
            if (isset($_POST['btn_retrieve'])) {
                $id = $_POST['txt_retrieve'];

                $ret = $conn->query("SELECT * FROM `tbl_student` WHERE `stud_id`='$id'");
                $row = $ret->fetch_array();
            }
            ?>
        </div>

        <div class="two">
            <!-- Center -->
            <div class="header">
                <h1>RETRIEVE DATA FROM DATABASE</h1>
            </div>

            <form method="POST">
                <input type="text" name="txt_retrieve" placeholder="Enter Student ID" class="enterInfo" required>
                <br><br>
                <input type="submit" name="btn_retrieve" class="button">

                <div class="container_mid">
                    <h3>DISPLAY DATA HERE</h3>
                    <hr>
                    <div class="wrapper">
                        <h4>ID:
                            <span class="student_data1"><?php echo @$row['stud_id'] ?></span>
                        </h4>
                        <h4>Name:
                            <span class="student_data2"><?php echo @$row['student_name'] ?></span>
                        </h4>
                        <h4>Course:
                            <span class="student_data3"><?php echo @$row['student_course'] ?></span>
                        </h4>
                    </div>
                </div>
            </form>


        </div>

        <div class="three">
            <!-- Right Side-->
            <div class="header">
                <h1>SEARCH DATA FROM DATABASE</h1>
            </div>

            <form method="POST">
                <input type="text" name="txt_search" placeholder="Enter the ID, Name, Course of the Student"
                    class="enterInfo"> <br><br>

                <input type="submit" value="Search" class="button" name="btn_search">

            </form>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Course</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (isset($_POST['btn_search'])) {
                        $search_txt = $_POST['txt_search'];
                        $ret2 = $conn->query("SELECT * FROM `tbl_student` WHERE CONCAT(`stud_id`, `student_name`, `student_course`) LIKE '%$search_txt%' ");

                        while ($fetch_d = $ret2->fetch_array()) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $fetch_d['stud_id']; ?>
                                </td>
                                <td>
                                    <?php echo $fetch_d['student_name']; ?>
                                </td>
                                <td>
                                    <?php echo $fetch_d['student_course']; ?>
                                </td>

                                <td>
                                    <a href="edit_page.php?id=<?php echo $fetch_d['stud_id']; ?>">
                                        <button type="button" class="icon"><ion-icon name="pencil-outline"></ion-icon></button>
                                    </a>
                                </td>
                                <form method="POST" encytype="multipart/form-data"
                                    action="delete_function.php?cd=<?php echo $fetch_d['stud_id']; ?>">
                                    <td>
                                        <button type="submit" name="delete" class="icon"><ion-icon
                                                name="trash-outline"></ion-icon></button>
                                    </td>
                                </form>
                            </tr>

                            <?php
                        }

                    }
                    ?>
                </tbody>
            </table>

        </div>

    </div>



</body>

</html>