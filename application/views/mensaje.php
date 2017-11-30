<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

<script type="text/javascript">
function back(){
		history.back();
}
</script>

<style>
.mensaje{
    border: 3px solid green;
    padding: 1px;
    margin-bottom: 30px;
    text-align: center;
}
</style>

		<div >
			<p class="mensaje"><?php echo $mensaje ?></p>
        </div>
        
        <input type="button" value="Volver" onclick="back()">