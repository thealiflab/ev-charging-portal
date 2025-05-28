<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=@$title?></title>
    <style>
        body { 
            margin: 0px;
        }
        nav { 
            background-color: #333; 
            padding: 10px;
            text-align: center;;
        }
        nav a {
            color: white; 
            text-decoration: none; 
            margin: 0 15px;
            font-weight: bold;
        }
        nav a:hover { text-decoration: underline; }

        .container { 
            text-align: center;
            padding: 20px; 
            margin: 50px;
        }
        h1, h2 { margin-top: 0; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table input {
            padding: 4px;
            font-size: 14px;
        }
        td {
            padding: 4px 8px;
            vertical-align: middle;
        }
        th {
            background-color: #f2f2f2;
        }

        .section {
            margin-bottom: 40px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
        }
        form {
            margin: 0 auto;
            width: 400px;
        }
        input[type="submit"] {
            padding: 6px 16px;
            font-weight: bold;
        }

        .success-message{
            color: green;
            text-align: center;
        }

        .fail-message{
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- <nav>
        <a href="index.php">Home</a>
        <a href="submit_task.php">Submit Task</a>
        <a href="task_details.php">Task Details</a>
        <a href="submit_bid.php">Submit Bid</a>
        <a href="#">About</a>
    </nav> -->