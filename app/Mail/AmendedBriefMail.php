<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Brief;
use App\Department;
use PDF;

class AmendedBriefMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $brief_id;
    protected $updated_at;
    protected $jobnumber;
    protected $jobname;
    protected $projectmanager;
    protected $department_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\Brief $brief, $department_name)
    {
        $this->brief_id         = $brief->id;
        $this->updated_at       = $brief->updated_at->format('m/d/Y h:m');
        $this->jobnumber        = $brief->jobnumber;
        $this->jobname          = $brief->jobname;
        $this->projectmanager   = $brief->projectmanager;
        $this->department_name  = $department_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.amendedbriefemail')
                    ->attach($this->attachment())
                    ->with([
                        'updated_at'        => $this->updated_at,
                        'jobnumber'         => $this->jobnumber,
                        'jobname'           => $this->jobname,
                        'projectmanager'    => $this->projectmanager,
                        'department_name'   => $this->department_name,
                    ]);
    }

    public function attachment() 
    {
        $brief = Brief::find($this->brief_id);
        $departments = Department::isactive()->get();

        $pdf = PDF::loadView('pdf.amendedbriefpdf-1', compact('brief', 'departments'))->setPaper('a4');
        $save_directory = storage_path().'/app/temp/';
        $random_filename = str_random(10).'.pdf';
        $pdf->save($save_directory.$random_filename);

        return $save_directory.$random_filename;
    }
}
