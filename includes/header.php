<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="<?php print($maincss)?>" rel="stylesheet" type="text/css" />
	<link rel="icon" href="/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <link rel="alternate" href="/events/feed" type="application/rss+xml" title="Events Feed" />
        <link rel="alternate" href="http://twitter.com/statuses/user_timeline/50761169.rss" type="application/rss+xml" title="Twitter" />
        <script type="text/JavaScript" src="/scripts/functions.js"></script>
        <script type="text/JavaScript" src="/scripts/curvycorners.js"></script>
        <script type="text/JavaScript" src="/scripts/banner.js"></script>
        <meta name="description" content="Kingston University's LGBT Society" />
        <meta name="keywords" content="kingston, kingston university, lgbt, kingston lgbt, gay, lesbian, bi, bisexual, trans, transgender" />
        <?php print($extra)?>
	<title><?php print($pagetitleprefix) ?><?php print($pagetitle) ?></title>
        <?php
            if(isset($backgroundcolor))
            {
                print('<style type="text/css">#mainarea{background-color:'.$backgroundcolor.';}</style>');
            } ?>
