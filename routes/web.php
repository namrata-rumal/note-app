<?php


use App\Models\Note;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function (Illuminate\Http\Request $request) {

    $search = $request->search;

    $notes = Note::when($search, function ($query, $search) {

        $query->where('title', 'LIKE', "%{$search}%")
              ->orWhere('content', 'LIKE', "%{$search}%");

    })->latest()->paginate(3);

    return view('note.index', compact('notes'));

});

Route::get('/create',function(){
    return view('note.create');
});


Route::post('/store', function (Request $request) {

    $request->validate([
         'title' => 'required|max:255',
        'content' => 'required'
    ]);

    Note::create([
        'title' => $request->title,
        'content' => $request->content
    ]);

    return redirect('/');
});

Route::get('/edit/{id}',function($id){
    $note = Note::findOrFail($id);
    return view('note.edit',compact('note'));
});

Route::post('/update/{id}', function(Request $request, $id){
    $note = Note::findOrFail($id);
    $note->update([
        'title'=>$request->title,
        'content'=>$request->content
    ]);
    return redirect('/');
});

Route::get('/delete/{id}', function($id){
    $note = Note::findOrFail($id)->delete();

    return redirect('/');
});
// Route::get('/',[NoteController::class,'index']);
// Route::post('/note',[NoteController::class,'store']);