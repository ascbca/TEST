<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Search Cricketers</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #searchResult {
            border: 1px solid #ddd;
            max-height: 200px;
            overflow-y: auto;
        }

        #searchResult div {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
        }

        #searchResult div:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h1>Live Search for Cricketers</h1>
    <input type="text" id="search" placeholder="Search cricketers..." autocomplete="off">
    <div id="searchResult"></div>

    <script>
        $(document).ready(function() {
            // Detect input in the search box
            $('#search').on('keyup', function() {
                var query = $(this).val();  // Get input value
                if (query != "") {
                    $.ajax({
                        url: 'search.php',
                        method: 'POST',
                        data: {query: query},
                        success: function(data) {
                            $('#searchResult').html(data);  // Display result
                        }
                    });
                } else {
                    $('#searchResult').html("");  // Clear results if query is empty
                }
            });

            // Optional: Handle click event on result
            $(document).on('click', '#searchResult div', function() {
                $('#search').val($(this).text());  // Set clicked text to input box
                $('#searchResult').html("");  // Clear results after selection
            });
        });
    </script>
</body>
</html>
