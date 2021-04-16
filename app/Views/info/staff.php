<div class="products">
    <div class="title">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1><?=$data['title']?></h1>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ .'/../admin/errors.php'; ?>

    <div class="cart_content">
        <form action="/nop-ho-so.html" method="post" enctype="multipart/form-data">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Thông Tin Người Tuyển Dụng</h3>

                        <div class="form-group">
                            <label for="">Tên Người Tuyển Dụng *</label>
                            <input type="text" name="name" class="form-control" placeholder="Vui lòng nhập tên Anh/Chị" required>
                        </div>

                        <div class="form-group">
                            <label for="">Vị Trí Ứng Tuyển: </label>
                                         
                            <label name="recruitment_id" value="<?=$data['recruitments']['id']?>" ><?=Helper::decodeSafe($data['recruitments']['title'])?></label>
                        </div>

                        <div class="form-group">
                            <label for="">Số điện thoại *</label>
                            <input type="text" name="phone" class="form-control" placeholder="Vui lòng nhập số đt Anh/Chị" required>
                        </div>

                        

                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Lời giới thiệu ngắn gọn</label>
                            <textarea name="content" class="form-control"></textarea>
                        </div>

                        <div class="input-entry">
                            <label>
                                Ảnh của bạn
                            </label>
                            <div class="input-content" style="align-items: center;-webkit-box-align: center;-ms-flex-align: center;">
                                <label class="label-btn bg-orange">
                                    <input type="file" name="fileinfo" accept=".jpg,.jpeg,.png">
                                </label>
                                
                            </div>
                        </div>

                        
                        <div class="input-entry">
                            <label>
                                Hồ sơ của bạn
                            </label>
                            <div class="input-content" style="align-items: center;-webkit-box-align: center;-ms-flex-align: center;">
                                <label class="label-btn bg-orange">
                                    <input type="file" name="filecv" accept=".xlsx,.xls,.doc,.docx,.pdf,.jpg,.jpeg,.png">
                                </label>
                                
                            </div>
                        </div>

                        <button type="submit" class="send-cv-btn">Nộp hồ sơ</button>
                    </div>

                    <div class="col-md-6">
                        <h3>Thông Tin Liên hệ</h3>
                        <table>
                            <tbody>
                                <tr>
                                    <td><strong>Thông tin liên hệ:</strong></td>
                                    <td>Nguyễn Mạnh Cường</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>cuongtd@bitisnmc.com.vn</td>
                                </tr>
                                <tr>
                                    <td><strong>Điện thoại cố định:</strong></td>
                                    <td>028 7300 2222 máy lẻ 80512</td>
                                </tr>
                                <tr>
                                    <td><strong>Điện thoại di động:</strong></td>
                                    <td>0383693322</td>
                                </tr>
                            </tbody>
                        </table>

                        <h3 class="tt">Thông Tin Tham Khảo</h3>
                        <ul>
                            <li>Tìm hiểu về BITIS NMC <a href="/gioi-thieu">tại đây</a></li>
                            <li>Công việc tuyển dụng tại BITIS NMC <a href="/tuyen-dung.html">tại đây</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>