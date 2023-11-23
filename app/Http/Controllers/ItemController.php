<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use Laravel\Ui\Presets\React;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        $items = Item::paginate(10);

        return view('item.index', compact('items'));
    }

    public function show($id)
    {
        $item = Item::find($id);
        $reviews = $item->reviews()->get();
        $category = ["ビジネス", "小説", "漫画", "趣味・実用", "雑誌・ムック", "専門書", "学習参考書"];
        return view('item.show', [
            'item' => $item, "category" => $category, "reviews" => $reviews
        ]);
    }

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {

            // バリデーションルール
            $rules = [
                'name' => 'required|string|max:100',
                'type' => 'required|',
                'detail' => 'required|string|max:500',
                'image' => 'nullable|image|mimes:jpeg,jpg|max:50',
            ];

            // バリデーションを実行
            $request->validate(
                $rules,
                [
                    'name.required' => '商品名は必須です。',
                    'name.string' => '使用できない文字が含まれています。',
                    'name.max' => '商品名は100文字以内です。',
                    'type.required' => '商品種別を選択してください。',
                    'detail.required' => '商品詳細は必須です。',
                    'detail.string' => '使用できない文字が含まれています。',
                    'detail.max' => '詳細は500文字以内です。',
                    'image.image' => 'imageにはファイルを指定してください。',
                    'image.mimes' => 'jpeg／jpg以外のファイルは添付できません。',
                    'image.max' => '50KBを超えるファイルは添付できません。',
                ]
            );




            // 商品登録
            $item = new Item;
            $item->name = $request->name;
            $item->user_id = Auth::id();
            $item->type = $request->type;
            $item->detail = $request->detail;
            $item->author = $request->author;

            // 画像アップロード
            if ($request->has('image')) {
                $item->image = base64_encode(file_get_contents($request->image));
            }

            $item->save();


            return redirect('/items');
        }

        return view('item.add');
    }

    public function edit($id)
    {
        $item = Item::find($id);
        return view("item.edit", ['item' => $item]);
    }

    public function update(Request $request)
    {
        $item = Item::where('id', '=', $request->id)->first();
        $item->name = $request->name;
        $item->author = $request->author;
        $item->user_id = Auth::id();
        $item->type = $request->type;
        $item->detail = $request->detail;

        if ($request->hasFile('image')) {
            // 新しい画像がアップロードされた場合

            // 古いバイナリデータを削除する（存在する場合）
            if ($item->image) {
                $item->image = null; // 古いバイナリデータを削除
            }

            $image = $request->file('image');
            $imageData = base64_encode(file_get_contents($image->getRealPath()));

            // 新しいバイナリデータを更新
            $item->image = $imageData;
        }

        $item->save();

        return redirect('/items')->with('message', '商品情報の編集が完了しました');
    }

    public function delete(Request $request)
    {
        $item = Item::find($request->id);
        $item->delete();
        return redirect('/items');
    }

    public function search(Request $request)
    {
        $search1 = $request->input("keyword");
        $search2 = $request->input("category_id");
        if (!empty($search1) && !empty($search2)) {
            $items = Item::where('type', '=', $search2)->where(function ($query) use ($search1) {
                $query->where('name', 'LIKE', '%' . $search1 . '%')->orWhere('author', 'LIKE', '%' . $search1 . '%');
            })->paginate(10);
        } elseif (!empty($search1)) {
            $items = Item::where('name', 'LIKE', '%' . $search1 . '%')->orWhere('author', 'LIKE', '%' . $search1 . '%')->paginate(10);
        } elseif (!empty($search2)) {
            $items = Item::where('type', '=', $search2)->paginate(10);
        } else {
            //itemsテーブルからデータを取得
            $items = Item::orderBy('id')->paginate(10);
        }
        $category = ["生活家電", "キッチン家電", "ビジュアル家電", "オーディオ家電", "理美容家電", "季節家電", "情報家電"];

        return view('item.index', [
            'items' => $items, "category" => $category
        ]);
    }
}
