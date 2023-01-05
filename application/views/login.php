<div class="container">
    <br>
    <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-6" style="border-right: 2px solid gray;">
            <form id="login-user-form">
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <h1>Login</h1>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6">
                        <label>Email Address</label>
                        <input type="text" class="form-control" id="login-email"/>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6">
                        <label>Password</label>
                        <input type="password" class="form-control" id="login-password"/>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <br/>
                        <button class="btn btn-success" onclick="loginUser(event)">Login</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-6">
            <form id="register-user-form">
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <h1>Register</h1>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6">
                        <label>First Name</label>
                        <input type="text" class="form-control" id="register-first-name"/>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6">
                        <label>Last Name</label>
                        <input type="text" class="form-control" id="register-last-name"/>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6">
                        <label>Email Address</label>
                        <input type="text" class="form-control" id="register-email"/>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6">
                        <label>Password</label>
                        <input type="password" class="form-control" id="register-password"/>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6">
                        <label>Phone Number</label>
                        <input type="number" class="form-control" id="register-phone"/>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6">
                        <label>Age</label>
                        <input type="number" class="form-control" id="register-age" min="0"/>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <br/>
                        <button class="btn btn-success" onclick="registerUser(event)">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>