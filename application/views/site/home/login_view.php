<div id="container">
    <h2><?=$judul;?></h2>
    <form action="<?=$action;?>" method="POST">
        <ul>
            <li>
                <label>Username</label>
                <div>
                    <input type="text" id="user_id" name="user_id" placeholder="User ID" required />
                </div>
            </li>
            <li>
                <label>Password</label>
                <div>
                    <input type="password" id="password" name="password" placeholder="Password" required />
               </div>
            </li>
            <li>
                <div>
                    <input type="submit" name="submit" value="Login" />
                    <input type="reset" name="reset" value="Reset" />
                </div>
            </li>
            <li>
                <div>
                    <?php 
                        if($this->session->flashdata('login_error'))
                        {
                            echo 'You entered an incorrect username or password';
                        }
                        echo validation_errors();?>
                </div>
            </li>
        </ul>
    </form>
</div>

