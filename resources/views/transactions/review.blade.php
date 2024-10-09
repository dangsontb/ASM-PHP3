<!doctype html>
<html lang="en">

<head>
    <title>Review Transaction</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <!-- Navbar here -->
    </header>
    <main class="container mt-4">
        <h1>Review Transaction</h1>

        

        @if (session('completeSuccess'))
            <div class="alert alert-success">
                {{ session('completeSuccess') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session()->has('transaction'))
            <div class="table-responsive">
                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">Tên</th>
                            <th scope="col">Giá trị</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td scope="row">Transaction ID</td>
                            <td>{{ $transaction['transaction_id'] }}</td>
                        </tr>
                        <tr class="">
                            <td scope="row">Số tiền</td>
                            <td>{{  $transaction['amount'] }}</td>
                        </tr>
                        <tr class="">
                            <td scope="row">Số tài khoản</td>
                            <td>{{   $transaction['receiver_account'] }}</td>
                        </tr>
                        <tr class="">
                            <td scope="row">Trạng thái</td>
                            <td>{{   $transaction['status'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            @if (!session('completeSuccess'))
                <form action="{{ route('complete') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-success">Hoàn thành giao dịch</button>
                </form>
                <form action="{{ route('cancel') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger">Hủy giao dịch</button>
                </form>
            @endif

        @else
        @endif
    </main>

    <footer>
        <!-- Footer here -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
