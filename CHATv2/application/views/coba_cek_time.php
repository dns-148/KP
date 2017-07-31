<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>
		CEK TIME
	</title>

    <script src="<?php echo base_url(); ?>asset/JS/moment.js"></script>
    <script src="<?php echo base_url(); ?>asset/JS/moment-timezone.js"></script>
    <script src="<?php echo base_url(); ?>asset/JS/moment-timezone-with-data.js"></script>
    

</head>

<script>

    var get_tz = moment.tz.guess();
    console.log('mendapatkan zone:' + get_tz);
    var date_now = moment().tz(get_tz).format("YYYY-MM-D hh:mm:ss");
    
    console.log('JAM berdasar zone : ' + date_now);
    console.log(typeof(date_now));
    console.log(typeof(get_tz));

    var server = moment.tz(date_now, get_tz);
    var london = server.clone().tz("Europe/London");
    var date_london = london.format("YYYY-MM-D hh:mm:ss");
    console.log('parse to london :' + date_london);

</script>
<body>
    <?php echo " ".date("Y-m-d h:m:s"); ?>
</body>
</html>