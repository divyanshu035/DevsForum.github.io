
<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">signup Modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="/forums/components/handleSignup.php" method="post">
                    <div class="mb-3">
                        <label for="signupEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="signupEmail" name="signupEmail"
                            aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="Password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="Password" name="Password">
                    </div>
                    <!-- comfirm password -->
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>

                        <input type="Password" class="form-control" id="confirmPassword" name="confirmPassword">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">I am not a Robot</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Signup</button>


                </form>

            </div>

        </div>
    </div>
</div>