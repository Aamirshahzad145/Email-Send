<?php
  
namespace App\Mail;
  
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
  
class TestMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
  
    public $details;
    public $files;

    // public $pdf;
  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $files)
    {
        $this->details = $details;
        $this->files = $files;
        // $this->pdf =$pdf;
        // dd($this->files);
    }
  
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->subject('Test Mail From Aamir shahzad')
        //             ->view('email.Test_mail');
        return $this->subject('Test Mail From Aamir shahzad')
            ->markdown('email.Test_mail')
            ->attach($this->files)
            ->with([
                'url' => url('/register/'),
            ]);
        
    }
}