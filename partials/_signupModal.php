<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="signupModalLabel">Signup</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/iDiscuss/partials/_handle_signup.php" method="POST">
        <div class="modal-body">
          <div class="form-group mt-3">
              <label for="signup_email">Email</label>
              <input type="email" class="form-control" id="signup_email" maxlength="56" aria-describedby="emailHelp" placeholder="Enter a Email" name="signup_email" required/>
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group mt-3">
              <label for="signup_password">Password</label>
              <input type="password" class="form-control" id="signup_password" maxlength="32" placeholder="Enter Password" name="signup_password" required/>
          </div>
          <div class="form-group mt-3">
              <label for="signup_confirmpassword">Confirm Password</label>
              <input type="password" class="form-control" id="signup_confirmpassword" maxlength="32" placeholder="Enter Confirm Password" name="signup_confirmpassword" required/>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Signup</button>
        </div>
      </form>
    </div>
  </div>
</div>