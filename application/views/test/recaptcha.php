<html>

<head>
    <title>reCAPTCHA Example</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
</head>

<body>
    <div class="text-danger"><strong><?= $this->session->flashdata('flashError') ?></strong></div>


    <form action="<?php echo site_url('test/recaptchaPost') ?>" method="post">
        <?php echo $widget; ?>
        <?php echo $script; ?>
        <br />
        <input type="submit" value="submit" />
    </form>
</body>

</html>