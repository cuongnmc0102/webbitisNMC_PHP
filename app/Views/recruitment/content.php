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
					<div class="job_wrap">
						<div class="block_job">
							<h2>Vị trí tuyển dụng: </h2>

								<div class="container-fluid">

									<div class="row">
										<h1><?=Helper::decodeSafe($data['recruitmentdetail']['content'])?></h1>
									</div>

								</div>
						</div>
					</div>
					<div class="">
						<a class="new-style frame-link button-page" 
							data-id=<?=Helper::decodeSafe($data['recruitmentdetail']['id'])?> 
							href="/nop-don-tuyen-dung/<?=Helper::decodeSafe($data['recruitmentdetail']['id'])?>/<?=Helper::slug($data['recruitmentdetail']['title'])?> " >

							Nộp đơn tuyển dụng
						</a>

						
					</div>
				</div>
			</div>
		</div>
    </div>
</div>