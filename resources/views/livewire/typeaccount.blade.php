<head><link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/typeaccount.css') }}">
    </head>
<div class="container mt-5">
    <div class="container mt-5">
        <h2>What is your account?</h2>
        <p>Select whether your account will be for a company or  a personal account</p>
        <hr>
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="accountType" id="personal" value="personal" checked>
                    <label class="form-check-label" for="personal">
                        Personal
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="accountType" id="company" value="company">
                    <label class="form-check-label" for="company">
                        Company
                    </label>
                </div>
            </div>
            <button class="btn btn-primary">Next ➔</button>
        </div>
    </div>