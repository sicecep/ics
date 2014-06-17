
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/style-login.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/style-notif.css" />
    
        <div class="main">		
            <div class="box">
                <?php if ( $this->session->flashdata( 'message' ) ) : ?>
    <p><?php echo $this->session->flashdata( 'message' ); ?></p>
<?php endif; ?>
                <div align="center">
                <img src="<?php echo base_url(); ?>/images/logo.png" />
                </div>

                <div class="form">   
                    <form id="login-form" action="<?php echo base_url(); ?>index.php/main/login" method="post">
                    <fieldset>
                        <div class="row">
                            <label for="LoginForm_username" class="required">Username <span class="required">*</span></label>
                            <br />
                            <input class="login" placeholder="Username" name="username" id="username" type="text" size="100" />	
                            <?php echo form_error( 'username' ); ?>
                        </div>

                        <div class="row">
                            <label for="LoginForm_password" class="required">Password <span class="required">*</span></label> 
                            <br />
                            <input class="password" placeholder="Password" size="100" name="password" id="password" type="password" />
                            <?php echo form_error( 'password' ); ?>
                            <p class="forgot" size="150">
                                <!--Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.-->
                            </p>
                        </div>

                        <div class="row rememberMe"></div>

                        <div class="row">
                            <input type="submit" name="login" id="login" value="Login" />
                        </div>
                    </fieldset>
                    </form>
                </div><!-- form -->

            </div>
        </div>
  