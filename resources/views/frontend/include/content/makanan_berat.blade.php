
<div class="gallary" id="Gallary">
    <h1>Menu<span>Prasmanan</span></h1>
    <div class="gallary_image_box">
        <div class="gallary_card">
            <div class="menu_image">
                <img src="frontend/images/ayam_bakar_1.png" alt="Card image cap">
            </div>
            <div class="menu_info">
                <h2>Food</h2>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi sint eveniet laboriosam</p>
                <h3>Price: $10</h3>
                <br>
                <a href="#" class="menu_btn">Order Now</a>
            </div>
        </div>
        <div class="gallary_card">
            <div class="menu_image">
                <img src="frontend/images/ayam_bakar_1.png" alt="Card image cap">
            </div>
            <div class="menu_info">
                <h2>Food</h2>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi sint eveniet laboriosam</p>
                <h3>Price: $10</h3>
                <br>
                <a href="#" class="menu_btn">Order Now</a>
            </div>
        </div>
        <div class="gallary_card">
            <div class="menu_image">
                <img src="frontend/images/ayam_bakar_1.png" alt="Card image cap">
            </div>
            <div class="menu_info">
                <h2>Food</h2>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi sint eveniet laboriosam</p>
                <h3>Price: $10</h3>
                <br>
                <a href="#" class="menu_btn">Order Now</a>
            </div>
        </div>
        <div class="gallary_card">
            <div class="menu_image">
                <img src="frontend/images/ayam_bakar_1.png" alt="Card image cap">
            </div>
            <div class="menu_info">
                <h2>Food</h2>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi sint eveniet laboriosam</p>
                <h3>Price: $10</h3>
                <br>
                <a href="#" class="menu_btn">Order Now</a>
            </div>
        </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
    $(document).ready(function() {
        $('.gallary_image_box').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        });
    });
</script>
