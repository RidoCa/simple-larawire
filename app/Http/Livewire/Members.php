<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Member;
use Livewire\WithFileUploads;

class Members extends Component
{
    use WithFileUploads;
    public $members, $name, $email, $phone_number, $status, $member_id, $foto;
    public $isModal;
    
    public function render()
    {
        $this->members = Member::orderBy('created_at', 'DESC')->get();
        return view('livewire.members');
    }
    
    public function create(){
        $this->resetField();
        $this->openModal();
    }
    
    public function resetField(){
        $this->name = '';
        $this->email = '';
        $this->phone_number = '';
        $this->status = '';
        $this->member_id = '';
        $this->foto = '';
        
    }
    
    public function openModal(){
        $this->isModal = true;
    }
    
    public function closeModal(){
        $this->isModal = false;
        $this->resetField();
    }
    
    public function store(){
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:members,email,' .$this->member_id,
            'phone_number' => 'required|numeric',
            'status' => 'required',
            'foto' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
        ]);
        
        $filePath = $this->foto->store('public/photos');
        
        Member::updateOrCreate(
        
        ['id' => $this->member_id], 
        [
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'status' => $this->status,
            'foto' => $filePath,
            
        ]
        );
        
        session()->flash('message', $this->member_id ? 'Data member '.$this->name. ' Diperbarui':'Data member '.$this->name. ' Ditambahkan');
        $this->closeModal();
        $this->resetField();
    }
    
    public function edit($id){
        $member = Member::find($id);
        $this->member_id = $id;
        $this->name = $member->name;
        $this->email = $member->email;
        $this->phone_number = $member->phone_number;
        $this->status = $member->status;
        $this->openModal();
    }
    
    public function delete($id){
        $member = Member::find($id);
        $member->delete();
        session()->flash('message', 'Data Member '.$member->name. ' Dihapus');
    }
    
}
