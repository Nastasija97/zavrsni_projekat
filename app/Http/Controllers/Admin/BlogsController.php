<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;

class BlogsController extends Controller {

    public function index() {
        //$systemMessage = session()->pull('system_message');
        //$blogs = Blog::query()
        //    ->with(['brand', 'blogCategory', 'tags'])
        //	->orderBy('created_at', 'desc')
        //    ->get();

        return view('admin.blogs.index', [
                //'blogs' => $blogs,
                //'systemMessage' => $systemMessage,
        ]);
    }

    public function datatable(Request $request) {

        $searchFilters = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'blog_category_id' => ['nullable', 'numeric', 'exists:blog_categories,id'],
            'important' => ['nullable', 'in:0,1'],
            'tag_ids' => ['nullable', 'array', 'exists:tags,id'],
        ]);


        $query = Blog::query()
                ->with(['blogCategory', 'tags'])
                ->join('blog_categories', 'blogs.blog_category_id', '=', 'blog_categories.id')
                ->select(['blogs.*', 'brands.name AS brand_name', 'blog_categories.name AS blog_category_name']);


         if (isset($searchFilters['name'])) {
          $query->where('blogs.name', 'LIKE', '%' . $searchFilters['name'] . '%');
          }

        

          if (isset($searchFilters['blog_category_id'])) {
          $query->where('blogs.blog_category_id', '=', $searchFilters['blog_category_id']);
          }

          if (isset($searchFilters['index_page'])) {
          $query->where('blogs.index_page', '=', $searchFilters['index_page']);
          }

          if (isset($searchFilters['tag_ids'])) {
          $query->whereHas('tags', function ($subQuery) use ($searchFilters) {

          $subQuery->whereIn('tag_id', $searchFilters['tag_ids']);
          });
          } 


        //Inicijalizacija datatables-a
        $dataTable = \DataTables::of($query);

        //Podesavanje kolona
        $dataTable->addColumn('tags', function ($blog) {
                    return optional($blog->tags->pluck('name'))->join(', ');
                })
                //->addColumn('brand_name', function ($blog) {
                //	return optional($blog->brand)->name;
                //})
                //->addColumn('blog_category_name', function ($blog) {
                //	return optional($blog->blogCategory)->name;
                //})
                ->addColumn('actions', function ($blog) {
                    return view('admin.blogs.partials.actions', ['blog' => $blog]);
                })
                ->editColumn('photo1', function ($blog) {
                    return view('admin.blogs.partials.blog_photo', ['blog' => $blog]);
                })
                ->editColumn('id', function ($blog) {
                    return '#' . $blog->id;
                })
                ->editColumn('name', function ($blog) {
                    return '<strong>' . e($blog->name) . '</strong>';
                });


        $dataTable->rawColumns(['name', 'photo1', 'actions']);

        $dataTable->filter(function ($query) use ($request, $searchFilters) {

            if (
                    $request->has('search') && is_array($request->get('search')) && isset($request->get('search')['value'])
            ) {
                $searchTerm = $request->get('search')['value'];

                $query->where(function ($query) use ($searchTerm) {

                    $query->orWhere('blogs.name', 'LIKE', '%' . $searchTerm . '%')
                            ->orWhere('blogs.description', 'LIKE', '%' . $searchTerm . '%')
                            ->orWhere('blog_categories.name', 'LIKE', '%' . $searchTerm . '%')
                            ->orWhere('blogs.id', '=', $searchTerm);
                });
            }



            if (isset($searchFilters['name'])) {
                $query->where('blogs.name', 'LIKE', '%' . $searchFilters['name'] . '%');
            }



            if (isset($searchFilters['blog_category_id'])) {
                $query->where('blogs.blog_category_id', '=', $searchFilters['blog_category_id']);
            }

            if (isset($searchFilters['important'])) {
                $query->where('blogs.important', '=', $searchFilters['important']);
            }

            if (isset($searchFilters['tag_ids'])) {
                $query->whereHas('tags', function ($subQuery) use ($searchFilters) {

                    $subQuery->whereIn('tag_id', $searchFilters['tag_ids']);
                });
            }
        });

        return $dataTable->make(true); //make - pravi json po specifikaciji DataTables.js plugin-a	
    }

    public function add(Request $request) {

        $blogCategories = BlogCategory::query()
                ->orderBy('priority')
                ->get();

        $tags = Tag::all();

        return view('admin.blogs.add', [
            'blogCategories' => $blogCategories,
            'tags' => $tags,
        ]);
    }

    public function insert(Request $request) {

        $formData = $request->validate([
            'blog_category_id' => ['nullable', 'numeric', 'exists:blog_categories,id'],
            'name' => ['required', 'string', 'max:255', 'unique:blogs,name'],
            'description' => ['nullable', 'string', 'max:2000'],
            'important' => ['required', 'numeric', 'in:0,1'],
            'tag_id' => ['nullable', 'array', 'exists:tags,id'],
            'photo1' => ['nullable', 'file', 'image'],
            'photo2' => ['nullable', 'file', 'image'],
            'details' => ['nullable', 'string'],
        ]);

        //dd($formData);
        // novi model u memoriji, jos nije sacuvan u bazi
        $newBlog = new Blog();

        //setovanje kolona u redu tabele
        //
        //jedna kolona po jedna kolona
        //$newBlog->name = $formData['name'];
        //MASS ASIGNMENT - vise kolona od jednom
        $newBlog->fill($formData);

        //dd($newBlog);
        //objekat pre snimanja u bazu
        //dump($newBlog);
        //save funkcija vrsi cuvanje promena nad redom u tabeli 
        $newBlog->save(); // radi se INSERT QUERY nad bazom zato sto smo rucno kreirali objekat sa "new"
        //$formData['tag_id'] = [3,6,9];
        //$newBlog->id - 101

        /*
          blog_tags:
          blog_id,    tag_id
          101,           3
          101,           6
          101,           9
         */

        //sync funkcija nad relacijom sluzi za odrzavanje veze vise na vise
        $newBlog->tags()->sync($formData['tag_id']);


        $this->handlePhotoUpload('photo1', $request, $newBlog);
        $this->handlePhotoUpload('photo2', $request, $newBlog);


        //objekat nakon snimanja u bazu
        //dd($newBlog);

        session()->flash('system_message', __('New blog has been saved!'));

        return redirect()->route('admin.blogs.index');
    }

    public function edit(Request $request, Blog $blog) {
        $blogCategories = BlogCategory::query()
                ->orderBy('priority')
                ->get();

        $tags = Tag::all();

        return view('admin.blogs.edit', [
            'blog' => $blog,
            'blogCategories' => $blogCategories,
            'tags' => $tags,
        ]);
    }

    public function update(Request $request, Blog $blog) {
//        $formData = $request->validate([
//            'name' => ['required', 'string', 'max:10', Rule::unique('blogs')->ignore($blog->id),]
//        ]);

        $formData = $request->validate([
            'brand_id' => ['required', 'numeric', 'exists:brands,id'],
            'blog_category_id' => ['required', 'numeric', 'exists:blog_categories,id'],
            'name' => ['required', 'string', 'max:255', Rule::unique('blogs')->ignore($blog->id)],
            'description' => ['nullable', 'string', 'max:2000'],
           'important' => ['required', 'numeric', 'in:0,1'],
            'tag_id' => ['required', 'array', 'exists:tags,id', 'min:2'],
            'photo1' => ['nullable', 'file', 'image'],
            'photo2' => ['nullable', 'file', 'image'],
            'details' => ['nullable', 'string'],
        ]);

        $blog->fill($formData);

        $blog->save(); //UPDATE QUERY nad bazom, zato sto je red vec nekako dobijen iz baze
        //odrzavanje veze vise na vise
        // $proucts tags: 1,7,8
        //  $formData['tag_id'] -> 4,5,6
        $blog->tags()->sync($formData['tag_id']);


        $this->handlePhotoUpload('photo1', $request, $blog);
        $this->handlePhotoUpload('photo2', $request, $blog);


        session()->flash('system_message', __('Blog has been saved'));

        return redirect()->route('admin.blogs.index');
    }

    public function delete(Request $request) {
        $formData = $request->validate([
            'id' => ['required', 'numeric', 'exists:blogs,id'],
        ]);

        $formData['id'];

        $blog = Blog::findOrFail($formData['id']);

        //brisanje reda iz baze preko Objekta
        $blog->delete();

        //ODRZAVANJE RELACIJA
        //Imamo preneseni kljuc blog_id u tabeli blog_blogs
        \DB::table('blog_tags')
                ->where('blog_id', '=', $blog->id)
                ->delete();

        //$blog->tags()->delete();
        //$blog->tags()->sync([]);
        //brisanje redova pomocu QueryBuilder-a
        //Blog::query()->where('id', $formData['id'])->delete();
        //Blog::query()->where('created_at', '<', date('Y-m-d H:i:s', strtotime('-1 year')))->delete();
        //brisanje SVIH POVEZANIH FAJLOVA!!!
        $blog->deletePhotos();


        /* if ($request->wantsJson()) {

          return response()->json([
          'system_message' => __('Blog has been deleted')
          ]);
          }

          session()->flash('system_message', __('Blog has been deleted'));

          return redirect()->route('admin.blogs.index'); */

        return response()->json([
                    'system_message' => __('Blog has been deleted')
        ]);
    }

    public function deletePhoto(Request $request, Blog $blog) {
        $formData = $request->validate([
            'photo' => ['required', 'string', 'in:photo1,photo2'],
        ]);

        $photoFieldName = $formData['photo']; //photo1 ili photo2

        $blog->deletePhoto($photoFieldName);

        //reset kolone photo1 ili photo2 na null
        //da izbrisemo podatak u bazi o povezanoj fotografiji
        $blog->$photoFieldName = null;
        $blog->save();

        return response()->json([
                    'system_message' => __('Photo has been deleted'),
                    'photo_url' => $blog->getPhotoUrl($photoFieldName),
        ]);
    }

    protected function handlePhotoUpload(
            string $photoFieldName, Request $request, Blog $blog
    ) {
        if ($request->hasFile($photoFieldName)) {


            $blog->deletePhoto($photoFieldName);

            $photoFile = $request->file($photoFieldName);

            $newPhotoFileName = $blog->id . '_' . $photoFieldName . '_' . $photoFile->getClientOriginalName();

            $photoFile->move(
                    public_path('/storage/blogs/'), $newPhotoFileName
            );


            //$field = 'field_name';
            //echo $o1->$field; // $o1->field_name
            //$a = 5;
            //$b = 'a';
            //echo $$b; // echo $a
            //$photoFieldName = 'photo2'

            $blog->$photoFieldName = $newPhotoFileName;

            $blog->save();

            //originalna slika
            \Image::make(public_path('/storage/blogs/' . $blog->$photoFieldName))
                    ->fit(600, 800)
                    ->save();

            //thumb slika
            \Image::make(public_path('/storage/blogs/' . $blog->$photoFieldName))
                    ->fit(300, 300)
                    ->save(public_path('/storage/blogs/thumbs/' . $blog->$photoFieldName));
        }
    }

}
