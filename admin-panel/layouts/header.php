<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/custom.css">
    <title>Admin Panel</title>
</head>

<body>
    <div id="myAlert">
        <div class="myAlert-text-icon">
            <div class="myAlert-message">
                Message here
            </div>
            <button class="close" onclick="hideAlert()">
                <i class='bx bx-x'></i>
            </button>
        </div>
        <div id="myAlertProgress">
            <div id="myAlertBar"></div>
        </div>
    </div>




    <header class="container-fluid bg-dark text-white">
        <div class="container py-2 text-center">
            <div class="row">
                <div class="col">User Name</div>
                <div class="col">
                    <a href="index.php">
                        Dashboard
                    </a>
                </div>
                <div class="col">Change Password</div>
                <div class="col">Logout</div>
                <div class="col">Profile</div>
            </div>
        </div>
    </header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 p-0 bg-primary text-white" style="min-height: 100vh;">
                <ul id="sideMenu">
                    <li>
                        <i class="far fa-window-maximize"></i>
                        News
                        <i class="fas fa-sort-down"></i>
                        <ul class="child bg-dark">
                            <li>
                                <a href="add-news.php">
                                    Add
                                </a>
                            </li>
                            <li>
                                <a href="view-news.php">
                                    View
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>