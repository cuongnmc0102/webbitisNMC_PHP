<form action="/admin/productslider/update/<?=$data['productslider']['id']?>" method="post" enctype="multipart/form-data">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tên Sản Phẩm *</label>
                    <select class="form-control" name="product_id">
                        <?php while ($row = $data['products']->fetch_assoc()) {?>
                            <option value="<?=$row['id']?>" <?=$data['productslider']['product_id'] == $row['id'] ? 'selected' : ''?>>
                                <?=Helper::decodeSafe($row['title'])?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Hình ảnh</label>
                    <input type="file" class="form-control" name="file">
                    <br />
                    <img src="<?=$data['productslider']['url']?>" width="100px">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label>Kích hoạt</label>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="1" name="active" <?=$data['productslider']['active'] == 1 ? 'checked':''?>>
                        <label class="form-check-label">Có</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="0" name="active" <?=$data['productslider']['active'] == 0 ? 'checked':''?>>
                        <label class="form-check-label">Không</label>
                    </div>
                </div>  
            </div>
        </div>
    </div>
    <div class="card-footer">
        <input type="submit" name="update" class="btn btn-info" value="Update">
        <button type="submit" class="btn btn-default float-right">Cancel</button>
    </div>
</form>