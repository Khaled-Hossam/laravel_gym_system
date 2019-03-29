<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Member;
use Carbon\Carbon;
use App\Notifications\MemberNotAvtiveNotification;

class NotifyNotActiveMembers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:members-not-logged-in-for-month';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $members = Member::where('last_login','<',Carbon::now()->subMonth())
            ->where('verified',1)->get();
        
        foreach ($members as $member){
            $member->notify(new MemberNotAvtiveNotification());
        }
    }
}
