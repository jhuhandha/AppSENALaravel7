<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use DataTables;
use Flash;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

    public function index()
    {
        return view('producto.index');
    }

    public function listar(Request $request)
    {

        $productos = Producto::select("producto.*", "categoria.nombre_categoria")
            ->join("categoria", "producto.categoria_id", "=", "categoria.id")
            ->get();

        return DataTables::of($productos)
            ->editColumn("imagen", function ($producto) {
                $defecto = "favicon.ico";
                return "<img src='/" . ($producto->imagen == null ? $defecto : "uploads/".$producto->imagen) . "' width='100px' >";
            })
            ->editColumn("estado", function ($producto) {
                return $producto->estado == 1 ? "Activo" : "Inactivo";
            })
            ->addColumn('editar', function ($producto) {
                return '<a class="btn btn-primary bt-sm" href="/producto/editar/' . $producto->id . '">Editar</a>';
            })
            ->addColumn('cambiar', function ($producto) {
                if ($producto->estado == 1) {
                    return '<a class="btn btn-danger bt-sm" href="/producto/cambiar/estado/' . $producto->id . '/0">Inactivar</a>';
                } else {
                    return '<a class="btn btn-success bt-sm" href="/producto/cambiar/estado/' . $producto->id . '/1">Activar</a>';
                }
            })
            ->rawColumns(['editar', 'cambiar', 'imagen'])
            ->make(true);
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('producto.create', compact("categorias"));
    }

    public function save(Request $request)
    {
        $request->validate(Producto::$rules);
        $input = $request->all();

        try {
            $imagen = null;
            if ($request->imagen != null) {
                $imagen = $input["nombre_producto"] . '.' . time() . '.' . $request->imagen->extension();
                $request->imagen->move(public_path('uploads'), $imagen);
            }

            Producto::create([
                "nombre_producto" => $input["nombre_producto"],
                "categoria_id" => $input["categoria_id"],
                "precio" => $input["precio"],
                "cantidad" => 0,
                "estado" => 1,
                "imagen" => $imagen,
            ]);

            Flash::success("Se registro el producto");

            return redirect("/producto");

        } catch (\Exception $e) {
            Flash::error($e->getMessage());

            return redirect("/producto/crear");
        }
    }

    public function edit($id)
    {
        $categorias = Categoria::all();
        $producto = Producto::find($id);

        if ($producto == null) {
            Flash::error("Producto no encontrado");
            return redirect("/producto");
        }

        return view("producto.edit", compact("producto", "categorias"));
    }

    public function update(Request $request)
    {
        $request->validate(Producto::$rules);
        $input = $request->all();

        try {

            $producto = Producto::find($input["id"]);

            if ($producto == null) {
                Flash::error("Producto no encontrado");
                return redirect("/producto");
            }

            $producto->update([
                "nombre_producto" => $input["nombre_producto"],
                "categoria_id" => $input["categoria_id"],
                "precio" => $input["precio"],
            ]);

            Flash::success("Se modifico el producto");

            return redirect("/producto");

        } catch (\Exception $e) {
            Flash::error($e->getMessage());
            return redirect("/producto");
        }
    }

    public function updateState($id, $estado)
    {
        $producto = Producto::find($id);

        if ($producto == null) {
            Flash::error("Producto no encontrado");
            return redirect("/producto");
        }

        try {
            $producto->update(["estado" => $estado]);
            Flash::success("Se modifico el estado del producto");
            return redirect("/producto");
        } catch (\Exception $e) {
            Flash::error($e->getMessage());
            return redirect("/producto");
        }

    }

}
