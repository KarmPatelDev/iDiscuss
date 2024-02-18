<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="loginModalLabel">Login</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/iDiscuss/partials/_handle_login.php" method="POST">
      <div class="modal-body">
       <div class="form-group mt-3">
        <label for="login_email">Email</label>
        <input type="email" class="form-control" id="login_email" maxlength="56" aria-describedby="emailHelp" placeholder="Enter a Email" name="login_email" required/>
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
       </div>
       <div class="form-group mt-3">
        <label for="login_password">Password</label>
        <input type="password" class="form-control" id="login_password" maxlength="32" placeholder="Enter Password" name="login_password" required/>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
      </form>
    </div>
  </div>
</div>