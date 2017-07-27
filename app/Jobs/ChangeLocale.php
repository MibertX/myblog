<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\App;

class ChangeLocale implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $lang;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \App::setLocale($this->lang);

        session()->set('locale', $this->lang);
    }
}
