@include('livewire.navigation-bar')
<head><link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/companylist.css') }}">
    </head>
<br>
<br>
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-4 bg-light p-4 containerOfMyNetwork">
            <h5>Manage My Network</h5>
            <br>
            <ul class="list-unstyled">
                <li><strong>Following</strong> 1000</li>
                <br>
                <li>Followers 200</li>
                <br>
                <li>Companies 30</li>
            </ul>
        </div>
        <div class="col-md-8">
            <h5>Companies</h5>
            <ul class="list-group">
                @foreach($companies as $company)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="https://placehold.co/50x50" alt="Company Logo" class="mr-3">
                        <div>
                            <strong>{{ $company['name'] }}</strong><br>
                            {{ number_format($company['id']) }} followers
                        </div>
                    </div>
                    <button class="btn btn-outline-primary">Following</button>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
