<?php
	header("Content-Type: text/xml");	
	echo "<?xml version='1.0'?>\n";			
?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:georss="http://www.georss.org/georss">
	<channel>
		<title><![CDATA[<?php echo escape($vars['full_title']); ?>]]></title>
		<link><?php echo escape($vars['canonical_url']); ?></link>
		<?php 
			echo $vars['content'];	
		?>
	</channel>
</rss>