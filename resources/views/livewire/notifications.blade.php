<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/Layout/notifications.css') }}">
<div class="container mt-4">
    <div class="row">
        <!-- قسم الإحصائيات -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    NOTIFICATIONS
                </div>
                <div class="card-body text-center" >
                    <h1 style="color: #2B6DAE !important;">367</h1>
                    <p>Last Post Views</p>
                    <h1 style="color: #2B6DAE !important;">15</h1>
                    <p>Posts views</p>
                    <h1 style="color: #2B6DAE !important;">9</h1>
                    <p>Profile views</p>
                </div>
            </div>
        </div>

        <!-- قسم الإشعارات -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>Notifications</span>
                    <a href="#" class="text-primary">Mark all as read</a>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Mentions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Unread</a>
                        </li>
                    </ul>
                    <div class="mt-3">
                        <!-- إشعار -->
                        <div class="alert alert-light d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Ashwin Bose</strong> is requesting access to Design File - Final Project.
                                <div>
                                    <button class="btn btn-sm btn-primary">Accept</button>
                                    <button class="btn btn-sm btn-secondary">Decline</button>
                                </div>
                            </div>
                            <span>15h</span>
                        </div>
                        <!-- إشعارات أخرى -->
                        <div class="alert alert-light">
                            <strong>Patrick</strong> added a comment on Design Assets - Smart Tags file: "Looks perfect, send it for technical review tomorrow!"
                            <span class="float-right">15h</span>
                        </div>
                        <div class="alert alert-light">
                            <strong>Samantha</strong> has shared a file with you
                            <span class="float-right">14h</span>
                        </div>
                        <div class="alert alert-light">
                            <strong>Steve and 8 others</strong> added comments on Design Assets - Smart Tags file
                            <span class="float-right">15h</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>