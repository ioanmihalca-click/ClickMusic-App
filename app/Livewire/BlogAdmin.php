<?php

namespace App\Livewire;

use App\Models\Post;
use Ramsey\Uuid\Uuid;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class BlogAdmin extends Component
{
    use WithFileUploads;

    public $posts, $title, $slug, $body, $meta_description, $featured_image, $published_at; 
// Remove 'is_published = false'
public $editing = false;
public $postId;

    // Form Validation Rules (Dynamic)
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:canvas_posts,slug,' . $this->postId, 
            'body' => 'required',
            'meta_description' => 'nullable|string|max:255', 
            'featured_image' => 'nullable|image|max:1024', // Max 1MB
            'published_at' => 'nullable|date',
        ];
    }

    // Lifecycle Methods
    public function mount()
    {
        $this->posts = Post::all();
        $this->editing = false;
    }

    public function render()
    {
        return view('livewire.blog-admin'); // Don't need to pass $editing here anymore
    }

    // Form Handling Methods
    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value); // Auto-generate slug
    }

    public function create()
    {
        $this->resetInputFields();
        $this->editing = true;
        $this->dispatch('editingStateChanged');
    }

    public function save()
    {
        $this->validate();

        $data = [
       
            'id' => (string) Uuid::uuid4(),  // Generate a UUID string
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            'meta' => ['description' => $this->meta_description],
            'published_at' => $this->published_at,
        ];

        if ($this->featured_image) {
            $data['featured_image'] = $this->featured_image->store('blog-images', 'public'); 
        }

        if ($this->postId) {
            Post::find($this->postId)->update($data);
            session()->flash('message', 'Post updated successfully.');
        } else {
            Post::create($data);
            session()->flash('message', 'Post created successfully.');
        }

        $this->resetInputFields();
        $this->editing = false;
        $this->posts = Post::all(); // Refresh post list
        $this->dispatch('editingStateChanged');
    }
    public function edit($id)
{
    $post = Post::findOrFail($id);

  // Manually set properties
  $this->postId = $post->id;
  $this->title = $post->title;
  $this->slug = $post->slug;
  $this->body = $post->body;
  $this->meta_description = $post->meta['description'] ?? '';
  $this->featured_image = $post->featured_image;
  $this->published_at = $post->published_at; // Set published_at directly 

  $this->editing = true;
  $this->dispatch('editingStateChanged');
}



public function delete($id)
    {
        DB::beginTransaction(); 
        
        Post::findOrFail($id)->forceDelete();
        $this->posts = Post::all(); // Refresh post list


        DB::commit();

        session()->flash('message', 'Post deleted successfully.');
        $this->dispatch('editingStateChanged');
    }

    public function resetInputFields()
    {
        $this->reset(['title', 'slug', 'body', 'meta_description', 'featured_image', 'published_at', 'postId']);
    }

    public function cancelEdit()
    {
        $this->resetInputFields();
        $this->editing = false;
        $this->dispatch('editingStateChanged');
    }
}
