<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Validation\Rule;
class TagsController extends Controller {

    public function index() {

        $tags = Tag::all();

        return view('admin.tags.index', [
            'tags' => $tags,
        ]);
    }

    public function add(Request $request) {




        return view('admin.tags.add', [
        ]);
    }

    public function insert(Request $request) {

        $formData = $request->validate([
            'name' => ['required', 'string', 'max:20', 'unique:tags,name'],
        ]);

        $newTag = new Tag();


        $newTag->fill($formData);
        $newTag->save();


        session()->flash('system_message', __('New tag has been saved!'));
        return redirect()->route('admin.tags.index');
    }

    public function edit(Request $request, Tag $tag) {




        return view('admin.tags.edit', [
            'tag' => $tag,
        ]);
    }

    public function update(Request $request, Tag $tag) {

        $formData = $request->validate([
            'name' => ['required', 'string', 'max:20', Rule::unique('users')->ignore($tag->id)],
        ]);
     


        $tag->fill($formData);
        $tag->save(); //UPDATE QUERY nad bazom,zato sto je red vec nekako dobijen iz baze

        session()->flash('system_message', __('Tag has been updated'));
        return redirect()->route('admin.tags.index');
    }

    public function delete(Request $request) {
        $formData = $request->validate([
            'id' => ['required', 'numeric', 'exists:tags,id'],
        ]);


        $tag = Tag::findOrFail($formData['id']);
        
        $tag->delete();

     //deleting the relation
//        \DB::table('product_tags')
//                ->where('tag_id', $tag->id)
//                ->delete();






        session()->flash('system_message', __('Your tag has been deleted'));

        return redirect()->route('admin.tags.index');
    }

}
