<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Task;

class NewTaskMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Instance of created Task
     * 
     * @var Task
     */
    protected $task;

    /**
     * Button URL to visualize task
     */
    protected $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
        $this->url = 'http://127.0.0.1:8000/task/'.$task->id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.new-task', [
            'task' => $this->task,
            'url' => $this->url,
        ])->subject('New task Created');
    }
}
