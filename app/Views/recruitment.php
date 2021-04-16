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
    
    <div class="main_job">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="job_info">
						
						<h1>Thông tin tuyển dụng</h1>
						<h2 class="hidden">Cơ hội nghề nghiệp</h2>
						<div class="job_content"><p style="text-align: justify;" data-mce-style="text-align: justify;">
                            <span style="font-size: 12pt;" data-mce-style="font-size: 12pt;">
                        Năm 2017 đánh dấu cột mốc 35 năm tuổi của thương hiệu Bitis NMC. 
                        Trên suốt chặng hành trình “<em><strong>Nâng niu bàn chân Việt</strong></em>”, 
                        Biti's luôn theo đuổi sự ưu tú, những giá trị bền vững trong từng việc làm và từng sản phẩm, 
                        dịch vụ mang đến khách hàng. Cùng đồng hành với Bitis NMC, chúng tôi tìm kiếm và mang đến cơ hội 
                        cho các bạn trẻ có tư duy năng động, trẻ trung, trách nhiệm, tinh thần học tập và cải tiến liên tục, 
                        luôn cầu thị trong từng công việc và hướng đến việc đóng góp, xây dựng những giá trị tốt đẹp cho cộng đồng, xã hội.
                        </span></p><p><span style="font-size: 12pt;" data-mce-style="font-size: 12pt;"><strong>Mọi thắc mắc vui lòng 
                        liên hệ:</strong>&nbsp;</span><br><span style="font-size: 12pt;" data-mce-style="font-size: 12pt;"><strong>
                        Email:&nbsp;</strong><strong><span style="color: rgb(255, 0, 0);" data-mce-style="color: #ff0000;">
                        <a data-mce-href="mailto:nhansu@bitis.com.vn" href="mailto:nhansu@bitis.com.vn" style="color: rgb(255, 0, 0);" 
                        data-mce-style="color: #ff0000;">nhansu@gmail.com.vn</a></span></strong></span><br><span style="font-size: 12pt;" 
                        data-mce-style="font-size: 12pt;"><strong>SĐT:</strong>&nbsp;(028) 7777777</span><br></p></div>
					</div>
				</div>
				<div class="col-xs-12">
					<div class="job_wrap">
						<div class="block_job">
							<h2>Vị trí tuyển dụng</h2>

								<div class="container-fluid">
									<div class="rec">
											<?php  while ($row = $data['recruitments']->fetch_assoc()) {  
												$recruitmentTitle = Helper::decodeSafe($row['title']);
											?>
												<div class="col-md-1">
													<div class="item">
														<div class="job_number">
															<?=Helper::decodeSafe($row['id'])?>
														</div>
													</div>
												</div>

												<div class="col-md-11">
													<div class="item">
														<div class="info">
															<div class="job_text_title">
																<a href="/tuyen-dung-vi-tri/<?=$row['id']?>/<?=Helper::slug($recruitmentTitle)?>" title="<?=$recruitmentTitle?>">
																	<?=$recruitmentTitle?>
																</a>
															</div>
														</div>
													</div>
												</div>

											<?php } ?>
									</div>

								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>