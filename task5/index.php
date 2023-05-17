<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculties</title>
    <link rel="stylesheet" href="./index.css">
</head>
<body>
    <?php
        $conn = mysqli_connect("localhost", "root", "", "task5_faculties");
        $getQ = "SELECT * FROM faculties";
        $getQRun = $conn->query($getQ);
        $getQCount = mysqli_num_rows($getQRun);
    ?>
    <div id="box">
        <div class="top">
            <p onclick="window.location='./';">Faculties</p>
        </div>

        <div class="bottom">
            <div class="b1" id="b1">
                <div style="text-align:left;"><p>Total Record(s): <b><?php echo $getQCount ?></b></p></div>
                <div style="text-align:right;"><button name="addnew" id="addnew">Add New</button></div>
            </div>

            <br>

            <div class="b2" id="b2">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Short Name</th>
                        <th>Code</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        while($f = $getQRun->fetch_assoc()){
                            ?>
                            <tr>
                                <td><?php echo $f['id']; ?></td>
                                <td><?php echo $f['fname']; ?></td>
                                <td><?php echo $f['fshortname']; ?></td>
                                <td><?php echo $f['fcode']; ?></td>
                                <td>
                                    <form action="" method="POST">
                                        <input type="text" name="fID" id="fID" value="<?php echo $f['id']; ?>" required readonly hidden>
                                        
                                        <input type="submit" name="edit" id="edit" value="Edit">
                                        <input type="submit" name="delete" id="delete" value="Delete">
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                </table>
            </div>

        </div>
    </div>

    <div class="b3" id="b3">
        <form action="" method="POST">
            <input type="text" name="fName" id="fName" placeholder="Enter faculty name" required>
            <input type="text" name="fShortName" id="fShortName" placeholder="Enter faculty's short name" required>
            <input type="number" name="fCode" id="fCode" placeholder="Enter faculty code" required>

            <input type="submit" name="add" id="add" value="Add">
        </form>
    </div>

    <?php
        if(isset($_POST['add'])){
            $name = $_POST['fName'];
            $shortname = $_POST['fShortName'];
            $code = $_POST['fCode'];

            $addQ = "INSERT INTO faculties(fname, fshortname, fcode) VALUES('$name', '$shortname', '$code')";
            $addQRun = $conn->query($addQ);
            ?>
            <script>
                alert("Faculty Added");
                window.location.replace("./");
            </script>
            <?php
        }
    ?>

    <?php
        if(isset($_POST['delete'])){
            $fID = $_POST['fID'];
            $delQ = "DELETE FROM faculties WHERE id = '$fID'";
            $delQRun = $conn->query($delQ);
            ?>
            <script>
                alert("Faculty Deleted");
                window.location.replace("./");
            </script>
            <?php
        }
    ?>

    <?php
        if(isset($_POST['edit'])){
            $fID = $_POST['fID'];
            $findQ = "SELECT * FROM faculties WHERE id = '$fID'";
            $findQRun = $conn->query($findQ);
            $fac = $findQRun->fetch_assoc();
            ?>
            <div class="b4" id="b4">
                <form action="" method="POST" style="display:flex; flex-direction:column; width:500px;">
                    <input type="text" name="fid" id="fid" value="<?php echo $fID; ?>" required style="margin: 1px; padding: 2px;">
                    <input type="text" name="fname" id="fname" placeholder="Enter faculty name" value="<?php echo $fac['fname']; ?>" required style="margin: 1px; padding: 2px;">
                    <input type="text" name="fShortName" id="fShortName" placeholder="Enter faculty's short name" value="<?php echo $fac['fshortname']; ?>" required style="margin: 1px; padding: 2px;">
                    <input type="number" name="fCode" id="fCode" value="<?php echo $fac['fcode']; ?>" placeholder="Enter faculty code" required style="margin: 1px; padding: 2px;">

                    <input type="submit" name="update" id="update" value="Update">
                </form>
            </div>
            <?php
        }

        if(isset($_POST['update'])){
            $facID = $_POST['fid'];
            $facName = $_POST['fname'];
            $facShortname = $_POST['fShortName'];
            $facCode = $_POST['fCode'];

            $updQ = "UPDATE faculties SET fname = '$facName', fshortname = '$facShortname', fcode = '$facCode'";
            $updQRun = $conn->query($updQ);

            ?>
            <script>
                alert("Faculty Updated");
                window.location.replace("./");
            </script>
            <?php
        }
    ?>

    <script>
        document.getElementById('addnew').addEventListener("click", function(){
            document.getElementById("b2").style.display = "none";
            document.getElementById("b3").style.visibility = "visible";
        });
    </script>
</body>
</html>