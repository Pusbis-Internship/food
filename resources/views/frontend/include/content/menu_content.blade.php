<link rel="stylesheet" href="{{ asset('frontend/css/style.c') }}">
<!-- Menu -->

<div class="menu" id="Menu">
    <h1><span>Menu</span></h1>
    
    <select name="category" id="category">
        <option value="">Select Category</option>
        @if($categories && count($categories) > 0)
            @foreach($categories as $category)
                <option value="{{ $category['id'] }}">{{ $category->category_name }}</option>
            @endforeach
        @endif
    </select>

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

        <script>
        $(document).ready(function(){
            $("#category").on('change', function(){
                var category = $(this).val();
                $.ajax({
                    url:"{{ route('menu' )}}",
                    type: "GET",
                    data: {category: category},
                    success:function(data){
                        var menus = data.menus;
                        var html = '';
                        if(menus.length>0){
                            for(let i=0; i<menus.length; i++){
                                html +='<tr>\
                                        <td>'+(menus[i]['id'])+'</td>\
                                        <td>'+menus[i]['menu_name']+'</td>\
                                        <td>'+menus[i]['menu_price']+'</td>\
                                        <td>'+menus[i]['menu_desc']+'</td>\
                                        </tr>';
                            }
                        } else {
                            html += '<tr>\
                                        <td>Tidak ada menu tersedia</td>\
                                    </tr>';
                        }
                        $("#body").html(html);
                    }
                })
            })
        })
    </script>
    </div>

</div>