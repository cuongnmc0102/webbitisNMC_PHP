<form action="/admin/slider/update/<?=$data['slider']['id']?>" method="post" enctype="multipart/form-data">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tiêu đề *</label>
                    <input type="text" class="form-control" value="<?=Helper::decodeSafe($data['slider']['title'])?>" name="title">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Liên kết *</label>
                    <input type="text" class="form-control" value="<?=Helper::decodeSafe($data['slider']['url'])?>" name="url">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Hình ảnh *</label>
                    <input type="file" class="form-control" name="file">
                    <br />
                    <img src="<?=$data['slider']['thumb']?>" style="width: 100px">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Sắp Xếp</label>
                    <input type="number" class="form-control" name="sort" value="<?=$data['slider']['sort_by']?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label>Kích hoạt</label>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="1" name="active" <?=$data['slider']['active'] == 1 ? 'checked=""' : ''?>>
                        <label class="form-check-label">Có</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="0" name="active" <?=$data['slider']['active'] == 0 ? 'checked=""' : ''?>>
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