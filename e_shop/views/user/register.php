
<?include ROOT. "/layouts/header.php";?>
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <?if($result == true):?>
                    <?echo "You are registered";?>
                <?else:?>
                <?if(isset($errors) && is_array($errors)):?>
                    <ul>
                        <?foreach($errors as $error):?>
                        <li>- <?echo $error;?></li>
                        <?endforeach;?>
                    </ul>
                <?endif;?>

                <div class="login-form"><!--login form-->
                    <h2>Login to your account</h2>
                    <form action="#" >
                        <input type="text" placeholder="Name" />
                        <input type="email" placeholder="Email Address" />
                        <span>
								<input type="checkbox" class="checkbox">
								Keep me signed in
							</span>
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>New User Signup!</h2>
                    <form action="#"method="post">
                        <input type="text" placeholder="name" name="name" value="<?echo $name;?>"/>
                        <input type="email" placeholder="email" name="email" value="<?echo $email;?>"/>
                        <input type="password" placeholder="password" name="password" value="<?echo $password;?>"/>
                        <button type="submit" class="btn btn-default" name="submit">Signup</button>
                    </form>
                </div><!--/sign up form-->
                <?endif;?>
            </div>
        </div>
    </div>

</section><!--/form-->

<?include ROOT. "/layouts/footer.php";?>