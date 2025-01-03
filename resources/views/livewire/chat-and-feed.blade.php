 <div class="">
     {{-- chat card --}}
     <div>
         <div class="card bg-white rounded border shadow-sm flex-grow-1">
             <!-- Header -->
             <h5 class="card-header pt-3 pl-3">Chats</h5>

             <!-- Chat List -->
             <div class="card-body">
                 <a href="{{route('chat')}}" class="text-decoration-none text-dark">
                     <div class="d-flex align-items-center clickable-div py-1  justify-content-start">
                         <img src="https://via.placeholder.com/50" alt="User" class="rounded-circle me-3 mr-3">
                         <div>
                             <strong>Company name</strong>
                             <p class="text-muted small mb-0">Hey, how is your project?</p>
                         </div>
                     </div>
                 </a>
                 <a href="{{route('chat')}}" class="text-decoration-none text-dark">
                     <div class="d-flex align-items-center mb-1 clickable-div py-1  justify-content-start">
                         <img src="https://via.placeholder.com/50" alt="User" class="rounded-circle me-3 mr-3">
                         <div>
                             <strong>Company name</strong>
                             <p class="text-muted small mb-0">Hey, how is your project?</p>
                         </div>
                     </div>
                 </a>
                 <a href="{{route('chat')}}" class="text-decoration-none text-dark">
                     <div class="d-flex align-items-center clickable-div py-1  justify-content-start">
                         <img src="https://via.placeholder.com/50" alt="User" class="rounded-circle me-3 mr-3">
                         <div>
                             <strong>Company name</strong>
                             <p class="text-muted small">Hey, how is your project?</p>
                         </div>
                     </div>
                 </a>
             </div>
         </div>

         <!-- Start New Chat Button -->
         {{-- <div class="bg-white p-3 text-center rounded shadow-sm"
                    style="border-radius: 0 0 .25rem .25rem  !important; margin-top: -5px;">
                    <button class="btn btn-primary w-100 text-light">START NEW CHAT</button>
                </div> --}}
     </div>

     {{-- feed card --}}
     <div class=" card bg-white rounded border shadow-sm mt-3">
         <!-- Header -->
         <h5 class="card-header pt-3">Add to feed</h5>

         <!-- Feed List -->
         <div class="card-body">
             <div class="d-flex align-items-center mb-3">
                 <img src="https://via.placeholder.com/50" alt="Company Logo" class="rounded-circle me-3 mr-3">
                 <div class="flex-grow-1">
                     <a href="#" class="text-dark font-weight-bold">Company name</a>
                     <p class="text-muted small mb-0">Company Major</p>
                 </div>
                 <button class="btn btn-primary btn-sm text-light" x-data ="{state: false}" x-text ="state === false? 'follow': 'following'" @click="state = !state"></button>
             </div>

             <div class="d-flex align-items-center mb-3">
                 <img src="https://via.placeholder.com/50" alt="Company Logo" class="rounded-circle me-3 mr-3">
                 <div class="flex-grow-1">
                     <a href="#" class="text-dark font-weight-bold">Company name</a>
                     <p class="text-muted small mb-0">Company Major</p>
                 </div>
                 <button class="btn btn-primary btn-sm text-light" x-data ="{state: false}" x-text ="state === false? 'follow': 'following'" @click="state = !state"></button>
             </div>

             <div class="d-flex align-items-center ">
                 <img src="https://via.placeholder.com/50" alt="Company Logo" class="rounded-circle me-3 mr-3">
                 <div class="flex-grow-1">
                     <a href="#" class="text-dark font-weight-bold">Company name</a>
                     <p class="text-muted small mb-0">Company Major</p>
                 </div>
                 <button class="btn btn-primary btn-sm text-light" x-data ="{state: false}" x-text ="state === false? 'follow': 'following'" @click="state = !state"></button>
             </div>
         </div>
     </div>
