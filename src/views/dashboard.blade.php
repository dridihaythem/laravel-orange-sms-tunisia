<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ORANGE SMS TUNISIA Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="https://github.com/dridihaythem/laravel-orange-sms-tunisia">Github</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://api.whatsapp.com/send/?phone=21629175235">Contact Me</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-2">

        <div class="text-end mb-3 @if ($availableUnits > 0) text-success @else text-danger @endif "
            style="font-size: 20px">
            <Strong>{{ $availableUnits }}</Strong> SMS units available
        </div>

        @if (!$log_enabled)
            <div class="alert alert-danger" role="alert">
                <strong>Warning!</strong> SMS logs are disabled, you can enable it by setting
                <strong>ORANGE_SMS_TUNISIA_ENABLE_LOG</strong>
                to <strong>true</strong> in your .env file.
            </div>
        @endif

        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                SMS Logs
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Message</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                            <tr>
                                <td>{{ $log->phone_number }}</td>
                                <td>{{ $log->message }}</td>
                                <td>
                                    @if ($log->success)
                                        <span class="badge text-bg-success">Success</span>
                                    @else
                                        <span class="badge text-bg-danger">Failed</span>
                                    @endif
                                </td>
                                <td>{{ $log->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    <div class="d-flex justify-content-center">
                        <ul class="pagination">
                            @if ($logs->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">&laquo;</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a href="{{ $logs->previousPageUrl() }}" class="page-link"
                                        rel="prev">&laquo;</a>
                                </li>
                            @endif

                            @foreach ($logs->getUrlRange(1, $logs->lastPage()) as $page => $url)
                                <li class="page-item {{ $logs->currentPage() == $page ? 'active' : '' }}">
                                    <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                </li>
                            @endforeach

                            @if ($logs->hasMorePages())
                                <li class="page-item">
                                    <a href="{{ $logs->nextPageUrl() }}" class="page-link" rel="next">&raquo;</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">&raquo;</span>
                                </li>
                            @endif
                        </ul>
                    </div>

                </div>

            </div>
        </div>

    </div>
</body>

</html>
