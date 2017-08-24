<?php

namespace Dark\Http\Controllers\Admin;

use Dark\Models\User;
use Illuminate\Http\Request;
use Dark\Http\Controllers\Controller;
use Dark\Forms\UserForm;
use Kris\LaravelFormBuilder\FormBuilder;

class UsersController extends Controller
{
    protected $formbuilder;
    protected $formclass = UserForm::class;
    protected $formOptions;

    public function __construct(FormBuilder $formBuilder)
    {
        $this->formbuilder = $formBuilder;
        $this->formOptionsCreate = ['url'  => route('admin.users.store'),'method' => 'POST'];
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->formbuilder->create($this->formclass, $this->formOptionsCreate);
        return view('admin.users.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = $this->formbuilder->create($this->formclass);
        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }
        $data = $form->getFieldValues();
        $data['password'] = str_random(6);
        User::create($data);
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Dark\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Dark\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $form = $this->formbuilder->create($this->formclass, [
                'url'  => route('admin.users.update', ['user' => $user->id]),
                'method' => 'PUT',
                'model' => $user
        ]);
        return view('admin.users.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Dark\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        $form = $this->formbuilder->create($this->formclass,[
            'data' => ['id' => $user->id]
        ]);
        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }
        $data = $form->getFieldValues();
        $user->update($data);
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Dark\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
