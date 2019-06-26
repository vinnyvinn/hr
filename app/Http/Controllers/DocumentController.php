<?php

namespace App\Http\Controllers;

use App\Mail\DocumentCreated;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use App\Document;
use App\Http\Requests\DocumentRequest;
use App\User;
use App\DocumentType;
use Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function index()
    {

        if(Auth::user()->role->layout ==1){
            $documents = Document::all();
        }
       else{
           $documents = Auth::user()->documents;
       }

		return view('documents.index', compact('documents'));
    }
	
	public function search(Request $request)
	{
				$users = User::whereRaw("(CONCAT(first_name,' ',last_name) like ?)", ['%'.$request->get('term').'%'])->get();
				$documents = Document::whereIn('user_id', $users->pluck('id'))->paginate(30);
			return view('documents.index', compact('documents'));

	}
    
    public function create(User $user)
    {

			$document_types = [''=>''] + DocumentType::pluck('document_type', 'id')->toArray();
			 if(User::find(Auth::id())->role->layout==0){
                 return view('documents.user_doc', compact('user', 'document_types'));
             }
			return view('documents.create', compact('user', 'document_types'))->with('employees',User::all());

    }
	
    public function store(DocumentRequest $request, User $user)
    {

        $image = $request->file('document');
        $name = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('documents/'),$name);

        Document::insert([
            'user_id' => $request->get('user_id') ? $request->get('user_id'): Auth::id() ,
            'document_type_id'  => $request->get('document_type_id'),
            'document' => $name
        ]);

        Mail::to('pj@wizag.biz')->send(new DocumentCreated());
		return redirect( 'all-documents')->withSuccess('Document has been saved.');

    }
	
    public function show($id)
    {

               $document = Document::findOrFail($id);
				$users = User::where('department_id', Auth::user()->department_id)->pluck('id');
				//$document = Document::where('id', $id)->whereIn('user_id', $users)->first();

			return $document ? response()->download(public_path('documents/'.$document->document)) : abort(403);

    }
	
    public function edit($id)
    {
		  $document=  Document::find($id);
		  $document_types = DocumentType::all();
		return view('documents.edit', compact('document', 'document_types'))->with('employees',User::all());

    }
	
    public function update(Request $request, $id)
    {
        $doc = Document::find($id);

        if ($request->has('file')) {
            $image = $request->file('document');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('documents/'), $name);
            $doc->document = $name;
            $doc->save();
        }
        $doc->user_id = $request->get('user_id');
        $doc->document_type_id =  $request->get('document_type_id');
        $doc->save();
			return redirect('all-documents')->withSuccess('Document has been updated.');

    }
	
    public function destroy($id)
    {

			 Document::findOrFail($id)->delete();
			 return redirect('all-documents')->withSuccess('Document has been deleted.');

    }
}
