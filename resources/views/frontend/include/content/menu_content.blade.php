<link rel="stylesheet" href="{{ asset('frontend/css/style.c') }}">
<!-- Menu -->

<div class="menu" id="Menu">
    <h1><span>Menu</span></h1>
    
    @auth
    <form action="{{ route('menu_user') }}" method="GET">
        <div class="input-group input-group-sm" style="width: 150px;">
            <input type="search" name="search" class="form-control float-right" placeholder="Search">
            <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
    <br>
    <form action="{{ route('filter.menu.user') }}" method="GET">
        <select name="category" id="category">
            <option value="">Select Category</option>
            @if($categories && count($categories) > 0)
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            @endif
        </select>
        <button type="submit">Filter</button>
    </form>
    @endauth
    @guest
    <form action="{{ route('menu') }}" method="GET">
        <div class="input-group input-group-sm" style="width: 150px;">
            <input type="search" name="search" class="form-control float-right" placeholder="Search">
            <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
    <br>
    <form action="{{ route('filter.menu') }}" method="GET">
        <select name="category" id="category">
            <option value="">Select Category</option>
            @if($categories && count($categories) > 0)
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            @endif
        </select>
        <button type="submit">Filter</button>
    </form>
    @endguest

    <br>
    <br>

    <div class="menu_box">
        @foreach($menus as $menu)
        <div class="menu_card">
            <div class="menu_image">
                <img src="{{ url('storage/menu_images/' . basename($menu->menu_pic)) }}">
            </div>
            <div class="small_card">
                <i class="icon-basket2"></i>
            </div>
            <div class="menu_info">
                <h2>{{ $menu->menu_name }}</h2>
                <p>{{ $menu->seller }}</p>
                <p>{{ $menu->menu_desc }}</p>
                <h3>Rp. {{ number_format($menu->menu_price, 0, ',', '.') }}</h3>
                <div class="menu_icon">
                    <i class="icon-basket2"></i>
                </div>
               @auth
               <a href="{{ route('addMenu.to.order', $menu->id) }}" class="menu_btn">Order Now</a>   
               @endauth
               @guest
               <a href="{{ route('auth') }}" class="menu_btn">Order Now</a> 
               @endguest
            </div>
        </div>
        @endforeach
    </div>
</div>