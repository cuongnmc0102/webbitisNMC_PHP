<div class="product_content">
    <div class="contaier-fluid">
        <div class="row">
            <div class="col-md-5">
                <div>
                    <img id="productImg" src="<?=$data['product']['thumb']?>" alt="">
                </div>
                <?php while ($row = $data['sliders']->fetch_assoc()) {?>
                    <img src="<?=$row['url']?>" class="thumb">
                <?php } ?>
            </div>
            <div class="col-md-7">
                <h1><?=$data['title']?></h1>

                <div class="gold">
                    <?=price($data['product']['price'], $data['product']['sale_price'])?>
                </div>

                <div class="description">
                    <?=Helper::decodeSafe($data['product']['description'])?>
                </div>

                <div class="cart">
                    <form action="/them-gio-hang/<?=$data['product']['id']?>" method="post">
                        <div class="row">
                            <div class="col-6">
                                <input type="number" value="1" name="number" class="form-control">
                            </div>

                            <div class="col-4">
                                <input type="submit" name="addCart" value="Thêm Vào Giỏ Hàng" class="btn btn-success">
                            </div>
                        </div>
                    </form>
                </div>

                <div class="size">
                    <ul>
                        <li>Kích thước: </li>
                        
                        <span data-value="39" class="title title-2 swatch-element  available">
			                    39
	                    </span>
                        
                        <span data-value="40" class="title title-2 swatch-element  available">
			                    40
	                    </span>
                        <span data-value="41" class="title title-2 swatch-element  available">
                                41
                        </span>
                        <span data-value="42" class="title title-2 swatch-element  available">
                                42
                        </span>
                        <span data-value="43" class="title title-2 swatch-element  available">
                                43
                        </span>
                        <span data-value="44" class="title title-2 swatch-element  available">
                                44
                        </span>
                        <span data-value="45" class="title title-2 swatch-element  available">
                                45
                        </span>
                    </ul>
                </div>

                <div class="share">
                    <ul>
                        <li>Share: </li>
                        <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http://php-09-11.vtest/san-pham/51/sandal-si-eva-phun-be-trai-e10"><i class="fab fa-facebook-square"></i></a></li>
                        <li><a target="_blank" href=""><i class="fab fa-twitter-square"></i></a></li>
                        <li><a href=""><i class="fab fa-facebook-messenger"></i></a></li>
                        <li><a href=""><i class="fas fa-mail-bulk"></i></a></li>
                        <li><a href=""><i class="fab fa-instagram-square"></i></a></li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <article class="content_full">
                    <h5>Chi Tiết Sản Phẩm</h5>
                    <?=Helper::decodeSafe($data['product']['content'])?>
                </article>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="content_full">
                    <h5>Có Thể Bạn Thích</h5>
                </div>
            </div>


            <?php  while ($row = $data['productMores']->fetch_assoc()) {  
                
                $productTitle = Helper::decodeSafe($row['title']);
            ?>
                <div class="col-md-4">
                    <div class="item">
                        <div class="image">
                            <a href="/san-pham/<?=$row['id']?>/<?=Helper::slug($productTitle)?>" title="<?=$productTitle?>">
                                <img src="<?=$row['thumb']?>">
                            </a>
                        </div>
                        <div class="info">
                            <a href="/san-pham/<?=$row['id']?>/<?=Helper::slug($productTitle)?>" title="<?=$productTitle?>">
                                <?=$productTitle?>
                            </a>
                            <div class="price">
                                <p><?=price($row['price'], $row['sale_price'])?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
          
        </div>
    </div>
</div>

