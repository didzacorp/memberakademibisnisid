<!DOCTYPE html>
<html lang="en" class="error_page">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Access Rejected</title>
		<!-- Bootstrap framework -->
             <link rel="stylesheet" href="<?php echo get_themes()?>/bootstrap/css/bootstrap.min.css" />
            <link rel="stylesheet" href="<?php echo get_themes()?>/bootstrap/css/bootstrap-responsive.min.css" />
			
		<!-- main styles -->
           <link rel="stylesheet" href="<?php echo get_themes()?>/css/style.css" />
			
			
            
	</head>
	<body>

		<div class="error_box">
			<h1>Blocked</h1>
			<p>You can't access this page.</p>
			<a href="<?= base_url()?>" class="back_link btn btn-small">Go Home</a>
		</div>

	</body>
</html>