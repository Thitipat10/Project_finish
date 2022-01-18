<!DOCTYPE html>
<html lang="en">
<?php require_once('include/linkcss.php') ?>
<?php require_once('connection/conn.php') ?>
<?php require_once('connection/connection.php') ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: roboto;

        }

        .material-icons {
            cursor: pointer;
        }

        .invoice-container {
            margin: auto;
            padding: 0px 20px;
        }

        .invoice-header {
            display: flex;
            padding: 70px 0%;
            width: 100%;
        }

        .title {
            font-size: 18px;
            letter-spacing: 3px;
            color: rgb(66, 66, 66);
        }

        .date {
            padding: 5px 0px;
            font-size: 14px;
            letter-spacing: 3px;
            color: rgb(156, 156, 156);
        }

        .invoice-number {
            font-size: 17px;
            letter-spacing: 2px;
            color: rgb(156, 156, 156);
        }


        .space {
            width: 50%;
        }

        table {
            table-layout: auto;
            width: 100%;
        }

        table,
        th,
        td {
            border-collapse: collapse;
        }

        th {
            padding: 10px 0px;
            border-bottom: 1px solid #000;

            font-weight: 400;
            font-size: 13px;
            letter-spacing: 2px;
            color: #000;
            text-align: left;

        }


        td {
            padding: 10px 0px;
            border-bottom: 0.5px solid rgb(226, 226, 226);
            text-align: left;



        }

        .dashed {
            border-bottom: 1px solid rgb(187, 187, 187);
            border-bottom-style: dashed;
        }

        .total {
            font-weight: 800;
            font-size: 20px !important;
            color: black;
        }


        input[type=number] {
            text-align: center;
            max-width: 50px;
            font-size: 15px;
            padding: 10px;
            border: none;
            outline: none;
        }

        input[type=text] {
            max-width: 170px;
            text-align: left;
            font-size: 15px;
            padding: 10px;
            border: none;
            outline: none;
        }

        input[type=text]:focus {
            border-radius: 5px;
            background: #ffffff;
            box-shadow: 11px 11px 22px #d9d9d9,
                -11px -11px 22px #ffffff;
        }

        input[type=number]:focus {
            border-radius: 5px;
            background: #ffffff;
            box-shadow: 11px 11px 22px #d9d9d9,
                -11px -11px 22px #ffffff;
        }

        /*Hide Arrows From Input Number*/
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }


        .float {

            width: 40px;
            height: 40px;
            background-color: #FF1D89;
            color: #FFF;
            border-radius: 100%;
            text-align: center;
            box-shadow:
                0 2.8px 2.2px rgba(0, 0, 0, 0.048),
                0 6.7px 5.3px rgba(0, 0, 0, 0.069),
                0 12.5px 10px rgba(0, 0, 0, 0.085),
                0 22.3px 17.9px rgba(0, 0, 0, 0.101),
                0 41.8px 33.4px rgba(0, 0, 0, 0.122),
                0 100px 80px rgba(0, 0, 0, 0.17);
        }

        .float:hover {
            background-color: #ff057e;
        }

        .plus {
            margin-top: 10px;
        }

        #sum {
            text-align: right;
            width: 100%;
        }

        #sum input[type=text] {
            width: 100%;
            font-size: 33px !important;
            color: black;
            text-align: right !important;

        }

        /* Medium devices (landscape tablets, 768px and up) */
        @media only screen and (min-width: 768px) {
            body {

                color: #000;
            }

            .invoice-container {
                border: solid 1px gray;
                width: 60%;
                margin: 50px auto;
                padding: 40px;
                padding-bottom: 100px;
                border-radius: 5px;
                background: white;
                box-shadow:
                    0 2.8px 2.2px rgba(0, 0, 0, 0.02),
                    0 6.7px 5.3px rgba(0, 0, 0, 0.028),
                    0 12.5px 10px rgba(0, 0, 0, 0.035),
                    0 22.3px 17.9px rgba(0, 0, 0, 0.042),
                    0 41.8px 33.4px rgba(0, 0, 0, 0.05),
                    0 100px 80px rgba(0, 0, 0, 0.07);
            }

            .title-date {
                width: 20%;
            }

            .invoice-number {
                width: 20%;
            }

            .space {
                width: 80%;
            }

            .text-r {
                text-align: right;
            }
        }

        @media print {

            @page {
                size: A4;
                size: landscape;
            }



            .font-bold {
                font-weight: bold;

            }

            body {
                background-color: #000;
            }


        }
    </style>
</head>

<body>
    <?php
    if (isset($_GET['id']) && !empty($_GET['id'])) {


        $id = $_GET['id'];

        $sql = "SELECT * FROM tb_orders  WHERE  OrderID = $id";
        $query = mysqli_query($connection, $sql);
        $result = mysqli_fetch_assoc($query);
    }
    ?>
    <div class="invoice-container">

        <div class="title-date">
            <h2 class="">Sira-on Shop</h2>
            <?php echo $result['OrderDate'] ?>
            <br>
            เลขที่ใบสั่งซื้อ <?php echo $result['OrderID'] ?>
        </div>
        <div class="invoice-body">
            <table>
                <thead>
                    <th class="font-bold">ลำดับ</th>
                    <th style="padding-left:12px;" class="font-bold">รายการ</th>
                    <th class="font-bold">จำนวน</th>
                    <th class="font-bold">ราคา</th>
                    <th class="font-bold" style="text-align: right;">รวม</th>
                </thead>
                <tbody>
                    <?php foreach ($query as $row) { ?>
                        <?php
                        $i = 1;
                        $total = 0;
                        $totalsum = 0;
                        $sqldetail =
                            "SELECT * FROM tb_orders_detail as d 
                            INNER JOIN tb_product as p    ON d.ProductID = p.id_product 
                            INNER JOIN tb_payment_orders as pm  ON d.OrderID = pm.id_order
                            INNER JOIN tb_payment as py  ON pm.id_bank = py.id_payment
                            WHERE d.OrderID = '" . $row['OrderID'] . "' ";
                        $query2 = mysqli_query($connection, $sqldetail);
                        $result2 = mysqli_fetch_assoc($query2);
                        ?>
                        <?php foreach ($query2 as $item) { ?>
                            <tr class="single-row">
                                <td><?php echo $i++;?></td>
                                <td><?php echo $item['title'] ?></td>
                                <td><?php echo number_format($item['price']) ?></td>
                                <td> <?php echo $item['Qty'] ?></td>

                                <td style="text-align: right;"><span class="material-icons">&#3647;<?php echo number_format($item['Qty'] * $item['price']) ?></span></td>
                            </tr>
                            <?php $total += $item['price'] * $item['Qty'] ?>
                        <?php } ?>
                </tbody>
            </table>
            <div style="text-align: right;">ยอดรวมชำระเงิน &#3647;<?php echo number_format($total) ?></div>
        <?php } ?>
        </div>

    </div>
    <script type="text/javascript">
        window.addEventListener("Load", window.print());
    </script>
</body>

</html>