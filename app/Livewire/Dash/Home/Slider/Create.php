<?php

namespace App\Livewire\Dash\Home\Slider;

use App\Models\HomeSlider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use withFileUploads;

    public ?array $form = [
        'title' => '',
        'image' => '',
        'link' => '',
        'status' => true,
    ];

    protected $rules = [
        'form.title' => 'required|string',
        'form.image' => 'required|image| mimes:jpeg,png,jpg,webp|max:1040',
        'form.link' => 'nullable|string',
        'form.status' => 'required|boolean',
    ];
    protected array $validationAttributes = [
        'form.title' => 'title',
        'form.image' => 'image',
        'form.link' => 'link',
        'form.status' => 'status',
    ];


    public function store()
    {
        $this->validate();


        $image = $this->form['image']->storeAs(
            'sliders',
            Str::slug($this->form['title']) . '.' . $this->form['image']->extension(),
            'public'
        );
        Storage::disk('local')->delete('livewire-tmp/' . $this->form['image']->getFilename());

        $slider = new HomeSlider();
        $slider->title = $this->form['title'];
        $slider->image = $image;
        $slider->link = $this->form['link'] ?? null;
        $slider->status = $this->form['status'];
        $slider->save();

        session()->flash('success', 'Slider created successfully');

        return $this->redirect(route('admin.slider.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.dash.home.slider.create', ['header' => 'Create Home Slider'])
            ->layout('layouts.app', ['title' => 'Create Home Slider']);
    }
}
