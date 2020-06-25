<form enctype="multipart/form-data" action="<?=$_SERVER['REQUEST_URI'] ?>" method="post"><!--catwi入力フォーム-->
    <input type="hidden" name="MAX_FILE_SIZE" value="33554432" />
<div id="catwi_form">
  <textarea name="catwi_text" placeholder="Catwiしよう"></textarea>
  <input type="submit" value="送信" class="button">
  <label class="upload_label">
    画像を選択
  <input name="img" type="file" accept=".png, .jpg, .jpeg" required>
  </label>
</div>
</form>
