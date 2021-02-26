<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Vprotect India : Sis Prosegur Alarm Monitoring And Response 
Services Private Limited</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            } 

            .title {
                font-size: 70px;
            }

            th, td {
            padding: 15px;
            }
        </style>
    </head>
    <body> 
                    <h1>User Login Details</h1>

                <table style="width:100%">
                <tr>
                    <th>Name</th>
                    <th>Mobile</th> 
                    <th>Email</th>
                    <th>Customer Code</th>
                    <th>Password</th>
                </tr>
                <tr>
                    <td>{{ $user['name'] }}</td>
                    <td>{{ $user['mobile'] }}</td> 
                    <td>{{ $user['email'] }}</td>
                    <td>{{ $user['customer_code'] }}</td> 
                    <td>{{ $user['pass'] }}</td>
                </tr>
                
                </table>
                <h3><a href="https://crm.vprotectindia.com"></a></h3>
    </body>
</html>
