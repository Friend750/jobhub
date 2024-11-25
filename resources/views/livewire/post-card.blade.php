<div>

    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body img {
            max-height: 300px;
            object-fit: cover;
        }

        .image-container {
            position: relative;
            width: 100%;
            min-height: 300px;
            /* Adjust height as needed */
            /* background-image: url('https://via.placeholder.com/600x400'); */
            /* URL of the virtual background image */
            background-size: cover;
            background-position: center;
            border-radius: 10px;
            overflow: hidden;
        }

        .image-container img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 100%;
            max-height: 100%;
            border-radius: 10px;
        }

        .create-post-card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .create-post-card .form-control {
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .create-post-card .btn {
            border-radius: 5px;
            font-size: 14px;
        }
    </style>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-3"></div>

            <div class="col-md-6">

                <div class="create-post-card card mb-3">

                    <div class="card-body d-flex justify-content-center align-items-center">
                        <input type="text" class="form-control w-100 ps-3 bg-light" placeholder="Write something..."
                            data-toggle="modal" data-target="#CreatePostForm">
                        <div class="btn bg-light ms-2 p-2 rounded-circle ml-2" data-toggle="modal"
                            data-target="#CreatePostForm" style="width: 40px; height: 40px;">
                            <i class="bi bi-image"></i>
                        </div>
                    </div>

                </div>

                <!-- Modal -->
                <div class="modal fade" id="CreatePostForm">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <div class="d-flex">
                                    <img src="https://via.placeholder.com/50" alt="User"
                                        class="rounded-circle me-3 mr-3">
                                    <div class="ms-3">
                                        <h5 class="mb-0">Elon Musk</h5>
                                        <div class="dropdown">
                                            <!-- Dropdown Toggle -->
                                            <button class="btn btn-light btn-sm dropdown-toggle" type="button"
                                                id="postAudienceDropdown" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                Post to anyone
                                            </button>

                                            <!-- Dropdown Menu -->
                                            <ul class="dropdown-menu" aria-labelledby="postAudienceDropdown">
                                                <li><a class="dropdown-item" href="#">Post to anyone</a></li>
                                                <li><a class="dropdown-item" href="#">Connections only</a></li>
                                                <li><a class="dropdown-item" href="#">Specific group</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal Body -->
                            <div class="modal-body">
                                <div class="form-group">
                                    <textarea class="form-control w-100" id="postContent" rows="13" placeholder="What do you want to talk about?"></textarea>
                                </div>

                                <div class="d-flex justify-content-between mt-3">
                                    <div>
                                        <button class="btn btn-light"><i class="bi bi-image"></i></button>
                                        <button class="btn btn-light"><i class="bi bi-play-btn"></i></button>
                                    </div>
                                    <button class="btn btn-light">Post</button>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>


                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex">
                                <img src="https://via.placeholder.com/50" alt="User"
                                    class="rounded-circle me-3 mr-3">
                                <div class="ms-3">
                                    <h5 class="mb-0">Elon Musk</h5>
                                    <small class="text-muted">CEO of SpaceX</small>
                                </div>
                            </div>
                            <a href="#"><i class="bi bi-three-dots-vertical p-1"></i></a>

                        </div>
                        <p>You have to match the convenience of the gasoline car in order for people to buy an electric
                            car. "In order to have clean air in cities, you have to go electric.” "You should not show
                            somebody something very cool and then not do it. At Tesla, any prototype that is shown to
                            customers, the production must be better.</p>
                        <div class="image-container">
                            <img src="https://via.placeholder.com/300" alt="Post Image" class="img-fluid rounded w-100">
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <div>
                                <button class="btn btn-light"><i class="bi bi-heart"></i></button>
                                <button class="btn btn-light"><i class="bi bi-chat"></i></button>
                                <button class="btn btn-light"><i class="bi bi-share"></i></button>
                            </div>
                            <button class="btn btn-light"><i class="bi bi-save"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 p-0">
                @livewire('ChatAndFeed')

            </div>
        </div>
    </div>

</div>
