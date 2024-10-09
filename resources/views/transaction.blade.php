<!doctype html>
<html lang="en">

<head>
    <title>Giao dịch chuyển tiền</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>

    <main class="container mt-4">
        <h1>Giao dịch chuyển tiền</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif

        {{-- Uncomment if you want to show session error messages --}}
        @if (session('error'))
            <div class="alert alert-primary" role="alert">
                <strong>{{ session('error') }}</strong>
            </div>
        @endif

        <form action="{{ route('start') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="transaction_id" class="form-label">Transaction ID:</label>
                <input type="text" name="transaction_id" id="transaction_id" class="form-control">
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Số tiền:</label>
                <input type="number" name="amount" id="amount" class="form-control">
            </div>

            <div class="mb-3">
                <label for="receiver_account" class="form-label">Số tài khoản người nhận:</label>
                <input type="number" name="receiver_account" id="receiver_account" class="form-control">
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái:</label>
                <select name="status" id="status" class="form-select">
                    <option value="pending" selected>Đang chờ</option>
                    
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Bắt đầu giao dịch</button>
        </form>
    </main>

    <footer class="text-center mt-4">
        <p>&copy; 2024 MyApp. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
