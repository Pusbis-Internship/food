<!-- dessert -->
<section id="cheffs" class="padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="heading">Our &nbsp; Kitchen &nbsp; Staff</h2>
                <hr class="heading_space">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="cheffs_wrap_slider">
                    <div id="our-cheffs" class="owl-carousel">
                        @foreach($makanans as $menu)
                        <div class="item">
                            <div class="cheffs_wrap">
                                <div class="menu_card">

                                    <div class="menu_image">
                                        <img src="{{ url('storage/menu_images/' . basename($menu->menu_pic)) }}" alt="Menu Image">
                                    </div>

                                    <div class="small_card">
                                        <i class="icon-basket2"></i>
                                    </div>

                                    <div class="menu_info">
                                        <h2>{{$menu->menu_name}}</h2>
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
                                        <small>{{$menu->seller}}</small>
                                        <p>{{ $menu->menu_desc }}</p>
                                        <a href="#" class="menu_btn">Rp. {{ $menu->menu_price }}</a>
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
