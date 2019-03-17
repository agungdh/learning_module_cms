<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

use App\Models\Menu;

use ADHhelper;
use Validator;

class MenuController extends Controller
{
    private function move($id, $up)
    {
        $dari = Menu::find($id);
        $ke = Menu::where([
            'parent_id' => $dari->parent_id,
            'posisi' => $up ? $dari->posisi - 1 : $dari->posisi + 1,
        ])->first();

        $dariPosisi = $dari->posisi;
        $kePosisi = $ke->posisi;

        $dari->posisi = $kePosisi;
        $ke->posisi = $dariPosisi;

        $dari->save();
        $ke->save();

        return route('menu.index', ['id' => $dari->parent_id ?: null]);
    }
    
    public function up($id) 
    {
        return redirect($this->move($id, true));
    }

    public function down($id) 
    {
        return redirect($this->move($id, false));
    }

    private function countTree($menu)
    {
        $countTree = 1;
        if ($menu->parent) {
            $countTree++;
            if ($menu->parent->parent) {
                $countTree++;
                if ($menu->parent->parent->parent) {
                    $countTree++;
                }
            }
        }

        return $countTree;
    }

    public function index(Request $request)
    {
        if ($request->id) {
            Menu::findOrFail($request->id);
        }

        $bolds = ADHhelper::menuBoldParents($request->id);
     
        $menusTree = Menu::with('childs.childs.childs')->where('parent_id', null)->orderBy('posisi')->get();

        if ($request->id) {
            $menus = Menu::with('childs.childs.childs')->where('parent_id', $request->id)->orderBy('posisi')->get();
            $menu = Menu::find($request->id);

            if ($menu->route != null) {
                abort(403);
            } 

            $countTree = $this->countTree($menu);
        } else {
            $menus = Menu::with('childs.childs.childs')->where('parent_id', null)->orderBy('posisi')->get();
            $menu = null;
        }
                
        $countTree = isset($countTree) ? $countTree : 1;
        
        if ($countTree > 3) {
            abort(403);
        } elseif ($countTree == 3) {
            $canGoToChilds = false;
        } else {
            $canGoToChilds = true;
        }

        return view('menu.index', compact(['menus', 'request', 'menu', 'menusTree', 'canGoToChilds', 'bolds']));
    }

    public function create(Request $request)
    {
        if ($request->id) {
            $menu = Menu::find($request->id);

            if (!$menu || $this->countTree($menu) > 3) {
                abort(403);
            }            
        }

        return view('menu.create', compact(['request']));   
    }

    public function store(Request $request)
    {
        $required = [
            'menu' => 'required',
            'icon' => 'required',
        ];

        if ($request->id) {
            $menu = Menu::find($request->id);

            if (!$menu || $this->countTree($menu) > 3) {
                abort(403);
            } elseif ($menu && $this->countTree($menu) == 3) {
                $required['route'] = 'required';
            }            
        }

        $request->validate($required);

        $data = $request->only('menu', 'icon', 'route');
        $data['parent_id'] = $request->id;

        if ($request->route != null) {
            $request->validate([
                'route' => [
                    'unique:menu,route',
                    Rule::in(ADHhelper::getRouteList()),
                    function ($attribute, $value, $fail) {
                        if (trim($value) != "") {
                            if (!ADHhelper::checkRouteForMenu($value)) {
                                $fail("The selected {$attribute} is invalid.");
                            }
                        }
                    },
                ],
            ]);            
        }

        if ($request->id) {
            $parent = Menu::find($request->id);

            if (count($parent->childs) > 0) {
                $data['posisi'] = count($parent->childs) + 1;
            } else {
                $data['posisi'] = 1;
            }
        } else {
            $menus = Menu::where(['parent_id' => null])->get();

            if (count($menus) > 0) {
                $data['posisi'] = count($menus) + 1;
            } else {
                $data['posisi'] = 1;
            }
        }

        Menu::create($data);

        return redirect()->route('menu.index', ['id' => $request->id ?: null])->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Tambah Data',
            'class' => 'success',
        ]);
    }

    public function edit(Request $request, $id)
    {
        $menu = Menu::find($id);

        return view('menu.edit', compact(['request', 'menu']));   
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);

        $required = [
            'menu' => 'required',
            'icon' => 'required',
        ];

        if ($this->countTree($menu) == 4) {
            $required['route'] = 'required';
        }  

        $request->validate($required);

        if ($request->route != null) {
            if ($menu->route != $request->route) {
                $request->validate([
                    'route' => [
                        'unique:menu,route',
                        Rule::in(ADHhelper::getRouteList()),
                        function ($attribute, $value, $fail) {
                            if (trim($value) != "") {
                                if (!ADHhelper::checkRouteForMenu($value)) {
                                    $fail("The selected {$attribute} is invalid.");
                                }
                            }
                        },
                    ],
                ]);
            }
        }

        $data = $request->only('menu', 'icon', 'route');

        Menu::where(['id' => $id])->update($data);

        return redirect()->route('menu.index', ['id' => $menu->parent_id ?: null])->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Ubah Data',
            'class' => 'success',
        ]);
    }

    public function destroy($id)
    {
        $menu = Menu::find($id);


        $id = $menu->parent_id ?: null;
        $posisi = $menu->posisi;

        try {
            $menu->delete();   
            
            Menu::where(['parent_id' => $menu->parent_id])->where('posisi', '>', $menu->posisi)->decrement('posisi');
        } catch (QueryException $exception) {
            return redirect()->back()->with('alert', [
                'title' => 'ERROR !!!',
                'message' => config('app.debug') ? $exception->getMessage() : 'Something Went Wrong !!!',
                'class' => 'error',
            ]);        
        }

        return redirect()->route('menu.index', ['id' => $id])->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Hapus Data',
            'class' => 'success',
        ]);
    }
}
