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
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
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
                    <a href="#" class="menu_btn">Order Now</a>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div id="Myprasmanan" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="menu_image">
            <img src="{{ url('storage/menu_images/' . basename($menu->menu_pic)) }}" alt="Menu Image">
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
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

        // Menampilkan pop-up saat tombol "Order Now" ditekan
        $('.menu_btn').click(function(event) {
            event.preventDefault(); // Menghentikan perilaku default dari link

            // Menemukan menu_info terdekat dari tombol yang ditekan
            var menuInfo = $(this).closest('.menu_info');

            // Mendapatkan informasi menu yang dipesan
            var menuName = menuInfo.find('h2').text();
            var menuPrice = menuInfo.find('h3').text();
            

            // Menampilkan pop-up dengan informasi menu
            $('#Myprasmanan .modal-content').html(
                '<span class="close">&times;</span><h2>Order Details</h2><p>Menu: ' + menuName +
                '</p><p>Price: ' + menuPrice + '</p>');
            $('#Myprasmanan').css('display', 'block');
        });
    });

    // Fungsi untuk menutup modal
    function closeModal() {
        $('#Myprasmanan').css('display', 'none');
    }

    // Event listener untuk menutup modal saat tombol close di klik
    $(document).on('click', '.close', function() {
        closeModal();
    });

    // Event listener untuk menutup modal saat area di luar modal di klik
    $(window).click(function(event) {
        if ($(event.target).hasClass('modal')) {
            closeModal();
        }
    });
</script>

