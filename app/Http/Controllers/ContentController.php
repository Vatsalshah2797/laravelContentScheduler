<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
//use App\Mail\ContentEmail;
use App\Http\Helpers\CommonTrait;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    use CommonTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $walletBalance = 0;
        //$contents = Post::where('user_id', $user->id)->count();
        //$transactions = Post::where('user_id', $user->id)->count();
        //$content = Post::where('user_id', $user->id)->count();
        if (!empty($user) && isset($user->id)) {
            $walletBalance = $this->getUserWalletBalance($user->id);
            //$walletBalance = (int)$walletBalance;
        }

        $contents = Content::latest()->paginate(5);
        return view('contents.index', compact('contents', 'user', 'walletBalance'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('contents.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'title' => 'required',
            'message' => 'required'
        ]);
  
        $input = $request->all();
        //$input['user_id'] = $user->id;
        // if ($image = $request->file('image')) {
        //     $destinationPath = 'image/';
        //     $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        //     $image->move($destinationPath, $profileImage);
        //     $input['image'] = "$profileImage";
        // }
    
        Content::create($input);
     
        return redirect()->route('contents.index')
                ->with('success', 'Content created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        return view('contents.show', compact('content'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit(Content $content)
    {
        $user = Auth::user();
        return view('contents.edit', compact('content', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Content $content)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required'
        ]);
  
        $input = $request->all();
  
        // if ($image = $request->file('image')) {
        //     $destinationPath = 'image/';
        //     $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        //     $image->move($destinationPath, $profileImage);
        //     $input['image'] = "$profileImage";
        // } else {
        //     unset($input['image']);
        // }
          
        $content->update($input);
    
        return redirect()->route('contents.index')
                ->with('success', 'content updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy(Content $content)
    {
        $content->delete();
     
        return redirect()->route('contents.index')
                ->with('success', 'content deleted successfully.');
    }

    public function sendEmail(Request $request)
    {
        $content = Content::find($request->input('content_id'));
        $userIds = $request->input('user_ids');

        // Load users based on selected user IDs
        $users = User::whereIn('id', $userIds)->get();

        foreach ($users as $user) {
            // Send email to each user
            //Mail::to($user->email)->send(new ContentEmail($content));
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Content sent successfully to selected users.');
    }

}
