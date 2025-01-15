<section class="form-section rounded">
    <h5 data-toggle="collapse" data-target="#websitesLinks">
        Websites & Social Links
        <i class="fas fa-caret-down"></i>
    </h5>
    <p>You can add links to websites you want hiring managers to see! Perhaps it will be a link to your
        portfolio, or personal website.</p>
    <div id="websitesLinks" class="collapse">
        <div id="linksContainer">
            <div class="row mb-3 link-block" id="initialLink">
                <div class="form-group col-md-6">
                    <label for="website1" style="min-width: 150px;">Website Name 1</label>
                    <input type="text" class="form-control" placeholder="e.g., LinkedIn, GitHub, Portfolio">
                </div>
                <div class="form-group col-md-6">
                    <label for="link1" style="min-width: 150px;">Link 1</label>
                    <input type="text" class="form-control"
                        placeholder="e.g., https://linkedin.com/in/yourprofile">
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <button class="btn btn-primary rounded" onclick="addLink()">+ Add one more Link</button>
        </div>
    </div>
</section>
