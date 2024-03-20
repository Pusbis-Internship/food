<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />

<style>
    .gallary {
        width: 100%;
        padding: 10px;
        margin-bottom: 40px;
        margin-top: 40px;
    }

    .gallary h1 {
        font-size: 55px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #000;
        margin-bottom: 0;
        /* Menghilangkan margin bawah */
    }

    .gallary h1 span {
        margin-left: 15px;
        color: #499848;
        font-family: mv boli;
    }

    .gallary h1 span::after {
        content: '';
        width: 100%;
        height: 2px;
        background: #499848;
        display: block;
        position: relative;
        bottom: 15px;
    }

    .gallary .gallary_image_box {
        width: 90%;
        margin: 0 auto 40px auto;
        padding: 60px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        /* Menyesuaikan ukuran kartu */
        grid-gap: 60px;
        /* Jarak antar kartu */
    }

    .gallary_card {
        position: relative;
        width: 100%;
        height: 100%;
        /* Menyesuaikan tinggi kartu */
        border-radius: 15px;
        /* Menyesuaikan radius kartu */
        overflow: hidden;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .gallary_card:hover {
        transform: translateY(-10px);
    }

    .gallary_card img {
        width: 100%;
        height: 100%;
        /* Menyesuaikan tinggi gambar */
        object-fit: cover;
        /* Memastikan gambar diisi dan tidak terdistorsi */
        border-radius: 15px;
        /* Menyesuaikan radius gambar */
    }

    .gallary_card .card-body {
        position: relative;
        /* Menjadikan posisi relatif untuk mengatur posisi absolut elemen dalamnya */
        padding: 20px;
    }

    .gallary_card .card-title,
    .gallary_card .card-text,
    .gallary_card .gallary_btn {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        opacity: 0;
        transition: opacity 0.3s ease;
        color: #fff;
    }

    .gallary_card:hover .card-title,
    .gallary_card:hover .card-text,
    .gallary_card:hover .gallary_btn {
        opacity: 1;
        transition-delay: 0.2s;
        /* Menambahkan sedikit keterlambatan agar efek muncul lebih mulus */
    }

    .gallary_card:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        opacity: 0;
        transition: opacity 0.3s ease;
        border-radius: 15px;
    }

    .gallary_card:hover:before {
        opacity: 1;
    }

    .gallary_btn {
        background-color: #499848;
        padding: 10px 20px;
        border-radius: 10px;
    }

    .gallary_btn:hover {
        background-color: #3b7a3b;
    }
</style>

<div class="gallary" id="Gallary">
    <h1>Menu<span>Prasmanan</span></h1>

    <div class="gallary_image_box owl-carousel owl-theme">

        <div class="card gallary_card">
            <img class="card-img-top" src="{{ asset('frontend/images/ayam_bakar_1.png') }}" alt="Card image cap">
            <div class="card-body">
                <h3 class="card-title">Food</h3>
                <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi sint eveniet
                    laboriosam</p>
                <a href="#" class="btn btn-primary gallary_btn">Order Now</a>
            </div>
        </div>
        <div class="card gallary_card">
            <img class="card-img-top" src="{{ asset('frontend/images/ayam_bakar_1.png') }}" alt="Card image cap">
            <div class="card-body">
                <h3 class="card-title">Food</h3>
                <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi sint eveniet
                    laboriosam</p>
                <a href="#" class="btn btn-primary gallary_btn">Order Now</a>
            </div>
        </div>
        <div class="card gallary_card">
            <img class="card-img-top" src="{{ asset('frontend/images/ayam_bakar_1.png') }}" alt="Card image cap">
            <div class="card-body">
                <h3 class="card-title">Food</h3>
                <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi sint eveniet
                    laboriosam</p>
                <a href="#" class="btn btn-primary gallary_btn">Order Now</a>
            </div>
        </div>
        <div class="card gallary_card">
            <img class="card-img-top" src="{{ asset('frontend/images/ayam_bakar_1.png') }}" alt="Card image cap">
            <div class="card-body">
                <h3 class="card-title">Food</h3>
                <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi sint eveniet
                    laboriosam</p>
                <a href="#" class="btn btn-primary gallary_btn">Order Now</a>
            </div>
        </div>
        <div class="card gallary_card">
            <img class="card-img-top" src="{{ asset('frontend/images/ayam_bakar_1.png') }}" alt="Card image cap">
            <div class="card-body">
                <h3 class="card-title">Food</h3>
                <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi sint eveniet
                    laboriosam</p>
                <a href="#" class="btn btn-primary gallary_btn">Order Now</a>
            </div>
        </div>
        <div class="card gallary_card">
            <img class="card-img-top" src="{{ asset('frontend/images/ayam_bakar_1.png') }}" alt="Card image cap">
            <div class="card-body">
                <h3 class="card-title">Food</h3>
                <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi sint eveniet
                    laboriosam</p>
                <a href="#" class="btn btn-primary gallary_btn">Order Now</a>
            </div>
        </div>
        <div class="card gallary_card">
            <img class="card-img-top" src="{{ asset('frontend/images/ayam_bakar_1.png') }}" alt="Card image cap">
            <div class="card-body">
                <h3 class="card-title">Food</h3>
                <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi sint eveniet
                    laboriosam</p>
                <a href="#" class="btn btn-primary gallary_btn">Order Now</a>
            </div>
        </div>
        <!-- tambahkan item lain di sini -->

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
