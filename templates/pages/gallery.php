<link href="/public/gallery.css" rel="stylesheet">

<div class="gallery">
<?php
$dirname = "uploads/";
$images = glob($dirname."*.*");

foreach($images as $image) {
    echo '<img src="'.$image.'" /><br />';
}
?>
</div>