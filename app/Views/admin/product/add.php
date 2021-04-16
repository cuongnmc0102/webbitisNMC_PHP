<form action="/admin/product/store" method="post" enctype="multipart/form-data">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tên Sản Phẩm *</label>
                    <input type="text" class="form-control" name="title">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Danh Mục *</label>
                    <select class="form-control" name="menu_id">
                        <?php while ($row = $data['menus']->fetch_assoc()) {?>
                            <option value="<?=$row['id']?>"><?=Helper::decodeSafe($row['title'])?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Giá gốc</label>
                    <input type="number" name="price" class="form-control">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Giá giảm</label>
                    <input type="number" name="sale_price" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Mô tả ngắn</label>
                    <textarea class="form-control" name="description"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Mô tả chi tiết</label>
                    <textarea class="form-control" id="content" name="content"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Hình ảnh</label>
                    <input type="file" class="form-control" name="file">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label>Kích hoạt</label>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="1" name="active" checked="">
                        <label class="form-check-label">Có</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="0" name="active" >
                        <label class="form-check-label">Không</label>
                    </div>
                </div>  
            </div>
        </div>
    </div>
    <div class="card-footer">
        <input type="submit" name="add" class="btn btn-info" value="Thêm Mới">
        <button type="submit" class="btn btn-default float-right">Cancel</button>
    </div>
</form>