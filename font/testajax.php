
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script type="text/javascript" src="show.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js" integrity="sha512-d5Jr3NflEZmFDdFHZtxeJtBzk0eB+kkRXWFQqEc1EKmolXjHm2IKCA7kTvXBNjIYzjXfD5XzIjaaErpkZHCkBg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>


        <button class="btn btn-danger" id="test" value="sdsdsd" onclick="test()">
            testasdsad

        </button>

        <div id="resultsumtotal"></div>
        <div id="filter_data"></div>
        <script>
            function test() {
                var date = $('#test').val();
                load_data();

                function load_data(query) {
                    $.ajax({
                        url: "ajaxtest.php",
                        method: "post",
                        data: {
                            query: query,
                            date: date
                        },
                        success: function(data) {
                            $('#filter_data').html(data);
                         
                        }
                    });
                }
            }
        </script>
        <!-- <script>
            function test() {
                var date = $('#test').val();

                $.ajax({
                    url: 'ajaxtest.php',
                    method: 'POST',
                    data: {
                        date: date
                    },


                    success(data) {
                        // console.log(date)
                        $('#resultsumtotal').html(date);
                    }

                });
            }
        </script> -->

        <!-- <script>
            $(document).ready(function() {
                $('#test').change(function() {
                    var date = $('#test').val();
                    $.ajax({
                        url: 'chart.php',
                        method: 'POST',
                        data: {
                            date: date


                        },


                        // success(data) {
                        //     $('#resultsumtotal').html(data);
                        // }

                    });

                    console.log(data);
                });

            });
        </script> -->
    </body>

    </html>