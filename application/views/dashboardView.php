<?php require_once('headerView.php'); ?>
<div align="center">
    <h1>Dashboard</h1>

    <div>
        <div>
            <table>
                <tr>
                    <td>
                        Email:
                    </td>
                    <td>
                        <?php if($this->session->has_userdata('email')) {
                            echo $this->session->userdata('email');
                        }?> <br>
                    </td>
                </tr>
                <tr>
                    <td>
                        Password:
                    </td>
                    <td>
                        <?php if($this->session->userdata('password')) {
                            echo $this->session->userdata('password');
                        }?> <br>
                    </td>
                </tr>
            </table>
        </div>
        <div>
            <a href="<?php echo base_url('LoginController/logout'); ?>"> Logout </a>
        </div>
    </div>
    <div style="text-align: left">
        <pre>
            <?php print_r($_SERVER); ?>
        </pre>
    </div>
</div>
<?php require_once('footerView.php'); ?>