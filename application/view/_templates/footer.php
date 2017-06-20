        	<footer></footer>
        </div>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    	<script type="text/javascript" src="<?=Config::get('URL') ?>js/materialize.min.js"></script>
    	<script type="text/javascript" src="<?=Config::get('URL') ?>js/barcodeFix.js"></script>
    	<?php if ($filename === 'index/search') { ?>
			<script src="<?=Config::get('URL') ?>js/search.js" type="text/javascript"></script>
		<?php } ?>
    </body>
</html>