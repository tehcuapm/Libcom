<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\PanierInterface;
use App\Models\Article;
use App\Models\Image;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    private $panier;

    public function __construct(PanierInterface $panier)
    {
        $this->panier = $panier;
    }

    public function showAdmin()
    {
        return view('admin.admin');
    }

    public function showAdminCreate()
    {
        return view('admin.admin-create');
    }

    public function showAdminDelete()
    {
        return view('admin.admin-delete', ["articles" => Article::all()]);
    }

    public function showAdminAddImg()
    {
        return view('admin.admin-addimg', ["images" => Image::all()]);
    }

    public function showUsers()
    {
        return view('admin.admin-users');
    }

    public function getUsers()
    {
        $users = User::all(["id", "name", "email", "last_connection", "created_at"])->toArray();
        return response()->json(["data" => $users]);
    }

    public function AddArticles(Request $request)
    {
        $validated = $request->validate([
            "title" => 'required|min:3|max:50',
            "speech" => 'required',
            "stock" => 'required',
            "price" => 'required',
            "category_id" => 'required'
        ]);

        $validatedData = $request->validate([
            'path_file' => 'required'
        ]);

        //grace au lien symbolique, on peut stocker dans le storage et y acceder de
        //maniere publique

        $name_file = $request->file('path_file')->getClientOriginalName();
        $image_path = ("storage/assets/products/" . $name_file);

        $file_info = array(
            "name" => $name_file,
            "path_file" => $image_path,
        );

        $test_ifexist = Image::where('name', '=', $name_file)->select('name')->get();
        //On vérifie si il n'existe aucune image
        if (!empty($test_ifexist[0])) {
            $test_ifexist = $test_ifexist[0]->name;
        }

        if ($name_file != $test_ifexist) {
            //Si aucune image n'a le même nom
            $file = $request->file('path_file')->storeAs("assets/products", $name_file);
            $image_id = Image::query()->create($file_info)->id;
        } else {
            //Si une image à déjà le même nom, on ne stocke pas d'image

            $image_id = Image::query()->where("name", "=", $name_file)->get()->first()->id;
        }

        $new_article = Article::query()->create($validated)->getModel();

        $new_article->images()->attach($image_id);
        return Redirect::to(route('article.index'));
    }

    public function deleteArticle(Request $request)
    {
        $article = $request->input('article');
        Article::query()->where('id', '=', $article)->delete();
        $this->panier->remove($article);
        return Redirect::to(route('admin.deleteArticle'));
    }

    public function addImages(Request $request)
    {
        $name_file = $request->file('addimage')->getClientOriginalName();
        $image_path = ("storage/assets/products/" . $name_file);

        $file = array(
            'name' => $name_file,
            'path_file' => $image_path
        );

        $test_ifexist = Image::query()->where('name', '=', $name_file)->select('name')->get();
        //On vérifie si il n'existe aucune image
        if (!empty($test_ifexist[0])) {
            $test_ifexist = $test_ifexist[0]->name;
        }

        if ($name_file != $test_ifexist) {
            //Si aucune image n'a le même nom
            $store_file = $request->file('addimage')->storeAs("assets/products", $name_file);
            Image::query()->create($file);
            //Si une image à déjà le même nom, on ne stocke pas d'image
        }
        return Redirect::to(route('admin.addImg'));
    }

    public function delImages(Request $request)
    {
        $id_img = $request->image_id;
        Image::query()->where("id", "=", $id_img)->delete();
        return Redirect::back();
    }

    public function resetPage(Request $request)
    {
        $nowDate = Carbon::now()->isoFormat('YYYY-MM-DD HH:mm:ss');
        $verificationDate = Carbon::now()->subDays(14);
        $activeUser = User::select()->whereBetween("last_connection", [$verificationDate, $nowDate])->count();

        $orders = Order::all();
        $orderNumber = $orders->count();
        $prices = $orders->map(function (Order $order) {
            return $order->getTotalPrice();
        });
        $mostExpensive = $prices->max();

        return array($activeUser, $orderNumber, $mostExpensive);
    }
}
