<?php

namespace App\Mail;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DelPostMailable extends Mailable
{
    use Queueable, SerializesModels;
    protected $post;
    /**
     * Create a new message instance.
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * @return $this.
     */
    public function build()
    {
        return $this->markdown('mails.delete-post')
        ->subject("Your post has been deleted!")
        ->with('post', $this->post);
    }
}
