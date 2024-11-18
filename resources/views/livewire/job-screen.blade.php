@include('livewire.navigation-bar')

<div>
        <main class="container mt-5">
            <div class="row">
                <section class="col-md-8">
                    <div class="input-group mb-4">
                        <input type="text" class="form-control mr-3" placeholder="Search for a job" aria-label="Search for a job">
                        <div class="input-group-append">
                            <button class="btn custom-btn" type="button">Search</button>
                        </div>
                    </div>
                    <h4 class="mb-4">JOBS FOR YOU</h4>
    
                    <!-- Job Card -->
                    <div class="job-card p-3 bg-white mb-4">
                        <div class="d-flex align-items-center">
                            <img src="https://via.placeholder.com/50" alt="Job Profile" class="rounded-circle">
                            <div class="ml-3">
                                <h5 class="mb-1">Web Developer</h5>
                                <p class="mb-1">Freelance &bull; Remote</p>
                                <p class="mb-0">Looking for skilled developers for various projects. Apply now and get started!</p>
                            </div>
                            <button class="ml-auto more-button btn btn-outline-secondary">More</button>
                        </div>
                    </div>
    
                    <!-- Repeat the job card for more listings -->
                    <div class="job-card p-3 bg-white mb-4">
                        <div class="d-flex align-items-center">
                            <img src="https://via.placeholder.com/50" alt="Job Profile" class="rounded-circle">
                            <div class="ml-3">
                                <h5 class="mb-1">Web Developer</h5>
                                <p class="mb-1">Freelance &bull; Remote</p>
                                <p class="mb-0">Looking for skilled developers for various projects. Apply now and get started!</p>
                            </div>
                            <button class="ml-auto more-button btn btn-outline-secondary">More</button>
                        </div>
                    </div>
                </section>
    
                <aside class="col-md-4">
                    <div class="sidebar mb-4">
                        <h5>Chats</h5>
                        <div class="chat-item d-flex align-items-center mb-2">
                            <img src="https://via.placeholder.com/40" alt="Chat with Company" class="rounded-circle">
                            <div>
                                <p class="mb-0">Company Name</p>
                                <small>Hey, how is your project?</small>
                            </div>
                        </div>
                        <div class="chat-item d-flex align-items-center mb-2">
                            <img src="https://via.placeholder.com/40" alt="Chat with Theresa" class="rounded-circle">
                            <div>
                                <p class="mb-0">Theresa Steward</p>
                                <small>Hi, Dmitry! I have work for you.</small>
                            </div>
                        </div>
                        <button class="btn custom-btn btn-block mt-2" type="button">START NEW CHAT</button>
                    </div>
                    <div class="sidebar">
                        <h5>Add To Your Feed</h5>
                        <div class="feed-item d-flex align-items-center mb-2">
                            <img src="https://via.placeholder.com/40" alt="Company Feed" class="rounded-circle">
                            <div class="flex-grow-1">
                                <p class="mb-0">Company Name</p>
                                <small>Company Major</small>
                            </div>
                            <button class="ml-auto follow-button btn btn-outline-primary">Follow</button>
                        </div>
                        <div class="feed-item d-flex align-items-center mb-2">
                            <img src="https://via.placeholder.com/40" alt="Company Feed" class="rounded-circle">
                            <div class="flex-grow-1">
                                <p class="mb-0">Another Company</p>
                                <small>Different Major</small>
                            </div>
                            <button class="ml-auto follow-button btn btn-outline-primary">Follow</button>
                        </div>
                    </div>
                </aside>
            </div>
        </main>
    
</div>
