<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {

            background: #d1d5db;
        }

        .height {

            height: 50vh;
        }

        .form {

            position: relative;
        }

        .form .fa-search {

            position: absolute;
            top: 20px;
            left: 20px;
            color: #9ca3af;

        }

        .form span {

            position: absolute;
            right: 17px;
            top: 13px;
            padding: 2px;
            border-left: 1px solid #d1d5db;

        }

        .left-pan {
            padding-left: 7px;
        }

        .left-pan i {

            padding-left: 10px;
        }

        .form-input {

            height: 55px;
            text-indent: 33px;
            border-radius: 10px;
        }

        .form-input:focus {

            box-shadow: none;
            border: none;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="row height d-flex justify-content-center align-items-center">

            <div class="col-md-6">

                <div class="form">
                    <i class="fa fa-search"></i>
                    <input type="text" class="form-control form-input Search" placeholder="Search anything...">
                    <span class="left-pan"><i class="fa fa-microphone"></i></span>
                </div>

            </div>

        </div>
        <div class="row">
            <div class="card">

            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var data = [];

            $(document).on('keyup', '.Search', function() {
                var value = $(this).val().toLowerCase();
                console.log(value);
                filter(value);
            });

            $.ajax({
                url: 'session.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        var apiData = response.apiData;
                        data = JSON.parse(apiData);
                        console.log(data);
                        userdata(data);
                    }
                }
            });

            function userdata(users) {
                var new_card = $('.card').empty();
                var card = `<div class="col-md-6">`;

                $.each(users, function(key, value) {
                    card += `<div>
                        <h2>${value.name}</h2>
                        <p>Username: ${value.username}</p>
                        <p>Email: ${value.email}</p>
                        <p>Company: ${value.company.name}</p>
                        <p>Zipcode: ${value.address.zipcode}</p>
                        <p>Phone: ${value.phone}</p>
                    </div>`;
                });

                card += `</div>`;
                new_card.append(card);  
            }

            function filter(search) {
                const filterdata = data.filter(user =>
                    user.name.toLowerCase().includes(search) ||
                    user.username.toLowerCase().includes(search) ||
                    user.website.toLowerCase().includes(search) ||
                    user.phone.toLowerCase().includes(search) ||
                    user.company.name.toLowerCase().includes(search) ||
                    user.address.city.toLowerCase().includes(search) ||
                    user.address.street.toLowerCase().includes(search) ||
                    user.address.zipcode.toLowerCase().includes(search) ||
                    user.address.suite.toLowerCase().includes(search)
                );
                userdata(filterdata);
            }
        });
    </script>
</body>

</html>