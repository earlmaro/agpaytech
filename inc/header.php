<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Leave Feedback</title>
    <script src="jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
        function validateFile() {
            var csvInputFile = document.forms["frmCSVImport"]["file"].value;
            if (csvInputFile == "") {
                error = "No source found to import. Please choose a CSV file. ";
                $("#response").html(error).addClass("error");;
                return false;
            }
            return true;
        }
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="../test">Precious' Solution</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../test/countries.php">Countries</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../test/currencies.php">Currencies</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <div class="container d-flex flex-column align-items-center">