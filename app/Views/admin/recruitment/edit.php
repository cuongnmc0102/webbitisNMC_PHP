<form action="/admin/recruitment/update/<?=$data['recruitment']['id']?>" method="post">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tên vị trí tuyển dụng*</label>
                    <input type="text" class="form-control" value="<?=Helper::decodeSafe($data['recruitment']['title'])?>" name="title">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Mô tả công việc</label>
                    <textarea class="form-control" id="content" name="content"><?=Helper::decodeSafe($data['recruitment']['content'])?></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label>Kích hoạt</label>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="1" name="active" <?=$data['recruitment']['active']  == 1 ? ' checked=""' : ''?>>
                        <label class="form-check-label">Có</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="0" name="active"  <?=$data['recruitment']['active']  == 0 ? ' checked=""' : ''?>>
                        <label class="form-check-label">Không</label>
                    </div>
                </div>  
            </div>
        </div>
    </div>
    <div class="card-footer">
        <input type="submit" name="update" class="btn btn-info" value="Cập Nhật">
        <button type="submit" class="btn btn-default float-right">Cancel</button>
    </div>
</form>