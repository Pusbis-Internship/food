<section id="cheffs1">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="heading">Snack &nbsp;</h2>
                <hr class="heading_space">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="cheffs_wrap_slider">
                    <div id="our-cheffs" class="owl-carousel">
                        @foreach($snacks as $menu)
                        <div class="item">
                            <div class="cheffs_wrap">
                                <div class="menu_card">

                                    <div class="menu_image">
                                        <img src="{{ url('storage/menu_images/' . basename($menu->menu_pic)) }}" alt="Menu Image">
                                    </div>

                                    <div class="menu_info">
                                        <h2>{{$menu->menu_name}}</h2>
                                        @if ($menu->reviews->count() > 0)
                                            <p class="icon-star">{{ number_format($menu->averageRating(), 1) }}</p>
                                        @else
                                            <p class="icon-star">0</p>
                                        @endif
                                        <small>{{$menu->seller}}</small>
                                        <h3>Rp. {{ number_format($menu->menu_price, 0, ',', '.') }}</h3>
                                        <p>{{ $menu->menu_desc }}</p>
                                        @auth
                                        <a href="{{ route('addMenu.to.order', $menu->id) }}" class="menu_btn">Order Now</a>   
                                        @endauth
                                        @guest
                                        <a href="{{ route('auth') }}" class="menu_btn">Order Now</a> 
                                        @endguest
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>