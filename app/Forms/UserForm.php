<?php

namespace Dark\Forms;

use Kris\LaravelFormBuilder\Form;

class UserForm extends Form
{
    public function buildForm()
    {
        $id = $this->getData('id');
        $this
            ->add('name', 'text', [
                'label' => 'Nome',
                'rules' => 'required|max:255|min:3'
            ])
            ->add('email', 'email', [
                'label' => 'Email',
                'rules' => "required|max:255|unique:users,email,{$id}"
            ]);
    }
}
