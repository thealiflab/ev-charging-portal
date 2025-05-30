<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=@$title?></title>
    <style>
        body { 
            margin: 0px;
            text-align: center;
        }
        h1, h2, h3 { 
            margin-top: 0; 
            color: #009af4;
        }

        table {
            text-align: center;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
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

        footer{
            padding-top: 100px;
        }

        ul {
            list-style-type: none;
        }

        .admin-links {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 15px;
        }

            .admin-links a {
            text-decoration: none;
            color: purple;
            font-weight: bold;
            transition: color 0.2s;
        }

            .admin-links a:hover {
            color: darkblue;
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

        .mainindexheading{
            padding-top: 50px;
        }


        .button-container {
            text-align: center;
        }

        .button-container .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            font-size: 15px;
            font-weight: bold;
            color: white;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            border-radius: 6px;
            border: none;
            transition: background-color 0.3s ease;
        }

        .button-container .login-btn {
            background-color: #009af4; /* blue shade */
        }

        .button-container .login-btn:hover {
            background-color:rgb(140, 198, 232); /* lighter blue shade on hover */
        }

        .button-container .register-btn {
            background-color: #009af4; /* dark grey shade */
        }

        .button-container .register-btn:hover {
            background-color: rgb(140, 198, 232); /* lighter grey shade on hover */
        }

        /* for login */
        .login-container {
            background-color: #fff;
            padding: 50px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            text-align: center;
            width: 300px;
            }

            .login-container h2 {
            color: #333;
            margin-bottom: 20px;
            }

            .login-container input[type="email"],
            .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            }

            .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            }

            .login-container button:hover {
            background-color: #45a049;
            }

            .back-link {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #4CAF50;
            }

            .back-link:hover {
            text-decoration: underline;
            }

            /* for register */
            .register-container {
                background-color: #fff;
                padding: 30px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                border-radius: 8px;
                text-align: center;
                width: 350px;
                margin: 0 auto;
                font-family: Arial, sans-serif;
                }

                .register-container h2 {
                margin-bottom: 20px;
                color: #333;
                }

                .register-container input,
                .register-container select {
                width: 100%;
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 5px;
                box-sizing: border-box;
                font-size: 14px;
                }

                .register-container button {
                width: 100%;
                padding: 10px;
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 15px;
                transition: background-color 0.3s;
                }

                .register-container button:hover {
                background-color: #45a049;
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