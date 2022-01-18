    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script type="text/javascript" src="show.js"></script>
    <?php
    $connection = mysqli_connect("localhost", "root", "", "test");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL:" . mysqli_connect_errno();
        exit();
    } else {
        //echo'success';
    }

    ?>


    <html>
       <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: "Rubik", sans-serif;
        }

        body {
            background-color: #f5f8ff;
        }

        .container {
            background-color: #ffffff;
            width: 60%;
            min-width: 450px;
            position: relative;
            margin: 50px auto;
            padding: 50px 20px;
            border-radius: 7px;
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.05);
        }

        input[type="file"] {
            display: none;
        }

        label {
            display: block;
            position: relative;
            background-color: #025bee;
            color: #ffffff;
            font-size: 18px;
            text-align: center;
            width: 300px;
            padding: 18px 0;
            margin: auto;
            border-radius: 5px;
            cursor: pointer;
        }

        .container p {
            text-align: center;
            margin: 20px 0 30px 0;
        }

        #images {
            width: 90%;

            position: relative;
            margin: auto;
            display: flex;
            justify-content: space-evenly;
            gap: 20px;
            flex-wrap: wrap;
        }

        figure {
            width: 45%;
        }

        img {
            width: 90px;
            height: 90px;
        }

        figcaption {
            text-align: center;
            font-size: 2.4vmin;
            margin-top: 0.5vmin;
        }

     
    </style>

    <head>
        <title>ThaiCreate.Com Tutorial</title>
    </head>

    <body>
        <?php
        if (isset($_POST) && !empty($_POST)) {
            $name = $_POST['name'];

            $sql = "INSERT INTO tb_product (name) VALUES ('$name')";
            $query = mysqli_query($connection, $sql);
            $PROID =  $connection->insert_id;
            if (isset($_FILES["filUpload"])) {
                foreach ($_FILES['filUpload']['tmp_name'] as $key => $val) {

                    $file_type = strrchr($_FILES['filUpload']['name'][$key], ".");
                    $file_name = 'product_' . rand() . $file_type;
                    $file_size = $_FILES['filUpload']['size'][$key];
                    $file_tmp = $_FILES['filUpload']['tmp_name'][$key];
                    $file_type = $_FILES['filUpload']['type'][$key];
                    move_uploaded_file($file_tmp, 'upload/test/' . $file_name);
                    $sql2 = "INSERT INTO tb_image_product (tb_product_id,image) VALUES ('$PROID','$file_name')";
                    $query2 = mysqli_query($connection, $sql2);
                }
                echo "Copy/Upload Complete";
            }
        }


        ?>
        <form name="form1" method="post" action="" enctype="multipart/form-data">
            <div class="container">
                <input type="file" name="filUpload[]" id="file-input" accept="image/png, image/jpeg" onchange="preview()" multiple="multiple">
                <input type="text" name="name">
                <input name="btnSubmit" type="submit" value="Submit">
                <label for="file-input">
                    <i class="fas fa-upload"></i> &nbsp; Choose A Photo
                </label>
                <p id="num-of-files">No Files Chosen</p>
                <div id="images"></div>
            </div>
        </form>
        <script>
            let fileInput = document.getElementById("file-input");
            let imageContainer = document.getElementById("images");
            let numOfFiles = document.getElementById("num-of-files");

            function preview() {
                imageContainer.innerHTML = "";
                numOfFiles.textContent = `${fileInput.files.length} Files Selected`;

                for (i of fileInput.files) {
                    let reader = new FileReader();
                    let figure = document.createElement("figure");
                    let figCap = document.createElement("figcaption");
                    figCap.innerText = i.name;
                    figure.appendChild(figCap);
                    reader.onload = () => {
                        let img = document.createElement("img");
                        img.setAttribute("src", reader.result);
                        figure.insertBefore(img, figCap);
                    }
                    imageContainer.appendChild(figure);
                    reader.readAsDataURL(i);
                }
            }
        </script>

    </body>

    </html>