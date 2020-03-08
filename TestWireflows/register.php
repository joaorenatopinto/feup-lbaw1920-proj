<?php include_once 'header.php' ?>


    <div class="col justify-content-center d-flex">

    <form>
        <div class ="d-flex">
            <input type="text" id="first_name" class="form-control " name="First Name" placeholder="First Name">
            <input type="text" id="last_name" class="form-control " name="Last Name" placeholder="Last Name">
        </div>
        <input type="text" id="email" class="form-control " name="Email" placeholder="Email">

        <input type="text" id="username" class="form-control " name="login" placeholder="login">
        <input type="text" id="password" class="form-control" name="login" placeholder="password">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">
            I have read and accept the <a href="#"> terms and conditions</a>
            </label>
        </div>
        <div class ="d-flex justify-content-around">
            <button type="submit" class="btn btn-primary">Log In</button>
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </form>
    </div>




<?php include_once 'footer.php' ?>
