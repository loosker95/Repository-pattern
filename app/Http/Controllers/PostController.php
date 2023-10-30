<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use App\Http\Requests\CreateRequest;


class PostController extends Controller
{
    private $postRepoClass;

    public function __construct(PostRepository $postRepoClass)
    {
        $this->postRepoClass = $postRepoClass;
    }

    public function index()
    {
        $data = $this->postRepoClass->getAll();
        return view('index')->with('posts', $data);
    }

    public function create()
    {
        return view('pages.create');
    }

    public function store(CreateRequest $request)
    {
        $this->postRepoClass->addPost($request);
        return to_route('index.post');
        // return redirect()->back()->with('success', 'Post submit succesfully');
    }

    public function show($slug)
    {
        $data = $this->postRepoClass->getOne($slug);
        return view('pages.show')->with('data', $data);
    }

    public function edit($id)
    {
        $data = $this->postRepoClass->changeEdit($id);
        return view('pages.edit')->with('post', $data);
    }

    public function update(CreateRequest $request, $id)
    {
        $this->postRepoClass->infosUpdate($request, $id);
        return redirect()->back()->with('success', 'Post Updated succesfully');
    }

    public function delete($id)
    {
        $this->postRepoClass->toTrash($id);
        return redirect()->back()->with('success', 'Post Deleted succesfully');
    }
}
