<html><head><title>UPLOAD</title>
<script type='text/javascript'>
<?php echo view('js/header'); ?>
</script>
</head>
<body style='padding:0px;margin:0px'>
<form id='form' method='POST' enctype='multipart/form-data' action='/pg/upload?iframe=1'>
<?php
    echo view('input/hidden_multi', array('fields' => $_GET));
    echo view('input/file', array(
        'name' => 'file',
        'id' => 'file',
        'attrs' => array('onchange' => 'fileChanged()')
    ));   
?>

<script type='text/javascript'>
var swfupload_id = <?php echo json_encode(get_input('swfupload')); ?>;
var swfupload = window.parent.SWFUpload.instances[swfupload_id];

<?php
    $lastUpload = Session::get('lastUpload');
    if ($lastUpload)
    {
        Session::set('lastUpload', null);
?>
        swfupload.uploadSuccess(null, <?php echo json_encode($lastUpload) ?>);
<?php
    }
?>
function fileChanged()
{
    var form = $('form'),
        file = $('file');

    if (file.value)
    {
        swfupload.uploadProgress();
        form.submit();
    }
}
</script>
</form>
</body>
</html>