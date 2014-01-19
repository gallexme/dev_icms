<?php
	/*
	 * @author: InyaProduction
	 * @version: 0.1b
	 * @file: index
	 */
	 
	 
	 $coreFileName = "core.php";
	 include_once($coreFileName);
	 Core::getInstance()->run();
if(!isset($_GET['api'])):
?> 
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46290662-4', 'inyaproduction.de');
  ga('send', 'pageview');

</script>
<?php endif;