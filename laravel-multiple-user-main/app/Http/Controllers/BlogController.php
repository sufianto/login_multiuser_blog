<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('blog.index', compact('blogs'));
    }

    /**
* create
*
* @return void
*/
public function create()
{
    return view('blog.create');
}

/**
* store
*
* @param  mixed $request
* @return void
*/
public function store(Request $request)
{
    $this->validate($request, [
        'image'     => 'required|image|mimes:png,jpg,jpeg',
        'title'     => 'required',
        'kontent'   => 'required'
    ]);

    //upload image
    $image = $request->file('image');
    $image->storeAs('public/blogs', $image->hashName());

    $blog = Blog::create([
        'image'     => $image->hashName(),
        'title'     => $request->title,
        'content'   => $request->kontent
    ]);

    if($blog){
        //redirect dengan pesan sukses
        return redirect()->route('blog.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }else{
        //redirect dengan pesan error
        return redirect()->route('blog.index')->with(['error' => 'Data Gagal Disimpan!']);
    }
}


public function show(Blog $blog)
{
    /// dengan menggunakan resource, kita bisa memanfaatkan model sebagai parameter
    /// berdasarkan id yang dipilih
    return view('blog.show',compact('blog'));
}
/**
* edit
*
* @param  mixed $blog
* @return void
*/
public function edit(Blog $blog)
{
    return view('blog.edit', compact('blog'));
}


/**
* update
*
* @param  mixed $request
* @param  mixed $blog
* @return void
*/
public function update(Request $request, Blog $blog)
{
    $this->validate($request, [
        'title'     => 'required',
        'kontent'   => 'required'
    ]);

    //get data Blog by ID
    $blog = Blog::findOrFail($blog->id);

    if($request->file('image') == "") {

        $blog->update([
            'title'     => $request->title,
            'content'   => $request->kontent
        ]);

    } else {

        //hapus old image
        Storage::disk('local')->delete('public/blogs/'.$blog->image);

        //upload new image
        $image = $request->file('image');
        $image->storeAs('public/blogs', $image->hashName());

        $blog->update([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'content'   => $request->kontent
        ]);

    }

    if($blog){
        //redirect dengan pesan sukses
        return redirect()->route('blog.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }else{
        //redirect dengan pesan error
        return redirect()->route('blog.index')->with(['error' => 'Data Gagal Diupdate!']);
    }
}

/**
* destroy
*
* @param  mixed $id
* @return void
*/
public function destroy($id)
{
  $blog = Blog::findOrFail($id);
  Storage::disk('local')->delete('public/blogs/'.$blog->image);
  $blog->delete();

  if($blog){
     //redirect dengan pesan sukses
     return redirect()->route('blog.index')->with(['success' => 'Data Berhasil Dihapus!']);
  }else{
    //redirect dengan pesan error
    return redirect()->route('blog.index')->with(['error' => 'Data Gagal Dihapus!']);
  }
}

public function search(Request $request)
{
    $keyword = $request->search;
    $blogs = Blog::where('title', 'like', "%" . $keyword . "%")->paginate(5);
    return view('blog.index', compact('blogs'))->with('i', (request()->input('page', 1) - 1) * 5);
}



}

