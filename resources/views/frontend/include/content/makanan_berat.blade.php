<style>
    /* CSS for modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 60%;
        /* Ubah lebar menjadi 60% */
        height: 68%;
    }

    .modal-content img {
        max-width: 100%;
        max-height: 80vh;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* Style for the Order Now button */
    .menu_btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
    }

    .menu_btn:hover {
        background-color: #0056b3;
    }

    .modal-content img {
        max-width: 50%;
        max-height: 40%;
        /* Mengatur tinggi maksimum gambar */
        display: block;
        /* Menghilangkan spasi ekstra */
    }

    /* Tambahkan gaya CSS untuk mengatur posisi menu-foods */
    .menu-image-and-foods {
        display: flex;
        align-items: flex-start;
    }

    .menu-image-and-foods img {
        max-width: 50%;
        /* Lebar gambar maksimum */
        max-height: 100%;
        /* Tinggi gambar maksimum */
    }

    #menu-foods {
        margin-left: 20px;
        /* Atur jarak antara gambar dan daftar makanan */
        padding: 0;
        list-style-type: none;
    }

    #menu-foods li {
        margin-bottom: 5px;
        /* Atur jarak antara setiap item makanan */
    }
</style>




<div class="gallary" id="Gallary">
    <h1>Menu<span>Prasmanan</span></h1>
    <div class="gallary_image_box owl-carousel">
        @foreach ($prasmanans as $menu)
            <div class="gallary_card">
                <div class="menu_image">
                    <img src="{{ url('storage/menu_images/' . basename($menu->menu_pic)) }}" alt="Menu Image">
                </div>
                <div class="menu_info">
                    <h2>{{ $menu->menu_name }}</h2>
                    @if ($menu->reviews->count() > 0)
                        <div class="rating">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $menu->averageRating())
                                    <i class="icon-star-full"></i>
                                @else
                                    <i class="icon-star-empty"></i>
                                @endif
                            @endfor
                            <span>{{ number_format($menu->averageRating(), 1) }}</span>
                        </div>
                    @else
                        <div class="rating">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="icon-star-empty"></i>
                            @endfor
                            <span>0</span>
                        </div>
                    @endif
                    <small>{{ $menu->seller }}</small>
                    <h3>Rp. {{ number_format($menu->menu_price, 0, ',', '.') }}</h3>
                    <br>
                    <a href="#" class="menu_btn menu_btn_gallery">Order Now</a>
                    <!-- Tambahkan kelas menu_btn_gallery -->
                </div>
                <!-- Tambahkan bagian untuk menampilkan makanan -->
                <div class="menu_foods">
                    <ul hidden>
                        <li>{{ $menu->makanan_1 }}</li>
                        <li>{{ $menu->makanan_2 }}</li>
                        <li>{{ $menu->makanan_3 }}</li>
                        <li>{{ $menu->makanan_4 }}</li>
                        <li>{{ $menu->makanan_5 }}</li>
                        <li>{{ $menu->makanan_6 }}</li>
                        <li>{{ $menu->makanan_7 }}</li>
                        <li>{{ $menu->makanan_8 }}</li>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div id="Myprasmanan" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="menu-details">
            <div class="menu-image-and-foods">
                <img src="" alt="Menu Image" id="menu-image">
                <ul id="menu-foods"></ul>
            </div>
            <div class="menu-info">
                <h2 id="menu-name"></h2>
                <br>
                <h3 id="menu-price"></h3>
                @auth
                <a href="{{ route('addMenu.to.order', $menu->id) }}" class="menu_btn">Order Now</a>   
                @endauth
                @guest
                <a href="{{ route('auth') }}" class="menu_btn">Order Now</a> 
                @endguest
                <p id="menu-desc"></p>
            </div>
        </div>
    </div>
</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
...
<script>
    document.addEventListener("DOMContentLoaded", function() {
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

        // Event listener for opening modal when "Order Now" button is clicked
        $('.menu_btn_gallery').click(function(event) {
            event.preventDefault(); // Prevent the default behavior of the link

            var $menuCard = $(this).closest('.gallary_card');
            var menuName = $menuCard.find('.menu_info h2').text();
            var menuPrice = $menuCard.find('.menu_info h3').text();
            var menuDesc = $menuCard.find('.menu_info p').text();
            var menuImage = $menuCard.find('.menu_image img').attr('src');
            var foods = [];

            // Get food items
            for (var i = 1; i <= 8; i++) {
                var food = $menuCard.find('.menu_foods li:nth-child(' + i + ')').text();
                if (food) {
                    foods.push(food);
                }
            }


            // Set modal content
            $('#menu-name').text(menuName);
            $('#menu-price').text(menuPrice);
            $('#menu-desc').text(menuDesc);
            $('#menu-image').attr('src', menuImage);

            // Set food items
            var $menuFoods = $('#menu-foods');
            $menuFoods.empty();
            foods.forEach(function(food, index) {
                $menuFoods.append('<li>Menu ' + (index + 1) + ': ' + food + '</li>');
            });

            // Show the modal
            $('#Myprasmanan').fadeIn(); // Show modal with fade-in animation
        });

        // Event listener for closing modal when the close button is clicked
        $('.close').click(function() {
            $('#Myprasmanan').fadeOut(); // Close modal with fade-out animation
        });

        // Event listener for closing modal when clicked outside the modal
        $(window).click(function(event) {
            if ($(event.target).hasClass('modal')) {
                $('#Myprasmanan').fadeOut(); // Close modal with fade-out animation
            }
        });
    });
</script>
