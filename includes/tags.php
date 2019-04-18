<?php
  use App\classes\Tag;

  $tag = new Tag;
?>

<!-- Tags -->
<div class="row mt-3 bg-white pt-3 pl-3 pb-1 border">
  <h5 class="text-secondary"><i class="fa fa-tags"></i> Tags</h5>
</div>
<div class="row c-tags bg-white p-3 border">

<?php
  $tags = $tag->getTags();
  if ($tags->num_rows > 0) {
    foreach ($tags as $key => $value) {
?>

  <a href="index.php?tagId=<?php echo $value['id']; ?>" class="mr-sm-2 mb-sm-1"><?php echo $value['name']; ?></a>
  
<?php } } ?>

</div>