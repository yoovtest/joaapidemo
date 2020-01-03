<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <title>Document</title>
    <style>
        .token-info-table tr > td:first-child {
            text-align: right;
            white-space: nowrap;
        }

        .token-info-table tr > td:nth-child(2) > div {
            word-wrap:break-word;
            width:100%;
            max-width:1000px;
            white-space: nowrap;
            overflow-x: scroll;
            /*text-overflow:ellipsis;*/
        }

    </style>
</head>
<body>
    <div class="container-fluid mt-1">
        <div class="row">
            <div class="col-sm-12">
                <div class="m-1">
                    @if(isset($accessToken))
                        <a href="/logout" class="btn btn-outline-primary">
                        Logout
                        </a>
                    @else
                        <a href="/" class="btn btn-outline-primary">
                        Login
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if(isset($accessToken))
        <div class="card m-3">
        <div class="card-body p-0">
            <h5 class="card-title p-2 bg-primary text-white">Access Token</h5>
                <table class="table-bordered table table-striped token-info-table">
                    <tr>
                        <td>Access Token</td>
                        <td>
                            <div>
                                {{ $accessToken }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Refresh Token</td>
                        <td>
                            <div>
                                {{ $refreshToken }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Expired In</td>
                        <td>{{ $expiredIn }}</td>
                    </tr>
                    <tr>
                        <td>Expired</td>
                        <td>{{ $expired ? 'yes' : 'no' }}</td>
                    </tr>
                </table>
            </h5>
        </div>
    </div>
        <div class="card m-3">
        <div class="card-body p-0">
            <h5 class="card-title p-2 bg-secondary text-white">Team List</h5>
                <table class="table table-striped table-bordered">
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Short Name</td>
                        <td>Code</td>
                        <td>Contact</td>
                        <td>Max Employees</td>
                        <td>Total Employees</td>
                    </tr>
                    @foreach($teams as $team)
                        <tr>
                        <td>{{ $team['id'] }}</td>
                        <td>{{ $team['name'] }}</td>
                        <td>{{ $team['shortName'] }}</td>
                        <td>{{ $team['code'] }}</td>
                        <td>{{ $team['contact'] }}</td>
                        <td>{{ $team['maxEmployees'] }}</td>
                        <td>{{ $team['totalEmployees'] }}</td>
                    </tr>
                    @endforeach
                </table>
            </h5>
        </div>
    </div>
    @endif

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
          integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
          crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
          integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
          crossorigin="anonymous"></script>
</body>
</html>
