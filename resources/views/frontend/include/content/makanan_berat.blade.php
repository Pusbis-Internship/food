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
        width: 80%;
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
            </div>
        @endforeach

    </div>
</div>

<div id="Myprasmanan" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
...
<script>
    // Function untuk menampilkan modal order
    function showOrderModal(menuName, menuPrice, menuImage, menuId, makanans) {
        var modalContent =
            '<span class="close" onclick="closeOrderModal()">&times;</span>' +
            '<div class="menu_details">' +
            '<img src="' + menuImage + '" alt="Menu Image">' +
            '<div>' +
            '<h2>' + menuName + '</h2>' +
            '<p>Price: ' + menuPrice + '</p>' +
            '<p><strong>Additional Foods:</strong></p>';

        // Tampilkan makanan tambahan
        for (var i = 0; i < makanans.length; i++) {
            modalContent += '<p>' + makanans[i] + '</p>';
        }

        // Cek apakah pengguna masuk atau tidak
        @auth
        modalContent += '<a href="{{ route('addMenu.to.order', ':menuId') }}" class="menu_btn">Order Now</a>'.replace(
            ':menuId', menuId);
    @else
        modalContent += '<a href="{{ route('auth') }}" class="menu_btn">Order Now</a>';
    @endauth

    modalContent += '</div></div>';

    $('#Myprasmanan .modal-content').html(modalContent);
    $('#Myprasmanan').fadeIn(); // Tampilkan modal dengan animasi fade-in
    }

    // Function untuk menutup modal order
    function closeOrderModal() {
        $('#Myprasmanan').fadeOut(); // Tutup modal dengan animasi fade-out
    }

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
        $('.menu_btn_gallery').click(function(event) {
            event.preventDefault(); // Menghentikan perilaku default dari link

            // Menemukan menu_info terdekat dari tombol yang ditekan
            var menuInfo = $(this).closest('.menu_info');

            // Mendapatkan informasi menu yang dipesan
            var menuName = menuInfo.find('h2').text();
            var menuPrice = menuInfo.find('h3').text();
            var menuImage = menuInfo.siblings('.menu_image').find('img').attr('src');
            var menuId = menuInfo.data('menu-id');
            var makanan1 = menuInfo.data('makanan-1');
            var makanan2 = menuInfo.data('makanan-2');
            var makanan3 = menuInfo.data('makanan-3');
            var makanan4 = menuInfo.data('makanan-4');
            var makanan5 = menuInfo.data('makanan-5');
            var makanan6 = menuInfo.data('makanan-6');
            var makanan7 = menuInfo.data('makanan-7');
            var makanan8 = menuInfo.data('makanan-8');

            // Simpan makanan tambahan dalam sebuah array
            var makanans = [makanan1, makanan2, makanan3, makanan4, makanan5, makanan6, makanan7, makanan8];

            // Tampilkan modal untuk memesan makanan
            showOrderModal(menuName, menuPrice, menuImage, menuId, makanans);
        });
    });

    // Event listener untuk menutup modal order saat area di luar modal di klik
    $(window).click(function(event) {
        if ($(event.target).hasClass('modal')) {
            closeOrderModal();
        }
    });
</script>

