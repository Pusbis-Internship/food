<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\User;

use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Models\Menu;

use App\Models\Order;

use Illuminate\Support\Facades\Auth;

use App\Models\Category;

use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index() {
        $menus = Menu::all();
        $order = session()->get('order', []);
        $total = 0;

        foreach ($order as $id => $order_detail) {
            $subtotal = isset($order_detail['subtotal']) ? $order_detail['subtotal'] : 0;
            $subtotal += $order_detail['quantity'] * $order_detail['menu_price'];
            $order[$id]['subtotal'] = $subtotal;
            $total += $subtotal;
        }
        session()->put('order', $order);  // Update the session with new subtotal values
        return view('pointakses/user/index', compact('menus', 'order', 'total'));
    }
    public function menu_user(){
        $menus = Menu::all();

        return view('pointakses/user/page_menu', compact('menus'));
    }

    public function filterMenu_user(Request $request){
        $query = Menu::query();
        $categories = Category::all();

        if($request->ajax()){
            $menus = $query->where(['category_id'=>$request->category])->get();
            return response() -> json(['menus'=>$menus]);
        }
        $menus = $query->get();

        return view ('pointakses/user/page_menu', compact('categories', 'menus'));
    }

    public function about_user(){
        return view('pointakses/user/page_about');
    }
    public function contact_user(){
        return view('pointakses/user/page_contact');
    }
    public function menuOrder(){
        return view('pointakses/user/order');
    }

    public function addMenutoOrder($id)
    {
        // Ensure the user is authenticated
        $this->middleware('auth');

        $menu = Menu::findOrFail($id);
        $userId = auth()->id();

        // Get the user's cart from the session
        $order = session()->get("order_$userId", []);

        if(isset($order[$id])) {
            $order[$id]['quantity']++;
            $order[$id]['subtotal'] = $order[$id]['quantity'] * $order[$id]['menu_price'];
        } else {
            $order[$id] = [
                "menu_id" => $menu->id,
                "menu_name" => $menu->menu_name,
                "seller" => $menu->seller,
                "menu_pic" => $menu->menu_pic,
                "quantity" => 1,
                "menu_price" => $menu->menu_price,
                "menu_desc" => $menu->menu_desc,
                "subtotal" =>$menu->menu_price
            ];
        }

        // Store the updated cart in the user's session
        session()->put("order_$userId", $order);

        return redirect()->back()->with('success', 'Menu berhasil ditambahkan.');
    }
    
    public function updateorder(Request $request)
    {
        $this->middleware('auth');

        $userId = auth()->id();

        if ($request->id && $request->quantity) {
            // Get the user's cart from the session
            $order = session()->get("order_$userId");

            if (isset($order[$request->id])) {
                $order[$request->id]["quantity"] = $request->quantity;
                // Recalculate subtotal when updating quantity
                $order[$request->id]["subtotal"] = $request->quantity * $order[$request->id]["menu_price"];
                // Store the updated cart in the user's session
                session()->put("order_$userId", $order);
                session()->flash('success', 'Product quantity updated.');
            }
        }
    }
  
    public function deleteMenu(Request $request)
    {
        $this->middleware('auth');

        $userId = auth()->id();

        if($request->id) {
            // Get the user's cart from the session
            $order = session()->get("order_$userId");

            if(isset($order[$request->id])) {
                unset($order[$request->id]);
                // Store the updated cart in the user's session
                session()->put("order_$userId", $order);
            }

            session()->flash('success', 'Menu successfully deleted.');
        }
    }

    public function checkout()
    {
        $order = Session::get("order_" . auth()->id(), []);
        $total = $this->calculateTotal($order);

        return view('pointakses/user/checkout', compact('order', 'total'));
    }

    private function calculateTotal($order)
    {
        $total = 0;

        foreach ($order as $id => $order_detail) {
            $total += $order_detail['subtotal'];
        }

        return $total;
    }
    public function history_order()
    {
        $userId = Auth::id();
    
        $groupedOrders = DB::table('orders')
            ->select('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam', 
                    DB::raw('GROUP_CONCAT(CONCAT(menu_name, " (", quantity, ")") SEPARATOR ", ") as menu_with_quantity'))
            ->where('users_id', $userId)
            ->groupBy('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam')
            ->get();
    
        return view('pointakses/user/history_order', ['groupedOrders' => $groupedOrders]);
    }

    public function invoice($id_pesanan)
    {
        $userId = Auth::id();
        
        // Retrieve the grouped orders
        $groupedOrders = DB::table('orders')
            ->join('users', 'orders.users_id', '=', 'users.id')
            ->select('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam', 'users.nama_lengkap', 
                DB::raw('GROUP_CONCAT(menu_name) as menu_names'), 
                DB::raw('GROUP_CONCAT(seller) as sellers'), 
                DB::raw('GROUP_CONCAT(menu_price) as menu_prices'), 
                DB::raw('GROUP_CONCAT(subtotal) as subtotals'), 
                DB::raw('GROUP_CONCAT(quantity SEPARATOR ", ") as quantities'))
            ->where('users_id', $userId)
            ->where('id_pesanan', $id_pesanan)
            ->groupBy('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam', 'users.nama_lengkap')
            ->get();
        
        // Return the view with the data
        return view('pointakses.user.invoice', compact('userId', 'groupedOrders'));
    }

    public function generateinvoice($id_pesanan)
    {
        $userId = Auth::id();
        
        // Retrieve the grouped orders
        $groupedOrders = DB::table('orders')
            ->join('users', 'orders.users_id', '=', 'users.id')
            ->select('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam', 'users.nama_lengkap', DB::raw('GROUP_CONCAT(menu_name) as menu_names'), DB::raw('GROUP_CONCAT(seller) as sellers'), DB::raw('GROUP_CONCAT(subtotal) as subtotals'), DB::raw('GROUP_CONCAT(quantity SEPARATOR ", ") as quantities'))
            ->where('users_id', $userId)
            ->where('id_pesanan', $id_pesanan)
            ->groupBy('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam', 'users.nama_lengkap')
            ->get();
        
        // Load the view for invoice
            $pdf = Pdf::loadView('pointakses.user.invoice', compact('userId', 'groupedOrders'));

        // Download the PDF file with the specified name
        return $pdf->download('Nota'.$id_pesanan.'.pdf');
    }
    
    public function editprofile()
    {
        return view('pointakses/user/editprofile');
    }

    public function updateprofile(Request $request)
    {
        $users = auth()->user();
        $users->nama_lengkap = $request->input('nama_lengkap');
        $users->email = $request->input('email');
        $users->no_tlp = $request->input('no_tlp');
        $users->alamat = $request->input('alamat');
        $users->unit_kerja = $request->input('unit_kerja');
        $users->save();

        return back()->with('message','Update Profile Berhasil');
    }

    public function editpassword()
    {
        return view('pointakses/user/changepassword');
    }
}