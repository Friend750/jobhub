@include('livewire.navigation-bar')
<div class="container mt-4 col-8">
    <div class="row">
        <!-- قسم الإحصائيات -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-secondary">
                   NOTIFICATIONS
                </div>
                <div class="card-body text-center" >
                    <h1 >367</h1>
                    <p>Last Post Views</p>
                    <h1 >15</h1>
                    <p>Posts views</p>
                    <h1 >9</h1>
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
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Interests</h5>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active text-dark" id="tab1-tab" data-toggle="tab"
                                   href="#All" role="tab" aria-controls="tab1" aria-selected="true">
                                   All
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-dark" id="tab2-tab" data-toggle="tab"
                                   href="#Mentions" role="tab" aria-controls="Mentions" aria-selected="false">
                                   Mentions
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-dark" id="tab3-tab" data-toggle="tab"
                                   href="#Unread" role="tab" aria-controls="Unread" aria-selected="false">
                                   Unread
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="myTabContent">
                            <!-- محتوى التبويبة 1 -->
                            <div class="tab-pane fade show active text-center" id="All" role="tabpanel" aria-labelledby="tab1-tab">
                                 <!-- إشعار -->
                        <div class="alert alert-light d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Ashwin Bose</strong> is requesting access to Design File - Final Project.
                                <div>
                                    <button class="btn btn-sm blue">Accept</button>
                                    <button class="btn btn-sm ">Decline</button>
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
                            <!-- محتوى التبويبة 2 -->
                            <div class="tab-pane fade text-center" id="Unread" role="tabpanel" aria-labelledby="tab3-tab">
                                <div>
                                    <h6>محتوى التبويبة الثالث</h6>
                                    <p>هذا هو النص داخل التبويبة الثالثة</p>
                                </div>
                            </div>

                            <div class="tab-pane fade text-center" id="Mentions" role="tabpanel" aria-labelledby="tab2-tab">
                                <div>
                                    <h6>محتوى التبويبة الثانية</h6>
                                    <p>هذا هو النص داخل التبويبة الثانية</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

